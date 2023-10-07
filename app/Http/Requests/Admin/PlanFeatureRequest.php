<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class PlanFeatureRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        switch ($this->getMethod()) {
            case 'POST':
                return [
                    'feature_name' => ['required', 'string', 'max:255'],
                    'feature_description' => ['required', 'string']
                ];
            case 'PUT':
                return [
                    'feature_name' => ['required', 'string', 'max:255'],
                    'feature_description' => ['required', 'string']
                ];
        }
    }
}
