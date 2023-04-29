<?php

namespace App\Http\Controllers\Store;

use Illuminate\View\View;
use App\Models\Store\Role;
use Illuminate\Http\Request;
use App\Models\Store\Permission;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\Store\AddRole;
use Illuminate\Support\Facades\Schema;
use App\Http\Requests\Store\UpdateRole;

class RoleController extends Controller
{
    public function index()
    {
        $roles = Role::getRolesList()->get();
        return view('store.modules.roles.index', compact('roles'));
    }

    public function create()
    {
        return view('store.modules.roles.create');
    }


    public function store(AddRole $request)
    {
        $validatedData = $request->validated();
        $role = Role::addRole($validatedData);
        if (!$role) {
            return redirect()->route('store.roles.list')->with('danger', 'Something went wrong!');
        }
        return redirect()->route('store.roles.list')->with('success', 'Role added successfully!');
    }

    public function update(UpdateRole $request, Role $role)
    {
        $validatedData = $request->validated();
        $role = Role::updateRole($role->id, $validatedData);
        if (!$role) {
            return redirect()->route('store.roles.list')->with('danger', 'Something went wrong!');
        }
        return redirect()->route('store.roles.list')->with('success', 'Role updated successfully!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role): View
    {
        return view('store.modules.roles.edit', compact('role'));
    }

    public function syncPermissions(Request $request)
    {
        $permisisonsList = config('tenant-permissions');
        if (!$permisisonsList) {
            return redirect()->route('store.roles.list')->with('danger', 'Something went wrong!');
        }
        Schema::disableForeignKeyConstraints();
        DB::table('permissions')->truncate();
        Schema::enableForeignKeyConstraints();
        $permissionData = [];
        foreach ($permisisonsList as $value) {
            if ($value['permissions']) {
                foreach ($value['permissions'] as $permission) {
                    $permissionData[] = [
                        'module' => $value['module'],
                        'name' => $permission,
                        'guard_name' => Role::GUARD_NAME
                    ];
                }
            }
        }
        Permission::insert($permissionData);
        return redirect()->route('store.roles.list')->with('success', 'Permissions updated successfully!');
    }

    public function rolePermissions(Request $request, Role $role)
    {

        $role = Role::withPermissions()->find($role->id);
        if (!$role) {
            return redirect()->route('store.roles.list')->with('danger', 'Something went wrong!');
        }

        $permissions = Permission::getPermissionsList()->get()
            ->groupBy('module')->toArray();

        $active_permissions = $role->permissions->pluck('id')->toArray();

        return view('store.modules.roles.role-permissions', compact('role', 'permissions', 'active_permissions'));
    }

    public function syncRolePermissions(Request $request, Role $role)
    {
        if (!$role) {
            return redirect()->route('store.roles.list')->with('danger', 'Something went wrong!');
        }
        $modules = optional($request)->permissions ? $request->permissions : [];
        $permissions = Permission::whereIn('name', $modules)->get();
        $role->syncPermissions($permissions);

        return redirect()->route('store.roles.list')->with('success', 'Permissions updated for ' . $role->name . '!');
    }
}
