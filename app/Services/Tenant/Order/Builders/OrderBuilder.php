<?php

namespace App\Services\Tenant\Order\Builders;

use App\Traits\ApiResponse;
use Illuminate\Database\Eloquent\Model;
use App\Services\Tenant\Order\OrderService;
use Symfony\Component\HttpFoundation\Response;
use App\Exceptions\DeliveryUnavailableException;
use App\Services\Tenant\Order\DeliveryChargeService;
use App\Services\Tenant\Payment\PaymentGatewayFactory;
use App\Services\Tenant\Order\Builders\Interfaces\OrderBuilderInterface;

class OrderBuilder implements OrderBuilderInterface
{
    use ApiResponse;

    private array $validatedData = [];
    private object $customer;
    private ?object $deliveryCharge;
    private Model $order;
    protected $orderService;
    protected $deliveryChargeService;
    protected $paymentGateway;

    public function __construct(OrderService $orderService, DeliveryChargeService $deliveryChargeService)
    {
        $this->orderService = $orderService;
        $this->deliveryChargeService = $deliveryChargeService;
    }

    public function setValidatedData(array $data): self
    {
        $this->validatedData = $data;

        return $this;
    }

    public function setCustomer(object $customer): self
    {
        $this->customer = $customer;

        return $this;
    }

    public function calculateDeliveryCharges(int $address_id): self
    {

        $delivery = $this->deliveryChargeService->calculateDeliveryCharge($address_id);
        if (!$delivery->delivery_avaiable) {
            throw new DeliveryUnavailableException("Delivery not available for this zone.");
        }
        $this->deliveryCharge = $delivery;
        return $this;
    }

    public function createOrder(): self
    {
        $order = $this->orderService->placeOrder(
            $this->validatedData,
            $this->customer,
            $this->deliveryCharge ?? null
        );
        $this->order = $order;
        return $this;
    }

    public function processPayment()
    {
        $this->paymentGateway = PaymentGatewayFactory::make($this->validatedData['payment_method']);

        $this->orderService->setPaymentGateway($this->paymentGateway);

        return $this->orderService->processOrderPayment($this->order);
    }

    public function getOrder(): Model
    {
        return $this->order;
    }
}
