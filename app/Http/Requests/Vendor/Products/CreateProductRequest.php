<?php

namespace App\Http\Requests\Vendor\Products;

use Illuminate\Foundation\Http\FormRequest;

class CreateProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|max:255|unique:products,name',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'prepration_time' => 'nullable|string',
            'status' => 'boolean',
            'featured' => 'boolean',
            'extras' => 'boolean',
            'is_variants_enabled' => 'boolean',
            'discount' => 'nullable|numeric',
            'discount_enabled' => 'boolean',
            'is_product_timing_enabled' => 'boolean',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'product_tags' => 'nullable|array',
            'seo_title' => 'nullable|string|max:255',
            'seo_description' => 'nullable|string',
            'seo_keywords' => 'nullable|string',
        ];
    }

    /**
     * Custom message for validation
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => 'Please enter a catchy name for your product.',
            'name.unique' => 'Oops! This product name is already taken. Please choose a unique name.',
            'price.required' => 'Please enter the price of your amazing product.',
            'category_id.required' => 'Please select a category for your product.',
            'category_id.exists' => 'Oh no! The selected product category is invalid. Please choose a valid category.',
            'image.image' => 'Hmm, it seems the file you uploaded is not a valid image. Please upload an image file.',
            'image.mimes' => 'Oops! The product image should be in one of the following formats: JPEG, PNG, JPG, GIF, SVG.',
            'image.max' => 'The product image you uploaded is too large. Please ensure it is under 2MB in size.',
        ];
    }
}
