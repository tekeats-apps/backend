<?php

namespace App\Http\Controllers\API\V1\Vendor\Product;

use Exception;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Vendor\Category;
use App\Http\Controllers\Controller;

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
    public function getList()
    {
        try {
            $categories = Category::getAllActiveCategories()->get();
            return $this->successResponse($categories, "Categories fetched successfully.", Response::HTTP_OK);
        } catch (Exception $e) {
            return $this->exceptionResponse($e, "Failed to fetch categories.");
        }
    }
}
