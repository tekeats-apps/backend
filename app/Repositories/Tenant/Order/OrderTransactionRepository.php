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

    public function updateTransaction($transactionId, $orderId, array $data)
    {
        $transaction = $this->model->where([
            'order_id' => $orderId,
            'transaction_id' => $transactionId
        ])->first();

        if (!$transaction) {
            throw new \Exception("Transaction not found.");
        }

        return $transaction->update($data);
    }

}
