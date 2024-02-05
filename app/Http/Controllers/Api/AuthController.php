<?php

namespace App\Http\Controllers\Api;

use App\Events\TestEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\SignUpRequest;
use App\Http\Resources\UserResource;
use App\Models\Test;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    public function SignUp(SignUpRequest $request){
        try {
            $input = $request->only('name','mobile','password');
            DB::beginTransaction();
            $user = User::create($input);
            $res = new UserResource($user);
            $token = $user->createToken('authToken')->accessToken;
            DB::commit();
            return response()->json([
                'data'=>$res,
                'token'=>$token,
            ]);
            
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e); 
        }
    }

    public function Login(LoginRequest $request){
       $input = $request->only('mobile','password');
       if(!auth()->attempt($input)){
        return response()->json([
            'message'=>'Password or mobile did not matched',
        
        ],401);
       }
       $token = auth()->user()->createToken('authToken')->accessToken;
       $response = new UserResource(auth()->user());
       $data =[
        'data'=>$response,
        'message'=>'Login Successfully',
        'token'=>$token
       ];
    //    event(new TestEvent(['msg'=>'User Login Successfully']));
       return response()->json($data);
    }


    public function Logout(Request $request){
        $request->user('api')->token()->revoke();
        return response()->json([
            'message'=>'Logout successfully'
        ]);
    }

    
}
