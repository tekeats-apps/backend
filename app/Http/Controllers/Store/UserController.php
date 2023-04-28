<?php

namespace App\Http\Controllers\Store;

use App\Models\Store\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
}
