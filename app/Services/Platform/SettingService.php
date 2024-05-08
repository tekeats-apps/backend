<?php

namespace App\Services\Platform;

use App\Repositories\Platform\Settings\SettingRepository;

class SettingService
{
    protected SettingRepository $settingRepository;

    public function __construct(SettingRepository $settingRepository)
    {
        $this->settingRepository = $settingRepository;
    }

    public function getGeneralSettings()
    {
        $generalSettings = $this->settingRepository->getGeneralSettings();
        return [
            'name' => $generalSettings->name ? $generalSettings->name : tenant()->business_name,
            'email' => $generalSettings->email ? $generalSettings->email : tenant()->email,
            'phone' => $generalSettings->phone,
            'address' => $generalSettings->address,
            'address_2' => $generalSettings->address_2,
            'country' => $generalSettings->country,
            'city' => $generalSettings->city,
            'latitude' => $generalSettings->latitude,
            'longitude' => $generalSettings->longitude,
        ];
    }

    public function getDeliverySettings()
    {
        $deliverySettings = $this->settingRepository->getDeliverySettings();
        return [
            'free_delivery' => $deliverySettings->free_delivery,
            'free_delivery_charge_type' => $deliverySettings->free_delivery_charge_type,
            'free_delivery_radius' => $deliverySettings->free_delivery_radius,
            'delivery_charge_type' => $deliverySettings->delivery_charge_type,
            'distance_unit' => $deliverySettings->distance_unit,
            'distance_based_radius' => $deliverySettings->distance_based_radius,
            'delivery_charges' => $deliverySettings->delivery_charges,
            'range_based_charges' => $deliverySettings->range_based_charges,
        ];
    }

    public function getBusinessTiming(){
        $businessTiming = $this->settingRepository->getBusinessTiming()->get();
        return $businessTiming;
    }
}