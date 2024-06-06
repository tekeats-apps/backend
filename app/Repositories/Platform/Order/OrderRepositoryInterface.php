<?php

namespace App\Repositories\Platform\Order;

interface OrderRepositoryInterface
{
    /**
     * Get orders.
     *
     * @param string $sortField
     * @param string $sortDirection
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getOrders($sortField = 'id', $sortDirection = 'desc');

    /**
     * Get order by ID.
     *
     * @param int $orderId
     * @return mixed
     */
    public function getOrderById(int $orderId);

    /**
     * Update order status.
     *
     * @param mixed $order
     * @param string $status
     * @return mixed
     */
    public function updateOrderStatus($order, string $status);
}
