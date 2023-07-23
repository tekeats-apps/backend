<?php

namespace App\Models\Vendor;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RestaurantOpeningHour extends Model
{
    use HasFactory;

    public const DAYS = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];

    protected $fillable = ['day', 'is_closed'];

    public function slots()
    {
        return $this->hasMany(Slot::class);
    }
}
