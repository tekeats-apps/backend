<?php

namespace App\Http\Controllers\Store;

use App\Models\Store\Role;
use App\Models\Store\User as StoreUser;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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
            return redirect()->route('store.users.index')->with('danger', 'Something went wrong!');
        }
        return redirect()->route('store.users.index')->with('success', 'User registered successfully!');
    }
}
