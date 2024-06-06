<?php

namespace App\Repositories\Platform\Product;

interface ProductRepositoryInterface
{
    public function getProductsList($sortField = 'id', $sortDirection = 'desc');
    public function getProductExtras($product_id, $sortField = 'id', $sortDirection = 'desc');
}
