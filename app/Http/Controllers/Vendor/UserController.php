<?php

namespace App\Http\Controllers\Vendor;

use App\Models\Vendor\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Vendor\User as StoreUser;
use App\Http\Requests\Vendor\UpdateStoreUser;
use App\Http\Requests\Vendor\StoreUser as StoreUserRequest;

class UserController extends Controller
{
    public function index()
    {
        return view('vendor.modules.users.index');
    }

    public function create()
    {
        $roles = Role::getRolesList()->pluck('name', 'id');
        return view('vendor.modules.users.create', compact('roles'));
    }

    public function store(StoreUserRequest $request)
    {
        $validatedData = $request->validated();
        $user = StoreUser::vendorUser($validatedData);
        if (!$user) {
            return redirect()->route('vendor.users.list')->with('danger', 'Something went wrong!');
        }
        return redirect()->route('vendor.users.list')->with('success', 'User registered successfully!');
    }

    public function edit(StoreUser $user)
    {
        $roles = Role::getRolesList()->pluck('name', 'id');
        $userRole = $user->role;
        return view('vendor.modules.users.edit', compact('user', 'roles', 'userRole'));
    }

    public function update(UpdateStoreUser $request, StoreUser $user)
    {
        $validatedData = $request->validated();
        $user = StoreUser::updateUser($user->id, $validatedData);
        if(!$user){
            return redirect()->route('vendor.users.list')->with('danger', 'Something went wrong!');
        }
        return redirect()->route('vendor.users.list')->with('success', 'User information updated successfully!');
    }

}
