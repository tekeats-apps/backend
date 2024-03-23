<?php

namespace App\Http\Controllers\API\V1\Platform\Category;

use App\Http\Controllers\Controller;
use App\Http\Requests\Platform\Category\CreateCategory;
use App\Http\Requests\Platform\Category\ListCategories;
use App\Http\Requests\Platform\Category\UpdateCategory;
use App\Models\Vendor\Category;
use App\Services\Platform\CategoryService;
use App\Traits\ApiResponse;
use Illuminate\Http\JsonResponse;
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

    /**
     * Get Category Details
     *
     * @authenticated
     *
     * Fetch details of a specific category.
     *
     * @param int $category The ID of the category to fetch details for.
     */
    public function getCategoryDetails(int $category): \Illuminate\Http\JsonResponse
    {
        try {
            $categoryDetails = $this->categoryService->getCategoryDetails($category);

            if (!$categoryDetails) {
                return $this->errorResponse('Category not found', Response::HTTP_NOT_FOUND);
            }

            return $this->successResponse($categoryDetails, "Category details retrieved successfully!");
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Update Category
     *
     * @authenticated
     *
     * Updates the specified category with the provided data.
     *
     * @param UpdateCategory $request
     * @param Category $category The ID of the category to update.
     * @return JsonResponse
     */
    public function updateCategory(UpdateCategory $request, Category $category): \Illuminate\Http\JsonResponse
    {
        try {
            $data = $request->validated();
            $updatedCategory = $this->categoryService->updateCategory($category, $data);
            return $this->successResponse($updatedCategory, "Category updated successfully!");
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Delete a Category
     *
     * @authenticated
     *
     * Deletes the specified category.
     *
     * @param int $category The ID of the category to delete.
     * @return JsonResponse
     */
    public function deleteCategory(int $category): \Illuminate\Http\JsonResponse
    {
        try {
            $this->categoryService->deleteCategory($category);
            return $this->successResponse(null, "Category deleted successfully!");
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }



}
