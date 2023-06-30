<?php

namespace App\Http\Controllers\Vendor;

use App\Models\Vendor\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Traits\TenantImageUploadTrait;
use App\Models\Vendor\User as StoreUser;
use App\Http\Requests\Vendor\UpdateStoreUser;
use App\Http\Requests\Vendor\Auth\PasswordUpdateRequest;
use App\Http\Requests\Vendor\StoreUser as StoreUserRequest;

class UserController extends Controller
{
    use TenantImageUploadTrait;

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
        $user = StoreUser::storeUser($validatedData);
        if ($validatedData['image']) {
            $image = $validatedData['image'];
            $module = StoreUser::IMAGE_PATH; // Assuming 'users' is the module name
            $recordId = $user->id; // Assuming the user's ID is the record ID
            $table_field = 'image';
            $table_name = 'users';

            // Upload the image and get the image URL
            $this->uploadImage($image, $module, $recordId, $table_field, $table_name);
        }
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
        // Check if an image file was uploaded
        if ($validatedData['image']) {
            $image = $validatedData['image'];
            $module = StoreUser::IMAGE_PATH; // Assuming 'users' is the module name
            $recordId = $user->id; // Assuming the user's ID is the record ID
            $table_field = 'image';
            $table_name = 'users';

            if ($user->image) {
                $this->delete_image_by_name($module, $user->image);
            }

            // Upload the image and get the image URL
            $this->uploadImage($image, $module, $recordId, $table_field, $table_name);
        }
        if (!$user) {
            return redirect()->route('vendor.users.list')->with('danger', 'Something went wrong!');
        }
        return redirect()->route('vendor.users.list')->with('success', 'User information updated successfully!');
    }

    public function passwordUpdate(PasswordUpdateRequest $request, StoreUser $user)
    {
        $user->update([
            'password' => Hash::make($request->password)
        ]);

        return redirect()->route('vendor.users.edit', $user->id)->with('success', 'User password updated successfully!');
    }
}
