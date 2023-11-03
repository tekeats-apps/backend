<?php

namespace App\Models\Admin;

use Bpuig\Subby\Models\Plan as PlanModel;

class Plan extends PlanModel
{
    public function scopeGetList($query, $search = '', $sortField = 'id', $sortDirection = 'desc')
    {
        if (!empty($search)) {
            $query->where(function ($subQuery) use ($search) {
                $subQuery->where('name', 'like', '%' . $search . '%')
                    ->orWhere('description', 'like', '%' . $search . '%')
                    ->orWhere('tag', 'like', '%' . $search . '%')
                    ->orWhere('price', 'like', '%' . $search . '%');
            });
        }

        return $query->orderBy($sortField, $sortDirection);
    }
}
