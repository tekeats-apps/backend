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

    public function subcategoryCreate()
    {
        $usedPositions = Category::getSubcategoriesUsedPositions();
        $mainCategories = Category::list()->pluck('name', 'id');
        $positions = range(1, Category::MAX_POSITION);
        return view('vendor.modules.categories.subcategories.create-edit', compact('positions', 'usedPositions', 'mainCategories'));
    }

    public function getSubcaegories(Category $category)
    {
        return view('vendor.modules.categories.subcategories.index', compact('category'));
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
                    $table_field = 'image';
                    $table_name = 'categories';

                    // Upload the image and get the image URL
                    $this->uploadImage($image, $module, $recordId, $table_field, $table_name);
                }
            }
            // Refresh the categories list or redirect if needed
            return redirect()->route('vendor.categories.list')->with('success', 'Category created successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while saving the category!');
            Log::error($e->getMessage());
        }
    }

    public function edit(Category $category)
    {
        $usedPositions = Category::pluck('position')->toArray();
        $positions = range(1, Category::MAX_POSITION);
        return view('vendor.modules.categories.create-edit', compact('category', 'positions', 'usedPositions'));
    }

    public function subcategoryEdit($category, $subcategory)
    {
        $subcategory = Category::where(['parent_id' =>  $category, 'id' => $subcategory])->first();
        if (!$subcategory instanceof Category) {
            abort(404);
        }
        $mainCategories = Category::list()->pluck('name', 'id');
        $usedPositions = Category::pluck('position')->toArray();
        $positions = range(1, Category::MAX_POSITION);
        return view('vendor.modules.categories.subcategories.create-edit', compact('subcategory', 'mainCategories','positions', 'usedPositions'));
    }

    public function update(UpdateCategory $request, Category $category)
    {
        $data = $request->validated();
        try {
            // Retrieve the existing category
            $category = Category::find($category->id);
            $data['position'] = isset($data['position']) ? $data['position'] : 0;
            $data['featured'] = isset($data['featured']) ? $data['featured'] : 0;
            $data['status'] = isset($data['status']) ? $data['status'] : 0;
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
            return redirect()->route('vendor.categories.list')->with('message', 'Category updated successfully!');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'An error occurred while saving the category!' . $e->getMessage());
            // You can also log the exception for debugging purposes
            Log::error($e->getMessage());
        }
    }
}
