<?php

namespace App\Services\Admin\Tenant;

use App\Models\Domain;
use App\Models\Tenant;

class TenantService
{
    public function registerTenant(array $data): Tenant
    {
        $tenant = Tenant::registerRestaurant($data);
        return $tenant;
    }

    public function isBusinessNameUnique($businessName): bool
    {
        return !Tenant::whereJsonContains('data->business_name', $businessName)->exists();
    }

    public function isDomainUnique($domain): bool
    {
        return !Domain::where('domain', $domain)->exists();
    }

    public function subscribeToPlan(Tenant $tenant, $plan): \Illuminate\Database\Eloquent\Model
    {
        return $tenant->newSubscription(
            'main',
            $plan,
            $plan->name,
            $plan->description,
            null,
            'free'
        );
    }

    public function registerTenantUser(Tenant $tenant, $data, $role = "admin")
    {
        return Tenant::registerTenantUser($tenant, $data, $role);
    }

    public function getTenantsList()
    {
        return Tenant::getTenantsList();
    }

    public function getTenantDetails(Tenant $tenant): Tenant
    {
            $tenant->load(['subscriptions:id,subscriber_id,name', 'domains:id,tenant_id,domain,status,type']);
            return $tenant;
    }
}
