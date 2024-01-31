<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
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
    public function update(Request $request){
        $user = $request->user('api');
    }
}
