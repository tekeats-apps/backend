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
        $price = $product->price;
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
        return $variant ? $variant->price : 0;
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
                $extrasPrice += $this->getExtraPrice($extraId);
            }
        }

        $total = $subtotal + $extrasPrice;

        return ['subtotal' => $subtotal, 'total' => $total];
    }

    /**
     * Calculate the total of the order.
     *
     * @param array $items
     * @return float
     */
    public function calculateOrderTotal(float $subtotal): float
    {
        // You can expand this method to include any additional calculations like taxes, discounts, etc.
        return $subtotal;
    }
}
