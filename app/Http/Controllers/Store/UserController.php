<?php

namespace App\Http\Controllers\Store;

use App\Models\Store\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Store\User as StoreUser;
use App\Http\Requests\Store\UpdateStoreUser;
use App\Http\Requests\Store\StoreUser as StoreUserRequest;

class UserController extends Controller
{
    public function index()
    {
        return view('store.modules.users.index');
    }

    public function create()
    {
        $roles = Role::getRolesList()->pluck('name', 'id');
        return view('store.modules.users.create', compact('roles'));
    }

    public function store(StoreUserRequest $request)
    {
        $validatedData = $request->validated();
        $user = StoreUser::storeUser($validatedData);
        if (!$user) {
            return redirect()->route('store.users.list')->with('danger', 'Something went wrong!');
        }
        return redirect()->route('store.users.list')->with('success', 'User registered successfully!');
    }

    public function edit(StoreUser $user)
    {
        $roles = Role::getRolesList()->pluck('name', 'id');
        $userRole = $user->role;
        return view('store.modules.users.edit', compact('user', 'roles', 'userRole'));
    }

    public function update(UpdateStoreUser $request, StoreUser $user)
    {
        $validatedData = $request->validated();
        $user = StoreUser::updateUser($user->id, $validatedData);
        if(!$user){
            return redirect()->route('store.users.list')->with('danger', 'Something went wrong!');
        }
        return redirect()->route('store.users.list')->with('success', 'User information updated successfully!');
    }

}
