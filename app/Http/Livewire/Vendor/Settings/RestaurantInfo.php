<?php

namespace App\Http\Livewire\Vendor\Settings;

use Livewire\Component;
use App\Settings\GeneralSettings;

class RestaurantInfo extends Component
{
    public string $name;
    public string $email;
    public string $phone;
    public string $address;
    public string $address_2;
    public string $country;
    public string $city;
    public float $latitude;
    public float $longitude;

    protected $rules = [
        'name' => 'required',
        'email' => 'nullable|email:rfc',
        'phone' => 'nullable',
        'address' => 'nullable',
        'address_2' => 'nullable',
        'country' => 'nullable',
        'city' => 'nullable',
        'latitude' => ['required', 'numeric', 'regex:/^[-]?(([0-8]?[0-9])\.(\d+))|(90(\.0+)?)$/'],
        'longitude' => ['required', 'numeric', 'regex:/^[-]?((([0-9]?[0-9])|[0-1][0-7][0-9])\.(\d+))|(180(\.0+)?)$/'],
    ];

    public function mount(GeneralSettings $settings)
    {

        $this->name = $settings->name ?? tenant()->business_name;
        $this->email = $settings->email ?? tenant()->email;
        $this->phone = $settings->phone ?? '';
        $this->address = $settings->address ?? '';
        $this->address_2 = $settings->address_2 ?? '';
        $this->country = $settings->country ?? '';
        $this->city = $settings->city ?? '';
        $this->latitude = $settings->latitude ?? 0.000000;
        $this->longitude = $settings->longitude ?? 0.00000;
    }

    public function render()
    {
        return view('livewire.vendor.settings.restaurant-info');
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function updateRestaurantInformation(GeneralSettings $settings)
    {
        $this->validate();

        $settings->name = $this->name;
        $settings->email = $this->email;
        $settings->phone = $this->phone;
        $settings->address = $this->address;
        $settings->address_2 = $this->address_2;
        $settings->country = $this->country;
        $settings->city = $this->city;
        $settings->latitude = $this->latitude !== null ? (float)$this->latitude : null;
        $settings->longitude = $this->longitude !== null ? (float)$this->longitude : null;

        $settings->save();

        tenant()->business_name = $settings->name;
        tenant()->email = $settings->email;
        tenant()->save();

        session()->flash('message', 'Restaurrestaurantant information updated successfully.');
    }
}
