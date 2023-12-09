<?php

namespace App\Http\Controllers\API\V1\Vendor\Product;

use Exception;
use App\Traits\ApiResponse;
use Illuminate\Http\Response;
use App\Models\Vendor\Category;
use App\Http\Controllers\Controller;
use App\Http\Requests\Vendor\Categories\API\GetCategories;

/**
 * @tags Products
 */

class CategoryController extends Controller
{
    use ApiResponse;
    /**
     * Get Categories
     *
     * Get categories list from the system
     */
    public function getList(GetCategories $request)
    {
        $validatedData = $request->validated();
        $limit = (isset($validatedData['limit']) ? $validatedData['limit'] : 10);
        try {
            $categories = Category::getAllActiveCategories([
                'id',
                'name',
                'discount_enabled',
                'discount',
                'image',
                'description'
            ])->paginate($limit);
            return $this->successResponse($categories, "Categories fetched successfully.", Response::HTTP_OK);
        } catch (Exception $e) {
            return $this->exceptionResponse($e, "Failed to fetch categories.");
        }
    }
}
