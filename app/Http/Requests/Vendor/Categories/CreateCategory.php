<?php

namespace App\Http\Requests\Vendor\Categories;

use Illuminate\Foundation\Http\FormRequest;

class CreateCategory extends FormRequest
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
        $categoryId = $this->category ? $this->category->id : null;

        $nameRule = $this->input('parent_id')
            ? 'required|unique:categories,name,NULL,id,parent_id,' . $this->input('parent_id')
            : 'required|unique:categories,name,' . $categoryId;

        return [
            'name' => $nameRule,
            'parent_id' => 'nullable|exists:categories,id',
            'position' => 'nullable|numeric',
            'description' => 'nullable',
            'featured' => 'nullable|numeric',
            'discount' => 'nullable|numeric',
            'discount_enabled' => 'nullable|numeric',
            'status' => 'nullable|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:1024'
        ];
    }
}
