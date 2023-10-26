<?php

namespace App\Observers\Vendor;

use App\Models\Vendor\Tax;

class TaxObserver
{
    /**
     * Handle the Tax "saved" event.
     */
    public function saved(Tax $tax): void
    {
        $tax->categories()->sync(request()->categories);
        $tax->products()->sync(request()->products);
    }
}
