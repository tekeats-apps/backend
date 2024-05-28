<?php

namespace App\Services\Tenant\Payment\Contracts;

interface PaymentGatewayInterface
{
    public function getName(): string;
    public function processPayment(array $paymentDetails): array;
}
