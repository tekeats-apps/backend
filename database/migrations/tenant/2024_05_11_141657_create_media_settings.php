<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('media.logo', null);
        $this->migrator->add('media.favicon', null);
    }
};
