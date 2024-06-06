<?php

namespace App\Services\Tenant\Order;

use Exception;
use App\Models\Vendor\Order;
use App\Models\Vendor\Customer;
use App\Enums\Vendor\Orders\OrderType;
use App\Factories\Tenant\OrderFactory;
use App\Enums\Vendor\Orders\PaymentStatus;
use App\Exceptions\CustomerNotFoundException;
use App\Enums\Vendor\Orders\OrderPaymentMethod;
use App\Strategies\Tenant\Order\PricingStrategy;
use App\Repositories\Tenant\Order\OrderRepository;
use App\Repositories\Tenant\Order\OrderItemRepository;
use App\Repositories\Tenant\Order\OrderChargeRepository;
use App\Repositories\Tenant\Order\OrderTransactionRepository;
use App\Services\Tenant\Payment\Contracts\PaymentGatewayInterface;

class OrderService
{
    protected $orderRepository;
    protected $orderItemRepository;
    protected $pricingStrategy;
    protected $orderChargeRepository;
    protected $paymentGateway;
    protected $orderTransactionRepository;


    public function __construct(
        OrderRepository $orderRepository, 
        OrderItemRepository $orderItemRepository, 
        PricingStrategy $pricingStrategy, 
        OrderChargeRepository $orderChargeRepository,
        OrderTransactionRepository $orderTransactionRepository
        )
    {
        $this->orderRepository = $orderRepository;
        $this->orderItemRepository = $orderItemRepository;
        $this->pricingStrategy = $pricingStrategy;
        $this->orderChargeRepository = $orderChargeRepository;
        $this->orderTransactionRepository = $orderTransactionRepository;
    }

    public function setPaymentGateway(PaymentGatewayInterface $paymentGateway)
    {
        $this->paymentGateway = $paymentGateway;
    }

    public function placeOrder(array $data, Customer $customer, object $deliveryCharge = null)
    {

        try {
            $additionalCharges = [];
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
                $item['extras'] = isset($item['extras']) ? json_encode($item['extras']) : null;

                $orderSubtotal += $itemPrices['total'];

                $modifiedItems[] = $item;
            }

            // Add logic to insert delivery charge into OrderCharge table
            if ($deliveryCharge && $data['order_type'] === OrderType::DELIVERY->value) {
                $additionalCharges[] = [
                    'type' => OrderType::DELIVERY->value,
                    'amount' => $deliveryCharge->delivery_charges,
                ];
            }

            $orderData['payment_status'] = PaymentStatus::UNPAID;
            $orderData['subtotal_price'] = $orderSubtotal;
            $orderData['total_price'] = $this->pricingStrategy->calculateOrderTotal($orderSubtotal, $additionalCharges);

            // Business logic for placing an order
            $order = $this->orderRepository->create($orderData);

            // Add order_id to each additional charge and prepare for bulk insertion
            foreach ($additionalCharges as &$charge) {
                $charge['order_id'] = $order->id;
            }
            unset($charge);

            foreach ($modifiedItems as &$orderItem) {
                $orderItem['order_id'] = $order->id;
            }
            unset($orderItem);
            $this->addOrderItems($modifiedItems);

            // Insert order charges in bulk
            if (!empty($additionalCharges)) {
                $this->addOrderCharges($additionalCharges);
            }

            return $order;
        } catch (Exception $e) {
            throw $e;
        }
    }

    protected function addOrderItems(array $items)
    {
        $this->orderItemRepository->createBulk($items);
    }

    protected function addOrderCharges(array $additionalCharges)
    {
        $this->orderChargeRepository->createBulk($additionalCharges);
    }

    public function processOrderPayment(Order $order)
    {
        if ($this->paymentGateway->getName() !== OrderPaymentMethod::CASH->value) {
            $paymentResult = $this->paymentGateway->processPayment([
                'amount' => $order->total_price * 100,
                'customer' => $order->customer
            ]);

            if ($paymentResult['success'] !== true) {
                throw new Exception($paymentResult['message']);
            }
            $paymentData = $paymentResult['data'];
            $paymentResponse = [
                'order_id' => $order->id,
                'transaction_id' => $paymentData->id,
                'amount' => $order->total_price,
                'status' => $paymentData->status,
                'payment_method' => $this->paymentGateway->getName(),
                'response' => $paymentData,
            ];
            $this->addOrderPaymentTransacrion($paymentResponse);
            $order->load('transaction');
        }
    }

    protected function addOrderPaymentTransacrion(array $transaction)
    {
        $this->orderTransactionRepository->create($transaction);
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
        $whereStatus = [];

        // Define the statuses that are considered 'active'
        $activeStatuses = ['pending', 'accepted', 'ready', 'assigned_to_driver', 'rider_picked_up'];

        // Check if 'status' is set to 'active' in the request
        if (isset($validatedData['status']) && $validatedData['status'] == 'active') {
            $whereStatus['status'] = $activeStatuses;
        } else if (isset($validatedData['status'])) {
            $whereStatus['status'] = $validatedData['status'];
        }

        $orders = Order::with(['items' => function ($query) {
            $query->select('order_id', \DB::raw('SUM(quantity) as item_count'))
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
            ], 'id', 'desc', $where)
            ->when(isset($whereStatus['status']), function ($query) use ($whereStatus) {
                if (is_array($whereStatus['status'])) {
                    $query->whereIn('status', $whereStatus['status']);
                } else {
                    $query->where('status', $whereStatus['status']);
                }
            })
            ->paginate($limit);

        return $orders;
    }
}
