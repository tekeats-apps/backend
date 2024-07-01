<?php

namespace App\Http\Controllers\API\V1\Platform;

use App\Traits\ApiResponse;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;

class DomainController extends Controller
{
    use ApiResponse;
    public function getDomains()
    {
        try {
            $domains = tenant()->domains;
            return $this->successResponse($domains, "Domains fetched successfully!");
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
