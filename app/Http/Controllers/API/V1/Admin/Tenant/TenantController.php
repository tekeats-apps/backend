<?php

namespace App\Http\Controllers\API\V1\Admin\Tenant;

use Exception;
use App\Models\Admin\Plan;
use App\Traits\ApiResponse;
use App\Http\Controllers\Controller;
use App\Services\Admin\Tenant\TenantService;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Requests\Admin\Api\Tenants\RegisterTenantRequest;
use App\Http\Requests\Admin\Api\Tenants\ValidateDomainRequest;
use App\Http\Requests\Admin\Api\Tenants\ValidateBusinessRequest;

/**
 * @tags Admin
 */

class TenantController extends Controller
{
    use ApiResponse;
    protected $tenantService;

    public function __construct(TenantService $tenantService)
    {
        $this->tenantService = $tenantService;
    }
    /**
     * Resgister Restaurant
     *
     * 🗝️ Use this endpoint to register business on our system to enjoy our apps and services!
     */
    public function registerTenant(RegisterTenantRequest $request)
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
            $plan = Plan::getById($data['plan_id']);

            $subscription = $this->tenantService->subscribeToPlan($tenant, $plan);
            if (!$subscription) {
                throw new Exception("Plan subscription failed.");
            }

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
    public function checkBusinessName(ValidateBusinessRequest $request)
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
    public function checkDomain(ValidateDomainRequest $request)
    {
        $data = $request->validated();
        if ($this->tenantService->isDomainUnique($data['domain'])) {
            return $this->successResponse(null, "Domain is unique.");
        } else {
            return $this->errorResponse("Domain is already taken.", Response::HTTP_UNPROCESSABLE_ENTITY);
        }
    }
}
