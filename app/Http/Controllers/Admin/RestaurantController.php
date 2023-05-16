<?php

namespace App\Http\Controllers\Admin;

use App\Models\Tenant;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AddRestaurant;

class RestaurantController extends Controller
{
    public function index(){
        return view('admin.modules.restaurants.index');
    }

    public function create(){
        return view('admin.modules.restaurants.create');
    }
}
