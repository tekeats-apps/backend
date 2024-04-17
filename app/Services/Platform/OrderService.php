<?php

namespace App\Services\Platform;

use App\Models\Vendor\Extra;
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
     * Get order details by ID
     *
     * @param int $orderId
     * @return mixed
     */
    public function getOrderDetailsByOrderId(int $orderId)
    {
        $orderDetails = $this->orderRepository->getOrderDetailsByOrderId($orderId);

        // Step 2: Process extras for each item
        foreach ($orderDetails->items as $item) {
            if (!empty($item->extras)) {
                // Assuming extras are stored as JSON of IDs: ["1", "2", ...]
                $extraIds = $item->extras;

                // Fetch additional details about extras if needed
                $extrasDetails = Extra::whereIn('id', $extraIds)->get();

                // Step 3: Merge the extras details back into the item
                $item->extrasDetails = $extrasDetails;
            }
        }
        return $orderDetails;
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