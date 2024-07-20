<?php

namespace App\Factories\Tenant\Gateways;

class StripePaymentGateway
{
    public function handleWebhook($data, $order)
    {
        return (object) [
            'transaction_id' => $data['id'],
            'status' => $data['status'],
            'type' => $data['type'] === 'payment_intent.succeeded' ? 'success' : ($data['type'] === 'payment_intent.payment_failed' ? 'failed' : 'pending'),
            'response' => $data
        ];
    }
}
