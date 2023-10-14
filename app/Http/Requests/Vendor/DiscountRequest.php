<?php

namespace App\Http\Requests\Vendor;

use Illuminate\Validation\Rule;
use App\Enums\Vendor\DiscountTypeEnum;
use Illuminate\Foundation\Http\FormRequest;

class DiscountRequest extends FormRequest
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
                    'title' => ['required', 'string', 'max:191', 'unique:discounts,title'],
                    'description' => ['nullable', 'string', 'max:20000'],
                    'type' => ['required', Rule::in(DiscountTypeEnum::values())],
                    'amount' => ['required', 'numeric', 'between:0,99999999.99'],
                    'active' => ['nullable']
                ];
            case 'PUT':
                return [
                    'title' => ['required', 'string', 'max:191', 'unique:discounts,title,' . $this->id],
                    'description' => ['nullable', 'string', 'max:20000'],
                    'type' => ['required', Rule::in(DiscountTypeEnum::values())],
                    'amount' => ['required', 'numeric', 'between:0,99999999.99'],
                    'active' => ['nullable']
                ];
        }
    }
}
