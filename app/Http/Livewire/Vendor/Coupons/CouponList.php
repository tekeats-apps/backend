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
}
