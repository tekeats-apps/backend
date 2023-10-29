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

            $products = Product::with([
                'category:id,name,image',
                'tags:id,name'
            ])
                ->list()
                ->paginate($limit);

            return $this->successResponse($products, "Products fetched successfully.", Response::HTTP_OK);
        } catch (Exception $e) {
            return $this->exceptionResponse($e, "Failed to fetch products.");
        }
    }
}
