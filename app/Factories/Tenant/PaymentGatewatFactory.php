<?php

namespace App\Factories\Tenant;

use InvalidArgumentException;
use App\Factories\Tenant\Gateways\StripePaymentGateway;

class PaymentGatewayFactory
{
    public static function make($paymentMethod, $data, $order)
    {
        switch ($paymentMethod) {
            case 'stripe':
                return new StripePaymentGateway($data, $order);
            default:
                throw new InvalidArgumentException("Unsupported payment method: {$paymentMethod}");
        }
    }
}