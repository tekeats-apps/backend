<?php

namespace App\Http\Controllers\Admin;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreUser;
use App\Http\Requests\Admin\UpdateUser;
use App\Http\Requests\Admin\UpdateUserPassword;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::list()->get();
        return view('admin.modules.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::getRolesList()->pluck('name', 'id');
        return view('admin.modules.users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUser $request)
    {
        $validatedData = $request->validated();
        $user = User::storeUser($validatedData);
        if(!$user){
            return redirect()->route('admin.users.index')->with('danger', 'Something went wrong!');
        }
        return redirect()->route('admin.users.index')->with('success', 'User registered successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function passwordUpdate(UpdateUserPassword $request, User $user)
    {
        $validatedData = $request->validated();
        $user = User::updatePassword($user->id, $validatedData['password']);
        if(!$user){
            return redirect()->route('admin.users.edit', $user->id)->with('danger', 'Something went wrong!');
        }
        return redirect()->route('admin.users.edit', $user->id)->with('success', 'User password changed successfully!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $roles = Role::getRolesList()->pluck('name', 'id');
        $userRole = $user->role;
        return view('admin.modules.users.edit', compact('user', 'roles', 'userRole'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUser $request, User $user)
    {
        $validatedData = $request->validated();
        $user = User::updateUser($user->id, $validatedData);
        if(!$user){
            return redirect()->route('admin.users.index')->with('danger', 'Something went wrong!');
        }
        return redirect()->route('admin.users.index')->with('success', 'User information updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
