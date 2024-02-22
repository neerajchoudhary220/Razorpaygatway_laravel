<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use App\Http\Resources\RazorpayCustomerResource;
use App\Models\RazorpayCustomer;
use App\Models\RazorPayTransaction;
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
            $key = config('app.RAZORPAY_KEY');
            $secret = config('app.RAZORPAY_SECRET');

            $api = new Api($key, $secret);
            $user = $request->user('api');

            $data = [
                'name' => $user->name,
                'contact' => $user->mobile,
                'email' => $user->email
            ];
            $result = $api->customer->create($data);
            $user->razorpayCustomer()->create([
                'customer_id' => $result['id'],
                'entity' => $result['entity']
            ]);

            $results = new RazorpayCustomerResource($result);
            return response()->json([
                'data' => $results
            ]);

            // return $result;
        } catch (\Exception $e) {
            Log::error($e->getMessage());
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


            if ($webhookSignature == $expectedSignature) {
                $payment = $request['payload']['payment']['entity'];



                if ($request->event == 'payment.captured')
                    $data =  RazorPayWebhook::create([
                        'payment_id' => $payment['id'],
                        'payment_order_id' => $payment['order_id'] ?? null,
                        'currency' => $payment['currency'],
                        'email' => $payment['email'],
                        'contact' => $payment['contact'],
                        'amount' => ((float)$payment['amount']) / 100,
                        'status' => $payment['status'],
                        'event' => $payment['event'] ?? null,
                    ]);

                if ($payment['order_id']) {
                    $RazorPayTransaction = RazorPayTransaction::where('razorpay_order_id', $payment['order_id']);
                    if ($payment['status'] == 'authorized') {
                        $RazorPayTransaction->clone()->update(['status' => 'attempted']);
                    }
                    if ($payment['status'] == 'failed') {
                        $RazorPayTransaction->clone()->update(['status' => 'failed']);
                    }
                }

                if ($request->event == "order.paid") {
                    $order = $request['payload']['order']['entity'];
                    RazorPayTransaction::where('razorpay_order_id', $order['id'])
                        ->update([
                            'amount_paid' => ((float)$order['amount_paid']) / 100,
                            'amount_due' => ($order['amount_due'] > 0) ? ((float)$order['amount_due'] / 100) : $order['amount_due'],
                            'status' => $order['status'],
                            'attempts' => $order['attempts'],
                        ]);
                }
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
