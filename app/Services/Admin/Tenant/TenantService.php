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

    public function isBusinessNameUnique($businessName)
    {
        return !Tenant::whereJsonContains('data->business_name', $businessName)->exists();
    }

    public function isDomainUnique($domain)
    {
        $domain = $domain . '.' . env('TENANT_DOMAIN');
        return !Domain::where('domain', $domain)->exists();
    }

    public function subscribeToPlan(Tenant $tenant, $plan)
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
}
