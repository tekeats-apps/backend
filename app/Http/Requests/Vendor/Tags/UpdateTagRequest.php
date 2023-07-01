<?php

namespace App\Http\Requests\Vendor\Tags;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTagRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255|unique:tags,name,' . $this->tag, // to ensure unique name per tag, excluding the current tag being updated
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'name.required' => 'A tag name is required',
            'name.string' => 'Tag name must be a string',
            'name.max' => 'Tag name must not exceed 255 characters',
            'name.unique' => 'Tag name already exists',
        ];
    }
}
