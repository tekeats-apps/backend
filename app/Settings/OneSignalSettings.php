<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class OneSignalSettings extends Settings
{
    public ?string $app_id;
    public ?string $api_key;

    public static function group(): string
    {
        return 'onesignal';
    }
}