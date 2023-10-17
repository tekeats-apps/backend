<?php

namespace App\Enums\Vendor;

use ArchTech\Enums\InvokableCases;
use ArchTech\Enums\Names;
use ArchTech\Enums\Values;

enum DiscountActiveEnum: int
{
    use Names;
    use Values;
    use InvokableCases;

    case ACTIVE = true;
    case IN_ACTIVE = false;
}
