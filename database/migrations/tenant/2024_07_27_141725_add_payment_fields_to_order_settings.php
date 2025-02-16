<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('order.online_payment', false); // Adds the online_payment field with a default value of false
        $this->migrator->add('order.allowed_payment_methods', null); // Adds the allowed_payment_methods field with a default value of null
    }

    public function down(): void
    {
        $this->migrator->delete('order.online_payment'); // Removes the online_payment field
        $this->migrator->delete('order.allowed_payment_methods'); // Removes the allowed_payment_methods field
    }
};