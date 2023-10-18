<?php

namespace App\Enums\Tenant;

class DeliveryTypes
{
    const FLAT = 'flat';
    const DISTANCE = 'distance';
    /**
     * Get all the address types.
     *
     * @return array
     */
    public static function getAll(): array
    {
        return [
            self::DISTANCE,
            self::FLAT
        ];
    }
}
