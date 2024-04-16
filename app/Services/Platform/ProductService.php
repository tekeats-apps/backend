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

    /**
     * @throws \Exception
     */
    public function updateProduct(Product $product, array $data): Product
    {
        $data['slug'] = Str::slug($data['name']);
        $product->update($data);
        // Handle image update if provided
        if (!empty($data['image'])) {
            // If a new image is provided, upload and update the image URL
            $image = $data['image'];
            $module = Product::IMAGE_PATH;
            $recordId = $product->id;
            $tableField = 'image';
            $tableName = 'categories';

            if ($product->image) {
                $this->delete_image_by_name($module, $product->image);
            }

            $filename = $this->uploadImage($image, $module, $recordId, $tableField, $tableName);
            $product->image = $filename;
            $product->save();
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