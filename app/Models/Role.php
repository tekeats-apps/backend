<?php

namespace App\Models;

use Spatie\Permission\Models\Role as SpatieRole;

class Role extends SpatieRole
{
    public function getNameAttribute($value){
        return strtoupper($value);
    }
    protected function scopeGetRolesList($query){
        return $query->orderBy('name', 'ASC')->pluck('name', 'id');
    }
}
