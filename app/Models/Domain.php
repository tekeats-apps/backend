<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Domain extends Model
{
    use HasFactory;

    protected $fillable = [
        'id', 'domain','tenant_id','type', 'status'
    ];

    protected $hidden = [
        'tenant_id'
    ];

    protected $casts = [
        'created_at' => 'datetime:M d, Y H:i',
        'updated_at' => 'datetime:M d, Y H:i',
    ];

}
