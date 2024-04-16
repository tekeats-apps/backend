<?php

namespace App\Http\Requests\Platform\Product;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProduct extends FormRequest
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
        $productId = $this->product ? $this->product->id : null;
        return [
            'name' => [
                'required',
                Rule::unique('products', 'name')
                    ->ignore($productId)
            ],
            'description' => 'nullable|string',
            'price' => 'nullable|numeric|min:0',
            'prepration_time' => 'nullable|string',
            'status' => 'nullable|boolean',
            'featured' => 'nullable|boolean',
            'is_extras_enabled' => 'nullable|boolean',
            'is_variants_enabled' => 'nullable|boolean',
            'discount' => 'nullable|numeric',
            'discount_enabled' => 'nullable|boolean',
            'category_id' => 'nullable|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'product_tags' => 'nullable|array',
        ];
    }
}
