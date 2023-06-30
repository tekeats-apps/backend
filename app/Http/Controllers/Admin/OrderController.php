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
        $order = Order::createNewOrder($data);
        $data['order_id'] = $order->id;
        try {
            $tenant = Tenant::registerRestaurant($data);
            Tenant::registerTenantUser($tenant, $data, 'admin');
        } catch (\Exception $e) {
            $order->delete(); // rollback order creation

            // Delete the tenant's database
            try {
                DB::statement("DROP DATABASE IF EXISTS {$tenant->database}");
            } catch (\Exception $ex) {
                // Handle the exception if the database deletion fails
                dd($ex->getMessage());
            }
            dd($e->getMessage());
            return redirect()->route('admin.order.list')->with('danger', 'Failed to create tenant: ' . $e->getMessage());
        }

        if (!$order) {
            $tenant->delete(); // rollback tenant creation
            return redirect()->route('admin.order.list')->with('danger', 'Something went wrong!');
        }

        return redirect()->route('admin.order.list')->with('success', 'Order created successfully!');
    }
}
