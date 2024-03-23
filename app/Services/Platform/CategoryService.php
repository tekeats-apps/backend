<?php

namespace App\Services\Platform;

use App\Traits\TenantImageUploadTrait;
use Illuminate\Support\Str;
use App\Models\Vendor\Category;
use App\Repositories\Platform\Category\CategoryRepository;

class CategoryService
{
    use TenantImageUploadTrait;
    protected CategoryRepository $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }
    public function getCategoryList()
    {
        return $this->categoryRepository->listCategories();
    }
    public function createCategory(array $data)
    {
        $data['slug'] = Str::slug($data['name']);
        $category = $this->categoryRepository->createCategory($data);

        // Check if image is provided and save it
        if (!empty($data['image'])) {
            $image = $data['image'];
            $module = Category::IMAGE_PATH; // Define the path where you want to store the images
            $recordId = $category->id; // Use the newly created category's ID
            $tableField = 'image'; // The field in the database where the image path will be stored
            $tableName = 'categories'; // The table where the category data is stored

            // Upload the image and update the category record
            $this->uploadImage($image, $module, $recordId, $tableField, $tableName);
        }
        return $category;
    }

}
