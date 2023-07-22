<?php

namespace App\Http\Livewire\Vendor\Settings;

use Livewire\Component;
use App\Models\Vendor\OrderSetting as OrderSettings;

class OrderSetting extends Component
{
    public $dine_in = false;
    public $pickup = false;
    public $delivery = false;
    public $cash_on_delivery = false;
    public $stripe = false;
    public $paypal = false;
    public $orders_auto_accept = false;
    public $allow_special_instructions = false;
    public $allow_order_discounts = false;
    public $minimum_order;
    public $order_preparation_time;
    public $order_lead_time;
    public $order_cutoff_time;

    protected $rules = [
        'dine_in' => 'boolean',
        'pickup' => 'boolean',
        'delivery' => 'boolean',
        'cash_on_delivery' => 'boolean',
        'stripe' => 'boolean',
        'paypal' => 'boolean',
        'orders_auto_accept' => 'boolean',
        'allow_special_instructions' => 'boolean',
        'allow_order_discounts' => 'boolean',
        'minimum_order' => 'required|numeric',
        'order_preparation_time' => 'required|string',
        'order_lead_time' => 'required|string',
        'order_cutoff_time' => 'required|string',
    ];

    public function mount()
    {
        $settings = OrderSettings::first();
        if ($settings) {
            $this->dine_in = $settings->dine_in;
            $this->pickup = $settings->pickup;
            $this->delivery = $settings->delivery;
            $this->cash_on_delivery = $settings->cash_on_delivery;
            $this->stripe = $settings->stripe;
            $this->paypal = $settings->paypal;
            $this->orders_auto_accept = $settings->orders_auto_accept;
            $this->allow_special_instructions = $settings->allow_special_instructions;
            $this->allow_order_discounts = $settings->allow_order_discounts;
            $this->minimum_order = $settings->minimum_order;
            $this->order_preparation_time = $settings->order_preparation_time;
            $this->order_lead_time = $settings->order_lead_time;
            $this->order_cutoff_time = $settings->order_cutoff_time;
        }
    }

    public function render()
    {
        return view('livewire.vendor.settings.order-setting');
    }

    public function save()
    {
        $validatedData = $this->validate();
        try {
            $orderSettings = OrderSettings::first();
            if ($orderSettings) {
                $orderSettings->update($validatedData);
            } else {
                OrderSettings::create($validatedData);
            }

            session()->flash('message', 'Order Settings Successfully Updated.');
        } catch (Exception $e) {
            Log::error('An error occurred while updating the Order settings: ', ['error' => $e]);
            session()->flash('error', 'An error occurred while updating the restaurant Order settings:' . $e->getMessage());
        }
    }
}
