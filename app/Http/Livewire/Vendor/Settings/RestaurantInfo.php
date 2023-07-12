<?php

namespace App\Http\Livewire\Vendor\Settings;

use Exception;
use Livewire\Component;
use App\Models\Vendor\RestaurantInfo as RestaurantInformation;

class RestaurantInfo extends Component
{
    public $name;
    public $email;
    public $phone;
    public $address;
    public $address_2;
    public $country;
    public $city;
    public $latitude;
    public $longitude;

    protected $rules = [
        'name' => 'required',
        'email' => 'nullable|email:rfc',
        'phone' => 'nullable',
        'address' => 'nullable',
        'address_2' => 'nullable',
        'country' => 'nullable',
        'city' => 'nullable',
        'latitude' => 'nullable',
        'longitude' => 'nullable',
    ];

    public function mount()
    {
        $this->name = tenant()->business_name ?? '';
        $this->email = tenant()->email ?? '';

        $restaurant = RestaurantInformation::first();
        if ($restaurant) {
            $this->name = $restaurant->name;
            $this->email = $restaurant->email;
            $this->phone = $restaurant->phone;
            $this->address = $restaurant->address;
            $this->address_2 = $restaurant->address_2;
            $this->country = $restaurant->country;
            $this->city = $restaurant->city;
            $this->latitude = $restaurant->latitude;
            $this->longitude = $restaurant->longitude;
        }
    }

    public function render()
    {
        return view('livewire.vendor.settings.restaurant-info');
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function updateRestaurantInformation()
    {
        $this->validate();
        try {
            $data = [
                'name' => $this->name,
                'email' => $this->email,
                'phone' => $this->phone,
                'address' => $this->address,
                'address_2' => $this->address_2,
                'country' => $this->country,
                'city' => $this->city,
                'latitude' => $this->latitude,
                'longitude' => $this->longitude,
            ];

            $restaurant = RestaurantInformation::first();
            if ($restaurant) {
                $restaurant->update($data);
            } else {
                RestaurantInformation::create($data);
            }

            tenant()->business_name = $restaurant->name;
            tenant()->email = $restaurant->email;
            tenant()->save();

            session()->flash('message', 'Restaurant information updated successfully.');
        } catch (Exception $e) {
            session()->flash('error', 'An error occurred while updating the restaurant information:' . $e->getMessage());
            // You can log the exception or perform additional error handling here
        }
    }
}
