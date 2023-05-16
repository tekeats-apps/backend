<?php

namespace App\Http\Livewire\Admin\Restaurants;

use App\Models\Tenant;
use Livewire\Component;
use Livewire\WithPagination;

class RestaurantsList extends Component
{
    use WithPagination;
    public $search;
    public $status;
    public $perPage = 10;
    public $sortField = 'created_at';
    public $sortDirection = 'desc';
    public function render()
    {
        $restaurants = $this->getRestaurants();
        return view('livewire.admin.restaurants.restaurants-list', ['restaurants' => $restaurants]);
    }

    public function getRestaurants()
    {
        $restaurants = Tenant::getRestaurantsList($this->search, $this->status, $this->sortField, $this->sortDirection)->paginate($this->perPage);
        return $restaurants;
    }

}
