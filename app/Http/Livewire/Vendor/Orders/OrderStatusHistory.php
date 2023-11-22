<?php

namespace App\Http\Livewire\Vendor\Orders;

use Livewire\Component;
use App\Models\Vendor\OrderStatusHistory as OrderStatus;

class OrderStatusHistory extends Component
{
    public $order;
    public $orderStatusHistory;

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
}
