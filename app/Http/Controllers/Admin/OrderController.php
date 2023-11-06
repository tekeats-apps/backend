<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use App\Models\Tenant;
use App\Models\Admin\Plan;
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
        $plans = Plan::getList()->pluck('name', 'id');
        return view('admin.modules.orders.create', compact('plans'));
    }

    public function store(CreateOrder $request)
    {
        $data = $request->validated();

        try {
            $order = Order::createNewOrder($data);
            $data['order_id'] = $order->id;
            $plan = Plan::find($data['plan_id']);
            $tenant = Tenant::registerRestaurant($data);
            if ($tenant) {
                $tenant->newSubscription(
                    'main',
                    $plan,
                    null,
                    null,
                    null,
                    'free'
                );
            }
            Tenant::registerTenantUser($tenant, $data, 'admin');

            return redirect()->route('admin.order.list')->with('success', 'Order created successfully!');
        } catch (\Exception $e) {
            if (isset($order)) {
                $order->delete(); // Remove the created order
            }

            if (isset($tenant)) {
                $tenant->delete(); // Remove the created tenant
            }
            DB::rollback();
            return redirect()->route('admin.order.list')->with('error', 'Failed to create order and tenant: ' . $e->getMessage());
        }
    }
}
