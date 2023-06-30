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
            'is_product_timing_enabled' => 'boolean',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'product_tags' => 'nullable|array',
            'seo_title' => 'nullable|string|max:255',
            'seo_description' => 'nullable|string',
            'seo_keywords' => 'nullable|array',
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
            'name.required' => 'Please enter a product name.',
            'name.unique' => 'This product name is already taken.',
            'price.required' => 'Please enter a product price.',
            'category_id.required' => 'Please select a product category.',
            'category_id.exists' => 'The selected product category is invalid.',
            'image.image' => 'The product image must be an image.',
            'image.mimes' => 'The product image must be a file of type: jpeg, png, jpg, gif, svg.',
            'image.max' => 'The product image may not be larger than 2048 kilobytes.'
        ];
    }
}
