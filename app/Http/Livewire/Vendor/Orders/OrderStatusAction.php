<?php

namespace App\Http\Livewire\Vendor\Orders;

use Livewire\Component;
use App\Models\Vendor\OrderStatusHistory as OrderStatus;

class OrderStatusAction extends Component
{
    public $order;
    public $status;

    public function mount($order)
    {
        $this->order = $order;
        $this->status = $order->status;
    }

    public function updateOrderStatus($newStatus)
    {
        if ($this->status != $newStatus) {
            $this->status = $newStatus;
            $this->order->status = $newStatus;
            $this->order->save();

            // Create a new OrderStatus record
            OrderStatus::create([
                'order_id' => $this->order->id,
                'status' => $newStatus,
            ]);
            // Dispatch Livewire event to refresh OrderStatusHistory component
            $this->emit('orderStatusUpdated');
        }
    }

    public function render()
    {
        return view('livewire.vendor.orders.order-status-action');
    }
}
