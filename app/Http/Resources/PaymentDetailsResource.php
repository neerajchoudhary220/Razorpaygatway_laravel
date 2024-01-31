<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PaymentDetailsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        
        return [
            'payment_id'=>$this->id,
            'entity'=>$this->entity,
            'amount'=>$this->amount,
            'status'=>$this->status,
            'method'=>$this->method,
            'amount_refunded'=>$this->amount_refunded,
            'refund_status'=>$this->refund_status,
            'captured'=>$this->captured,
            'description'=>$this->description,
            'bank'=>$this->bank??'N/A',
            'wallet'=>$this->wallet??'N/A',
            'vpa'=>$this->vpa??'N/A',
            'email'=>$this->email,
            'contact'=>$this->contact,
            'token_id'=>$this->token_id??null,
            'fee'=>$this->fee,
            'created_at'=>Carbon::parse($this->created_at)->format('Y-m-d, g:i A'),
            'card_id'=>$this->card_id,
            'card'=> new PaymentCardResource($this->card)
        ];
    }
}
