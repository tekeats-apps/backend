<?php

namespace App\Http\Requests\Platform\Tag;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateTag extends FormRequest
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
        $tagId = $this->tag ? $this->tag->id : null;
        return [
            'name' => 'required|string|max:255|unique:tags,name,' . $this->tagId, // to ensure unique name per tag, excluding the current tag being updated
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
