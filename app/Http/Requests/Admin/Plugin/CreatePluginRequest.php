<?php

namespace App\Http\Requests\Admin\Plugin;

use Illuminate\Validation\Rules\File;
use Illuminate\Foundation\Http\FormRequest;

class CreatePluginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'plugin_type_id' => ['required', 'exists:plugin_types,id'],
            'name' => ['required', 'unique:plugins,name', 'string', 'max:255'],
            'image' => ['nullable', File::types(['png', 'jpg', 'jpeg'])],
            'documentation' => ['nullable', File::types('pdf')->max(1024 * 2)],
            'video' => ['nullable', 'url'],
            'version' => ['nullable', 'numeric', 'between:0,99.99'],
            'description' => ['required', 'string', 'max:20000'],
            'is_paid' => ['nullable'],
            'active' => ['nullable'],
            'featured' => ['nullable']
        ];
    }

    public function messages()
    {
        return [
            'plugin_type_id.required' => 'The plugin type field is required.',
        ];
    }
}
