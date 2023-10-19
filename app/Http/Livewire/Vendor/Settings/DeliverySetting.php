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
    public float $delivery_charges;

    protected function rules()
    {
        return [
            'free_delivery' => 'boolean',
            'free_delivery_charge_type' => ['required', 'in:' . implode(',', DeliveryTypes::getAll())],
            'free_delivery_radius' => 'required_if:free_delivery_charge_type,' . DeliveryTypes::DISTANCE . '|numeric',
            'delivery_charge_type' => ['required', 'in:' . implode(',', DeliveryTypes::getAll())],
            'distance_unit' => ['required', 'in:' . implode(',', DistanceUnit::getAll())],
            'distance_based_radius' => 'required_if:delivery_charge_type,' . DeliveryTypes::DISTANCE . '|numeric',
            'delivery_charges' => 'required_if:delivery_charge_type,Flat|numeric',
        ];
    }


    public function getDeliveryUnitsProperty()
    {
        return DistanceUnit::getAll();
    }

    public function getDeliveryTypesProperty()
    {
        return DeliveryTypes::getAll();
    }

    public function mount(DeliverySettings $settings)
    {
        $this->free_delivery = $settings->free_delivery ?? false;
        $this->free_delivery_charge_type = $settings->free_delivery_charge_type ?? 'flat';
        $this->free_delivery_radius = $settings->free_delivery_radius ?? 0;
        $this->delivery_charge_type = $settings->delivery_charge_type ?? 'flat';
        $this->distance_unit = $settings->distance_unit ?? 'kilometers';
        $this->distance_based_radius = $settings->distance_based_radius ?? 0;
        $this->delivery_charges = $settings->delivery_charges ?? 0.00;
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
            $settings->free_delivery = $this->free_delivery;
            $settings->free_delivery_charge_type = $this->free_delivery_charge_type;
            $settings->free_delivery_radius = $this->free_delivery_radius;
            $settings->delivery_charge_type = $this->delivery_charge_type;
            $settings->distance_unit = $this->distance_unit;
            $settings->distance_based_radius = $this->distance_based_radius;
            $settings->delivery_charges = $this->delivery_charges;

            $settings->save();

            session()->flash('message', 'Delivery Settings Successfully Updated.');
        } catch (\Exception $e) {
            Log::error('An error occurred while updating the delivery settings: ', ['error' => $e]);
            session()->flash('error', 'An error occurred while updating the delivery settings: ' . $e->getMessage());
        }
    }
}
