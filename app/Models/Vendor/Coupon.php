<?php

namespace App\Models\Vendor;

use Carbon\Carbon;
use App\Enums\Vendor\CouponActive;
use App\Enums\Vendor\CouponAmountType;
use App\Enums\Vendor\CouponIsUnlimited;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Coupon extends Model
{
    use HasFactory, HasUuids;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'uuid',
        'coupon_code',
        'amount_type',
        'amount',
        'start_date',
        'expiry_date',
        'description',
        'allowed_time',
        'is_unlimited',
        'active'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'amount_type' => CouponAmountType::class,
        'is_unlimited' => CouponIsUnlimited::class,
        'active' => CouponActive::class
    ];

    public function uniqueIds()
    {
        return ['uuid'];
    }

    public function startDate(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value
                ? Carbon::parse($value)->format('d M, Y')
                : $value
        );
    }

    public function expiryDate(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value
                ? Carbon::parse($value)->format('d M, Y')
                : $value
        );
    }

    public function scopeGetList($query, $search, $sortField, $sortDirection)
    {
        if (!empty($search)) {
            $query->where(function ($subQuery) use ($search) {
                $subQuery->where('coupon_code', 'like', '%' . $search . '%')
                    ->orWhere('amount_type', 'like', '%' . $search . '%')
                    ->orWhere('amount', 'like', '%' . $search . '%')
                    ->orWhere('description', 'like', '%' . $search . '%')
                    ->orWhere('allowed_time', 'like', '%' . $search . '%')
                    ->status($search);
            });
        }

        return $query->orderBy($sortField, $sortDirection);
    }

    // exact match searching for status
    public function scopeStatus($query, $keyword)
    {
        if ($keyword == 'active' || $keyword == 'Active' || $keyword == 'ACTIVE') {
            return $query->orWhere('active', CouponActive::ACTIVE->value);
        }

        if ($keyword == 'inactive' || $keyword == 'Inactive' || $keyword == 'INACTIVE') {
            return $query->orWhere('active', CouponActive::INACTIVE->value);
        }
    }
}
