<?php

namespace App\Http\Controllers\API\V1\Vendor;

use Exception;
use App\Traits\ApiResponse;
use App\Models\Vendor\Extra;
use App\Http\Controllers\Controller;
use App\Services\Tenant\TenantService;
use App\Services\Tenant\Order\OrderService;
use Symfony\Component\HttpFoundation\Response;
use App\Exceptions\DeliveryUnavailableException;
use App\Services\Tenant\Order\Builders\OrderBuilder;
use App\Services\Tenant\Order\DeliveryChargeService;
use App\Http\Requests\Vendor\Orders\PlaceOrderRequest;
use App\Services\Tenant\Order\Directors\OrderDirector;
use App\Services\Tenant\Payment\PaymentGatewayFactory;
use App\Http\Requests\Platform\Order\PaymentCallBackRequest;
use App\Http\Requests\Vendor\Orders\GetDeliveryChargesRequest;

/**
 * @tags Order
 */
class OrderController extends Controller
{
    use ApiResponse;
    protected $orderService;
    protected $deliveryChargeService;
    protected $tenantService;

    public function __construct(OrderService $orderService, DeliveryChargeService $deliveryChargeService, TenantService $tenantService)
    {
        $this->orderService = $orderService;
        $this->deliveryChargeService = $deliveryChargeService;
        $this->tenantService = $tenantService;
    }

    /**
     * Calculate Delivery Charges
     *
     * 💵🚚 Curious about the delivery charges? Use this endpoint to find out exactly how much it'll cost to get your yummy food delivered right to your doorstep. Just provide your address ID and let us handle the rest!
     */
    public function calculateDeliveryCharges(GetDeliveryChargesRequest $request)
    {
        $data = $request->validated();
        if (!$this->tenantService->isCurrentlyOpen()) {
            return $this->errorResponse("The restaurant is currently closed.", Response::HTTP_BAD_REQUEST);
        }
        $address_id = (int) $data['address_id'];
        $delivery = $this->deliveryChargeService->calculateDeliveryCharge($address_id);
        if (!$delivery->delivery_avaiable) {
            return $this->errorResponse("Oops! It looks like you're outside our delivery zone.", Response::HTTP_BAD_REQUEST);
        }
        return $this->successResponse($delivery, "Delivery charges calculated successfully!");
    }
    /**
     * Place Order
     *
     * 🛒🍔 Ready to chow down? Use this endpoint to securely place your order. Just fill in the required details and you'll receive an order ID as confirmation. Let's make your mealtime amazing!
     */
    public function placeOrder(PlaceOrderRequest $request)
    {
        $validated = $request->validated();
        try {
            if (!$this->tenantService->isCurrentlyOpen()) {
                return $this->errorResponse("The restaurant is currently closed.", Response::HTTP_BAD_REQUEST);
            }
            
            $director = new OrderDirector();
            $order = $director->placeOrder(new OrderBuilder($this->orderService, $this->deliveryChargeService), $validated, $request->user());
        } catch (DeliveryUnavailableException $e) {
            return $this->errorResponse($e->getMessage(), Response::HTTP_BAD_REQUEST);
        } catch (Exception $e) {
            return $this->errorResponse("Oops! Something went wrong. " . $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
        return $this->successResponse($order, "Order successfully placed!", Response::HTTP_CREATED);
    }

    /**
     * Get Order Details
     *
     * 📋🛍️ Need to know what's in your order? Utilize this endpoint to retrieve comprehensive details about your placed order. Provide the order ID, and we'll furnish you with a breakdown of items, delivery information, and other essential specifics. Let's ensure your order is exactly as you expect!
     *
     * */
    public function getOrderDetails($orderId)
    {
        $orderDetails = $this->orderService->getOrderDetailsById($orderId);

        // Step 2: Process extras for each item
        foreach ($orderDetails->items as $item) {
            if (!empty($item->extras)) {
                // Assuming extras are stored as JSON of IDs: ["1", "2", ...]
                $extraIds = $item->extras;

                // Fetch additional details about extras if needed
                $extrasDetails = Extra::whereIn('id', $extraIds)->get();

                // Step 3: Merge the extras details back into the item
                $item->extrasDetails = $extrasDetails;
            }
        }

        if (!$orderDetails) {
            return $this->errorResponse("Order not found.", Response::HTTP_NOT_FOUND);
        }

        return $this->successResponse($orderDetails, "Order details fetched successfully!");
    }

    public function paymentCallback(PaymentCallBackRequest $request, $order_id)
    {
        try {

            $data = $request->validated();
            $order = $this->orderService->getOrderDetailsById($order_id);
            $paymentTransaction = PaymentGatewayFactory::make($data['payment_method'], $data, $order);
            dd($paymentTransaction);

        } catch (Exception $e) {
            return $this->errorResponse("Oops! Something went wrong. " . $e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

}
