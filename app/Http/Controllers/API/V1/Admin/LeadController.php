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
use App\Http\Requests\Admin\Lead\UpdateLeadStatusRequest;

class LeadController extends Controller
{
    use ApiResponse;

    public function __construct(protected LeadService $leadService) {}

    public function store(StoreLeadRequest $request): JsonResponse
    {
        try {
            $lead = $this->leadService->createLead($request->validated());
            return $this->successResponse(null, "Lead created successfully!");
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function getLeads(): JsonResponse
    {
        try {
            $limit = 10;
            $leads = $this->leadService->getLeadsByStatus()->paginate($limit);
            return $this->successResponse($leads, "Leads retrieved successfully!");
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function getLeadDetails($lead): JsonResponse
    {
        try {
            $lead = $this->leadService->getLeadDetails($lead)->load('statusHistories.user:id,name');
            if (!$lead) {
                return $this->errorResponse("Lead not found", Response::HTTP_NOT_FOUND);
            }
            $lead->available_statuses = array_map(function (LeadStatus $status) {
                return [
                    'value' => $status->value,
                    'label' => $status->getLabel(),
                    'requires_reason' => in_array($status, [LeadStatus::REJECTED, LeadStatus::CLOSED])
                ];
            }, $lead->getAvailableStatusTransitions());
            return $this->successResponse($lead, "Lead details retrieved successfully!");
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function updateStatus(UpdateLeadStatusRequest $request): JsonResponse
    {
        try {
            $validatedData = $request->validated();
            $lead = $this->leadService->getLeadDetails($validatedData['lead_id']);
            if (!$lead) {
                return $this->errorResponse("Lead not found", Response::HTTP_NOT_FOUND);
            }
            $statusEnum = LeadStatus::tryFrom($validatedData['status']);
            $this->leadService->updateLeadStatus($lead, $statusEnum, $validatedData['reason']);
            return $this->successResponse(null, "Lead status updated successfully!");
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
