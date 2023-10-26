<?php

namespace App\Observers\Vendor;

use App\Models\Vendor\Discount;

class DiscountObserver
{
    /**
     * Handle the Discount "created" event.
     */
    public function created(Discount $discount): void
    {
        $discount->categories()->attach(request()->categories);
        $discount->products()->attach(request()->products);
    }

    /**
     * Handle the Discount "updated" event.
     */
    public function updated(Discount $discount): void
    {
        $discount->categories()->sync(request()->categories);
        $discount->products()->sync(request()->products);
    }
}
