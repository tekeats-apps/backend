<?php

namespace App\Enums\Vendor;

use ArchTech\Enums\InvokableCases;
use ArchTech\Enums\Names;
use ArchTech\Enums\Values;

enum CouponOption: string
{
    use Names;
    use Values;
    use InvokableCases;

    case MANUAL = 'manual';
    case AUTOMATIC = 'automatic';
}
