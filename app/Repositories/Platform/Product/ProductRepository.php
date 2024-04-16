<?php

namespace App\Repositories\Platform\Product;

use App\Models\Vendor\Product;
use App\Repositories\Platform\Product\ProductRepositoryInterface;

class ProductRepository implements ProductRepositoryInterface
{
    protected $model;

    public function __construct(Product $product)
    {
        $this->model = $product;
    }

    public function getProductsList($sortField = 'id', $sortDirection = 'desc')
    {
        return $this->model->orderBy($sortField, $sortDirection);
    }

    public function createProduct(array $data)
    {
        return $this->model->create($data);
    }

    public function findProduct($productId)
    {
        return $this->model->find($productId);
    }
}
