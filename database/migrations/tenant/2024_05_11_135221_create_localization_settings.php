<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('localization.languages', null);
        $this->migrator->add('localization.default_language', null);
        $this->migrator->add('localization.timezone', null);
        $this->migrator->add('localization.date_format', null);
        $this->migrator->add('localization.time_format', null);
        $this->migrator->add('localization.currency', null);
        $this->migrator->add('localization.currency_symbol', null);
        $this->migrator->add('localization.currency_position', null);
    }
};
