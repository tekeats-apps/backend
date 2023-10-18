<?php

namespace App\Http\Controllers\API\V1\Vendor;

use App\Traits\ApiResponse;
use App\Http\Controllers\Controller;
use App\Services\Tenant\Order\OrderService;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Requests\Vendor\Orders\PlaceOrderRequest;
use App\Services\Tenant\Order\Directors\OrderDirector;
use App\Services\Tenant\Order\Builders\OrderBuilder;

class OrderController extends Controller
{
    use ApiResponse;
    protected $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    public function placeOrder(PlaceOrderRequest $request)
    {
        $data = [];
        $director = new OrderDirector();
        $order = $director->placeOrder(new OrderBuilder($this->orderService), $request->validated(), $request->user());
        $data['order_id'] = $order->order_id;
        return $this->successResponse($data, "Order successfully placed!", Response::HTTP_CREATED);
    }
}
