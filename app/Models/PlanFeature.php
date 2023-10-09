<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class PlanFeature extends Model
{
    use HasFactory;

    protected $fillable = ['feature_name', 'feature_description'];

    public function scopeGetList($query, $search, $sortField, $sortDirection)
    {
        if (!empty($search)) {
            $query->where(function ($subQuery) use ($search) {
                $subQuery->where('feature_name', 'like', '%' . $search . '%')
                    ->orWhere('feature_description', 'like', '%' . $search . '%');
            });
        }

        return $query->orderBy($sortField, $sortDirection);
    }

    public function planSubscriptions(): BelongsToMany
    {
        return $this->belongsToMany(PlanSubscription::class, 'plan_feature_pivot', 'feature_id', 'plan_id', 'id', 'id');
    }
}
