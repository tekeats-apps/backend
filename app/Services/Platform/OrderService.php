<?php

namespace App\Services\Platform;

use App\Events\Platform\OrderStatusUpdateEvent;
use App\Repositories\Platform\Order\OrderRepository;
use App\Repositories\Platform\Order\OrderStatusRepository;

class OrderService
{
    protected OrderRepository $orderRepository;
    protected OrderStatusRepository $orderStatusHistory;

    public function __construct(OrderRepository $orderRepository, OrderStatusRepository $orderStatusHistory)
    {
        $this->orderRepository = $orderRepository;
        $this->orderStatusHistory = $orderStatusHistory;
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
        $order = $this->orderRepository->updateOrderStatus($order, $status);
        $this->orderStatusHistory->updateOrderStatus($order, $status);

        event(new OrderStatusUpdateEvent($order));

        return $order;
    }

}