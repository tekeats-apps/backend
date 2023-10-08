<?php

namespace App\Enums\Tenant;

class AddressType
{
    const HOME = 'home';
    const WORK = 'work';
    const PARTNER = 'partner';
    const OTHER = 'other';

    /**
     * Get all the address types.
     *
     * @return array
     */
    public static function getAll(): array
    {
        return [
            self::HOME,
            self::WORK,
            self::PARTNER,
            self::OTHER,
        ];
    }
}
