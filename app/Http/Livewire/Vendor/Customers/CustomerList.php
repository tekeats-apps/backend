<?php

namespace App\Http\Livewire\Vendor\Customers;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Vendor\Customer;

class CustomerList extends Component
{
    use WithPagination;

    public $search;
    public $status;
    public $perPage = 5;
    public $sortField = 'created_at';
    public $sortDirection = 'desc';
    public $paginationTheme = 'bootstrap';


    public function render()
    {
        $customers = $this->loadCustomers();
        return view('livewire.vendor.customers.customer-list', compact('customers'));
    }

    public function updated($propertyName)
    {
        if (in_array($propertyName, ['search', 'status', 'sortField', 'sortDirection'])) {
            $this->loadCustomers();
        }
    }

    public function loadCustomers()
    {
        $customers = Customer::list($this->search, $this->status, $this->sortField, $this->sortDirection)->paginate($this->perPage);
        return $customers;
    }

    public function toggleStatus($userId)
    {
        $user = Customer::findOrFail($userId);
        $user->status = !$user->status;
        $user->save();

        // Refresh the component to update the UI
        $this->render();
    }
}
