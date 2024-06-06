<?php

namespace App\Services\Tenant\Order\Directors;

use App\Enums\Vendor\Orders\OrderType;
use App\Models\Vendor\Customer;
use App\Services\Tenant\Order\Builders\OrderBuilder;
use Illuminate\Support\Facades\DB;

class OrderDirector
{
    public function placeOrder(OrderBuilder $builder, array $request, Customer $customer)
    {
        DB::beginTransaction();
        try {
            // Set the validated data and customer
            $builder->setValidatedData($request)
                ->setCustomer($customer);

            // Check if the order type is 'delivery'
            if ($request['order_type'] === OrderType::DELIVERY->value) {
                $builder->calculateDeliveryCharges($request['address_id']);
            }

            // Create the order
            $builder->createOrder();

            // Process the payment
           $builder->processPayment();

            // Commit the transaction if everything is successful
            DB::commit();

            return $builder->getOrder();
        } catch (\Exception $e) {
            // Rollback the transaction on failure
            DB::rollBack();
            throw $e;
        }
    }
}
