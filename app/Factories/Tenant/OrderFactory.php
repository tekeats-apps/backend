<?php

namespace App\Factories\Tenant;

class OrderFactory
{
    public static function make(array $data, object $customer): array
    {
        return [
            'customer_id' => $customer->id,
            'order_type' => $data['order_type'],
            'payment_method' => $data['payment_method'],
            'address_id' => isset($data['address_id']) ? $data['address_id'] : null,
            'notes' => $data['notes'],
            'items' => $data['items'],
        ];
    }
}
