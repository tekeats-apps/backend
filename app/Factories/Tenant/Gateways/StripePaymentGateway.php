<?php

namespace App\Factories\Tenant\Gateways;

use Illuminate\Http\Request;

class StripePaymentGateway
{
    public function handleWebhook($data, $order)
    {
        return (object) [
            'order_id' => $order_id,
            'transaction_id' => $data['id'],
            'amount' => $data['data.object.amount'] / 100,
            'status' => $data['type'] === 'payment_intent.succeeded' ? 'success' : ($data['type'] === 'payment_intent.payment_failed' ? 'failed' : 'pending')
        ];
    }
}
