<?php

namespace App\Http\Requests\Platform\Category;

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
                    ->ignore($categoryId)
            ],
            'description' => 'nullable',
            'featured' => 'nullable|numeric',
            'discount' => 'nullable|numeric',
            'discount_enabled' => 'nullable|numeric',
            'status' => 'nullable|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:100'
        ];
    }
}
