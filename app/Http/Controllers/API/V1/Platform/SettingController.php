<?php

namespace App\Http\Controllers\API\V1\Platform;

use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Platform\SettingService;
use Symfony\Component\HttpFoundation\Response;

class SettingController extends Controller
{
    use ApiResponse;
    protected SettingService $settingService;

    public function __construct(SettingService $settingService)
    {
        $this->settingService = $settingService;
    }

     /**
     * Get General Settings
     *
     * Fetch all the general settings for the platform.
     */
    public function getGeneralSettings(): \Illuminate\Http\JsonResponse
    {
        try {
            $settings = $this->settingService->getGeneralSettings();
            return $this->successResponse($settings, "General settings retrieved successfully!");
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Get Delivery Settings
     *
     * Fetch all the delivery settings for the platform.
     */
    public function getDeliverySettings(): \Illuminate\Http\JsonResponse
    {
        try {
            $settings = $this->settingService->getDeliverySettings();
            return $this->successResponse($settings, "Delivery settings retrieved successfully!");
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Get Business Timing
     *
     * Fetch business timing/working hours with slots for the platform.
     */
    public function getBusinessTiming(): \Illuminate\Http\JsonResponse
    {
        try {
            $settings = $this->settingService->getBusinessTiming();
            return $this->successResponse($settings, "Business timing retrieved successfully!");
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    
}
