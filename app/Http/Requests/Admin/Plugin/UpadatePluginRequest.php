<?php

namespace App\Http\Requests\Admin\Plugin;

use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\File;
use Illuminate\Foundation\Http\FormRequest;

class UpadatePluginRequest extends FormRequest
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
        $plugin = $this->plugin ? $this->plugin->id : null;
        return [
            'plugin_type_id' => ['required'],
            'name' => [
                'required',
                Rule::unique('plugins', 'name')
                    ->ignore($plugin)
            ],
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
}
