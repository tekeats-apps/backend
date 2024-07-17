<?php

namespace App\Http\Requests\Platform\Plugins;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSettingFieldsRequest extends FormRequest
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
            'setting_fields' => 'required|array',
            'setting_fields.*.name' => 'required|string',
            'setting_fields.*.type' => 'required|string',
            'setting_fields.*.label' => 'required|string',
            'setting_fields.*.value' => 'required|string',
        ];
    }
}
