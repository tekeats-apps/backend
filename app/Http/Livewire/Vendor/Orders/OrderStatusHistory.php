<?php

namespace App\Http\Livewire\Vendor\Orders;

use Livewire\Component;
use App\Models\Vendor\OrderStatusHistory as OrderStatus;

class OrderStatusHistory extends Component
{
    public $order;
    public $orderStatusHistory;

    protected $listeners = ['orderStatusUpdated'];

    public function mount($order)
    {
        $this->order = $order;
        $this->getOrderHistory();
    }

    public function render()
    {
        return view('livewire.vendor.orders.order-status-history');
    }

    protected function getOrderHistory()
    {
        $this->orderStatusHistory = OrderStatus::ofOrder($this->order->id)->get();
    }

    // This method will be called when the 'orderStatusUpdated' event is emitted
    public function orderStatusUpdated()
    {
        $this->getOrderHistory(); // Refresh the order history
    }
}
