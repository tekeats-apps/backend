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

    public function render()
    {
        return view('livewire.vendor.taxes.tax-list', ['taxes' => $this->getTaxesList()]);
    }

    private function getTaxesList()
    {
        return Tax::getList($this->search, $this->sortField, $this->sortDirection)->paginate($this->perPage);
    }
}
