<?php

namespace App\Enums\Vendor;

enum CouponAmountType: string
{
    case FLAT = 'flat';
    case PERCENTAGE = 'percentage';
}
