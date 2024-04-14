<?php

namespace App\Services\Platform;

use App\Repositories\Platform\Product\ProductRepository;

class ProductService
{
    protected ProductRepository $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function getProducts()
    {
        return $this->productRepository->getProductsList();
    }

}