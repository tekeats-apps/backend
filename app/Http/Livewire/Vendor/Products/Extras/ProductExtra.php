<?php

namespace App\Http\Livewire\Vendor\Products\Extras;

use Exception;
use Livewire\Component;
use App\Models\Vendor\Extra;
use App\Models\Vendor\Product;

class ProductExtra extends Component
{

    public $productId, $extraId, $name, $price;

    protected $listeners = ['editExtra' => 'loadExtra'];

    protected $rules = [
        'name' => 'required',
        'price' => 'required|numeric|min:0',
    ];

    public function render()
    {
        return view('livewire.vendor.products.extras.product-extra');
    }

    public function resetInputFields()
    {
        $this->name = '';
        $this->price = '';

        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function loadExtra($extraId)
    {
        $this->extraId = $extraId;
        $extra = Extra::findOrFail($extraId);
        $this->extraId = $extra->id;
        $this->name = $extra->name;
        $this->price = $extra->price;

        $this->emit('openExtrasModal');
    }


    public function store()
    {
        $this->validate();
        try {
            // Find the product and attach the extra to it.
            $product = Product::find($this->productId);
            // Check if the product already has an extra with this name
            $existingExtra = $product->findExtraByName($this->name);

            if ($existingExtra) {
                // If an extra with this name exists, return an error
                $this->addError('name', 'An extra with this name already exists for this product.');
                return false;
            }

            // If $extraId is set, then we are updating, otherwise creating.
            if ($this->extraId) {
                $extra = Extra::updateExisting($this->extraId, $this->name, $this->price);
            } else {
                $extra = Extra::createNew($this->name, $this->price);
            }


            $product->extras()->syncWithoutDetaching($extra->id);

            $this->resetInputFields();

            // session()->flash('message', $this->extraId ? 'Product Extra Updated Successfully.' : 'Product Extra Created Successfully.');

            // Emit event to close the modal.
            $this->emit('closeExtrasModal');

            // Emit event to show the message on the list component.
            $this->emit('extraAdded');
        } catch (Exception $e) {
            $this->addError('error', 'Something went wrong: ' . $e->getMessage());
        }
    }
}
