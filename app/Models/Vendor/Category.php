<?php

namespace App\Models\Vendor;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;

    const MAX_POSITION = 30;

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
            $path = User::IMAGE_PATH . '/' . $value;
            $image = tenant_asset($path);
        }

        return $image;
    }

    public function scopeList($query, $search, $sortField, $sortDirection)
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
    public function scopeStoreCategory($query, $data)
    {
        return $query->create([
            'name' => $data['name'],
            'slug' => Str::slug($data['name']),
            'position' => ($data['position'] ? $data['position'] : 0),
            'description' => ($data['description'] ? $data['description'] : null),
            'featured' => ($data['featured'] ? $data['featured'] : 0),
            'status' => ($data['status'] ? $data['status'] : 0)
        ]);
    }
}
