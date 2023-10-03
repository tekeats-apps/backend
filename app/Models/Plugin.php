<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Plugin extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'uuid',
        'plugin_type_id',
        'name',
        'image',
        'documentation',
        'video',
        'description',
        'version',
        'is_paid',
        'price',
        'active',
        'featured'
    ];

    protected $primaryKey = 'uuid';

    public function scopeGetList($query, $search, $sortField, $sortDirection)
    {
        if (!empty($search)) {
            $query->where(function ($subQuery) use ($search) {
                $subQuery->where('name', 'like', '%' . $search . '%')
                    ->orWhere('description', 'like', '%' . $search . '%')
                    ->orWhere('version', 'like', '%' . $search . '%');
            });
        }

        return $query->orderBy($sortField, $sortDirection);
    }
}
