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

    public function getGeneralSettings(): array
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

    public function getDeliverySettings(): array
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

    // Function to get OrderSettings
    public function getOrderSettings(): array
    {
        $orderSettings = $this->settingRepository->getOrderSettings();
        return [
            'dine_in' => $orderSettings->dine_in,
            'pickup' => $orderSettings->pickup,
            'delivery' => $orderSettings->delivery,
            'cash_on_delivery' => $orderSettings->cash_on_delivery,
            'orders_auto_accept' => $orderSettings->orders_auto_accept,
            'allow_special_instructions' => $orderSettings->allow_special_instructions,
            'allow_order_discounts' => $orderSettings->allow_order_discounts,
            'minimum_order' => $orderSettings->minimum_order,
            'order_preparation_time' => $orderSettings->order_preparation_time,
            'order_lead_time' => $orderSettings->order_lead_time,
            'order_cutoff_time' => $orderSettings->order_cutoff_time,
        ];
    }

    public function getLocalizationSettings(): array
    {
        $localizationSettings = $this->settingRepository->getLocalizationSettings();
        return [
            'languages' => $localizationSettings->languages,
            'default_language' => $localizationSettings->default_language,
            'timezone' => $localizationSettings->timezone,
            'date_format' => $localizationSettings->date_format,
            'time_format' => $localizationSettings->time_format,
            'currency' => $localizationSettings->currency,
            'currency_symbol' => $localizationSettings->currency_symbol,
            'currency_position' => $localizationSettings->currency_position
        ];
    }

    public function getMediaSettings(): array
    {
        $mediaSettings = $this->settingRepository->getMediaSettings();
        return [
            'logo' => $mediaSettings->logo,
            'favicon' => $mediaSettings->favicon,
        ];
    }

    public function getBusinessTiming()
    {
        $businessTiming = $this->settingRepository->getBusinessTiming()->get();
        return $businessTiming;
    }
}
