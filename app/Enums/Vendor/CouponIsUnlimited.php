<?php

namespace App\Enums\Vendor;

enum CouponIsUnlimited: int
{
    case ACTIVE = 1;
    case INACTIVE = 0;
}
