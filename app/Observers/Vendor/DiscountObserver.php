<?php

namespace App\Observers\Vendor;

use App\Models\Vendor\Discount;

class DiscountObserver
{
    /**
     * Handle the Discount "saved" event.
     */
    public function saved(Discount $discount): void
    {
        $discount->categories()->sync(request()->categories);
        $discount->products()->sync(request()->products);
    }
}
