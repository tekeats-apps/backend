<?php

namespace App\Services\Tenant\Payment\Gateways;

use Stripe\StripeClient;
use App\Models\Vendor\Customer;
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

    protected function findOrCreateCustomer(Customer $customer)
    {
        try {
            // Find customer by email
            $customers = $this->stripe->customers->all(['email' => $customer->email, 'limit' => 1]);
            if (!empty($customers->data)) {
                $customer = $customers->data[0];
                // Update customer if needed
                $this->stripe->customers->update($customer->id, [
                    'name' => $customer->full_name,
                ]);
                return $customer;
            } else {
                // Create new customer
                return $this->stripe->customers->create([
                    'email' => $customer->email,
                    'name' => $customer->full_name,
                ]);
            }
        } catch (ApiErrorException $e) {
            throw new \Exception('Failed to find or create customer');
        }
    }

    protected function createEphemeralKey($customerId)
    {
        try {
            return $this->stripe->ephemeralKeys->create(
                ['customer' => $customerId],
                ['stripe_version' => '2024-04-10']
            );
        } catch (ApiErrorException $e) {
            throw new \Exception('Failed to create ephemeral key');
        }
    }

    public function processPayment(array $paymentDetails): array
    {
        try {
            // Extract customer details
            $customerDetails = $paymentDetails['customer'];
            $customer = $this->findOrCreateCustomer($customerDetails);
            $ephemeralKey = $this->createEphemeralKey($customer->id);
            $paymentIntent = $this->stripe->paymentIntents->create([
                'amount' => $paymentDetails['amount'],
                'currency' => "USD",
                'payment_method_types' => ['card'],
                'customer' => $customer->id,
                'metadata' => [
                    'ephemeral_key' => $ephemeralKey->secret,
                    'customer_email' => $customer->email,
                ],
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
