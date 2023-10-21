<?php

namespace App\Models\Vendor;

use App\Enums\Vendor\CouponAmountType;
use App\Enums\Vendor\CouponOption;
use App\Enums\Vendor\CouponType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
    ];
}
