<?php

namespace App\Http\Controllers\API\V1\Vendor;

use Exception;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Services\Platform\SettingService;

/**
 * @tags Settings
 */
class SettingController extends Controller
{
    use ApiResponse;
    
    protected SettingService $settingService;

    public function __construct(SettingService $settingService)
    {
        $this->settingService = $settingService;
    }

    /**
     * Fetch All Settings
     *
     *  🛠️⚙️ Need to know how your restaurant is configured? Use this endpoint to get all the setup details at once! This is your go-to place for finding out about your restaurant's info, delivery settings, localization preferences, and how orders are handled
     */
    public function getSettings(Request $request)
    {
        try {
            $settings = [
                'restaurnat_info' => $this->settingService->getGeneralSettings(),
                'delivery_settings' => $this->settingService->getDeliverySettings(),
                'order_settings' => $this->settingService->getOrderSettings(),
                'localization_settings' => $this->settingService->getLocalizationSettings(),
                'media_settings' => $this->settingService->getMediaSettings(),
            ];
            return $this->successResponse($settings, "Settings fetched successfully.", Response::HTTP_OK);
        } catch (Exception $e) {
            return $this->exceptionResponse($e, "Failed to fetch settings.");
        }
    }
}
