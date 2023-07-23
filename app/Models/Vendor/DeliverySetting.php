<?php

namespace App\Models\Vendor;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliverySetting extends Model
{
    use HasFactory;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        if (request()->capture()->is('api/*')) {
            $this->hidden = array_merge($this->hidden, ['id']);
        }
    }

    const DELIVERY_UNITS = [
        'kilometers',
        'miles',
        'meters'
    ];

    protected $fillable = [
        'free_delivery',
        'delivery_unit',
        'delivery_radius',
        'delivery_charges',
        'additional_charges'
    ];
}
