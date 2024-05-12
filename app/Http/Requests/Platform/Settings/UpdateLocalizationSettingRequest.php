<?php

namespace App\Http\Requests\Platform\Settings;

use Illuminate\Foundation\Http\FormRequest;

class UpdateLocalizationSettingRequest extends FormRequest
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
            'languages' => 'nullable|array',
            'default_language' => 'nullable|string',
            'timezone' => 'nullable|string',
            'date_format' => 'nullable|string',
            'time_format' => 'nullable|string',
            'currency' => 'nullable|string',
            'currency_symbol' => 'nullable|string',
            'currency_position' => 'nullable|string|in:left,right'
        ];
    }
}
