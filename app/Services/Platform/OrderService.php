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

    /**
     * Get order by ID
     *
     * @param int $orderId
     * @return mixed
     */
    public function getOrderById(int $orderId)
    {
        return $this->orderRepository->getOrderById($orderId);
    }

    /**
     * Update order status
     *
     * @param mixed $order
     * @param string $status
     * @return mixed
     */
    public function updateOrderStatus($order, string $status)
    {
        // You can implement your business logic here to update the order status
        return $this->orderRepository->updateOrderStatus($order, $status);
    }

}