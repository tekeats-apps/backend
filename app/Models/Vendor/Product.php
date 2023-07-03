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

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function getPriceAttribute($value)
    {
        return (float)$value;
    }

    public function extras()
    {
        return $this->belongsToMany(Extra::class);
    }

    public function findExtraByName($name)
    {
        return $this->extras()->where('name', $name)->first();
    }

    public function scopeGetProductExtras($query, $productId, $sortField = 'id', $sortDirection = 'desc')
    {
        $product = $query->findOrFail($productId);
        return $product->extras()->orderBy($sortField, $sortDirection);;
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
        $tagIds = $validatedData['product_tags'];
        unset($validatedData['product_tags']);
        $product = $query->create($validatedData);
        if (count($tagIds) > 0) {
            // Attach the tags
            $product->tags()->attach($tagIds);
        }
        return $product;
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
        $tagIds = $validatedData['product_tags'];
        unset($validatedData['product_tags']);
        $product = $query->findOrFail($id);
        $product->update($validatedData);
        // Sync the tags
        $product->tags()->sync($tagIds);

        return $product;
    }
}
