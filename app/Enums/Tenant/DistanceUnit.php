<?php

namespace App\Enums\Tenant;

class DistanceUnit
{
    const KILOMETERS = 'kilometers';
    const MILES = 'miles';
    const METERS = 'meters';
    /**
     * Get all the address types.
     *
     * @return array
     */
    public static function getAll(): array
    {
        return [
            self::KILOMETERS,
            self::MILES,
            self::METERS
        ];
    }
}
