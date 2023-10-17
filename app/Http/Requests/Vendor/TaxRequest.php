<?php

namespace App\Http\Requests\Vendor;

use App\Enums\Vendor\Tax\TypeEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TaxRequest extends FormRequest
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
                    'title' => ['required', 'string', 'max:191', 'unique:taxes,title'],
                    'description' => ['nullable', 'string', 'max:20000'],
                    'type' => ['required', Rule::in(TypeEnum::values())],
                    'amount' => ['required', 'numeric', 'between:0,99999999.99'],
                    'active' => ['nullable']
                ];
            case 'PUT':
                // dd($this->active);
                return [
                    'title' => ['required', 'string', 'max:191', 'unique:taxes,title,' . $this->id],
                    'description' => ['nullable', 'string', 'max:20000'],
                    'type' => ['required', Rule::in(TypeEnum::values())],
                    'amount' => ['required', 'numeric', 'between:0,99999999.99'],
                    'active' => ['nullable']
                ];
        }
    }
}
