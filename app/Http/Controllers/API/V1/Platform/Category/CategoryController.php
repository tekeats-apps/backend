<?php

namespace App\Http\Controllers\API\V1\Platform\Category;

use App\Http\Controllers\Controller;
use App\Http\Requests\Platform\Category\CreateCategory;
use App\Http\Requests\Platform\Category\ListCategories;
use App\Services\Platform\CategoryService;
use App\Traits\ApiResponse;
use Symfony\Component\HttpFoundation\Response;

/**
 * @tags Platform
 */
class CategoryController extends Controller
{
    use ApiResponse;
    protected CategoryService $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }
    /**
     * Get Categories List
     *
     * @authenticated
     *
     * Fetch all the categories added by platform user.
     */
    public function getCategories(ListCategories $request): \Illuminate\Http\JsonResponse
    {
        try {
            $limit = $request->input('limit', 10);

            $categories = $this->categoryService->getCategoryList()->paginate($limit);

            return $this->successResponse($categories, "Categories listed successfully!");
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Create a new Category
     *
     * @authenticated
     *
     * Creates a new category with the provided data.
     */
    public function createCategory(CreateCategory $request): \Illuminate\Http\JsonResponse
    {
        try {
            $data = $request->validated();
            $category = $this->categoryService->createCategory($data);
            return $this->successResponse($category, "Category created successfully!");
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
