<?php

namespace App\Models\Vendor;

use App\Enums\Vendor\TaxActive;
use App\Enums\Vendor\TaxType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tax extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['title', 'description', 'type', 'amount', 'active'];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'type' => TaxType::class,
        'active' => TaxActive::class
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
            return $query->orWhere('active', TaxActive::ACTIVE->value);
        }

        if ($keyword == 'inactive' || $keyword == 'Inactive' || $keyword == 'INACTIVE') {
            return $query->orWhere('active', TaxActive::INACTIVE->value);
        }
    }
}
