<?php

namespace App\Http\Controllers\API\V1\Platform;

use App\Traits\ApiResponse;
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

            // Update the order status
            $updatedOrder = $this->orderService->updateOrderStatus($order, $status);

            // Return success response
            return $this->successResponse($updatedOrder, "Order status updated successfully!");
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }


}
