<?php

namespace App\Models;

use Illuminate\Support\Str;
use Stancl\Tenancy\Contracts\TenantWithDatabase;
use Stancl\Tenancy\Database\Concerns\HasDomains;
use Stancl\Tenancy\Database\Concerns\HasDatabase;
use Stancl\Tenancy\Database\Models\Tenant as BaseTenant;

class Tenant extends BaseTenant implements TenantWithDatabase
{
    use HasDatabase, HasDomains;

    public static function getCustomColumns(): array
    {
        return [
            'id',
            'order_id'
        ];
    }

    public function scopeRegisterRestaurant($query, $data){

        $tenantID = Str::slug($data['store_name']);
        $tenant = Tenant::create([
            'id' => $tenantID,
            'order_id' => $data['order_id'],
            'store_name' => $data['store_name'],
            'customer_email' => $data['customer_email']
        ]);
        // Create Domain model and associate it with the Tenant model
        $domain = $data['domain'].'.'.request()->getHost();
        $tenant->domains()->create(['domain' => $domain]);
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
