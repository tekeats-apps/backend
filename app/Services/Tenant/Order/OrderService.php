<?php

namespace App\Services\Tenant\Order;

use App\Models\Vendor\Customer;
use App\Factories\Tenant\OrderFactory;
use App\Strategies\Tenant\Order\PricingStrategy;
use App\Repositories\Tenant\Order\OrderRepository;
use App\Repositories\Tenant\Order\OrderItemRepository;

class OrderService
{
    protected $orderRepository;
    protected $orderItemRepository;
    protected $pricingStrategy;

    public function __construct(OrderRepository $orderRepository, OrderItemRepository $orderItemRepository, PricingStrategy $pricingStrategy)
    {
        $this->orderRepository = $orderRepository;
        $this->orderItemRepository = $orderItemRepository;
        $this->pricingStrategy = $pricingStrategy;
    }

    public function placeOrder(array $data, Customer $customer)
    {

        $orderData = OrderFactory::make($data, $customer);
        // Calculate and update each item's subtotal and total
        $orderSubtotal = 0.00;
        $modifiedItems = [];
        foreach ($orderData['items'] as $item) {
            $itemPrices = $this->pricingStrategy->calculateItemSubtotalAndTotal($item);

            $item['subtotal'] = $itemPrices['subtotal'];
            $item['total'] = $itemPrices['total'];

            $orderSubtotal += $itemPrices['total'];

            $modifiedItems[] = $item;
        }

        $orderData['subtotal_price'] = $orderSubtotal;
        $orderData['total_price'] = $this->pricingStrategy->calculateOrderTotal($orderSubtotal);

        // Business logic for placing an order
        $order = $this->orderRepository->create($orderData);

        foreach ($modifiedItems as $item) {
            $this->orderItemRepository->create($item + ['order_id' => $order->id]);
        }

        return $order;
    }
}
