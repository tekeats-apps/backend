<?php

namespace App\Repositories\Tenant\Order;

use App\Models\Vendor\OrderItem;

class OrderItemRepository
{
    protected $orderItemModel;

    public function __construct(OrderItem $orderItem)
    {
        $this->orderItemModel = $orderItem;
    }

    public function create(array $data): OrderItem
    {
        return $this->orderItemModel->create($data);
    }
}

