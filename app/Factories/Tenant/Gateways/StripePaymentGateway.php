<?php

namespace App\Factories\Tenant\Gateways;

class StripePaymentGateway
{
    public function handleWebhook($event)
    {
        return (object) [
            'transaction_id' => $event['data']['object']['id'],
            'order_id' => $event['data']['object']['metadata']['order_id'],
            'status' => $event['data']['object']['status'],
            'response' => $event
        ];
    }
}
