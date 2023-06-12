<?php

namespace App\Models\Vendor;

use App\Models\Vendor\Role;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Traits\HasRoles;
use App\Models\Vendor\User as StoreUser;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory, HasRoles;

    public const IMAGE_PATH = 'users';

    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'image',
        'status'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'status' => 'boolean'
    ];

    public function scopeList($query,$search, $status, $sortField, $sortDirection)
    {
        if (!empty($search)) {
            $query->where(function ($q) use($search) {
                $q->where('name', 'like', '%' . $search . '%')
                    ->orWhere('email', 'like', '%' . $search . '%');
            });
        }

        if (!empty($status)) {
            $query->where('status', $status);
        }
        return $query->orderBy($sortField, $sortDirection);
    }

    protected function statusText(): Attribute
    {
        $status = 'Inactive';
        if ($this->status) {
            $status = 'Active';
        }
        return new Attribute(
            get: fn () => $status,
        );
    }

    protected function getImageAttribute($value)
    {

        $image = '';
        if ($value) {
            $path = User::IMAGE_PATH . '/' . $value;
            $image = tenant_asset($path);
        }

        return $image;
    }

    protected function role(): Attribute
    {
        $role = [
            'id' => $this->roles->pluck('id')->first(),
            'name' => $this->roles->pluck('name')->first()
        ];
        return new Attribute(
            get: fn () => (object) $role,
        );
    }

    public function scopeUpdateUser($query, $userId, $data)
    {
        $user = $query->findOrFail($userId);
        $user->fill([
            'name' => $data['name'],
            'username' => $data['username'],
            'email' => $data['email'],
            'status' => ($data['status']) ? 1 : 0,
        ]);

        if (isset($data['role'])) {
            $role = Role::findOrFail($data['role']);
            $user->syncRoles($role);
        }
        $user->save();
        return $user;
    }

    public function scopeStoreUser($query, $data)
    {
        $user = new StoreUser([
            'name' => $data['name'],
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'status' => ($data['status']) ? 1 : 0,
        ]);

        if (isset($data['role'])) {
            $role = Role::findOrFail($data['role']);
            $user->syncRoles($role);
        }

        $user->save();

        return $user;
    }

    public function scopeUpdatePassword($query, $userId, $password)
    {
        $user = $query->findOrFail($userId);
        $user->password = Hash::make($password);
        $user->save();

        return $user;
    }
}
