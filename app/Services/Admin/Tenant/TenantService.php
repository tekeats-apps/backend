<?php

namespace App\Services\Admin\Tenant;

use App\Models\Domain;
use App\Models\Tenant;
use Illuminate\Support\Facades\DB;

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

    public function getTenantDetails($tenant_id, $withDeleted = false)
    {
        $tenant = Tenant::with('domains');
        if ($withDeleted) {
            $tenant = $tenant->withTrashed();
        }
        return $tenant->find($tenant_id);
    }

    public function updateStatus(Tenant $tenant, bool $status): bool
    {
        return $tenant->update(['status' => $status]);
    }

    /**
     * Soft delete a tenant
     * This marks the tenant as inactive but keeps the record in the database
     *
     * @param Tenant $tenant
     * @return bool
     */
    public function softDeleteTenant(Tenant $tenant): bool
    {
        // Use the built-in softDelete method from the tenancy package
        return $tenant->delete();
    }

    /**
     * Permanently delete a tenant and all associated data
     *
     * @param Tenant $tenant
     * @return bool
     */
    public function permanentDeleteTenant(Tenant $tenant): bool
    {
        try {
            // Delete domains manually as they might not be handled by the package
            $tenant->domains()->delete();

            // Manually delete the tenant database
            $databaseName = $tenant->database()->getName();
            DB::statement("DROP DATABASE IF EXISTS `{$databaseName}`");

            // Use forceDelete to completely remove the tenant record
            $deleted = $tenant->forceDelete();

            return $deleted;
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function restoreTenant(Tenant $tenant)
    {
        return $tenant->onlyTrashed()->restore();
    }
}
