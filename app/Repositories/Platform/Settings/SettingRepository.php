<?php

namespace App\Repositories\Platform\Settings;

use App\Settings\GeneralSettings;
use App\Settings\DeliverySettings;
use App\Repositories\Platform\Settings\SettingRepositoryInterface;

class SettingRepository implements SettingRepositoryInterface
{

    protected GeneralSettings $generalSettings;
    protected DeliverySettings $deliverySettings;

    public function __construct(GeneralSettings $generalSettings, DeliverySettings $deliverySettings)
    {
        $this->generalSettings = $generalSettings;
        $this->deliverySettings = $deliverySettings;
    }

    public function getGeneralSettings()
    {
        return $this->generalSettings;
    }

    public function getDeliverySettings()
    {
        return $this->deliverySettings;
    }
}
