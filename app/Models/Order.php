<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'order_date',
        'status',
        'user_id',
        'total_amount',
        'full_name',
        'address',
        'phone',
        'payment_method',
        'payment_proof',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class);
    }
}
