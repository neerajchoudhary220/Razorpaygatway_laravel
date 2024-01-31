<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RazorPayTransaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id', 'user_id', 'razorpay_order_id',
        'amount', 'amount_due', 'amount_paid', 'receipt', 'status',
        'attempts', 'notes', 'order_date'
    ];

    protected $casts =[
        'notes'=>'array'
    ];
}
