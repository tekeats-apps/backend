<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class DeliverySettings extends Settings
{

    public bool $free_delivery;
    public ?string $free_delivery_charge_type; // Flat, DistanceBased
    public ?float $free_delivery_radius;

    public string $delivery_charge_type; // Flat, DistanceBased
    public string $distance_unit; // Kilometers, Miles, Meters
    public ?float $distance_based_radius;
    public ?float $delivery_charges;

    public ?array $range_based_charges; // This can be an array of arrays or objects to hold multiple ranges

    public static function group(): string
    {
        return 'delivery';
    }
}
