<?php

namespace App\Http\Controllers\API\V1\Vendor;

use App\Traits\ApiResponse;
use App\Http\Controllers\Controller;
use App\Services\Tenant\Order\OrderService;
use Symfony\Component\HttpFoundation\Response;
use App\Services\Tenant\Order\Builders\OrderBuilder;
use App\Services\Tenant\Order\DeliveryChargeService;
use App\Http\Requests\Vendor\Orders\PlaceOrderRequest;
use App\Services\Tenant\Order\Directors\OrderDirector;
use App\Http\Requests\Vendor\Orders\GetDeliveryChargesRequest;

/**
 * @tags Order
 */
class OrderController extends Controller
{
    use ApiResponse;
    protected $orderService;
    protected $deliveryChargeService;

    public function __construct(OrderService $orderService, DeliveryChargeService $deliveryChargeService)
    {
        $this->orderService = $orderService;
        $this->deliveryChargeService = $deliveryChargeService;
    }

    /**
     * Calculate Delivery Charges
     *
     * 💵🚚 Curious about the delivery charges? Use this endpoint to find out exactly how much it'll cost to get your yummy food delivered right to your doorstep. Just provide your address ID and let us handle the rest!
     */
    public function calculateDeliveryCharges(GetDeliveryChargesRequest $request)
    {
        $data = $request->validated();
        // dd($data);
        $address_id = (int) $data['address_id'];
        $delivery = $this->deliveryChargeService->calculateDeliveryCharge($address_id);
        return $this->successResponse($delivery, "Delivery charge calculated successfully!");
    }
    /**
     * Place Order
     *
     * 🛒🍔 Ready to chow down? Use this endpoint to securely place your order. Just fill in the required details and you'll receive an order ID as confirmation. Let's make your mealtime amazing!
     */
    public function placeOrder(PlaceOrderRequest $request)
    {
        $data = [];
        $director = new OrderDirector();
        $order = $director->placeOrder(new OrderBuilder($this->orderService), $request->validated(), $request->user());
        $data['order_id'] = $order->order_id;
        return $this->successResponse($data, "Order successfully placed!", Response::HTTP_CREATED);
    }
}
