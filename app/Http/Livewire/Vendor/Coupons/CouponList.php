<?php

namespace App\Http\Livewire\Vendor\Coupons;

use App\Models\Vendor\Coupon;
use Livewire\Component;

class CouponList extends Component
{
    public $search;
    public $perPage = 10;
    public $sortField = 'created_at';
    public $sortDirection = 'desc';

    protected $listeners = ['delete' => 'destroy'];

    public function render()
    {
        return view('livewire.vendor.coupons.coupon-list', ['coupons' => $this->getCouponsList()]);
    }

    private function getCouponsList()
    {
        return Coupon::getList($this->search, $this->sortField, $this->sortDirection)->paginate($this->perPage);
    }

    public function toggleStatus($id)
    {
        try {
            $coupon = Coupon::findOrFail($id);
            $coupon->active = !$coupon->active;
            $coupon->update();

            $message = $coupon->active ? 'Active' : 'Inactive';
            $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => 'Status updated to ' . $message]);
        } catch (\Exception $e) {
            session()->flash('error', 'Failed to update coupon status: ' . $e->getMessage());
        }
    }

    public function confirmDelete($id)
    {
        // Show the SweetAlert confirmation dialog
        $this->emit('swal:confirm-delete', [
            'title' => 'Are you sure?',
            'text' => 'You are about to delete the coupon. This action cannot be undone.',
            'id' => $id,
        ]);
    }

    public function destroy($id)
    {
        try {
            Coupon::findOrFail($id)->delete();
            $this->dispatchBrowserEvent('alert', ['type' => 'success', 'message' => 'Coupon deleted successfully!']);
        } catch (\Exception $e) {
            session()->flash('error', 'Failed to delete coupon: ' . $e->getMessage());
        }
    }
}
