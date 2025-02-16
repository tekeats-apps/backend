<?php

namespace App\Models\Vendor;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlatformPlugin extends Model
{
    use HasFactory;

    protected $fillable = ['plugin_id', 'settings', 'enabled'];
    
    protected $casts = [
        'enabled' => 'boolean',
        'settings' => 'array',
    ];
}
