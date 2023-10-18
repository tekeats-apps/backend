<?php

namespace App\Enums\Vendor\Tax;

use ArchTech\Enums\Names;
use ArchTech\Enums\Values;

enum TypeEnum: string
{
    use Names;
    use Values;

    case FLAT = 'flat';
    case PERCENTAGE = 'percentage';
}
