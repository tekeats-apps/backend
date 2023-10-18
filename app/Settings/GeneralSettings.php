<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class GeneralSettings extends Settings
{
    public ?string $name;
    public ?string $email;
    public ?string $phone;
    public ?string $address;
    public ?string $address_2;
    public ?string $country;
    public ?string $city;
    public ?float $latitude;
    public ?float $longitude;

    public static function group(): string
    {
        return 'business';
    }
}
