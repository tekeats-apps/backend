<?php

namespace App\Models\Vendor;

use App\Models\Vendor\Permission;
use Spatie\Permission\Models\Role as SpatieRole;

class Role extends SpatieRole
{
    public const GUARD_NAME = 'store';
    protected function scopeGetRolesList($query)
    {
        return $query->select('id', 'name', 'created_at', 'status')
            ->orderBy('name', 'ASC');
    }

    protected function scopeAddRole($query, $data)
    {
        $role_name = strtolower($data['name']);
        $role = $query->create([
            'name' => $role_name,
            'guard_name' => Role::GUARD_NAME
        ]);

        return $role;
    }

    protected function scopeUpdateRole($query, $id, $data)
    {
        $role = $query->find($id);
        $role_name = strtolower($data['name']);
        $role->name = $role_name;
        $role->status = $data['status'];
        $role->save();
        return $role;
    }

    public function scopeWithPermissions($query)
    {
        return $query->with('permissions');
    }
}
