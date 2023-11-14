<?php

namespace App\Enums\Vendor\Orders;

enum OrderStatus: string
{
    case PENDING = 'pending';
    case ACCEPTED = 'accepted';
    case READY = 'ready';
    case ASSIGNED_TO_DRIVER = 'assigned_to_driver';
    case RIDER_PICKED_UP = 'rider_picked_up';
    case DELIVERED = 'delivered';
    case RETURNED = 'returned';
    case CANCELLED = 'cancelled';
}
