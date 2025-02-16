<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class PluginTypeRequest extends FormRequest
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
        switch ($this->getMethod()) {
            case 'POST':
                return [
                    'name' => ['required', 'string', 'unique:plugin_types,name', 'max:255']
                ];
                break;
            case 'PUT':
                return [
                    'name' => ['required', 'string', 'unique:plugin_types,name,' . $this->id, 'max:255']
                ];
        }
    }
}
