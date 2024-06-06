<?php

namespace App\Models\Vendor;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Variant extends Model
{
    use SoftDeletes;

    protected $appends = ['discounted_price'];

    protected $fillable = ['name', 'price', 'quantity', 'status'];

    public function scopeCreateNew($query, $name, $price)
    {
        return $query->create([
            'name' => $name,
            'price' => $price,
        ]);
    }

    public function scopeUpdateExisting($query, $id, $name, $price)
    {
        $extra = $this->find($id);
        if ($extra) {
            $extra->update([
                'name' => $name,
                'price' => $price,
            ]);
        }
        return $extra;
    }

    public function getDiscountedPriceAttribute()
    {
        $product = $this->products()->first();

        if ($product && $product->discount_enabled && $product->discount > 0) {
            $discountAmount = ($this->price * $product->discount) / 100;
            return $this->price - $discountAmount;
        }

        return $this->price;
    }

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }
}
