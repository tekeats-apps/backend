<?php

namespace App\Http\Controllers\Store;

use App\Models\Store\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Store\AddRole;
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
    public function edit(Role $role)
    {
        return view('store.modules.roles.edit', compact('role'));
    }
}
