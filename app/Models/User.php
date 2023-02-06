<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
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


}
