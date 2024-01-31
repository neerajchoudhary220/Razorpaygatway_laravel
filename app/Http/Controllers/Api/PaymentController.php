<?php

namespace App\Http\Controllers\Api;

use App\Helpers\Helper;
use App\Http\Controllers\Controller;
use App\Http\Resources\PaymentDetailsResource;
use App\Http\Resources\RazorpayOrderResource;
use App\Http\Resources\RazorpayOrerResource;
use App\Models\Order;
use Illuminate\Http\Request;
use Razorpay\Api\Api;



class PaymentController extends Controller
{
   
    public function GetAllPaymentDetails(Request $request){
        
        $razorpay = Helper::Razorpay();
        $all = $razorpay->payment->all(['count'=>$request->count]);
        $data = PaymentDetailsResource::collection($all['items']);
        return response()->json([
            'data'=>$data
        ]);
       
        
    }

    public function specific_payment(Request $request){
        $key = config('app.RAZORPAY_KEY');
        $secret = config('app.RAZORPAY_SECRET');
        $razorpay = new Api($key,$secret);
        $res = $razorpay->payment->fetch($request->paymentId);
        $data = new PaymentDetailsResource($res);
        return response()->json([
            'data'=>$data
        ]);
    }


    public function CreateOrder(Request $request){
        $razorpay = Helper::Razorpay();
        $order = Order::find($request->order_id);
        $user = $request->user('api');
        
        $input =[
            'amount'=>(float)$order->amount,
            'currency'=>'INR',
            'receipt'=>'Order Create From App',
            'notes'=>[
                'description'=>'Order for abc'
            ]
            ];
        $res = $razorpay->order->create($input);
        $data= new RazorpayOrderResource($res);
        
       $order->razorpaytransaction()->create([
        'user_id'=>$user->id,
        'razorpay_order_id'=>$data['id'],
        'amount'=>$data['amount'],
        'amount_due'=>$data['amount_due'],
        'amount_paid'=>$data['amount_paid'],
        'receipt'=>$data['receipt'],
        'status'=>$data['status'],
        'attempts'=>$data['attempts'],
        'order_date'=>$data['created_at'],
        'notes'=>$data['notes']
       ]);

        return response()->json([
            'data'=>$data,
            'msg'=>'Order created successfully'
        ]);
    }
}
