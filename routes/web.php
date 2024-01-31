<?php

use App\Http\Controllers\Payment\RazorPayController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::controller(RazorPayController::class)->prefix('payment')->group(function(){
    Route::get('/','index');
    Route::get('create_customer','CreateCustomer');
    Route::get('get_customer','GetCustomer');
    Route::post('webhook','webhooksTest');
});

