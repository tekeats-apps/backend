<?php

namespace App\Http\Livewire\Vendor\Orders;

use App\Models\Vendor\Order;
use Livewire\WithPagination;
use Livewire\Component;

class OrderList extends Component
{
    use WithPagination;

    public $search;
    public $startDate;
    public $endDate;
    public $status;
    public $paymentStatus;
    public $perPage = 10;
    public $sortField = 'created_at';
    public $sortDirection = 'desc';

    protected $rules = [
        'startDate' => 'nullable|date',
        'endDate' => 'nullable|date|after_or_equal:startDate',
    ];

    protected $listeners = ['startDateChange', 'endDateChange'];

    public function render()
    {
        $orders = $this->getOrders();
        return view('livewire.vendor.orders.order-list', ['orders' => $orders]);
    }
    public function getOrders()
    {
        $orders = Order::getOrdersList($this->search, $this->status, $this->paymentStatus, $this->startDate, $this->endDate, $this->sortField, $this->sortDirection)->paginate($this->perPage);
        return $orders;
    }

    public function startDateChange($startDate)
    {
        $this->startDate = $startDate;
        $this->validate();
    }

    public function endDateChange($endDate)
    {
        $this->endDate = $endDate;
        $this->validate();
    }
}
