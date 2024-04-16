<?php

namespace App\Http\Controllers\API\V1\Platform;

use App\Traits\ApiResponse;
use App\Models\Vendor\Product;
use App\Http\Controllers\Controller;
use App\Services\Platform\ProductService;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Requests\Platform\Product\ListProducts;
use App\Http\Requests\Platform\Product\CreateProduct;
use App\Http\Requests\Platform\Product\UpdateProduct;

class ProductController extends Controller
{
    use ApiResponse;

    protected ProductService $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    /**
     * Get Products Listing
     *
     * @authenticated
     *
     * Fetch all the products lisitng with data and stats.
     */
    public function getProducts(ListProducts $request): \Illuminate\Http\JsonResponse
    {
        try {
            $limit = $request->input('limit', 10);

            $products = $this->productService->getProducts()->paginate($limit);

            return $this->successResponse($products, "Orders fetched successfully!");
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Create a new Product
     *
     * @authenticated
     *
     * Creates a new product with the provided data.
     */
    public function createProduct(CreateProduct $request): \Illuminate\Http\JsonResponse
    {
        try {
            $data = $request->validated();
            $product = $this->productService->createProduct($data);
            return $this->successResponse($product, "Product created successfully!");
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Update Product
     *
     * @authenticated
     *
     * Updates the specified product with the provided data.
     *
     * @param UpdateProduct $request
     * @param Product $product The ID of the product to update.
     * @return JsonResponse
     */
    public function updateProduct(UpdateProduct $request, Product $product): \Illuminate\Http\JsonResponse
    {
        try {
            $data = $request->validated();
            $updatedProduct = $this->productService->updateProduct($product, $data);
            return $this->successResponse($updatedProduct, "Product updated successfully!");
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Get Product Details
     *
     * @authenticated
     *
     * Fetch details of a specific product.
     *
     * @param int $product The ID of the product to fetch details for.
     */
    public function getProductDetails(int $product): \Illuminate\Http\JsonResponse
    {
        try {
            $productDetails = $this->productService->getProductDetails($product);
            if (!$productDetails) {
                return $this->errorResponse('Product not found', Response::HTTP_NOT_FOUND);
            }

            return $this->successResponse($productDetails, "Product details retrieved successfully!");
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Delete a Product (Soft Delete)
     *
     * @authenticated
     *
     * Deletes the specified product.
     *
     * @param int $product The ID of the product to delete.
     * @return JsonResponse
     */
    public function deleteProduct(int $product): \Illuminate\Http\JsonResponse
    {
        try {
            $this->productService->deleteProduct($product);
            return $this->successResponse(null, "Product deleted successfully!");
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
