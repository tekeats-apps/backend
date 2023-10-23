<?php

namespace App\Repositories\Tenant\Order;

use App\Models\Vendor\OrderCharge;

class OrderChargeRepository
{
    protected $orderChargeModel;

    public function __construct(OrderCharge $orderCharge)
    {
        $this->orderChargeModel = $orderCharge;
    }

    public function create(array $data): OrderCharge
    {
        return $this->orderChargeModel->create($data);
    }
}

