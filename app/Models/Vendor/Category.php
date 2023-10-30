<?php

namespace App\Models\Vendor;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;

    const MAX_POSITION = 50;
    const IMAGE_PATH = 'categories';

    protected $fillable = [
        'parent_id',
        'name',
        'slug',
        'position',
        'featured',
        'description',
        'image',
        'status',
    ];

    public function subcategories()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    protected function getImageAttribute($value)
    {

        $image = 'https://cdn-icons-png.flaticon.com/512/3787/3787263.png';
        if ($value) {
            $path = Category::IMAGE_PATH . '/' . $value;
            $image = tenant_asset($path);
        }

        return $image;
    }

    public function scopeList($query, $search = '', $sortField = 'id', $sortDirection = 'desc')
    {
        $query->whereNull('parent_id');
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
    public function scopeGetSubCategorieslist($query, $parentId, $search, $sortField, $sortDirection, $status)
    {
        $query->where('parent_id', $parentId);
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
    public function scopeGetAllActiveSubCategories($query, $sortField = 'id', $sortDirection = 'desc', $status = 1)
    {
        $query->whereNotNull('parent_id');

        if (!empty($status)) {
            $query->where('status', $status);
        }

        return $query->orderBy($sortField, $sortDirection);
    }
    public function scopeGetSubcategoriesUsedPositions($query)
    {
        return $query->whereNotNull('parent_id')->pluck('position')->toArray();
    }
    public function scopeStoreCategory($query, $data)
    {
        return $query->create([
            'name' => $data['name'],
            'parent_id' => isset($data['parent_id']) ? $data['parent_id'] : null,
            'slug' => Str::slug($data['name']),
            'position' => isset($data['position']) ? $data['position'] : 0,
            'description' => isset($data['description']) ? $data['description'] : null,
            'featured' => isset($data['featured']) ? $data['featured'] : 0,
            'status' => isset($data['status']) ? $data['status'] : 0
        ]);
    }
}
