<?php

namespace App\Models\Vendor;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'customer_id',
        'type',
        'address_line1',
        'address_line2',
        'city',
        'state',
        'postal_code',
        'country',
        'lat',
        'lng',
        'default',
    ];


    public function scopeStoreForCustomer($query, $data, $customerId)
    {
        $data['customer_id'] = $customerId;
        return $query->create($data);
    }

}
