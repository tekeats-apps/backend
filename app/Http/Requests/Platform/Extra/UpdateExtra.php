<?php

namespace App\Http\Requests\Platform\Extra;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateExtra extends FormRequest
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
        $extraId = $this->extra ? $this->extra->id : null;
        return [
            'name' => [
                'required',
                Rule::unique('extras', 'name')
                    ->ignore($extraId)
            ],
            'price' => 'nullable|numeric|min:0',
        ];
    }
}
