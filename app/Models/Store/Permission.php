<?php

namespace App\Models\Store;

use App\Models\Store\Role;
use Spatie\Permission\Models\Permission as SpatiePermission;

class Permission extends SpatiePermission
{
    protected $fillable = [
        'name',
        'module',
        'guard_name'
    ];

    protected function scopeGetPermissionsList($query)
    {
        return $query->select('id', 'name', 'module')
            ->orderBy('name', 'ASC');
    }
}
