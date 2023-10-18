<?php

namespace App\Observers;

use App\Models\PlanSubscription;

class PlanSubscriptionObserver
{
    /**
     * Handle the PlanSubscription "created" event.
     */
    public function created(PlanSubscription $planSubscription): void
    {
        $planSubscription->planFeatures()->attach(request()->features);
    }

    /**
     * Handle the PlanFeature "updated" event.
     */
    public function updated(PlanSubscription $planSubscription): void
    {
        $planSubscription->planFeatures()->sync(request()->features);
    }
}
