<?php

namespace App\Services\Platform;

use App\Repositories\Platform\Order\OrderRepository;

class OrderService
{
    protected OrderRepository $orderRepository;

    public function __construct(OrderRepository $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }
    public function getOrders()
    {
        return $this->orderRepository->getOrders();
    }

}