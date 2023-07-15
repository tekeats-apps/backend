<?php

namespace App\Models\Vendor;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LocalizationSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'languages',
        'default_language',
        'timezone',
        'date_format',
        'time_format',
        'currency',
        'currency_symbol',
        'currency_position',
    ];

    protected $casts = [
        'languages' => 'array',
    ];
}
