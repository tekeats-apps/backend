<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class MediaSettings extends Settings
{
    public ?string $logo;
    public ?string $favicon;

    public static function group(): string
    {
        return 'media';
    }
}