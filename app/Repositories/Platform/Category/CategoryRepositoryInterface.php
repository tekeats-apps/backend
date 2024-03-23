<?php

namespace App\Repositories\Platform\Category;

interface CategoryRepositoryInterface
{
    public function listCategories($sortField = 'id', $sortDirection = 'desc');
    public function createCategory(array $data);
}
