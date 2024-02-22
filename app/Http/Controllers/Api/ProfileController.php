<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileRequest;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function Details(Request $request){
        $user = $request->user('api');
        $response = new UserResource($user);
        $data=[
            'message'=>'Success',
            'data'=>$response
        ];
        return response()->json($data);
    }

    public function updateProfile(ProfileRequest $request){
        
        $user = $request->user('api');
        $input = $request->only('name','email');
        $user->update($input);
        return response()->json([
            'msg'=>'User Profile updated successfully',
            'data' => new UserResource($user)
            
        ]);
    }
}
