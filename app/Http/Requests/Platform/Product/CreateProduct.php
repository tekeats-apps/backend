<?php

namespace App\Http\Requests\Platform\Product;

use Illuminate\Foundation\Http\FormRequest;

class CreateProduct extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
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
            'is_extras_enabled' => 'boolean',
            'is_variants_enabled' => 'boolean',
            'discount' => 'nullable|numeric',
            'discount_enabled' => 'boolean',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'product_tags' => 'nullable|array',
        ];
    }
}
