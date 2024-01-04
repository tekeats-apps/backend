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

    /**
     * Insert multiple order charges in bulk.
     *
     * @param array $chargesArray Array of order charge data arrays
     * @return bool True on success, false on failure.
     */
    public function createBulk(array $chargesArray): bool
    {
        return $this->orderChargeModel->insert($chargesArray);
    }
}

