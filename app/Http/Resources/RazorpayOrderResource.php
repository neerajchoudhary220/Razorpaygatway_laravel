<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RazorpayOrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return parent::toArray($request);
        // dd($this);
        // return [
        //     'order_id'=>$this->id,
        //     'entity'=>$this->entity,
        //     'amount'=>((float)$this->amount)/100,
        //     'amount_due'=>((float)$this->amount_due/100),
        //     'amount_paid'=>$this->amount_paid,
        //     'currency'=>$this->currency,
        //     'receipt'=>$this->receipt,
        //     'offer_id'=>$this->offer_id,
        //     'status'=>$this->status,
        //     'attempts'=>$this->attempts,
        //     'created_at'=>$this->created_at,
        //     'notes'=>new RazorPayNotesResource($this->notes),
        // ];
    }
}
