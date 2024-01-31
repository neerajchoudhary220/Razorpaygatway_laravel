<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\OrderRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function store(OrderRequest $request){
        $input = $request->only('amount');
        $user =$request->user('api');
        $orderData =$user->orders()->create($input);
        return response()->json([
            'data'=>$orderData,
            'msg'=>'success',
        ]);   
    }   
}
