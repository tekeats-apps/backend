<?php

namespace App\Repositories\Platform\Order;

use App\Models\Vendor\Order;
use App\Repositories\Platform\Order\OrderRepositoryInterface;

class OrderRepository implements OrderRepositoryInterface
{
    protected Order $model;


    public function __construct(Order $order)
    {
        $this->model = $order;
    }

    public function getOrders($sortField = 'id', $sortDirection = 'desc')
    {
        return $this->model
            ->with('customer:id,first_name,last_name,email')
            ->select([
                'id',
                'order_id',
                'customer_id',
                'status',
                'payment_status',
                'payment_method',
                'order_type',
                'subtotal_price',
                'total_price',
                'created_at'
            ])
            ->orderBy($sortField, $sortDirection);
    }

    public function getOrdersByDate($date, $sortField = 'id', $sortDirection = 'desc')
    {
        return $this->model->whereDate('created_at', $date)
            ->with('customer:id,first_name,last_name,email')
            ->select([
                'id',
                'order_id',
                'customer_id',
                'status',
                'payment_status',
                'payment_method',
                'order_type',
                'subtotal_price',
                'total_price',
                'created_at'
            ])->orderBy($sortField, $sortDirection)->get();
    }

    public function getOrderById(int $orderId)
    {
        return $this->model->find($orderId);
    }

    public function getOrderDetailsByOrderId($orderId)
    {
        return $this->model->with(
            [
                'customer',
                'address',
                'charges',
                'rider',
                'items.product:id,name,image',
                'items.variant:id,name,price',
                'statusHistory'
            ]
        )->where('id', $orderId)
            ->first();
    }

    public function updateOrderStatus($order, string $status)
    {
        $order->status = $status;
        $order->save();

        return $order;
    }
}
