<?php

namespace App\Http\Controllers\API\V1\Platform;

use App\Traits\ApiResponse;
use App\Http\Controllers\Controller;
use App\Services\Platform\DomainService;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Requests\Platform\Domain\CreateDomainRequest;

class DomainController extends Controller
{
    use ApiResponse;

    public DomainService $domainService;

    public function __construct(DomainService $domainService)
    {
        $this->domainService = $domainService;
    }

    public function getDomains()
    {
        try {
            $domains = $this->domainService->getTenantDomains();
            return $this->successResponse($domains, "Domains fetched successfully!");
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function createDomain(CreateDomainRequest $request)
    {
        try {
            $domain = $this->domainService->createDomain($request->all());
            return $this->successResponse($domain, "Domain created successfully!");
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function deleteDomain($id)
    {
        try {
            $this->domainService->deleteDomain($id);
            return $this->successResponse([], "Domain deleted successfully!");
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
