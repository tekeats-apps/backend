<?php

namespace App\Http\Controllers\Vendor;

use Log;
use Exception;
use App\Models\Vendor\Category;
use App\Http\Controllers\Controller;
use App\Traits\TenantImageUploadTrait;
use App\Http\Requests\Vendor\Categories\CreateCategory;
use App\Http\Requests\Vendor\Categories\UpdateCategory;

class CategoryController extends Controller
{
    use TenantImageUploadTrait;

    public function index()
    {
        return view('vendor.modules.categories.index');
    }
    public function create()
    {
        $usedPositions = Category::pluck('position')->toArray();
        $positions = range(1, Category::MAX_POSITION);
        return view('vendor.modules.categories.create-edit', compact('positions', 'usedPositions'));
    }

    public function store(CreateCategory $request)
    {
        $data = $request->validated();

        try {
            $category = Category::storeCategory($data);

            if ($category) {
                if (isset($data['image']) && !empty($data['image'])) {
                    $image = $data['image'];
                    $module = Category::IMAGE_PATH; // Assuming 'users' is the module name
                    $recordId = $category->id; // Assuming the user's ID is the record ID
                    $tableField = 'image';
                    $tableName = 'categories';

                    // Upload the image and get the image URL
                    $this->uploadImage($image, $module, $recordId, $tableField, $tableName);
                }
            }

            // Determine the redirect route based on whether it's a category or subcategory
            $redirectRoute = $category->parent_id ? 'vendor.categories.subcategories.list' : 'vendor.categories.list';

            // Set the success message based on whether it's a category or subcategory
            $successMessage = $category->parent_id ? 'Subcategory created successfully!' : 'Category created successfully!';

            // Get the parent ID for subcategories
            $parentId = $category->parent_id ?? null;

            // Refresh the categories list or redirect if needed
            return redirect()->route($redirectRoute, [$parentId])->with('success', $successMessage);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'An error occurred while saving the category!');
        }
    }


    public function edit(Category $category)
    {
        $usedPositions = Category::pluck('position')->toArray();
        $positions = range(1, Category::MAX_POSITION);
        return view('vendor.modules.categories.create-edit', compact('category', 'positions', 'usedPositions'));
    }

    public function update(UpdateCategory $request, Category $category)
    {
        $data = $request->validated();
        try {
            // Update the category data
            $category->update($data);

            if (isset($data['image']) && !empty($data['image'])) {
                // If a new image is provided, upload and update the image URL
                $image = $data['image'];
                $module = Category::IMAGE_PATH;
                $recordId = $category->id;
                $tableField = 'image';
                $tableName = 'categories';

                if ($category->image) {
                    $this->delete_image_by_name($module, $category->image);
                }

                $this->uploadImage($image, $module, $recordId, $tableField, $tableName);
            }

            // Set the success message
            $successMessage = $category->parent_id ? 'Subcategory updated successfully!' : 'Category updated successfully!';

            // Determine the redirect route based on whether it's a category or subcategory
            $redirectRoute = $category->parent_id ? 'vendor.categories.subcategories.list' : 'vendor.categories.list';

            // Get the parent ID for subcategories
            $parentId = $category->parent_id ?? null;

            // Refresh the categories list or redirect if needed
            return redirect()->route($redirectRoute, [$parentId])->with('success', $successMessage);
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return redirect()->back()->with('error', 'An error occurred while saving the category: ' . $e->getMessage());
        }
    }
}
