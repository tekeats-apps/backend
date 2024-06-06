<?php

namespace App\Http\Requests\Vendor\Products;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255',  Rule::unique('products')->ignore($this->product)],
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'prepration_time' => 'nullable|string|max:255',
            'status' => 'required|boolean',
            'featured' => 'nullable|boolean',
            'is_extras_enabled' => 'nullable|boolean',
            'discount' => 'nullable|numeric',
            'discount_enabled' => 'boolean',
            'is_variants_enabled' => 'nullable|boolean',
            'is_product_timing_enabled' => 'nullable|boolean',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'product_tags' => 'nullable|array',
            'seo_title' => 'nullable|string|max:255',
            'seo_description' => 'nullable|string|max:255',
            'seo_keywords' => 'nullable|string|max:255',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'The product name field is required.',
            'name.unique' => 'The product name has already been taken.',
            'description.required' => 'The description field is required.',
            'price.required' => 'The price field is required.',
            'price.numeric' => 'The price field must be a number.',
            'status.required' => 'The status field is required.',
            'category_id.required' => 'The category field is required.',
            'category_id.exists' => 'The selected category is invalid.',
            'image.image' => 'The file must be an image.',
            'image.mimes' => 'The image must be a file of type: jpeg, png, jpg, gif, svg.',
            'seo_title.max' => 'The SEO title may not be greater than 255 characters.',
            'seo_description.max' => 'The SEO description may not be greater than 255 characters.',
            'seo_keywords.max' => 'The SEO keywords may not be greater than 255 characters.',
        ];
    }
}
