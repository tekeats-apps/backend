<?php

namespace App\Http\Livewire\Vendor\Settings;

use Exception;
use Livewire\Component;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Log;
use App\Models\Vendor\DeliverySetting as RestaurantDeliverySetting;

class DeliverySetting extends Component
{
    public $free_delivery;
    public $delivery_unit;
    public $delivery_radius;
    public $delivery_charges;
    public $additional_charges;

    protected function rules()
    {
        return [
            'free_delivery' => 'boolean',
            'delivery_unit' => ['required', Rule::in(RestaurantDeliverySetting::DELIVERY_UNITS)],
            'delivery_radius' => 'required|numeric',
            'delivery_charges' => 'required|numeric',
            'additional_charges' => 'required|numeric',
        ];
    }


    public function getDeliveryUnitsProperty()
    {
        return RestaurantDeliverySetting::DELIVERY_UNITS;
    }

    public function mount()
    {
        $deliverySetting = RestaurantDeliverySetting::first();
        if ($deliverySetting) {
            $this->free_delivery = $deliverySetting->free_delivery;
            $this->delivery_unit = $deliverySetting->delivery_unit;
            $this->delivery_radius = $deliverySetting->delivery_radius;
            $this->delivery_charges = $deliverySetting->delivery_charges;
            $this->additional_charges = $deliverySetting->additional_charges;
        }
    }

    public function render()
    {
        return view('livewire.vendor.settings.delivery-setting');
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function save()
    {
        $this->validate();
        try {
            $data = [
                'free_delivery' => $this->free_delivery,
                'delivery_unit' => $this->delivery_unit,
                'delivery_radius' => $this->delivery_radius,
                'delivery_charges' => $this->delivery_charges,
                'additional_charges' => $this->additional_charges
            ];

            $restaurant = RestaurantDeliverySetting::first();
            if ($restaurant) {
                $restaurant->update($data);
            } else {
                RestaurantDeliverySetting::create($data);
            }

            session()->flash('message', 'Delivery Settings Successfully Updated.');
        } catch (Exception $e) {
            Log::error('An error occurred while updating the restaurant delivery settings: ', ['error' => $e]);
            session()->flash('error', 'An error occurred while updating the restaurant delivery settings:' . $e->getMessage());
        }
    }
}
