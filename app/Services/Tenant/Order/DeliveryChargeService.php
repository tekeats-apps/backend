<?php

namespace App\Services\Tenant\Order;

use App\Models\Vendor\Address;
use App\Settings\GeneralSettings;
use App\Enums\Tenant\DistanceUnit;
use App\Settings\DeliverySettings;
use App\Enums\Tenant\DeliveryTypes;
use App\Models\Vendor\DeliveryChargeDetails;

class DeliveryChargeService
{
    protected $deliverySettings;
    protected $generalSettings;

    public function __construct(DeliverySettings $deliverySettings, GeneralSettings $generalSettings)
    {
        $this->deliverySettings = $deliverySettings;
        $this->generalSettings = $generalSettings;
    }

    public function calculateDeliveryCharge($addressId): DeliveryChargeDetails
    {
        $delivery = new DeliveryChargeDetails();
        $delivery->charge_type = $this->deliverySettings->delivery_charge_type;
        $address = Address::find($addressId);
        $distance = $this->calculateDistance(
            $address->lat,
            $address->lng,
            $this->generalSettings->latitude,
            $this->generalSettings->longitude
        );

        // First, check if delivery is available in the given area
        if ($distance >= $this->deliverySettings->distance_based_radius) {
            $delivery->delivery_avaiable = false;
            return $delivery;
        }

        $delivery->delivery_avaiable = true;

        // Check for free delivery first
        if ($this->deliverySettings->free_delivery) {
            if ($this->deliverySettings->free_delivery_charge_type === DeliveryTypes::FLAT) {
                $delivery->is_free_delivery = true;
                $delivery->delivery_charges = 0.00;
                return $delivery;
            }
            if ($this->deliverySettings->free_delivery_charge_type === DeliveryTypes::DISTANCE) {
                if ($distance <= $this->deliverySettings->free_delivery_radius) {
                    $delivery->is_free_delivery = true;
                    $delivery->delivery_charges = 0.00;
                    return $delivery;
                }
            }
        }

        // Next, apply regular delivery charges
        if ($this->deliverySettings->delivery_charge_type === DeliveryTypes::FLAT) {
            $delivery->delivery_charges = (float) $this->deliverySettings->delivery_charges;
        }

        if ($this->deliverySettings->delivery_charge_type === DeliveryTypes::DISTANCE) {
            $charges = number_format($this->deliverySettings->delivery_charges * $distance, 2, '.', '');
            $delivery->delivery_charges = (float) ($charges);
        }

        return $delivery;
    }


    private function calculateDistance($lat1, $lng1, $lat2, $lng2): float
    {
        $earthRadiusKm = 6371; // Earth's radius in Kilometers
        $earthRadiusMiles = 3958.8; // Earth's radius in Miles
        $earthRadiusMeters = $earthRadiusKm * 1000; // Earth's radius in Meters

        $dLat = deg2rad($lat2 - $lat1);
        $dLng = deg2rad($lng2 - $lng1);
        $a = sin($dLat / 2) * sin($dLat / 2) + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * sin($dLng / 2) * sin($dLng / 2);
        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

        $earthRadius = $earthRadiusKm; // Default to Kilometers

        if ($this->deliverySettings->distance_unit === DistanceUnit::MILES) {
            $earthRadius = $earthRadiusMiles;
        }

        if ($this->deliverySettings->distance_unit === DistanceUnit::METERS) {
            $earthRadius = $earthRadiusMeters;
        }
        $distance = $earthRadius * $c;

        // Convert the distance to the specified unit if it's not in kilometers
        if ($this->deliverySettings->distance_unit === DistanceUnit::MILES) {
            $distance /= 1.60934; // Convert from kilometers to miles
        } elseif ($this->deliverySettings->distance_unit === DistanceUnit::METERS) {
            $distance *= 1000; // Convert from kilometers to meters
        }

        return $distance;
    }


    private function calculateDistanceBasedCharge($distance): float
    {
        if ($distance <= $this->deliverySettings->distance_based_radius) {
            return (float) $this->deliverySettings->delivery_charges;
        }

        if ($this->deliverySettings->range_based_charges) {
            foreach ($this->deliverySettings->range_based_charges as $range) {
                if ($distance >= $range['min'] && $distance <= $range['max']) {
                    return (float) $range['charge'];
                }
            }
        }

        return 0.00;
    }
}
