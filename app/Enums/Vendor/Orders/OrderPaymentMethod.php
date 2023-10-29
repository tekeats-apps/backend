<?php

namespace App\Enums\Vendor\Orders;

enum OrderPaymentMethod: string
{
    case CARD = 'card';
    case PAYPAL = 'paypal';
    case CASH = 'cash';
}
