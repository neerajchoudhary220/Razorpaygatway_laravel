<?php

use App\Events\TestEvent;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\Payment\RazorPayController;
use App\Http\Controllers\Web\AuthController as WebAuthController;
use App\Http\Controllers\Web\HomeController;
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

Route::name('web.')->group(function(){
    Route::get('login',[WebAuthController::class,'login'])->name('login.form');
    Route::get('sew',[HomeController::class,'index'])->name('welcome.page');
});


Route::controller(RazorPayController::class)->prefix('payment')->name('payment.')->group(function(){
    Route::get('/','index')->name('view');
    Route::get('create_customer','CreateCustomer')->name('create_customer');
    Route::get('get_customer','GetCustomer')->name('getCustomer');
    
});

Route::get('send/{data}',function($data){
    event(new TestEvent($data));
});

Route::get('check',function(){
    return view('Events.index');
});






Route::controller(LocationController::class)->group(function(){
Route::get('find','index');
Route::post('store','store')->name('location.store');
});

