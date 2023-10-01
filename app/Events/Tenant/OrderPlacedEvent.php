<?php

namespace App\Events\Tenant;

use App\Models\Vendor\Order;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;

class OrderPlacedEvent
{
    use SerializesModels, Dispatchable;

    public $order;

    public function __construct(Order $order)
    {
        $this->order = $order;
    }
}
