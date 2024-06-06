<?php

namespace App\Repositories\Platform\Settings;

interface SettingRepositoryInterface
{
    /**
     * Retrieve all general settings.
     *
     * @return mixed
     */
    public function getGeneralSettings();

    /**
     * Retrieve all delivery settings.
     *
     * @return mixed
     */
    public function getDeliverySettings();
    public function getBusinessTiming();
}
