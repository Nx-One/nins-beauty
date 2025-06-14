<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'order_id',
        'method',
        'payment_date',
        'total_amount',
        'proof_image',
        'status',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
