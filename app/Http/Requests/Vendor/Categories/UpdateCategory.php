<?php

namespace App\Http\Requests\Vendor\Categories;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateCategory extends FormRequest
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
        return [
            'name' => [
                'required',
                Rule::unique('categories', 'name')
                    ->where(function ($query) use ($categoryId) {
                        if ($this->input('parent_id')) {
                            // Check uniqueness for the same parent_id
                            $query->where('parent_id', $this->input('parent_id'));
                        } else {
                            // Check uniqueness for the category ID
                            $query->where('id', $categoryId);
                        }
                    })
                    ->ignore($categoryId)
            ],
            'parent_id' => 'nullable|integer',
            'position' => 'nullable|numeric',
            'description' => 'nullable',
            'featured' => 'nullable|numeric',
            'status' => 'nullable|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:1024'
        ];
    }
}
