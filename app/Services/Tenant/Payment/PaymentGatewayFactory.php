<?php

namespace App\Services\Tenant\Payment;

use App\Services\Tenant\Payment\Gateways\Cash;
use App\Services\Tenant\Payment\Gateways\StripeGateway;
use App\Services\Tenant\Payment\Contracts\PaymentGatewayInterface;

class PaymentGatewayFactory
{
    public static function make($gateway): PaymentGatewayInterface
    {
        switch ($gateway) {
            case 'card':
                return new StripeGateway();
            case 'cash':
                return new Cash();
            default:
                throw new \Exception('Invalid payment gateway');
        }
    }
}
