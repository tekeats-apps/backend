<?php

namespace App\Console\Commands;

use App\Models\Tenant;
use Database\Seeders\TenantDatabaseSeeder;
use Illuminate\Console\Command;
use Stancl\Tenancy\Contracts\TenantWithDatabase;

class SeedTenants extends Command
{
    protected $signature = 'tenants:seed {--tenants=*}';
    protected $description = 'Seed tenant databases';

    public function handle()
    {
        $tenantIds = $this->option('tenants');

        if (empty($tenantIds)) {
            $this->error('No tenant ids provided.');
            return;
        }

        foreach ($tenantIds as $tenantId) {
            $tenant = Tenant::findOrFail($tenantId);

            if ($tenant instanceof TenantWithDatabase) {
                $tenant->run(function () {
                    $this->call(TenantDatabaseSeeder::class);
                });
            } else {
                $this->error("Tenant with id '{$tenantId}' does not use a database.");
            }
        }
    }
}
