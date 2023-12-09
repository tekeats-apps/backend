<?php

namespace App\Models\Vendor;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    const IMAGE_PATH = 'products';

    // Fields to be mass-assigned
    protected $fillable = [
        'name', 'description', 'price', 'prepration_time', 'status',
        'featured', 'is_extras_enabled', 'is_variants_enabled', 'is_product_timing_enabled',
        'category_id', 'image', 'product_tags', 'slug', 'seo_title', 'seo_description', 'seo_keywords', 'discount_enabled', 'discount'
    ];
    protected $appends = ['discounted_price'];

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

    public function variants()
    {
        return $this->belongsToMany(Variant::class);
    }

    public function findExtraByName($name)
    {
        return $this->extras()->where('name', $name)->first();
    }

    public function findVariantByName($name)
    {
        return $this->variants()->where('name', $name)->first();
    }

    public function scopeGetProductExtras($query, $productId, $sortField = 'id', $sortDirection = 'desc')
    {
        $product = $query->findOrFail($productId);
        return $product->extras()->orderBy($sortField, $sortDirection);
    }

    public function scopeGetProductVariants($query, $productId, $sortField = 'id', $sortDirection = 'desc')
    {
        $product = $query->findOrFail($productId);
        return $product->variants()->orderBy($sortField, $sortDirection);
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
        $tagIds = $this->getProductTags($validatedData);
        unset($validatedData['product_tags']);
        $product = $query->create($validatedData);
        if (!empty($tagIds)) {
            $product->tags()->attach($tagIds);
        }
        return $product;
    }

    public function scopeList($query, $search = '', $sortField = 'id', $sortDirection = 'desc', $status = 1)
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

    public function scopeGetAllActiveProducts($query, $fields = ['*'], $sortField = 'id', $sortDirection = 'desc', $status = 1, $relations = [])
    {
        if (!empty($status)) {
            $query->where('status', $status);
        }

        foreach ($relations as $relation => $relationFields) {
            $query->with([$relation => function ($query) use ($relationFields) {
                $query->select($relationFields);
            }]);
        }

        return $query->select($fields)->orderBy($sortField, $sortDirection);
    }

    public function scopeGetProductById($query, $productId, $fields = ['*'], $relations = [])
    {
        $query->where('id', $productId);

        foreach ($relations as $relation => $relationFields) {
            $query->with([$relation => function ($query) use ($relationFields) {
                $query->select($relationFields)->where('status', 1);
            }]);
        }

        return $query->select($fields);
    }

    public function scopeUpdateProduct($query, $id, array $validatedData)
    {
        $tagIds = $this->getProductTags($validatedData);
        unset($validatedData['product_tags']);
        $product = $query->findOrFail($id);
        $product->update($validatedData);
        $product->tags()->sync($tagIds);

        return $product;
    }

    public function getDiscountedPriceAttribute()
    {

        $discountedPrice = $this->price;
        if ($this->category && $this->category->discount_enabled) {
            $discountedPrice = $this->applyDiscount($discountedPrice, $this->category->discount);
        } elseif ($this->discount_enabled) {
            $discountedPrice = $this->applyDiscount($discountedPrice, $this->discount);
        }

        return (float) $discountedPrice;
    }

    protected function applyDiscount($price, $discount)
    {
        return $price - ($price * ($discount / 100));
    }


    protected function getProductTags($validatedData)
    {
        $tagIds = [];
        if (isset($validatedData['product_tags'])) {
            $tagIds = $validatedData['product_tags'];
        }
        return $tagIds;
    }
}
