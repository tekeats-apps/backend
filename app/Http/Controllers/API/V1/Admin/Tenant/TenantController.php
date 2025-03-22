<?php

namespace App\Http\Controllers\API\V1\Admin\Tenant;

use App\Models\Tenant;
use Exception;
use App\Models\Admin\Plan;
use App\Traits\ApiResponse;
use App\Http\Controllers\Controller;
use App\Services\Admin\Tenant\TenantService;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Requests\Admin\Api\Tenants\ListTenantsRequest;
use App\Http\Requests\Admin\Api\Tenants\RegisterTenantRequest;
use App\Http\Requests\Admin\Api\Tenants\ValidateDomainRequest;
use App\Http\Requests\Admin\Api\Tenants\ValidateBusinessRequest;
use App\Http\Requests\Admin\Api\Tenants\UpdateTenantStatusRequest;

/**
 * @tags Admin
 */

class TenantController extends Controller
{
    use ApiResponse;
    protected TenantService $tenantService;

    public function __construct(TenantService $tenantService)
    {
        $this->tenantService = $tenantService;
    }
    /**
     * Register Restaurant
     *
     * 🗝️ Use this endpoint to register business on our system to enjoy our apps and services!
     */
    public function registerTenant(RegisterTenantRequest $request): \Illuminate\Http\JsonResponse
    {
        $data = $request->validated();

        try {
            // Check if business name is unique
            if (!$this->tenantService->isBusinessNameUnique($data['business_name'])) {
                return $this->errorResponse("Business name is already taken.", Response::HTTP_UNPROCESSABLE_ENTITY);
            }

            // Check if domain is unique
            if (!$this->tenantService->isDomainUnique($data['domain'])) {
                return $this->errorResponse("Domain is already taken.", Response::HTTP_UNPROCESSABLE_ENTITY);
            }

            // Register Tenant
            $tenant = $this->tenantService->registerTenant($data);

            if (!$tenant) {
                throw new Exception("Tenant registration failed.");
            }

            // Subscribe to plan
            // $plan = Plan::getById($data['plan_id']);

            // $subscription = $this->tenantService->subscribeToPlan($tenant, $plan);
            // if (!$subscription) {
            //     throw new Exception("Plan subscription failed.");
            // }

            $this->tenantService->registerTenantUser($tenant, $data);

            return $this->successResponse($tenant, "Business registered successfully!");
        } catch (Exception $e) {

            return $this->errorResponse($e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Validate Business.
     *
     * 🔄 Use this endpoint to check the uniqueness of a business name.
     */
    public function checkBusinessName(ValidateBusinessRequest $request): \Illuminate\Http\JsonResponse
    {
        $data = $request->validated();
        if ($this->tenantService->isBusinessNameUnique($data['business_name'])) {
            return $this->successResponse(null, "Business name is unique.");
        } else {
            return $this->errorResponse("Business name is already taken.", Response::HTTP_UNPROCESSABLE_ENTITY);
        }
    }

    /**
     * Validate Domain.
     *
     * 🔄 Use this endpoint to check the uniqueness of a domain.
     */
    public function checkDomain(ValidateDomainRequest $request): \Illuminate\Http\JsonResponse
    {
        $data = $request->validated();
        if ($this->tenantService->isDomainUnique($data['domain'])) {
            return $this->successResponse(null, "Domain is unique.");
        } else {
            return $this->errorResponse("Domain is already taken.", Response::HTTP_UNPROCESSABLE_ENTITY);
        }
    }

    /**
     * List Tenants.
     *
     * 📋 Use this endpoint to get a paginated list of tenants.
     */
    public function listTenants(ListTenantsRequest $request): \Illuminate\Http\JsonResponse
    {
        try {
            $limit = $request->input('limit', 10);

            $tenants = $this->tenantService->getTenantsList()->paginate($limit);
            $tenants->load('subscriptions');

            return $this->successResponse($tenants, "Tenants listed successfully!");
        } catch (Exception $e) {
            return $this->errorResponse($e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Business Details.
     *
     * 📋 Use this endpoint to get a details of tenants.
     */
    public function getDetails(Tenant $tenant): \Illuminate\Http\JsonResponse
    {
        try {
            $tenantDetails = $this->tenantService->getTenantDetails($tenant);
            return $this->successResponse($tenantDetails, "Business details fetched successfully!");
        } catch (Exception $e) {
            return $this->errorResponse($e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Update Restaurant Status.
     *
     * 🔄 Use this endpoint to update the status of a restaurant.
     */
    public function updateStatus(UpdateTenantStatusRequest $request, $tenant): \Illuminate\Http\JsonResponse
    {
        try {
            $data = $request->validated();

            $tenant = $this->tenantService->getTenantDetails($tenant);
            if (!$tenant) {
                return $this->errorResponse("Invalid restaurant id.", Response::HTTP_NOT_FOUND);
            }

            if ($this->tenantService->updateStatus($tenant, $data['status'])) {
                return $this->successResponse(null, "Restaurant status updated successfully!");
            }

            return $this->errorResponse("Failed to update restaurant status.", Response::HTTP_INTERNAL_SERVER_ERROR);
        } catch (Exception $e) {
            return $this->errorResponse($e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
