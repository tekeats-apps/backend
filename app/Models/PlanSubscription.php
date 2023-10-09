<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasEvents;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class PlanSubscription extends Model
{
    use HasFactory, HasUuids, HasEvents;

    protected $fillable = [
        'uuid',
        'name',
        'duration',
        'price',
        'discount',
        'trial_period_days',
        'description'
    ];

    // protected $primaryKey = 'uuid';

    public function uniqueIds()
    {
        return ['uuid'];
    }

    public function scopeGetList($query, $search, $sortField, $sortDirection)
    {
        if (!empty($search)) {
            $query->where(function ($subQuery) use ($search) {
                $subQuery->where('name', 'like', '%' . $search . '%')
                    ->orWhere('description', 'like', '%' . $search . '%')
                    ->orWhere('duration', 'like', '%' . $search . '%')
                    ->orWhere('price', 'like', '%' . $search . '%')
                    ->orWhere('discount', 'like', '%' . $search . '%')
                    ->orWhere('trial_period_days', 'like', '%' . $search . '%');
            });
        }

        return $query->orderBy($sortField, $sortDirection);
    }

    public function planFeatures(): BelongsToMany
    {
        return $this->belongsToMany(PlanFeature::class, 'plan_feature_pivot', 'plan_id', 'feature_id', 'id', 'id');
    }
}
