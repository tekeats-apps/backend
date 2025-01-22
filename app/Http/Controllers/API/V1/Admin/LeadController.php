<?php

namespace App\Http\Controllers\API\V1\Admin;

use App\Models\Lead;
use App\Enums\LeadStatus;
use App\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;
use App\Services\Admin\LeadService;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Requests\Admin\Lead\StoreLeadRequest;

class LeadController extends Controller
{
    use ApiResponse;

    public function __construct(protected LeadService $leadService) {}

    public function store(StoreLeadRequest $request): JsonResponse
    {
        try {
            $lead = $this->leadService->createLead($request->validated());
            return $this->successResponse(null, "Lead created successfully!");
        }catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }


    }

    public function getLeads(): JsonResponse
    {
        try {
            $leads = $this->leadService->getLeadsByStatus();
            return $this->successResponse($leads, "Leads retrieved successfully!");
        }catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function updateStatus(Lead $lead, LeadStatus $status): JsonResponse
    {
        try {
            $this->leadService->updateLeadStatus($lead, $status);
            return $this->successResponse(null, "Lead status updated successfully!");
        }catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
