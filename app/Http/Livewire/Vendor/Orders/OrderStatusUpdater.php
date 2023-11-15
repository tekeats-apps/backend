<?php

namespace App\Http\Livewire\Vendor\Orders;

use Livewire\Component;
use App\Models\Vendor\OrderStatusHistory;

class OrderStatusUpdater extends Component
{
    public $order;
    public $status;
    public $orderStatusHistory;

    public function mount($order)
    {
        $this->order = $order;
        $this->status = $order->status;
        $this->getOrderHistory();
    }

    public function render()
    {
        return view('livewire.vendor.orders.order-status-updater');
    }

    public function updateOrderStatus($newStatus)
    {
        if ($this->status != $newStatus) {
            $this->status = $newStatus;
            $this->order->status = $newStatus;
            $this->order->save();

            // Create a new OrderStatusHistory record
            OrderStatusHistory::create([
                'order_id' => $this->order->id,
                'status' => $newStatus,
            ]);
            $this->getOrderHistory();
        }
    }

    protected function getOrderHistory()
    {
        $this->orderStatusHistory = OrderStatusHistory::ofOrder($this->order->id)->get();
    }
}
