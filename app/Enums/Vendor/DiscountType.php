<?php

namespace App\Enums\Vendor;

enum DiscountType: string
{
    case FLAT = 'flat';
    case PERCENTAGE = 'percentage';
}
