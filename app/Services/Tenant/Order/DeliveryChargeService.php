<?php

namespace App\Services\Tenant\Order;

class DeliveryChargeService
{
    public function calculateDeliveryCharge($addressId): float
    {
        // Logic to calculate delivery charge based on address_id
        return (float) 50.00;  // Example amount
    }
}
