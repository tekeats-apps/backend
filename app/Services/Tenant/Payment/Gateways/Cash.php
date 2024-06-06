<?php

namespace App\Services\Tenant\Payment\Gateways;

use App\Services\Tenant\Payment\Contracts\PaymentGatewayInterface;

class Cash implements PaymentGatewayInterface
{
    public function getName(): string
    {
        return 'cash';
    }

    public function processPayment(array $paymentDetails):array
    {
        return [];
    }
}
