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
     * Get Localization Settings
     *
     * Fetch all the localization settings for the platform.
     */
    public function getLocalizationSettings(): \Illuminate\Http\JsonResponse
    {
        try {
            $settings = $this->settingService->getLocalizationSettings();
            return $this->successResponse($settings, "Localization settings retrieved successfully!");
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Get Order Settings
     *
     * Fetch all the order settings for the platform.
     */
    public function getOrderSettings(): \Illuminate\Http\JsonResponse
    {
        try {
            $settings = $this->settingService->getOrderSettings();
            return $this->successResponse($settings, "Order settings retrieved successfully!");
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Get Media Settings
     *
     * Fetch all the media settings for the platform.
     */
    public function getMediaSettings(): \Illuminate\Http\JsonResponse
    {
        try {
            $settings = $this->settingService->getMediaSettings();
            return $this->successResponse($settings, "Media settings retrieved successfully!");
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
