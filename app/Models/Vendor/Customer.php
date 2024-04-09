<?php

namespace App\Models\Vendor;

use Illuminate\Support\Str;
use App\Models\Vendor\Address;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Customer extends Authenticatable
{
    use Notifiable, HasApiTokens;


    public const IMAGE_PATH = 'customers';
    public const DEFAULT_IMAGE_PATH = 'https://cdn-icons-png.flaticon.com/512/3787/3787263.png';

    // public function __construct(array $attributes = [])
    // {
    //     parent::__construct($attributes);

    //     if (request()->capture()->is('api/*')) {
    //         $this->hidden = array_merge($this->hidden, ['id']);
    //     }
    // }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone_number',
        'password',
        'avatar',
        'birthday',
        'gender',
        'verified',
        'social_id',
        'social_provider'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'updated_at',
        'otp',
        'social_id',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'verified' => 'boolean',
        'status' => 'boolean',
        'created_at' => 'datetime:M d, Y H:i',
        'updated_at' => 'datetime:M d, Y H:i',
    ];

    protected function getAvatarAttribute($value)
    {

        $image = Customer::DEFAULT_IMAGE_PATH;
        if ($value) {
            $path = Customer::IMAGE_PATH . '/' . $value;
            $image = Storage::disk('s3')->url($path);
        }

        return $image;
    }

    public function scopeList($query, $search, $status, $sortField, $sortDirection)
    {
        if (!empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->where('first_name', 'like', '%' . $search . '%')
                    ->orWhere('last_name', 'like', '%' . $search . '%')
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

    protected function fullName(): Attribute
    {
        return new Attribute(
            get: fn () => "{$this->first_name} {$this->last_name}",
        );
    }

    public function scopeCreateNew($query, $first_name, $last_name, $email, $password)
    {
        return $query->create([
            'first_name' => $first_name,
            'last_name' => $last_name,
            'email' => $email,
            'password' => Hash::make($password),
        ]);
    }

    public function scopeCreateNewSocialUser($query, $provider, $data)
    {
        $randomPassword = Str::random(10);
        return $query->create([
            'social_provider' => $provider,
            'social_id' => $data['id'],
            'first_name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($randomPassword),
            'verified' => true
        ]);
    }

    public function updateSocialUserData($provider, $data)
    {
        // Update only the fields you want to change
        $this->update([
            'social_provider' => $provider,
            'social_id' => $data['id'],
            'first_name' => $data['name'],
            'email' => $data['email'],
        ]);
    }

    public function addresses()
    {
        return $this->hasMany(Address::class);
    }

    public function routeNotificationForOneSignal()
    {
        return ['include_external_user_ids' => [$this->id]];
    }
}
