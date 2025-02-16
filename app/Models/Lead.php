<?php

namespace App\Models;

use App\Enums\LeadStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Lead extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'restaurant_name',
        'full_name',
        'email',
        'phone',
        'business_size',
        'experience_level',
        'system_goals',
        'status',
        'reason'
    ];

    protected $casts = [
        'system_goals' => 'array',
        'status' => LeadStatus::class
    ];

    public function routeNotificationForMail()
    {
        return $this->email;
    }

    public function getExperienceLevelAttribute()
    {
        return ucfirst(str_replace('-', ' ', $this->attributes['experience_level']));
    }

    public function statusHistories()
    {
        return $this->hasMany(LeadStatusHistory::class)->orderBy('created_at', 'desc');
    }

    public function getAvailableStatusTransitions(): array
    {
        if (!$this->status instanceof LeadStatus) {
            return [];
        }

        return $this->status->getAllowedTransitions();
    }

     /**
     * Check if lead can transition to given status
     */
    public function canTransitionTo(LeadStatus $status): bool
    {
        if (!$this->status instanceof LeadStatus) {
            return false;
        }

        return $this->status->canTransitionTo($status);
    }
}
