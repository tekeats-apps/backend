<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('business.name', '');
        $this->migrator->add('business.email', '');
        $this->migrator->add('business.phone', '');
        $this->migrator->add('business.address', '');
        $this->migrator->add('business.address_2', '');
        $this->migrator->add('business.country', '');
        $this->migrator->add('business.city', '');
        $this->migrator->add('business.latitude', 0.00000);
        $this->migrator->add('business.longitude', 0.00000);
    }
};
