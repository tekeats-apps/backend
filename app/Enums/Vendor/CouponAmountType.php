<?php

namespace App\Enums\Vendor;

use ArchTech\Enums\InvokableCases;
use ArchTech\Enums\Names;
use ArchTech\Enums\Values;

enum CouponAmountType: string
{
    use Names;
    use Values;
    use InvokableCases;

    case FLAT = 'flat';
    case PERCENTAGE = 'percentage';
}
