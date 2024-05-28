<?php

namespace App\Services\Tenant\Payment\Gateways;

use Stripe\StripeClient;
use Stripe\Exception\ApiErrorException;
use App\Services\Tenant\Payment\Contracts\PaymentGatewayInterface;

class StripeGateway implements PaymentGatewayInterface
{
    protected $stripe;

    public function __construct()
    {
        $this->stripe = new StripeClient(config('services.stripe.secret_key'));
    }

    public function getName(): string
    {
        return 'stripe';
    }

    public function processPayment(array $paymentDetails): array
    {
        try {
            $paymentIntent = $this->stripe->paymentIntents->create([
                'amount' => $paymentDetails['amount'],
                'currency' => "USD",
                'payment_method_types' => ['card'],
            ]);

            return [
                'success' => true,
                'data' => $paymentIntent
            ];
        } catch (ApiErrorException $e) {
            return [
                'success' => false,
                'message' => $e->getMessage(),
            ];
        } catch (\Exception $e) {
            return [
                'success' => false,
                'message' => $e->getMessage(),
            ];
        }
    }
}
