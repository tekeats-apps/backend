<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    public function scopeCreateNewOrder($query, $data){

        $order = new Order();
        $order->invoice_no = Str::random(8);
        $order->customer_name = $data['customer_name'];
        $order->email = $data['customer_email'];
        $order->transaction_id = strtolower(Str::random(15));
        $order->payment_status = $data['payment_status'];
        $order->status = $data['status'];
        $order->save();

        return $order;
    }

    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }
}
