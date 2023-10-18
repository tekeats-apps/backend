<?php

namespace App\Models\Vendor;

use Illuminate\Database\Eloquent\Model;
use App\Enums\Vendor\DiscountActiveEnum;
use App\Enums\Vendor\DiscountTypeEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Discount extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'type', 'amount', 'active'];

    protected $casts = [
        'type' => DiscountTypeEnum::class
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
