<?php

namespace App\Models\Vendor;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'customer_id',
        'rider_id',
        'address_id',
        'status',
        'payment_method',
        'order_type',
        'coupon_code',
        'notes',
        'subtotal_price',
        'total_price',
        'delivered_at'
    ];

    protected $dates = [
        'delivered_at',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function address()
    {
        return $this->belongsTo(Address::class);
    }

    public function rider()
    {
        return $this->belongsTo(Rider::class);
    }

    public function transactions()
    {
        return $this->hasMany(OrderTransaction::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($order) {
            $order->order_id = 'ORD-' . strtoupper(Str::random(10));
        });
    }
}
