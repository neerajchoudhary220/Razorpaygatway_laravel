<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RazorpayOrderResource extends JsonResource
{
    public $customer_id;
    public function __construct($resource, $customer_id){
        parent::__construct($resource);
        $this->resource = $resource;
        $this->customer_id = $customer_id;
    }
    public function toArray(Request $request): array
    {
        $data = parent::toArray($request);
        $data['customer_id'] =$this->customer_id;
        return $data;
        
}
}
