<?php

namespace App\Http\Livewire\Vendor\Orders;

use Livewire\Component;
use App\Models\Vendor\Order;

class OrderDetail extends Component
{
    public $order_id;
    public $order;

    public function mount($order_id)
    {
        $this->order_id = $order_id;
        $this->order = Order::find($order_id);
    }

    public function render()
    {
        return view('livewire.vendor.orders.order-detail');
    }
}
