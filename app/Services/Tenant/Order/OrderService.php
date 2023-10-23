<?php

namespace App\Services\Tenant\Order;

use Exception;
use App\Models\Vendor\Customer;
use App\Factories\Tenant\OrderFactory;
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

            // Add logic to insert delivery charge into OrderCharge table
            if ($deliveryCharge && $data['order_type'] === 'delivery') {
                $orderChargeData = [
                    'order_id' => $order->id,
                    'type' => 'delivery',
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
}
