<?php

namespace App\Models\Vendor;

use App\Enums\Vendor\DiscountType;
use App\Enums\Vendor\DiscountActive;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Discount extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'type', 'amount', 'active'];

    protected $casts = [
        'type' => DiscountType::class,
        'active' => DiscountActive::class
    ];

    public function scopeGetList($query, $search, $sortField, $sortDirection)
    {
        if (!empty($search)) {
            $query->where(function ($subQuery) use ($search) {
                $subQuery->where('title', 'like', '%' . $search . '%')
                    ->orWhere('description', 'like', '%' . $search . '%')
                    ->orWhere('type', 'like', '%' . $search . '%')
                    ->orWhere('amount', 'like', '%' . $search . '%')
                    ->status($search);
            });
        }

        return $query->orderBy($sortField, $sortDirection);
    }

    // exact match searching for status
    public function scopeStatus($query, $keyword)
    {
        if ($keyword == 'active' || $keyword == 'Active' || $keyword == 'ACTIVE') {
            return $query->orWhere('active', DiscountActive::ACTIVE->value);
        }

        if ($keyword == 'inactive' || $keyword == 'Inactive' || $keyword == 'INACTIVE') {
            return $query->orWhere('active', DiscountActive::INACTIVE->value);
        }
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class);
    }
}
