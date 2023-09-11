<?php

namespace App\Models\Vendor;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RestaurantMedia extends Model
{
    use HasFactory;

    const IMAGE_PATH = 'settings/media';

    protected $fillable = [
        'logo',
        'favicon'
    ];

    protected function getLogoAttribute($value)
    {
        $image = '';
        if ($value) {
            $path = RestaurantMedia::IMAGE_PATH . '/' . $value;
            $image = tenant_asset($path);
        }

        return $image;
    }

    protected function getFaviconAttribute($value)
    {
        $image = '';
        if ($value) {
            $path = RestaurantMedia::IMAGE_PATH . '/' . $value;
            $image = tenant_asset($path);
        }

        return $image;
    }
}
