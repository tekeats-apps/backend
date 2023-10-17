<?php

namespace App\Http\Livewire\Vendor\Discounts;

use App\Models\Vendor\Discount;
use Livewire\Component;

class DiscountList extends Component
{
    public $search;
    public $perPage = 10;
    public $sortField = 'created_at';
    public $sortDirection = 'desc';

    protected $listeners = ['delete' => 'destroy'];

    public function render()
    {
        return view('livewire.vendor.discounts.discount-list', ['discounts' => $this->getDiscountsList()]);
    }

    private function getDiscountsList()
    {
        return Discount::getList($this->search, $this->sortField, $this->sortDirection)->paginate($this->perPage);
    }

    public function toggleStatus($id)
    {
        try {
            $discount = Discount::findOrFail($id);
            $discount->active = !$discount->active;
            $discount->save();

            $message = $discount->active ? 'Active' : 'Inactive';
            $this->dispatchBrowserEvent('success', ['message' => 'Status updated to ' . $message]);
        } catch (\Exception $e) {
            session()->flash('error', 'Failed to update discount status: ' . $e->getMessage());
        }
    }

    public function confirmDelete($id)
    {
        // Show the SweetAlert confirmation dialog
        $this->emit('swal:confirm-delete', [
            'title' => 'Are you sure?',
            'text' => 'You are about to delete the discount. This action cannot be undone.',
            'id' => $id,
        ]);
    }

    public function destroy($id)
    {
        try {
            Discount::findOrFail($id)->delete();
            $this->dispatchBrowserEvent('success', ['message' => 'Discount deleted successfully!']);
        } catch (\Exception $e) {
            session()->flash('error', 'Failed to delete discount: ' . $e->getMessage());
        }
    }
}
