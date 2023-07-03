<?php

namespace App\Http\Livewire\Vendor\Products\Extras;

use Livewire\Component;
use App\Models\Vendor\Extra;
use App\Models\Vendor\Product;

class ExtrasList extends Component
{
    public $productId;
    public $extras;

    protected $listeners = ['extraAdded' => 'showSuccessMessage', 'delete-extra' => 'deleteExtra'];

    public function showSuccessMessage()
    {
        session()->flash('message', 'Product Extra added or updated Successfully.');
        $this->loadExtras(); // reload the extras
    }

    public function mount($productId)
    {
        $this->productId = $productId;
        $this->loadExtras();
    }

    public function loadExtras()
    {
        $this->extras = Product::getProductExtras($this->productId)->get();
    }

    public function edit($extraId)
    {
        $this->emitTo('vendor.products.extras.product-extra', 'editExtra', $extraId);
    }

    public function render()
    {
        return view('livewire.vendor.products.extras.extras-list');
    }

    public function toggleStatus($extraId)
    {
        $extra = Extra::findOrFail($extraId);
        $extra->status = !$extra->status;
        $extra->save();

        $statusMessage = $extra->status ? 'Active' : 'Inactive';
        session()->flash('message', 'Status updated to ' . $statusMessage);

        $this->loadExtras();
    }

    public function confirmDelete($extraId)
    {
        Extra::findOrFail($extraId);

        // Show the SweetAlert confirmation dialog
        $this->emit('swal:confirm-delete', [
            'title' => 'Are you sure?',
            'text' => 'You are about to delete the Extra. This action cannot be undone.',
            'extraId' => $extraId,
        ]);
    }

    public function deleteExtra($extraId)
    {
        try {
            $extra = Extra::findOrFail($extraId);

            // Detach all related products
            $extra->products()->detach();

            // Delete the Extra
            $extra->delete();

            session()->flash('message', 'Product Extra Deleted Successfully.');
        } catch (\Exception $e) {
            $this->addError('delete', 'Something went wrong: ' . $e->getMessage());
        }
        // Refresh the component to update the UI
        $this->loadExtras();
    }
}
