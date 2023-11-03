<?php

namespace App\Http\Controllers\Vendor;

use Log;
use Exception;
use App\Models\Vendor\Tag;
use App\Models\Vendor\Product;
use App\Models\Vendor\Category;
use App\Http\Controllers\Controller;
use App\Traits\TenantImageUploadTrait;
use App\Http\Requests\Vendor\Products\CreateProductRequest;
use App\Http\Requests\Vendor\Products\UpdateProductRequest;

class ProductController extends Controller
{
    use TenantImageUploadTrait;

    public function index()
    {
        return view('vendor.modules.products.index');
    }

    public function create()
    {
        $categories = Category::getAllActiveCategories()->pluck('name', 'id');
        $tags = Tag::getActiveTags()->pluck('name', 'id');
        return view('vendor.modules.products.create-edit', compact('categories', 'tags'));
    }

    public function store(CreateProductRequest $request)
    {
        try {
            $validatedData = $request->validated();

            // If there is an image, you should store the image and update $validatedData['image'] with the path of the image.
            $product = Product::createProduct($validatedData);

            if ($product) {
                if (isset($validatedData['image']) && !empty($validatedData['image'])) {
                    $image = $validatedData['image'];
                    $module = Product::IMAGE_PATH; // Assuming 'users' is the module name
                    $recordId = $product->id; // Assuming the user's ID is the record ID
                    $tableField = 'image';
                    $tableName = 'products';

                    // Upload the image and get the image URL
                    $this->uploadImage($image, $module, $recordId, $tableField, $tableName);
                }
            }

            return redirect()->route('vendor.products.list')->with('success', 'Product has been successfully added.');
        } catch (Exception $e) {
            // Log the error
            Log::error('An error occurred while storing the product: ' . $e->getMessage());
            return redirect()->back()->with('error', 'An error occurred while saving the category: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $subCategories = Category::getAllActiveSubCategories()->pluck('name', 'id');
        $tags = Tag::getActiveTags()->pluck('name', 'id');
        $product = Product::findOrFail($id);
        return view('vendor.modules.products.create-edit', compact('product', 'subCategories', 'tags'));
    }

    public function update(UpdateProductRequest $request, Product $product)
    {
        try {
            $validatedData = $request->validated();
            // If there is an image, you should store the image and update $validatedData['image'] with the path of the image.
            $product->updateProduct($product->id, $validatedData);
            if ($product) {
                if (isset($validatedData['image']) && !empty($validatedData['image'])) {
                    $image = $validatedData['image'];
                    $module = Product::IMAGE_PATH; // Assuming 'users' is the module name
                    $recordId = $product->id; // Assuming the user's ID is the record ID
                    $tableField = 'image';
                    $tableName = 'products';

                    if ($product->image) {
                        $this->delete_image_by_name($module, $product->image);
                    }

                    // Upload the image and get the image URL
                    $this->uploadImage($image, $module, $recordId, $tableField, $tableName);
                }
            }

            return redirect()->route('vendor.products.list')->with('success', 'Product has been successfully updated.');
        } catch (\Exception $exception) {
            // Log the error
            Log::error('An error occurred while updating the product: ' . $exception->getMessage());
            return redirect()->back()->with('error', 'An error occurred while saving the category: ' . $exception->getMessage());
        }
    }
}
