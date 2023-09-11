<?php

namespace App\Models\Vendor;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderTransaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id', 'transaction_id', 'amount', 'status', 'payment_method', 'response'
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
