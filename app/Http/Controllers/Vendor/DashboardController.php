<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $subscription = $this->subscriptionPlan();
        // dd(tenant()->subscription(), $subscription);
        return view('vendor.modules.dashboard.index', compact('subscription'));
    }

    protected function subscriptionPlan(){
        return [
            'active' => tenant()->subscription()->isActive(),
            'free_trail' => tenant()->subscription()->isOnTrial(),
            'trial_interval' => tenant()->subscription()->trial_interval,
            'trial_period' => tenant()->subscription()->trial_period,
            'trial_ends_at' => tenant()->subscription()->trial_ends_at,
            'subscription' => tenant()->subscription()
        ];
    }
}
