<?php

namespace App\Models;

use App\Models\Vendor\Role;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\Models\Vendor\User as StoreUser;
use Bpuig\Subby\Traits\HasSubscriptions;
use Stancl\Tenancy\Contracts\TenantWithDatabase;
use Stancl\Tenancy\Database\Concerns\HasDomains;
use Stancl\Tenancy\Database\Concerns\HasDatabase;
use Stancl\Tenancy\Database\Models\Tenant as BaseTenant;

class Tenant extends BaseTenant implements TenantWithDatabase
{
    use HasDatabase, HasDomains, HasSubscriptions;

    public static function getCustomColumns(): array
    {
        return [
            'id',
            'order_id'
        ];
    }

    public function scopeRegisterRestaurant($query, $data)
    {
        $tenantID = Str::slug($data['business_name'], '_'); // Generate tenant ID with spaces removed and concatenated with underscores
        $domain = $data['domain'] . '.' . env('TENANT_DOMAIN');
        $databaseName = 'tenant_' . $tenantID; // Generate the tenant's database name
        $tenant = $query->create([
            'business_name' => $data['business_name'],
            'email' => $data['email'],
            'domain' => $domain,
            'tenancy_db_name' => $databaseName
        ]);

        // Create Domain model and associate it with the Tenant model
        $tenant->domains()->create(['domain' => $domain]);

        return $tenant;
    }

    public function scopeGetRestaurantsList($query, $search, $status, $sortField, $sortDirection)
    {
        if (!empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->where('data->email', 'like', '%' . $search . '%')
                    ->orWhere('data->status', 'like', '%' . $search . '%')
                    ->orWhere('data->business_name', 'like', '%' . $search . '%');
            });
        }
        if (!empty($status)) {
            $query->where('status', $status);
        }
        return $query->orderBy($sortField, $sortDirection);
    }

    public static function registerTenantUser($tenant, $data, $role)
    {
        $tenant->run(function () use ($data, $role) {
            $user = new StoreUser();
            $user->name = $data['customer_name'];
            $user->email = $data['email'];
            $user->password = Hash::make($data['password']);

            if ($role) {
                $role = Role::where('name', $role)->first();
                $user->syncRoles($role);
            }

            $user->save();
        });
        return $tenant;
    }
    public function order()
    {
        return $this->hasOne(Order::class);
    }
    public function domains()
    {
        return $this->hasMany(Domain::class);
    }
}
