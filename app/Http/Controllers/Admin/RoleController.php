<?php

namespace App\Http\Controllers\Admin;

use App\Models\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RoleController extends Controller
{
    public function index(){
        $roles = Role::getRolesList()->get();
        return view('admin.modules.roles.index', compact('roles'));
    }

    public function create()
    {
        return view('admin.modules.roles.create');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        return view('admin.modules.roles.edit', compact('role'));
    }
}
