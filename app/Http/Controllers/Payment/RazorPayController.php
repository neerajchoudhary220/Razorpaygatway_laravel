<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use App\Models\RazorPayWebhook;
use App\Models\Test;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Razorpay\Api\Api;

class RazorPayController extends Controller
{
    public function index()
    {

        return view('payments.index');
    }

    public function CreateCustomer(Request $request)
    {
        try {
            $key = env('RAZORPAY_KEY');
            $secret = env('RAZORPAY_SECRET');

            $api = new Api($key, $secret);

            $user = [
                'name' => 'Neeraj choudhary',
                'contact' => "9509797669",
                'email' => 'N/A'
            ];
            $result = $api->customer->create($user);
        } catch (\Exception $e) {
        }
    }

    public function webhooksTest(Request $request)
    {

        try {
            $webhookSecret = 'x8KXeNMn4@xQV26';
            $webhookSignature = $request->header('X-Razorpay-Signature');
            $api = new Api(config('app.RAZORPAY_KEY'), config('app.RAZORPAY_SECRET'));
            $api->utility->verifyWebhookSignature($request->all(), $webhookSignature, $webhookSecret);
            // $payload = $request->getContent();
            // $expectedSignature = hash_hmac('sha256', $payload, $webhookSecret);

            log::debug($request->all());
            // if (!empty($request['event'])) {
            //     $payment_ev = $request['event'];
            //     $payment_ba = $request['payload']['payment']['entity'];
            //     if ($payment_ev == 'payment.captured') {
            //         $payment_id = $payment_ba['id'];
            //         $order_id = $payment_ba['order_id'];
            //     }

            //     if ($payment_ev == 'payment.failed') {
            //         $payment_id = $payment_ba['id'];
            //         $order_id = $payment_ba['order_id'];
            //     }
            //     RazorPayWebhook::create([
            //         'payment_id'=>$payment_id,
            //         'payment_order_id'=>$order_id,
            //         'currency'=>$payment_ba['currency'],
            //         'email'=>$payment_ba['email'],
            //         'contact'=>$payment_ba['contact'],
            //         'amount'=>$payment_ba['amount'],
            //         'status'=>$payment_ba['status'],
            //         'event'=>$payment_ba['event']
            //     ]);
            // }
        } catch (\Exception $e) {
            Log::error($e);
        }
    }

    public function webhooks(Request $request)
    {
        try {
            $webhookSecret = 'x8KXeNMn4@xQV26';
            $webhookSignature = $request->header('X-Razorpay-Signature');
            // $api = new Api(config('app.RAZORPAY_KEY'),config('app.RAZORPAY_SECRET'));
            // $api->utility->verifyWebhookSignature($request->all(), $webhookSignature, $webhookSecret);
            $payload = $request->getContent();
            $expectedSignature = hash_hmac('sha256', $payload, $webhookSecret);

            // Log::debug($request->all());
            if ($webhookSignature == $expectedSignature) {
                $payment_ba = $request['payload']['payment']['entity'];
             
            //  $data=   RazorPayWebhook::updateOrCreate(
            //         [
            //             'payment_id' => $payment_ba['id']
            //         ],
            //         [
            //             'payment_id' => $payment_ba['id'],
            //             'payment_order_id' => $payment_ba['order_id'] ?? null,
            //             'currency' => $payment_ba['currency'],
            //             'email' => $payment_ba['email'],
            //             'contact' => $payment_ba['contact'],
            //             'amount' => $payment_ba['amount'],
            //             'status' => $payment_ba['status'],
            //             'event' => $payment_ba['event'] ?? null,
            //         ]
            //     );
                $data =  RazorPayWebhook::create([
                    'payment_id' => $payment_ba['id'],
                    'payment_order_id' => $payment_ba['order_id'] ?? null,
                    'currency' => $payment_ba['currency'],
                    'email' => $payment_ba['email'],
                    'contact' => $payment_ba['contact'],
                    'amount' => $payment_ba['amount'],
                    'status' => $payment_ba['status'],
                    'event' => $payment_ba['event'] ?? null,
                ]);
                Log::alert($data);
            }
        } catch (\Exception $e) {
            Log::error($e);
        }
    }


    public function GetCustomer()
    {
        try {
            $api = new Api('rzp_test_8Pa3NdNZRHaNFT', 'vELzdKxNCbSoKlE87KOv00VH');
            $customer = $api->customer->fetch('cust_NSSvY4Q6iOZSBR');

        } catch (\Exception $e) {
            dd($e);
        }
    }
}
