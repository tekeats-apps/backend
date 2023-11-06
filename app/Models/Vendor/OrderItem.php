<?php

namespace App\Models\Vendor;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'product_id',
        'variant_id',
        'extras',
        'price',
        'quantity',
        'special_instructions',
        'subtotal',
        'total'
    ];

    protected $casts = [
        'extras' => 'array',
    ];
}
