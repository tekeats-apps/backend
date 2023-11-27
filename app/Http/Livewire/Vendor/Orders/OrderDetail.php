<?php

namespace App\Http\Livewire\Vendor\Orders;

use Livewire\Component;
use App\Models\Vendor\Order;

class OrderDetail extends Component
{
    public $order_id;
    public $order;

    protected $listeners = ['orderStatusUpdated'];

    public function mount($order_id)
    {
        $this->order_id = $order_id;
        $this->loadOrder();
    }

    public function render()
    {
        return view('livewire.vendor.orders.order-detail');
    }

    // Method to load order details
    public function loadOrder()
    {
        $this->order = Order::find($this->order_id);
    }

    public function orderStatusUpdated()
    {
        // Refresh the order details when the event is received
        $this->loadOrder();
    }
}
