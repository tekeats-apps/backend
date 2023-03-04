<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasRoles, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'image',
        'status'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'status' => 'boolean'
    ];


    public function scopeList($query){
        return $query->orderBy('name', 'ASC');
    }

    protected function statusText(): Attribute
    {
        $status = 'Inactive';
        if($this->status){
            $status = 'Active';
        }
        return new Attribute(
            get: fn () => $status,
        );
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
        $user = new User([
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
