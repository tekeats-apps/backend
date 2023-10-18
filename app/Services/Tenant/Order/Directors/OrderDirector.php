<?php

namespace App\Services\Tenant\Order\Directors;

use App\Models\Vendor\Customer;
use App\Services\Tenant\Order\Builders\OrderBuilder;

class OrderDirector
{
    public function placeOrder(OrderBuilder $builder, array $request, Customer $customer)
    {
        return $builder->setValidatedData($request)
                       ->setCustomer($customer)
                       ->createOrder()
                       ->getOrder();
    }
}
