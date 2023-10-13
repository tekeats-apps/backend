<?php

namespace App\Models\Vendor;

use App\Enums\Vendor\Tax\TypeEnum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tax extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'type', 'amount', 'active'];

    protected $casts = [
        'type' => TypeEnum::class
    ];

    public function scopeGetList($query, $search, $sortField, $sortDirection)
    {
        if (!empty($search)) {
            $query->where(function ($subQuery) use ($search) {
                $subQuery->where('title', 'like', '%' . $search . '%')
                    ->orWhere('description', 'like', '%' . $search . '%')
                    ->orWhere('type', 'like', '%' . $search . '%')
                    ->orWhere('amount', 'like', '%' . $search . '%');
            });
        }

        return $query->orderBy($sortField, $sortDirection);
    }
}
