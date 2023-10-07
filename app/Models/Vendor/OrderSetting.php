<?php

namespace App\Models\Vendor;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderSetting extends Model
{
    use HasFactory;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        if (request()->capture()->is('api/*')) {
            $this->hidden = array_merge($this->hidden, ['id']);
        }
    }

    protected $fillable = [
        'dine_in',
        'pickup',
        'delivery',
        'cash_on_delivery',
        'stripe',
        'paypal',
        'orders_auto_accept',
        'allow_special_instructions',
        'allow_order_discounts',
        'minimum_order',
        'order_preparation_time',
        'order_lead_time',
        'order_cutoff_time',
    ];
}
