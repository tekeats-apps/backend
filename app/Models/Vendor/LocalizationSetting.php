<?php

namespace App\Models\Vendor;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LocalizationSetting extends Model
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
