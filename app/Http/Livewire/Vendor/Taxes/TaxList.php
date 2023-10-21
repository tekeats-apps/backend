<?php

namespace App\Http\Livewire\Vendor\Taxes;

use App\Models\Vendor\Tax;
use Livewire\Component;

class TaxList extends Component
{
    public $search;
    public $perPage = 10;
    public $sortField = 'created_at';
    public $sortDirection = 'desc';

    protected $listeners = ['delete' => 'destroy'];

    public function render()
    {
        return view('livewire.vendor.taxes.tax-list', ['taxes' => $this->getTaxesList()]);
    }

    private function getTaxesList()
    {
        return Tax::getList($this->search, $this->sortField, $this->sortDirection)->paginate($this->perPage);
    }

    public function toggleStatus($id)
    {
        try {
            $tax = Tax::findOrFail($id);
            $tax->active = !$tax->active->value;
            $tax->update();

            $message = $tax->active->value ? 'Active' : 'Inactive';
            $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => 'Status updated to ' . $message]);
        } catch (\Exception $e) {
            session()->flash('error', 'Failed to update tax status: ' . $e->getMessage());
        }
    }

    public function confirmDelete($id)
    {
        // Show the SweetAlert confirmation dialog
        $this->emit('swal:confirm-delete', [
            'title' => 'Are you sure?',
            'text' => 'You are about to delete the tax. This action cannot be undone.',
            'id' => $id,
        ]);
    }

    public function destroy($id)
    {
        try {
            Tax::findOrFail($id)->delete();
            $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => 'Tax deleted successfully!']);
        } catch (\Exception $e) {
            session()->flash('error', 'Failed to delete tax: ' . $e->getMessage());
        }
    }
}
