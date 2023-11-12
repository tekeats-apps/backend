<?php

namespace App\Http\Controllers\Vendor;

use App\Models\Vendor\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    public function index()
    {
        return view('vendor.modules.orders.index');
    }

    public function detail($order_id)
    {
        return view('vendor.modules.orders.detail', compact('order_id'));
    }
}
