<?php

namespace App\Http\Controllers\API\V1\Platform;

use App\Traits\ApiResponse;
use App\Http\Controllers\Controller;
use App\Services\Platform\SettingService;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Requests\Platform\Settings\UpdateMediaSettingRequest;
use App\Http\Requests\Platform\Settings\UpdateOrderSettingRequest;
use App\Http\Requests\Platform\Settings\UpdateGeneralSettingRequest;
use App\Http\Requests\Platform\Settings\UpdateDeliverySettingRequest;
use App\Http\Requests\Platform\Settings\UpdateLocalizationSettingRequest;

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
     * Update General Settings
     *
     * Update the general settings for the platform.
     */
    public function updateGeneralSettings(UpdateGeneralSettingRequest $request): \Illuminate\Http\JsonResponse
    {
        try {
            $updatedSettings = $this->settingService->updateGeneralSettings($request->validated());
            return $this->successResponse($updatedSettings, "General settings updated successfully!");
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Update Delivery Settings
     *
     * Update the Delivery settings for the platform.
     */
    public function updateDeliverySettings(UpdateDeliverySettingRequest $request): \Illuminate\Http\JsonResponse
    {
        try {
            $updatedSettings = $this->settingService->updateDeliverySettings($request->validated());
            return $this->successResponse($updatedSettings, "Delivery settings updated successfully!");
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Update Order Settings
     *
     * Update the Order settings for the platform.
     */
    public function updateOrderSettings(UpdateOrderSettingRequest $request): \Illuminate\Http\JsonResponse
    {
        try {
            $updatedSettings = $this->settingService->updateOrderSettings($request->validated());
            return $this->successResponse($updatedSettings, "Order settings updated successfully!");
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Update Localization Settings
     *
     * Update the Localization settings for the platform.
     */
    public function updateLocalizationSettings(UpdateLocalizationSettingRequest $request): \Illuminate\Http\JsonResponse
    {
        try {
            $updatedSettings = $this->settingService->updateLocalizationSettings($request->validated());
            return $this->successResponse($updatedSettings, "Localization settings updated successfully!");
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Update Media Settings
     *
     * Update the Media settings for the platform.
     */
    public function updateMediaSettings(UpdateMediaSettingRequest $request): \Illuminate\Http\JsonResponse
    {
        try {
            $updatedSettings = $this->settingService->updateMediaSettings($request->validated());
            return $this->successResponse($updatedSettings, "Media settings updated successfully!");
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
