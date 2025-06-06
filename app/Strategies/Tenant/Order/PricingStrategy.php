<?php

namespace App\Strategies\Tenant\Order;

use App\Models\Vendor\Extra;
use App\Models\Vendor\Product;
use App\Models\Vendor\Variant;

interface PricingStrategyMethods
{
    public function calculateItemPrice(int $productId): float;
    public function calculateItemSubtotalAndTotal(array $items): array;
    public function calculateOrderTotal(float $subtotal): float;
}

class PricingStrategy implements PricingStrategyMethods
{
    /**
     * Simulated method to get the product price by its ID.
     *
     * @param int $productId
     * @return float
     */
    protected function getProductPrice(int $productId): float
    {
        $product = Product::find($productId);

        $price = $product->discounted_price;
        return $price;
    }

    protected function getExtraPrice(int $extraId): float
    {
        $extra = Extra::find($extraId);
        return $extra->price ?? 0.00;
    }

    protected function getVariantPrice(int $variantId): float
    {
        $variant = Variant::find($variantId);
        return $variant ? $variant->discounted_price : 0;
    }

    /**
     * Calculate the price of an individual item.
     *
     * @param int $productId
     * @return float
     */
    public function calculateItemPrice(int $productId): float
    {
        return $this->getProductPrice($productId);
    }

    public function calculateItemSubtotalAndTotal(array $item): array
    {
        $basePrice = isset($item['variant_id'])
            ? $this->getVariantPrice($item['variant_id'])
            : $this->calculateItemPrice($item['product_id']);

        $subtotal = $basePrice * $item['quantity'];

        $extrasPrice = 0.0;
        if (isset($item['extras']) && is_array($item['extras'])) {
            foreach ($item['extras'] as $extraId) {
                $extrasPrice += $this->getExtraPrice($extraId) * $item['quantity'];
            }
        }
        // $price = $this->calculateItemPrice($item['product_id']);
        $total = $subtotal + $extrasPrice;
        return ['price' => $basePrice, 'subtotal' => $subtotal, 'total' => $total];
    }

    /**
     * Calculate the total of the order including additional charges.
     *
     * @param float $subtotal - The subtotal of the order
     * @param array $additionalCharges - Associative array of additional charge types and amounts
     * @return float
     */
    public function calculateOrderTotal(float $subtotal, array $additionalCharges = []): float
    {
        $chargesTotal = $this->calculateAdditionalCharges($additionalCharges);
        return $subtotal + $chargesTotal;
    }

    protected function calculateAdditionalCharges(array $charges): float
    {
        $totalCharges = 0.00;
        foreach ($charges as $charge) {
            $totalCharges += $charge['amount'];
        }
        return $totalCharges;
    }
}
