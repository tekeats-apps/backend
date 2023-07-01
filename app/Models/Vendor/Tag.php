<?php

namespace App\Models\Vendor;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tag extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'status'
    ];

    protected $casts = [
        'status' => 'boolean'
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }

    public function scopeList($query, $search = '', $sortField = 'id', $sortDirection = 'desc')
    {
        if (!empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%');
            });
        }

        if (!empty($status)) {
            $query->where('status', $status);
        }
        return $query->orderBy($sortField, $sortDirection);
    }

    public function scopeCreateTag($query, array $validatedData)
    {
        return $query->create($validatedData);
    }

    public function scopeGetTagByID($query, int $id)
    {
        return $query->findOrFail($id);
    }

    public function scopeGetActiveTags($query, $sortField = 'id', $sortDirection = 'desc')
    {
        $query->where('status', 1);

        return $query->orderBy($sortField, $sortDirection);
    }

    public function scopeUpdateTag($query, int $id, array $validatedData)
    {
        $query->findOrFail($id);
        $query->update($validatedData);
        return $query;
    }
}
