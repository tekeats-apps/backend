<?php

namespace App\Models\Vendor;

use App\Enums\Vendor\CouponActive;
use Carbon\Carbon;
use Illuminate\Support\Str;
use App\Enums\Vendor\CouponType;
use App\Enums\Vendor\CouponOption;
use App\Enums\Vendor\CouponAmountType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Coupon extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'vendor_id',
        'coupon_option',
        'coupon_code',
        'type',
        'amount_type',
        'amount',
        'expiry_date',
        'active'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'coupon_option' => CouponOption::class,
        'type' => CouponType::class,
        'amount_type' => CouponAmountType::class,
        'active' => CouponActive::class
    ];

    public function couponCode(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => $value = $this->coupon_option->value == CouponOption::AUTOMATIC->value
                ? Str::random(8)
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
                $subQuery->where('coupon_option', 'like', '%' . $search . '%')
                    ->orWhere('coupon_code', 'like', '%' . $search . '%')
                    ->orWhere('type', 'like', '%' . $search . '%')
                    ->orWhere('amount_type', 'like', '%' . $search . '%')
                    ->orWhere('amount', 'like', '%' . $search . '%')
                    ->orWhere('expiry_date', 'like', '%' . $search . '%')
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
