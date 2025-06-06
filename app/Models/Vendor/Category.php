<?php

namespace App\Models\Vendor;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;

    const MAX_POSITION = 50;
    const IMAGE_PATH = 'categories';

    protected $fillable = [
        'name',
        'slug',
        'featured',
        'description',
        'image',
        'status',
        'discount_enabled',
        'discount'
    ];

    protected $casts = [
        'status' => 'boolean',
        'featured' => 'boolean',
        'discount_enabled' => 'boolean',
        'discount' => 'integer',
    ];

    protected function getImageAttribute($value)
    {

        $image = 'https://cdn-icons-png.flaticon.com/512/3787/3787263.png';
        if ($value) {
            $path = Category::IMAGE_PATH . '/' . $value;
            $image = Storage::disk('s3')->url($path);
        }

        return $image;
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
    public function scopeGetAllActiveCategories($query, $fields = ['*'],$sortField = 'id', $sortDirection = 'desc', $status = 1)
    {
        if (!empty($status)) {
            $query->where('status', $status);
        }

        return $query->select($fields)->orderBy($sortField, $sortDirection);
    }
    public function scopeStoreCategory($query, $data)
    {
        return $query->create([
            'name' => $data['name'],
            'parent_id' => isset($data['parent_id']) ? $data['parent_id'] : null,
            'slug' => Str::slug($data['name']),
            'position' => isset($data['position']) ? $data['position'] : 0,
            'description' => isset($data['description']) ? $data['description'] : null,
            'discount_enabled' => isset($data['discount_enabled']) ? $data['discount_enabled'] : 0,
            'discount' => isset($data['discount']) ? $data['discount'] : 0,
            'featured' => isset($data['featured']) ? $data['featured'] : 0,
            'status' => isset($data['status']) ? $data['status'] : 0
        ]);
    }
}
