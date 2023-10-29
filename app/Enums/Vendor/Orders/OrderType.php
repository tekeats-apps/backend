<?php

namespace App\Enums\Vendor\Orders;

enum OrderType: string
{
    case DINE_IN = 'dine_in';
    case TAKE_AWAY = 'take_away';
    case DELIVERY = 'delivery';
}
