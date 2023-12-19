<?php

namespace App\Services\Tenant\Order;

use Exception;
use App\Models\Vendor\Order;
use App\Models\Vendor\Customer;
use App\Enums\Vendor\Orders\OrderType;
use App\Factories\Tenant\OrderFactory;
use App\Enums\Vendor\Orders\OrderStatus;
use App\Models\Vendor\OrderStatusHistory;
use App\Enums\Vendor\Orders\PaymentStatus;
use App\Exceptions\CustomerNotFoundException;
use App\Strategies\Tenant\Order\PricingStrategy;
use App\Repositories\Tenant\Order\OrderRepository;
use App\Repositories\Tenant\Order\OrderItemRepository;
use App\Repositories\Tenant\Order\OrderChargeRepository;

class OrderService
{
    protected $orderRepository;
    protected $orderItemRepository;
    protected $pricingStrategy;
    protected $orderChargeRepository;

    public function __construct(OrderRepository $orderRepository, OrderItemRepository $orderItemRepository, PricingStrategy $pricingStrategy, OrderChargeRepository $orderChargeRepository)
    {
        $this->orderRepository = $orderRepository;
        $this->orderItemRepository = $orderItemRepository;
        $this->pricingStrategy = $pricingStrategy;
        $this->orderChargeRepository = $orderChargeRepository;
    }

    public function placeOrder(array $data, Customer $customer, object $deliveryCharge = null)
    {
        try {
            if (!$customer) {
                throw new CustomerNotFoundException("Customer not found");
            }
            $orderData = OrderFactory::make($data, $customer);
            // Calculate and update each item's subtotal and total
            $orderSubtotal = 0.00;
            $modifiedItems = [];
            foreach ($orderData['items'] as $item) {
                $itemPrices = $this->pricingStrategy->calculateItemSubtotalAndTotal($item);

                $item['price'] = $itemPrices['price'];
                $item['subtotal'] = $itemPrices['subtotal'];
                $item['total'] = $itemPrices['total'];

                $orderSubtotal += $itemPrices['total'];

                $modifiedItems[] = $item;
            }
            $orderData['payment_status'] = PaymentStatus::UNPAID;
            $orderData['subtotal_price'] = $orderSubtotal;
            $orderData['total_price'] = $this->pricingStrategy->calculateOrderTotal($orderSubtotal);

            // Business logic for placing an order
            $order = $this->orderRepository->create($orderData);

            $this->createOrderStatusHistory($order, OrderStatus::PENDING);

            foreach ($modifiedItems as $item) {
                $this->orderItemRepository->create($item + ['order_id' => $order->id]);
            }

            // Add logic to insert delivery charge into OrderCharge table
            if ($deliveryCharge && $data['order_type'] === OrderType::DELIVERY->value) {
                $orderChargeData = [
                    'order_id' => $order->id,
                    'type' => OrderType::DELIVERY->value,
                    'amount' => $deliveryCharge->delivery_charges,
                ];

                // Assuming you have an OrderCharge model and repository
                $this->orderChargeRepository->create($orderChargeData);
            }

            return $order;
        } catch (Exception $e) {
            throw $e;
        }
    }

    // New method to record order status history
    protected function createOrderStatusHistory($order, $status)
    {
        OrderStatusHistory::create([
            'order_id' => $order->id,
            'status' => $status,
        ]);
    }

    /**
     * Get order details by order ID with items.
     *
     * @param int $orderId
     * @return mixed
     */
    public function getOrderDetailsById($orderId)
    {
        return Order::GetOrderByOrderID($orderId);
    }

    public function getCustomerOrders($customer_id, $validatedData)
    {
        $limit = (isset($validatedData['limit']) ? $validatedData['limit'] : 10);
        $where = ['customer_id' => $customer_id];
        $orders = Order::with(['items' => function ($query) {
            $query->select('order_id', \DB::raw('count(*) as item_count'))
                ->groupBy('order_id');
        }])
            ->getCustomerOrders([
                'id',
                'order_id',
                'status',
                'payment_status',
                'payment_method',
                'order_type',
                'total_price',
                'created_at'
            ], 'id', 'desc', $where)->paginate($limit);

        return $orders;
    }
}
