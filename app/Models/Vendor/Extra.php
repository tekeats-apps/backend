<?php

namespace App\Models\Vendor;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Extra extends Model
{
    use SoftDeletes;

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

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }
}
