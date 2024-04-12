<?php

namespace App\Repositories\Platform\Order;

use App\Models\Vendor\Order;
use App\Repositories\Platform\Order\OrderRepositoryInterface;

class OrderRepository implements OrderRepositoryInterface
{
    protected Order $model;

    public function __construct(Order $category)
    {
        $this->model = $category;
    }

    public function getOrders($sortField = 'id', $sortDirection = 'desc')
    {
        return $this->model
            ->with('customer:id,first_name,last_name,email')
            ->select([
                'id',
                'order_id',
                'customer_id',
                'status',
                'payment_status',
                'payment_method',
                'order_type',
                'subtotal_price',
                'total_price',
                'created_at'
            ])
            ->orderBy($sortField, $sortDirection);
    }
}
