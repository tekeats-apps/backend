<?php

namespace App\Services\Platform;

use App\Models\Vendor\Slot;
use App\Settings\MediaSettings;
use App\Traits\TenantImageUploadTrait;
use Illuminate\Support\Facades\Storage;
use App\Models\Vendor\RestaurantOpeningHour;
use App\Repositories\Platform\Settings\SettingRepository;

class SettingService
{
    use TenantImageUploadTrait;
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
            'logo' => $this->getMediaFileURL($mediaSettings->logo),
            'favicon' => $this->getMediaFileURL($mediaSettings->favicon),
        ];
    }

    protected function getMediaFileURL($value)
    {
        $image = '';
        if ($value) {
            $path = MediaSettings::IMAGE_PATH . '/' . $value;
            $image = Storage::disk('s3')->url($path);
        }

        return $image;
    }

    public function getBusinessTiming()
    {
        $businessTiming = $this->settingRepository->getBusinessTiming()->get();
        return $businessTiming;
    }

    // Function to update GeneralSettings
    public function updateGeneralSettings(array $data): array
    {
        $generalSettings = $this->settingRepository->getGeneralSettings();

        $generalSettings->name = $data['name'] ?? tenant()->business_name;
        $generalSettings->email = $data['email'] ?? tenant()->email;
        $generalSettings->phone = $data['phone'] ?? '';
        $generalSettings->address = $data['address'] ?? '';
        $generalSettings->address_2 = $data['address_2'] ?? '';
        $generalSettings->country = $data['country'] ?? '';
        $generalSettings->city = $data['city'] ?? '';
        $generalSettings->latitude = $data['latitude'] ?? null;
        $generalSettings->longitude = $data['longitude'] ?? null;

        $generalSettings->save();

        return $this->getGeneralSettings();
    }

    public function updateDeliverySettings(array $data): array
    {
        $deliverySettings = $this->settingRepository->getDeliverySettings();

        $deliverySettings->free_delivery = $data['free_delivery'] ?? false;
        $deliverySettings->free_delivery_charge_type = $data['free_delivery_charge_type'] ?? '';
        $deliverySettings->free_delivery_radius = $data['free_delivery_radius'] ?? 0;
        $deliverySettings->delivery_charge_type = $data['delivery_charge_type'] ?? '';
        $deliverySettings->distance_unit = $data['distance_unit'] ?? '';
        $deliverySettings->distance_based_radius = $data['distance_based_radius'] ?? 0;
        $deliverySettings->delivery_charges = $data['delivery_charges'] ?? 0;
        $deliverySettings->range_based_charges = $data['range_based_charges'] ?? null;

        $deliverySettings->save();

        return $this->getDeliverySettings();
    }

    public function updateOrderSettings(array $data): array
    {
        $orderSettings = $this->settingRepository->getOrderSettings();

        $orderSettings->dine_in = $data['dine_in'] ?? false;
        $orderSettings->pickup = $data['pickup'] ?? false;
        $orderSettings->delivery = $data['delivery'] ?? false;
        $orderSettings->cash_on_delivery = $data['cash_on_delivery'] ?? false;
        $orderSettings->orders_auto_accept = $data['orders_auto_accept'] ?? false;
        $orderSettings->allow_special_instructions = $data['allow_special_instructions'] ?? false;
        $orderSettings->allow_order_discounts = $data['allow_order_discounts'] ?? false;
        $orderSettings->minimum_order = $data['minimum_order'] ?? null;
        $orderSettings->order_preparation_time = $data['order_preparation_time'] ?? null;
        $orderSettings->order_lead_time = $data['order_lead_time'] ?? null;
        $orderSettings->order_cutoff_time = $data['order_cutoff_time'] ?? null;

        $orderSettings->save();

        return $this->getOrderSettings();
    }

    public function updateLocalizationSettings(array $data): array
    {
        $localizationSettings = $this->settingRepository->getLocalizationSettings();

        $localizationSettings->languages = $data['languages'] ?? null;
        $localizationSettings->default_language = $data['default_language'] ?? null;
        $localizationSettings->timezone = $data['timezone'] ?? null;
        $localizationSettings->date_format = $data['date_format'] ?? null;
        $localizationSettings->time_format = $data['time_format'] ?? null;
        $localizationSettings->currency = $data['currency'] ?? null;
        $localizationSettings->currency_symbol = $data['currency_symbol'] ?? null;
        $localizationSettings->currency_position = $data['currency_position'] ?? null;

        $localizationSettings->save();

        return $this->getLocalizationSettings();
    }

    public function updateMediaSettings(array $data): array
    {
        $mediaSettings = $this->settingRepository->getMediaSettings();

        if (isset($data['logo']) && !empty($data['logo'])) {
            $image = $data['logo'];
            $module = MediaSettings::IMAGE_PATH;
            $tableField = 'logo';

            if ($mediaSettings->logo) {
                $this->delete_image_by_name($module, $mediaSettings->logo);
            }

            $this->uploadImage($image, $module, null, $tableField, null, $mediaSettings);
        }

        if (isset($data['favicon']) && !empty($data['favicon'])) {
            $image = $data['favicon'];
            $module = MediaSettings::IMAGE_PATH;
            $tableField = 'favicon';

            if ($mediaSettings->favicon) {
                $this->delete_image_by_name($module, $mediaSettings->favicon);
            }

            $this->uploadImage($image, $module, null, $tableField, null, $mediaSettings);
        }

        return $this->getMediaSettings();
    }

    public function getAllSettings(): array
    {
        $settings = [
            'restaurnat_info' => $this->getGeneralSettings(),
            'delivery_settings' => $this->getDeliverySettings(),
            'order_settings' => $this->getOrderSettings(),
            'localization_settings' => $this->getLocalizationSettings(),
            'media_settings' => $this->getMediaSettings(),
        ];

        return $settings;
    }

    public function updateBusinessTiming(array $data)
    {
        foreach ($data['opening_hours'] as $day => $daysData) {
            $openingHour = RestaurantOpeningHour::updateOrCreate(
                ['day' => $day],
                [
                    'day' => $day,
                    'is_closed' => $daysData['is_closed'] ?? 0
                ]
            );
            
            // Update the slots
            $this->updateSlots($openingHour, $daysData['slots']);
        }

        return $this->getBusinessTiming();
    }

    private function updateSlots($openingHour, $slotsData)
    {
        // Get current slot IDs for this OpeningHour
        $currentSlotIds = $openingHour->slots()->pluck('id')->toArray();

        $newSlotIds = [];

        foreach ($slotsData as $slot) {
            // Create or update the slot
            $slot = Slot::updateOrCreate([
                'restaurant_opening_hour_id' => $openingHour->id,
                'open_time' => $slot['open_time'],
                'close_time' => $slot['close_time'],
            ]);

            $newSlotIds[] = $slot->id;
        }

        // Find IDs of slots to be removed
        $slotsToRemove = array_diff($currentSlotIds, $newSlotIds);

        // Delete the removed slots
        Slot::whereIn('id', $slotsToRemove)->delete();
    }
}
