<?php

namespace App\Repositories\Platform\Order;

use App\Models\Vendor\OrderStatusHistory;
use App\Repositories\Platform\Order\OrderStatusRepositoryInterface;

class OrderStatusRepository implements OrderStatusRepositoryInterface
{
    protected OrderStatusHistory $model;

    public function __construct(OrderStatusHistory $orderStatus)
    {
        $this->model = $orderStatus;
    }

    public function updateOrderStatus($order, string $status)
    {
        return $this->model->create([
            'order_id' => $order->id,
            'status' => $status,
        ]);
    }
}
