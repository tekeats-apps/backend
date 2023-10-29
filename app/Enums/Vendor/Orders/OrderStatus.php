<?php

namespace App\Enums\Vendor\Orders;

enum OrderStatus: string
{
    case PENDING = 'pending';
    case PREPARING = 'preparing';
    case ASSIGNED_TO_DRIVER = 'assigned_to_driver';
    case RIDER_PICKED_UP = 'rider_picked_up';
    case COMPLETED = 'completed';
    case RETURNED = 'returned';
    case CANCELLED = 'cancelled';
}
