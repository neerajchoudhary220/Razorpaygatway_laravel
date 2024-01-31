<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PaymentCardResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        
        return [
            'id'=>$this->id,
            'entity'=>$this->entity,
            'name'=>$this->name,
            'last4digt'=>$this->last4,
            'card_name'=>$this->network,
            'type'=>$this->type,
            'issuer'=>$this->issuer,
            'international'=>$this->international,
            'emi'=>$this->emi,
            'sub_type'=>$this->sub_type,
            'token_iin'=>$this->token_iin,
        ];
    }
}
