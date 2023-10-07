<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PlanSubscription extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'uuid',
        'name',
        'duration',
        'price',
        'discount',
        'trial_period_days',
        'description'
    ];

    protected $primaryKey = 'uuid';

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
}
