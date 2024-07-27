<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->delete('order.order_lead_time'); // Removes the order_lead_time field
        $this->migrator->delete('order.order_cutoff_time'); // Removes the order_cutoff_time field
    }

    public function down(): void
    {
        $this->migrator->add('order.order_lead_time', null); // Optionally restore the order_lead_time field
        $this->migrator->add('order.order_cutoff_time', null); // Optionally restore the order_cutoff_time field
    }
};