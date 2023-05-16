<?php

namespace App\Models;

use Spatie\Permission\Models\Role as SpatieRole;

class Role extends SpatieRole
{
    protected function scopeGetRolesList($query){
        return $query->select('id', 'name', 'created_at')
                    ->orderBy('name', 'ASC');
    }
}
