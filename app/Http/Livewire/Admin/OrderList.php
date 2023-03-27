<?php

namespace App\Http\Livewire\Admin;

use App\Models\Order;
use Livewire\Component;

class OrderList extends Component
{
    public $orders;

    public function mount()
    {
        $this->orders = Order::with('tenant')->latest()->get();
    }

    public function render()
    {
        return view('livewire.admin.order-list');
    }
}
