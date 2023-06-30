<?php

namespace App\Models\Vendor;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    const IMAGE_PATH = 'products';

    // Fields to be mass-assigned
    protected $fillable = [
        'name', 'description', 'price', 'prepration_time', 'status',
        'featured', 'extras', 'is_variants_enabled', 'is_product_timing_enabled',
        'category_id', 'image', 'product_tags', 'slug', 'seo_title', 'seo_description', 'seo_keywords'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function getPriceAttribute($value)
    {
        return (float)$value;
    }

    protected function getImageAttribute($value)
    {

        $image = 'https://cdn-icons-png.flaticon.com/512/3787/3787263.png';
        if ($value) {
            $path = Product::IMAGE_PATH . '/' . $value;
            $image = tenant_asset($path);
        }

        return $image;
    }

    public function scopeCreateProduct($query, array $validatedData)
    {
        return $query->create($validatedData);
    }

    public function scopeList($query, $search = '', $sortField = 'id', $sortDirection = 'desc')
    {
        if (!empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                    ->orWhere('description', 'like', '%' . $search . '%')
                    ->orWhere('slug', 'like', '%' . $search . '%');
            });
        }

        if (!empty($status)) {
            $query->where('status', $status);
        }
        return $query->orderBy($sortField, $sortDirection);
    }

    public function scopeUpdateProduct($query, $id, array $validatedData)
    {
        return $query->where('id', $id)->update($validatedData);
    }
}
