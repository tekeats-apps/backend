<?php

namespace App\Services\Platform;

use Illuminate\Support\Str;
use App\Models\Vendor\Product;
use App\Traits\TenantImageUploadTrait;
use App\Repositories\Platform\Product\ProductRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ProductService
{
    use TenantImageUploadTrait;
    protected ProductRepository $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function getProducts()
    {
        return $this->productRepository->getProductsList();
    }

    public function createProduct(array $data)
    {
        $data['slug'] = Str::slug($data['name']);
        $product = $this->productRepository->createProduct($data);

        // Check if image is provided and save it
        if (!empty($data['image'])) {
            $image = $data['image'];
            $module = Product::IMAGE_PATH; // Define the path where you want to store the images
            $recordId = $product->id; // Use the newly created product's ID
            $tableField = 'image'; // The field in the database where the image path will be stored
            $tableName = 'categories'; // The table where the product data is stored

            // Upload the image and update the product record
            $filename = $this->uploadImage($image, $module, $recordId, $tableField, $tableName);
            $product->image = $filename;
        }
        return $product;
    }

    public function getProductDetails(int $productId)
    {
        return $this->productRepository->findProduct($productId);
    }

    public function deleteProduct(int $productId): void
    {
        $product = $this->productRepository->findProduct($productId);
        if (!$product) {
            throw new ModelNotFoundException('Product not found');
        }
        $product->delete();
    }

}