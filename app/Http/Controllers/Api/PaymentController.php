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

        $customer_id ='';
        
        //Create Razorpay Customer
      if(empty($user->razorpayCustomer)){
        $data = [
            'name' => $user->name,
            'contact' => $user->mobile,
            'email' => $user->email
        ];
        $result = $razorpay->customer->create($data);
        $user->razorpayCustomer()->create([
            'customer_id' => $result['id'],
            'entity' => $result['entity']
        ]);

        $customer_id =$result['id'];
      }else{
        $customer_id =$user->razorpayCustomer->customer_id;
      }

       



        $input =[
            'amount'=>((float)$order->amount)*100,
            'currency'=>'INR',
            'receipt'=>'Order Create From App',
            'notes'=>[
                'description'=>'Order for abc'
            ]
            ];

        $res = $razorpay->order->create($input);
        $data= new RazorpayOrderResource($res,$customer_id);
        
       $order->razorpaytransaction()->create([
        'user_id'=>$user->id,
        'razorpay_order_id'=>$data['id'],
        'amount'=>(float)$data['amount']/100,
        'amount_due'=>((float)$data['amount_due'])/100,
        'amount_paid'=>((float)$data['amount_paid'])/100,
        'receipt'=>$data['receipt'],
        'status'=>$data['status'],
        'attempts'=>$data['attempts'],
        'order_date'=>$data['created_at'],
        'notes'=>[
            "description"=>$data['notes']['description']
        ],
       ]);

        return response()->json([
            'data'=>$data,
            'msg'=>'Order created successfully'
        ]);
    }
}
