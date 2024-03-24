<?php

namespace App\Http\Requests\Platform\Tags;

use Illuminate\Foundation\Http\FormRequest;

class CreateTags extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255|unique:tags,name', // to ensure unique name per tag, excluding the current tag being updated
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
