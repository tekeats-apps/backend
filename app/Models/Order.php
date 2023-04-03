<?php

namespace App\Models;

use Carbon\Carbon;
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

    public function scopeGetOrdersList($query,$search,$status, $paymentStatus,$startDate, $endDate, $sortField, $sortDirection){
        if (!empty($search)) {
            $query->where(function ($q) use($search) {
                $q->where('customer_name', 'like', '%' . $search . '%')
                    ->orWhere('email', 'like', '%' . $search . '%')
                    ->orWhere('invoice_no', 'like', '%' . $search . '%')
                    ->orWhere('payment_status', 'like', '%' . $search . '%');
            });
        }
        if (!empty($startDate)) {
            $startDate = Carbon::parse($startDate);
            $endDate = Carbon::parse($endDate ?? $startDate)->endOfDay();
            $query->whereBetween('created_at', [$startDate, $endDate]);
        }

        if (!empty($status)) {
            $query->where('status', $status);
        }
        if (!empty($paymentStatus)) {
            $query->where('payment_status', $paymentStatus);
        }

        return $query->orderBy($sortField, $sortDirection);
    }

    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }
}
