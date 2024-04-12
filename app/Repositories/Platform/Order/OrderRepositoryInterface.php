<?php

namespace App\Repositories\Platform\Order;

interface OrderRepositoryInterface
{
    public function getOrders($sortField = 'id', $sortDirection = 'desc');
}
