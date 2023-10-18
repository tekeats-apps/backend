<?php

namespace App\Http\Livewire\Vendor\Settings;

use App\Enums\Tenant\DeliveryTypes;
use App\Enums\Tenant\DistanceUnit;
use Exception;
use Livewire\Component;
use Illuminate\Validation\Rule;
use App\Settings\DeliverySettings;
use Illuminate\Support\Facades\Log;

class DeliverySetting extends Component
{
    public bool $free_delivery;
    public string $free_delivery_charge_type;
    public float $free_delivery_radius;
    public string $delivery_charge_type;
    public string $distance_unit;
    public float $distance_based_radius;
    public float $flat_delivery_charge;

    protected function rules()
    {
        return [
            'free_delivery' => 'boolean',
            'free_delivery_charge_type' => ['required', 'in:' . implode(',', DeliveryTypes::getAll())],
            'free_delivery_radius' => 'required_if:free_delivery_charge_type,' . DeliveryTypes::DISTANCE . '|numeric',
            'delivery_charge_type' => ['required', 'in:' . implode(',', DeliveryTypes::getAll())],
            'distance_unit' => ['required', 'in:' . implode(',', DistanceUnit::getAll())],
            'distance_based_radius' => 'required_if:delivery_charge_type,' . DeliveryTypes::DISTANCE . '|numeric',
            'flat_delivery_charge' => 'required_if:delivery_charge_type,Flat|numeric',
        ];
    }


    public function getDeliveryUnitsProperty()
    {
        return RestaurantDeliverySetting::DELIVERY_UNITS;
    }

    public function mount(DeliverySettings $settings)
    {
        $this->free_delivery = $settings->free_delivery ?? false;
        $this->free_delivery_charge_type = $settings->free_delivery_charge_type ?? 'flat';
        $this->free_delivery_radius = $settings->free_delivery_radius ?? 0;
        $this->delivery_charge_type = $settings->delivery_charge_type ?? 'flat';
        $this->distance_unit = $settings->distance_unit ?? 'kilometers';
        $this->distance_based_radius = $settings->distance_based_radius ?? 0;
        $this->flat_delivery_charge = $settings->flat_delivery_charge ?? 0.00;
    }

    public function render()
    {
        return view('livewire.vendor.settings.delivery-setting');
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function save(DeliverySettings $settings)
    {
        $this->validate();
        try {
            $data = [
                'free_delivery' => $this->free_delivery,
                'free_delivery_charge_type' => $this->free_delivery_charge_type,
                'free_delivery_radius' => $this->free_delivery_radius,
                'delivery_charge_type' => $this->delivery_charge_type,
                'distance_unit' => $this->distance_unit,
                'distance_based_radius' => $this->distance_based_radius,
                'flat_delivery_charge' => $this->flat_delivery_charge,
            ];

            $settings->merge($data)->save();

            session()->flash('message', 'Delivery Settings Successfully Updated.');
        } catch (\Exception $e) {
            Log::error('An error occurred while updating the delivery settings: ', ['error' => $e]);
            session()->flash('error', 'An error occurred while updating the delivery settings: ' . $e->getMessage());
        }
    }
}
