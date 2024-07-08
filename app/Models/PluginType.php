<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Stancl\Tenancy\Database\Concerns\CentralConnection;

class PluginType extends Model
{
    use HasFactory, CentralConnection;

    protected $fillable = ['id','name'];

    public function plugins()
    {
        return $this->hasMany(Plugin::class);
    }
}
