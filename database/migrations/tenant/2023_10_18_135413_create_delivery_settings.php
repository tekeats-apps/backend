<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('delivery.free_delivery', false);
        $this->migrator->add('delivery.free_delivery_charge_type', 'flat');
        $this->migrator->add('delivery.free_delivery_radius', 0.00);
        $this->migrator->add('delivery.delivery_charge_type', 'flat');
        $this->migrator->add('delivery.distance_unit', 'kilometers');
        $this->migrator->add('delivery.distance_based_radius', 0.00);
        $this->migrator->add('delivery.delivery_charges', 0.00);
        $this->migrator->add('delivery.range_based_charges', []);
    }
};
