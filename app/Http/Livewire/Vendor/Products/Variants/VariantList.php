<?php

namespace App\Http\Livewire\Vendor\Products\Variants;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Vendor\Product;
use App\Models\Vendor\Variant;

class VariantList extends Component
{
    use WithPagination;

    public $productId;
    public $variants;

    protected $listeners = ['variantAdded' => 'showSuccessMessage', 'delete-variant' => 'deleteVariant'];

    public function showSuccessMessage()
    {
        session()->flash('message', 'Product Variant added or updated Successfully.');
        $this->loadVariants(); // reload the variants
    }

    public function mount($productId)
    {
        $this->productId = $productId;
        $this->loadVariants();
    }

    public function loadVariants()
    {
        $this->variants = Product::getProductVariants($this->productId)->get();
    }

    public function render()
    {
        return view('livewire.vendor.products.variants.variant-list');
    }

    public function edit($variantId)
    {
        $this->emitTo('vendor.products.variants.product-variant', 'editVariant', $variantId);
    }

    public function toggleStatus($variantId)
    {
        $variant = Variant::findOrFail($variantId);
        $variant->status = !$variant->status;
        $variant->save();

        $statusMessage = $variant->status ? 'Active' : 'Inactive';
        session()->flash('message', 'Status updated to ' . $statusMessage);

        $this->loadVariants();
    }

    public function confirmDelete($variantId)
    {
        Variant::findOrFail($variantId);

        // Show the SweetAlert confirmation dialog
        $this->emit('swal:confirm-delete', [
            'title' => 'Are you sure?',
            'text' => 'You are about to delete the Variant. This action cannot be undone.',
            'variantId' => $variantId,
        ]);
    }

    public function deleteVariant($variantId)
    {
        try {
            $variant = Variant::findOrFail($variantId);

            // Detach all related products
            $variant->products()->detach();

            // Delete the Variant
            $variant->delete();

            session()->flash('message', 'Product Variant Deleted Successfully.');
        } catch (\Exception $e) {
            $this->addError('delete', 'Something went wrong: ' . $e->getMessage());
        }
        // Refresh the component to update the UI
        $this->loadVariants();
    }
}
