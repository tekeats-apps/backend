<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use App\Models\Tenant;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CreateOrder;

class OrderController extends Controller
{
    public function index()
    {
        return view('admin.modules.orders.index');
    }

    public function create()
    {
        return view('admin.modules.orders.create');
    }

    public function store(CreateOrder $request)
    {
        $data = $request->validated();

        try {
            DB::beginTransaction();

            $order = Order::createNewOrder($data);
            $data['order_id'] = $order->id;

            $tenant = Tenant::registerRestaurant($data);
            Tenant::registerTenantUser($tenant, $data, 'admin');

            DB::commit();

            return redirect()->route('admin.order.list')->with('success', 'Order created successfully!');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('admin.order.list')->with('error', 'Failed to create order and tenant: ' . $e->getMessage());
        }
    }

}
