<?php

namespace App\Enums\Vendor;

use ArchTech\Enums\InvokableCases;
use ArchTech\Enums\Names;
use ArchTech\Enums\Values;

enum CouponType: string
{
    use Names;
    use Values;
    use InvokableCases;

    case SINGLE = 'single';
    case MULTIPLE = 'multiple';
}
