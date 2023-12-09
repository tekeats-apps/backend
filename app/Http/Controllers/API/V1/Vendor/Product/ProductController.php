<?php

namespace App\Http\Controllers\API\V1\Vendor\Product;

use Exception;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Vendor\Product;
use App\Http\Controllers\Controller;
use App\Http\Requests\Vendor\Products\API\GetProducts;

/**
 * @tags Products
 */


class ProductController extends Controller
{
    use ApiResponse;
    /**
     * Get Products
     *
     * Get products list from the system
     */
    public function getList(GetProducts $request)
    {
        $valid = $request->validated();
        $limit = (isset($valid['limit']) ? $valid['limit'] : 10);
        try {

            $relations = [
                'category' => ['categories.id', 'categories.name'],
                'tags' => ['tags.id', 'tags.name'],
            ];
            $products = Product::getAllActiveProducts(
                [
                    'id',
                    'price',
                    'name',
                    'featured',
                    'category_id',
                    'image',
                    'discount_enabled',
                    'discount',
                    'is_extras_enabled',
                    'is_variants_enabled',
                    'prepration_time'
                ],
                'id',
                'desc',
                1,
                $relations
            )
                ->paginate($limit);
            return $this->successResponse($products, "Products fetched successfully.", Response::HTTP_OK);
        } catch (Exception $e) {
            return $this->exceptionResponse($e, "Failed to fetch products.");
        }
    }
}
