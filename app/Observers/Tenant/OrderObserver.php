<?php

namespace App\Observers\Tenant;

use App\Models\Vendor\Order;
use App\Events\Tenant\OrderPlacedEvent;
use App\Enums\Vendor\Orders\OrderStatus;
use App\Models\Vendor\OrderStatusHistory;

class OrderObserver
{
    public function created(Order $order)
    {
        $this->createOrderStatusHistory($order, OrderStatus::PENDING);

        event(new OrderPlacedEvent($order));
    }

    protected function createOrderStatusHistory($order, $status)
    {
        OrderStatusHistory::create([
            'order_id' => $order->id,
            'status' => $status,
        ]);
    }
}
