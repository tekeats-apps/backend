<?php

namespace App\Observers\Tenant;

use App\Models\Vendor\Order;
use App\Events\Tenant\OrderPlacedEvent;

class OrderObserver
{
    public function created(Order $order)
    {
        // event(new OrderPlacedEvent($order));
    }
}
