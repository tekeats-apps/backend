<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class LocalizationSettings extends Settings
{
    public ?array $languages;
    public ?string $default_language;
    public ?string $timezone;
    public ?string $date_format;
    public ?string $time_format;
    public ?string $currency;
    public ?string $currency_symbol;
    public ?string $currency_position;
    
    public static function group(): string
    {
        return 'localization';
    }
}