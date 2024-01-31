<?php
namespace App\Helpers;

use Razorpay\Api\Api;

class Helper {

    public static function Razorpay(){
        $key = config('app.RAZORPAY_KEY');
        $secret = config('app.RAZORPAY_SECRET');
        $razorpay = new Api($key,$secret);
        return  $razorpay;
    }   
}
