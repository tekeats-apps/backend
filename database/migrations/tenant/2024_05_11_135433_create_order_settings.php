<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('order.dine_in', true);
        $this->migrator->add('order.pickup', true);
        $this->migrator->add('order.delivery', false);
        $this->migrator->add('order.cash_on_delivery', true);
        $this->migrator->add('order.orders_auto_accept', false);
        $this->migrator->add('order.allow_special_instructions', true);
        $this->migrator->add('order.allow_order_discounts', true);
        $this->migrator->add('order.minimum_order', null);
        $this->migrator->add('order.order_preparation_time', null);
        $this->migrator->add('order.order_lead_time', null);
        $this->migrator->add('order.order_cutoff_time', null);
    }
};
