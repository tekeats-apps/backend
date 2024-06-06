<?php

namespace App\Repositories\Platform\Settings;

use App\Settings\MediaSettings;
use App\Settings\OrderSettings;
use App\Settings\GeneralSettings;
use App\Settings\DeliverySettings;
use App\Settings\LocalizationSettings;
use App\Models\Vendor\RestaurantOpeningHour;
use App\Repositories\Platform\Settings\SettingRepositoryInterface;

class SettingRepository implements SettingRepositoryInterface
{
    public function __construct(
        protected GeneralSettings $generalSettings, 
        protected DeliverySettings $deliverySettings, 
        protected RestaurantOpeningHour $openingHours, 
        protected OrderSettings $orderSettings, 
        protected MediaSettings $mediaSettings, 
        protected LocalizationSettings $localizationSettings)
    {

    }

    public function getGeneralSettings()
    {
        return $this->generalSettings;
    }

    public function getDeliverySettings()
    {
        return $this->deliverySettings;
    }

    public function getBusinessTiming()
    {
        return $this->openingHours->with('slots');
    }

    public function getOrderSettings()
    {
        return $this->orderSettings;
    }

    public function getMediaSettings()
    {
        return $this->mediaSettings;
    }

    public function getLocalizationSettings()
    {
        return $this->localizationSettings;
    }
}
