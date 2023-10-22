<?php

namespace App\Enums\Vendor;

enum TaxType: string
{
    case FLAT = 'flat';
    case PERCENTAGE = 'percentage';
}
