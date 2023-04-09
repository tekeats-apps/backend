<?php

namespace App\Http\Livewire\Admin\Restaurants;

use App\Models\Tenant;
use Livewire\Component;

class RestaurantsList extends Component
{
    public function render()
    {
        return view('livewire.admin.restaurants.restaurants-list', ['restaurants' => []]);
    }

    public function getRestaurants()
    {

         $orders = Tenant::getRestaurantsList();
         return $orders;
    }

}
