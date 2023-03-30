<?php

namespace App\Http\Livewire\Admin;

use App\Models\Order;
use Livewire\WithPagination;
use Livewire\Component;

class OrderList extends Component
{
    use WithPagination;

    public $search;
    public $date;
    public $status;
    public $perPage = 10;
    public $sortField = 'created_at';
    public $sortDirection = 'desc';

    protected $listeners = ['refreshOrders' => '$refresh'];


    public function render()
    {
        $orders = $this->getOrders();
        return view('livewire.admin.order-list', ['orders' => $orders]);
    }
    public function getOrders()
    {
         $orders = Order::getOrdersList($this->search, $this->status, $this->sortField, $this->sortDirection)->paginate($this->perPage);
         return $orders;
    }
}
