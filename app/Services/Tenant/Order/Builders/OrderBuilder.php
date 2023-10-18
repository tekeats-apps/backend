<?php

namespace App\Services\Tenant\Order\Builders;

use Illuminate\Database\Eloquent\Model;
use App\Services\Tenant\Order\OrderService;
use App\Services\Tenant\Order\Builders\Interfaces\OrderBuilderInterface;

class OrderBuilder implements OrderBuilderInterface
{
    private array $validatedData = [];
    private object $customer;
    private Model $order;
    protected $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
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

    public function createOrder(): self
    {
        $order = $this->orderService->placeOrder($this->validatedData, $this->customer);
        $this->order = $order;
        return $this;
    }

    public function getOrder(): Model
    {
        return $this->order;
    }
}
