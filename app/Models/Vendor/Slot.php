<?php

namespace App\Models\Vendor;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slot extends Model
{
    use HasFactory;

    protected $fillable = ['restaurant_opening_hour_id', 'open_time', 'close_time'];

    public function openingHours()
    {
        return $this->belongsTo(RestaurantOpeningHour::class, 'restaurant_opening_hour_id');
    }
}
