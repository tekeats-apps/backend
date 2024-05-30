<?php

namespace App\Http\Controllers\API\V1\Platform;

use App\Traits\ApiResponse;
use App\Models\Vendor\Order;
use App\Http\Controllers\Controller;
use App\Services\Platform\OrderService;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Requests\Platform\Order\ListOrders;
use App\Http\Requests\Platform\Order\UpdateOrderStatus;

class OrderController extends Controller
{
    use ApiResponse;

    protected OrderService $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    /**
     * Get Orders Listing
     *
     * @authenticated
     *
     * Fetch all the customer orders with filters.
     */
    public function getOrders(ListOrders $request): \Illuminate\Http\JsonResponse
    {
        try {
            $limit = $request->input('limit', 10);

            $customers = $this->orderService->getOrders()->paginate($limit);

            return $this->successResponse($customers, "Orders fetched successfully!");
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Get Order Details
     *
     * @authenticated
     *
     * Fetch details for order along, cusotmer, items, payment etc.
     */
    public function getOrderDetails(int $orderId): \Illuminate\Http\JsonResponse
    {
        try {
            // Get the order by ID
            $order = $this->orderService->getOrderDetailsByOrderId($orderId);

            // Check if the order exists
            if (!$order instanceof Order) {
                return $this->errorResponse("Order not found!", Response::HTTP_NOT_FOUND);
            }
            // $order = $this->orderService->getOrderDetails();
            return $this->successResponse($order, "Order details fetched successfully!");
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

        /**
     * Update Order Status
     *
     * @authenticated
     *
     * Update the status of a specific order.
     */
    public function updateOrderStatus(UpdateOrderStatus $request, $orderId): \Illuminate\Http\JsonResponse
    {
        try {
            $validatedData = $request->validated();
            $status = $validatedData['status'];

            // Get the order by ID
            $order = $this->orderService->getOrderById($orderId);

            // Check if the order exists
            if (!$order) {
                return $this->errorResponse("Order not found!", Response::HTTP_NOT_FOUND);
            }
            
            // Check if the status is different from the current status
            if ($order->status->value === $status) {
                return $this->errorResponse("Order already has the provided status!", Response::HTTP_BAD_REQUEST);
            }

            // Update the order status
            $updatedOrder = $this->orderService->updateOrderStatus($order, $status);

            // Return success response
            return $this->successResponse($updatedOrder, "Order status updated successfully!");
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

     /**
     * Get Today's Orders Grouped by Status
     *
     * @authenticated
     *
     * Fetch today's orders and group them by status.
     */
    public function getLiveOrders(): \Illuminate\Http\JsonResponse
    {
        try {
            $groupedOrders = $this->orderService->getOrdersGroupedByStatusForToday();

            return $this->successResponse($groupedOrders, "Today's orders grouped by status fetched successfully!");
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }


}
