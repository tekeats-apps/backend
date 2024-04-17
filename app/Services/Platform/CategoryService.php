<?php

namespace App\Services\Platform;

use App\Traits\TenantImageUploadTrait;
use Illuminate\Database\Eloquent\ModelNotFoundException;
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
    public function getActiveCategoryList()
    {
        $fields = [
            'id',
            'name',
            'slug',
        ];
        return $this->categoryRepository->getActiveCategoryList($fields);
    }
    public function getCategoryDetails($categoryId)
    {
        return $this->categoryRepository->findCategory($categoryId);
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
            $filename = $this->uploadImage($image, $module, $recordId, $tableField, $tableName);
            $category->image = $filename;
        }
        return $category;
    }

    /**
     * @throws \Exception
     */
    public function updateCategory(Category $category, array $data): Category
    {
        $data['slug'] = Str::slug($data['name']);
        $category->update($data);
        // Handle image update if provided
        if (!empty($data['image'])) {
            // If a new image is provided, upload and update the image URL
            $image = $data['image'];
            $module = Category::IMAGE_PATH;
            $recordId = $category->id;
            $tableField = 'image';
            $tableName = 'categories';

            if ($category->image) {
                $this->delete_image_by_name($module, $category->image);
            }

            $filename = $this->uploadImage($image, $module, $recordId, $tableField, $tableName);
            $category->image = $filename;
            $category->save();
        }

        return $category;
    }

    public function deleteCategory(int $categoryId): void
    {
        $category = $this->categoryRepository->findCategory($categoryId);
        if (!$category) {
            throw new ModelNotFoundException('Category not found');
        }
        $category->delete();
    }

}
