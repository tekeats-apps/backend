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

    /**
     * Insert multiple order charges in bulk.
     *
     * @param array $chargesArray Array of order charge data arrays
     * @return bool True on success, false on failure.
     */
    public function createBulk(array $items): bool
    {
        return $this->orderItemModel->insert($items);
    }
}

