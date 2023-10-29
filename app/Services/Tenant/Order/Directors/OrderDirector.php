<?php

namespace App\Services\Tenant\Order\Directors;

use App\Enums\Vendor\Orders\OrderType;
use App\Models\Vendor\Customer;
use App\Services\Tenant\Order\Builders\OrderBuilder;

class OrderDirector
{
    public function placeOrder(OrderBuilder $builder, array $request, Customer $customer)
    {

        // Set the validated data and customer
        $builder->setValidatedData($request)
            ->setCustomer($customer);

        // Check if the order type is 'delivery'
        if ($request['order_type'] === OrderType::DELIVERY->value) {
            $builder->calculateDeliveryCharges($request['address_id']);
        }
        // print_r('ok');exit;
        // Create the order and return it
        return $builder->createOrder()
            ->getOrder();
    }
}
