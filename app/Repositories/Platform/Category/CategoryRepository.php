<?php

namespace App\Repositories\Platform\Category;

use App\Models\Vendor\Category;

class CategoryRepository implements CategoryRepositoryInterface
{
    protected Category $model;

    public function __construct(Category $category)
    {
        $this->model = $category;
    }

    public function listCategories($sortField = 'id', $sortDirection = 'desc')
    {
        return $this->model->orderBy($sortField, $sortDirection);
    }

    public function createCategory(array $data)
    {
        return $this->model->create($data);
    }

    public function findCategory($categoryId)
    {
        return $this->model->find($categoryId);
    }
}
