<?php

namespace App\Http\Controllers\API\V1\Admin\Tenant;

use Exception;
use App\Models\Admin\Plan;
use App\Http\Controllers\Controller;
use App\Traits\ApiResponse;
use Symfony\Component\HttpFoundation\Response;

/**
 * @tags Admin
 */

class PlanController extends Controller
{
    use ApiResponse;
    /**
     * Get Active Plans List
     *
     * 🔄 Retrieve a list of active plans with specified fields.
     *
     * This endpoint allows you to fetch a list of active plans, providing flexibility in selecting specific fields such as 'id' and 'name'.
     *
     * @response {
     *    "success": true,
     *    "data": [
     *        {"id": 1, "name": "Basic Plan"},
     *        {"id": 2, "name": "Pro Plan"},
     *        ...
     *    ],
     *    "message": "Plans fetched successfully!"
     * }
     * @response 500 {"success": false, "message": "Internal Server Error"}
     */
    public function getPlansList()
    {
        try {
            $activePlans = Plan::activePlans(['id', 'name'])->get();
            return $this->successResponse($activePlans, "Plans fetched successfully!");
        } catch (Exception $e) {

            return $this->errorResponse($e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
