<?php

namespace App\Repositories\Tenant\Order;

use App\Models\Vendor\OrderTransaction;

class OrderTransactionRepository
{
    protected $model;

    public function __construct(OrderTransaction $orderTransaction)
    {
        $this->model = $orderTransaction;
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

}
