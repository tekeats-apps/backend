<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Plugin extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'id',
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
                    ->orWhere('version', 'like', '%' . $search . '%')
                    ->orWhereHas('type', function ($query) use ($search) {
                        $query->where('name', 'like', '%' . $search . '%');
                    });
            });
        }

        return $query->orderBy($sortField, $sortDirection);
    }

    public function isPaid(): Attribute
    {
        return new Attribute(
            set: fn ($value) => $value === 'on' ? 1 : 0
        );
    }

    public function active(): Attribute
    {
        return new Attribute(
            set: fn ($value) => $value === 'on' ? 1 : 0
        );
    }

    public function featured(): Attribute
    {
        return new Attribute(
            set: fn ($value) => $value === 'on' ? 1 : 0
        );
    }

    public function type(): BelongsTo
    {
        return $this->belongsTo(PluginType::class, 'plugin_type_id');
    }
}
