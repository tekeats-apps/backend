<?php

namespace App\Models\Vendor;

use Illuminate\Database\Eloquent\Model;
use App\Enums\Vendor\DiscountActiveEnum;
use App\Enums\Vendor\DiscountTypeEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Discount extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'type', 'amount', 'active'];

    protected $casts = [
        'type' => DiscountTypeEnum::class,
        'active' => DiscountActiveEnum::class
    ];
}
