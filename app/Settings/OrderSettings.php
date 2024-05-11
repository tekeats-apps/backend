<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class OrderSettings extends Settings
{
    public bool $dine_in = true;
    public bool $pickup = true;
    public bool $delivery = false;
    public bool $cash_on_delivery = true;
    public bool $orders_auto_accept = false;
    public bool $allow_special_instructions = true;
    public bool $allow_order_discounts = true;
    public ?float $minimum_order = null;
    public ?string $order_preparation_time = null;
    public ?string $order_lead_time = null;
    public ?string $order_cutoff_time = null;

    public static function group(): string
    {
        return 'order';
    }
}