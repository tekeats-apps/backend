<?php

namespace App\Http\Controllers\API\V1\Vendor;

use Exception;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Models\Vendor\DeliverySetting;
use App\Models\Vendor\LocalizationSetting;
use App\Models\Vendor\OrderSetting;
use App\Models\Vendor\RestaurantInfo;

class SettingController extends Controller
{
    use ApiResponse;

    public function getSettings(Request $request)
    {
        try {
            $settings = [
                'restaurnat_info' => $this->getRestaurantInfo(),
                'delivery_settings' => $this->getDeliverySettings(),
                'localization_settings' => $this->getLocalizationSettings(),
                'order_settings' => $this->getOrderSettings()
            ];
            return $this->successResponse($settings, "Settings fetched successfully.", Response::HTTP_OK);
        } catch (Exception $e) {
            return $this->exceptionResponse($e, "Failed to fetch settings.");
        }
    }

    protected function getRestaurantInfo()
    {
        return RestaurantInfo::first();
    }
    protected function getDeliverySettings()
    {
        return DeliverySetting::first();
    }
    protected function getLocalizationSettings()
    {
        return LocalizationSetting::first();
    }
    protected function getOrderSettings()
    {
        return OrderSetting::first();
    }
}
