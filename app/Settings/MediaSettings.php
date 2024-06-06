<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class MediaSettings extends Settings
{

    const IMAGE_PATH = 'settings/media';
    
    public ?string $logo;
    public ?string $favicon;

    public static function group(): string
    {
        return 'media';
    }
}