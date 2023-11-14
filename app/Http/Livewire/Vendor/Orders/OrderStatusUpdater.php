<?php

namespace App\Http\Livewire\Vendor\Orders;

use Livewire\Component;

class OrderStatusUpdater extends Component
{
    public $order;
    public $status;

    public function mount($order)
    {
        $this->order = $order;
        $this->status = $order->status;
    }

    public function render()
    {
        return view('livewire.vendor.orders.order-status-updater');
    }

    public function updateOrderStatus($newStatus)
    {
        // Logic to update order status
        $this->status = $newStatus;
        $this->order->status = $newStatus;
        $this->order->save();

        // Additional logic (e.g., emit event, flash message)
    }
}
