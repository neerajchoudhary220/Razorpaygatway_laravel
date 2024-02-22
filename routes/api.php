<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\api\OrderController;
use App\Http\Controllers\Api\PaymentController;
use App\Http\Controllers\Api\ProfileController;
use App\Http\Controllers\Payment\RazorPayController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



Route::post('signup',[AuthController::class,'SignUp']);
Route::post('login',[AuthController::class,'Login']);

Route::post('webhook',[RazorPayController::class,'webhooks']);

Route::controller(PaymentController::class)->prefix('payment')->group(function(){
        Route::get('/','specific_payment');
        Route::get('all','GetAllPaymentDetails');
        Route::patch('create_order','CreateOrder');
});

Route::controller(OrderController::class)->prefix('order')->group(function(){
    Route::post('store','store');
});
Route::middleware('auth:api')->group(function(){
    
    Route::get('logout',[AuthController::class,'Logout']);
        Route::controller(ProfileController::class)->prefix('profile')->group(function(){
            Route::get('details','Details');
            Route::patch('update','updateProfile');
        });

    Route::get('payment/create-customer',[RazorPayController::class,'CreateCustomer']);
   
});

