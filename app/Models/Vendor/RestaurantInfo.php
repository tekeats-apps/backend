<?php

namespace App\Models\Vendor;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RestaurantInfo extends Model
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
        'name',
        'email',
        'phone',
        'address',
        'address_2',
        'country',
        'city',
        'latitude',
        'longitude',
    ];
}
