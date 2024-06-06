<?php

namespace App\Http\Requests\Platform\Settings;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMediaSettingRequest extends FormRequest
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
        return [
            'logo'  => 'nullable|image|max:1024|mimes:png',
            'favicon'  => 'nullable|image|max:20|mimes:png'
        ];
    }
}
