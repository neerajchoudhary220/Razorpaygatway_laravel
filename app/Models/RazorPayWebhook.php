<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RazorPayWebhook extends Model
{
    use HasFactory;

    protected $fillable = [
        'payment_id', 'payment_order_id', 'currency', 'amount',
         'email', 'contact', 'event', 'status'
    ];
}
