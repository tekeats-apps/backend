<?php

namespace App\Repositories\Platform\Order;

interface OrderStatusRepositoryInterface
{
    /**
     * Get orders.
     *
     * @param string $sortField
     * @param string $sortDirection
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function updateOrderStatus($order, string $status);
}
