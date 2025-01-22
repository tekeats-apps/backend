<?php

namespace App\Models;

use App\Enums\LeadStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Lead extends Model
{
    use HasFactory;

    protected $fillable = [
        'full_name',
        'email',
        'phone',
        'business_size',
        'experience_level',
        'system_goals',
        'status'
    ];

    protected $casts = [
        'system_goals' => 'array',
        'status' => LeadStatus::class
    ];
}
