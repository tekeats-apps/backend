<?php

namespace App\Services\Tenant\Order\Builders\Interfaces;

use App\Models\Vendor\Customer;
use Illuminate\Database\Eloquent\Model;

interface OrderBuilderInterface
{
    public function setValidatedData(array $data): self;

    public function setCustomer(Customer $customer): self;

    public function calculateDeliveryCharges(int $addressId): self;

    public function createOrder(): self;

    public function getOrder(): Model;
}
