<?php

namespace App\Factories\Tenant;

use InvalidArgumentException;
use App\Factories\Tenant\Gateways\StripePaymentGateway;

class PaymentCallbackFactory
{
    public static function make($paymentMethod)
    {
        switch ($paymentMethod) {
            case 'stripe':
                return new StripePaymentGateway();
            default:
                throw new InvalidArgumentException("Unsupported payment method: {$paymentMethod}");
        }
    }
}