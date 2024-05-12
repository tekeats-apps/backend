<?php

namespace App\Http\Controllers\API\V1\Vendor;

use Exception;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Settings\GeneralSettings;
use App\Settings\DeliverySettings;
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

    protected function getRestaurantInfo()
    {
        return [
            'name' => $this->generalSettings->name,
            'email' => $this->generalSettings->email,
            'phone' => $this->generalSettings->phone,
            'address' => $this->generalSettings->address,
            'country' => $this->generalSettings->country,
            'city' => $this->generalSettings->city,
            'latitude' => $this->generalSettings->latitude,
            'longitude' => $this->generalSettings->longitude,
        ];
    }
    protected function getDeliverySettings()
    {
        return [
            'free_delivery' => $this->deliverySettings->free_delivery,
            'free_delivery_charge_type' => $this->deliverySettings->free_delivery_charge_type,
            'free_delivery_radius' => $this->deliverySettings->free_delivery_radius,
            'delivery_charge_type' => $this->deliverySettings->delivery_charge_type,
            'distance_unit' => $this->deliverySettings->distance_unit,
            'distance_based_radius' => $this->deliverySettings->distance_based_radius,
            'delivery_charges' => $this->deliverySettings->delivery_charges,
            'range_based_charges' => $this->deliverySettings->range_based_charges,
        ];
    }
}
