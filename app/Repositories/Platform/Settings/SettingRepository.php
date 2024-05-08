<?php

namespace App\Repositories\Platform\Settings;

use App\Settings\GeneralSettings;
use App\Settings\DeliverySettings;
use App\Models\Vendor\RestaurantOpeningHour;
use App\Repositories\Platform\Settings\SettingRepositoryInterface;

class SettingRepository implements SettingRepositoryInterface
{

    protected GeneralSettings $generalSettings;
    protected DeliverySettings $deliverySettings;
    protected RestaurantOpeningHour $openingHours;

    public function __construct(GeneralSettings $generalSettings, DeliverySettings $deliverySettings, RestaurantOpeningHour $openingHours)
    {
        $this->generalSettings = $generalSettings;
        $this->deliverySettings = $deliverySettings;
        $this->openingHours = $openingHours;
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
}
