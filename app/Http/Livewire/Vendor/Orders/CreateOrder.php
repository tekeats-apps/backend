<?php

namespace App\Http\Livewire\Vendor\Orders;

use Livewire\Component;

class CreateOrder extends Component
{
    public $selectedProduct;
    public $selectedProducts = [];
    public $products = [
        ['id' => 1, 'name' => 'Burger', 'price' => 5.99],
        ['id' => 2, 'name' => 'Pizza', 'price' => 8.99],
        ['id' => 3, 'name' => 'Pasta', 'price' => 7.49]
    ];
    public $variants = [
        ['id' => 1, 'name' => 'Large', 'price' => 2.00],
        ['id' => 2, 'name' => 'Medium', 'price' => 1.50]
    ];
    public $extras = [
        ['id' => 1, 'name' => 'Extra Cheese', 'price' => 0.50],
        ['id' => 2, 'name' => 'Extra Sauce', 'price' => 0.30]
    ];
    public $subtotal = 0;
    public $total = 0;

    public function render()
    {
        return view('livewire.vendor.orders.create-order');
    }

    public function addProductToOrder()
    {
        $productIndex = collect($this->selectedProducts)->search(function ($product) {
            return $product['id'] == $this->selectedProduct;
        });

        if ($productIndex !== false) {
            // If product is already in the cart, increase its quantity
            $this->selectedProducts[$productIndex]['quantity'] += 1;
        } else {
            // If product is not in the cart, add it
            $product = collect($this->products)->firstWhere('id', $this->selectedProduct);
            if ($product) {
                $product['quantity'] = 1; // Default quantity
                $product['variant'] = null;
                $product['extras'] = null;
                $product['specialInstructions'] = null;
                $this->selectedProducts[] = $product;
            }
        }

        $this->selectedProduct = null;

        // Recalculate totals
        $this->calculateTotals();
    }

    public function calculateTotals()
    {
        foreach ($this->selectedProducts as $index => $product) {
            $variantPrice = collect($this->variants)->firstWhere('id', $product['variant'])['price'] ?? 0;
            $extrasPrice = collect($this->extras)->firstWhere('id', $product['extras'])['price'] ?? 0;

            $this->selectedProducts[$index]['subtotal'] = ($product['price'] + $variantPrice + $extrasPrice) * $product['quantity'];
        }

        $this->subtotal = $this->getSubtotalProperty();
        $this->total = $this->getTotalProperty();
    }

    public function updateProduct($index, $field, $value)
    {
        $this->selectedProducts[$index][$field] = $value;
    }

    public function removeProductFromOrder($index)
    {
        unset($this->selectedProducts[$index]);
        $this->selectedProducts = array_values($this->selectedProducts); // Re-index the array
    }

    public function getSubtotalProperty()
    {
        return collect($this->selectedProducts)->sum(function ($product) {
            return $product['price'] * $product['quantity'];
        });
    }
    public function getTotalProperty()
    {
        return $this->subtotal;
    }

    public function updateProductQuantity($index, $quantity)
    {
        $this->selectedProducts[$index]['quantity'] = $quantity;

        // Recalculate totals
        $this->calculateTotals();
    }

    public function updateProductVariant($index, $variant)
    {
        $this->selectedProducts[$index]['variant'] = $variant;

        // Recalculate totals
        $this->calculateTotals();
    }

    public function updateProductExtras($index, $extras)
    {
        $this->selectedProducts[$index]['extras'] = $extras;

        // Recalculate totals
        $this->calculateTotals();
    }
}
