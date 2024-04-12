<?php

namespace App\Http\Controllers\API\V1\Platform;

use App\Http\Controllers\Controller;
use App\Services\Platform\OrderService;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Requests\Platform\Order\ListOrders;
use App\Traits\ApiResponse;

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

}
