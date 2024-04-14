<?php

namespace App\Http\Controllers\API\V1\Platform;

use App\Traits\ApiResponse;
use App\Http\Controllers\Controller;
use App\Services\Platform\ProductService;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Requests\Platform\Product\ListProducts;

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
}
