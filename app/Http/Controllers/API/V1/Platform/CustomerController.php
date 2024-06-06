<?php

namespace App\Http\Controllers\API\V1\Platform;

use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Platform\CustomerService;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Requests\Platform\Customer\ListCustomers;

class CustomerController extends Controller
{
    use ApiResponse;
    protected CustomerService $customerService;

    public function __construct(CustomerService $customerService)
    {
        $this->customerService = $customerService;
    }

    /**
     * Get Customers List
     *
     * @authenticated
     *
     * Fetch all the customer registered or added by platform.
     */
    public function getCustomers(ListCustomers $request): \Illuminate\Http\JsonResponse
    {
        try {
            $limit = $request->input('limit', 10);

            $customers = $this->customerService->getCustomerList()->paginate($limit);

            return $this->successResponse($customers, "Customers listed successfully!");
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    
}
