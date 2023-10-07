<?php

namespace App\Http\Controllers\API\V1\Vendor;

use App\Traits\ApiResponse;
use App\Http\Controllers\Controller;
use App\Services\Tenant\Order\OrderService;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Requests\Vendor\Orders\PlaceOrderRequest;

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
        $validatedData = $request->validated();
        $validatedData['customer_id'] = $request->user()->id;
        $order = $this->orderService->placeOrder($validatedData);
        $data['order_id'] = $order->order_id;
        return $this->successResponse($data, "Order successfully placed!", Response::HTTP_CREATED);
    }
}
