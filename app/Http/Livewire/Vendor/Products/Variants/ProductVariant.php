<?php

namespace App\Http\Livewire\Vendor\Products\Variants;

use Livewire\Component;
use App\Models\Vendor\Product;
use App\Models\Vendor\Variant;

class ProductVariant extends Component
{
    public $productId, $variantId, $name, $price;

    protected $listeners = ['editVariant' => 'loadVariant'];

    protected $rules = [
        'name' => 'required',
        'price' => 'required|numeric|min:0',
    ];

    public function render()
    {
        return view('livewire.vendor.products.variants.product-variant');
    }

    public function resetInputFields()
    {
        $this->name = '';
        $this->price = '';

        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function loadVariant($variantId)
    {
        $this->variantId = $variantId;
        $variant = Variant::findOrFail($variantId);
        $this->variantId = $variant->id;
        $this->name = $variant->name;
        $this->price = $variant->price;

        $this->emit('openVariantsModal');
    }

    public function store()
    {
        $this->validate();
        try {
            // Find the product and attach the variant to it.
            $product = Product::find($this->productId);
            // Check if the product already has an variant with this name
            $existingVariant = $product->findVariantByName($this->name);

            if ($existingVariant) {
                // If an variant with this name exists, return an error
                $this->addError('name', 'An variant with this name already exists for this product.');
                return false;
            }

            // If $variantId is set, then we are updating, otherwise creating.
            if ($this->variantId) {
                $variant = Variant::updateExisting($this->variantId, $this->name, $this->price);
            } else {
                $variant = Variant::createNew($this->name, $this->price);
            }


            $product->variants()->syncWithoutDetaching($variant->id);

            $this->resetInputFields();

            // session()->flash('message', $this->variantId ? 'Product Variant Updated Successfully.' : 'Product Variant Created Successfully.');

            // Emit event to close the modal.
            $this->emit('closeVariantsModal');

            // Emit event to show the message on the list component.
            $this->emit('variantAdded');
        } catch (Exception $e) {
            $this->addError('error', 'Something went wrong: ' . $e->getMessage());
        }
    }
}
