<?php

namespace App\Repositories\Tenant\Order;

use App\Models\Vendor\Order;

class OrderRepository
{
    protected $orderModel;

    public function __construct(Order $order)
    {
        $this->orderModel = $order;
    }

    public function create(array $data)
    {
        return $this->orderModel->create($data);
    }

    public function find($id)
    {
        return $this->orderModel->find($id);
    }

}
