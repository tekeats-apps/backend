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

    public function render()
    {
        return view('livewire.vendor.discounts.discount-list', ['discounts' => $this->getDiscountsList()]);
    }

    private function getDiscountsList()
    {
        return Discount::getList($this->search, $this->sortField, $this->sortDirection)->paginate($this->perPage);
    }
}
