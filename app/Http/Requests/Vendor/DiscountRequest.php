<?php

namespace App\Http\Requests\Vendor;

use App\Enums\Vendor\DiscountType;
use Illuminate\Validation\Rules\Enum;
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
                    'type' => ['required', new Enum(DiscountType::class)],
                    'amount' => ['required', 'numeric', 'between:0,99999999.99'],
                    'active' => ['nullable'],
                    'categories' => ['nullable'],
                    'products' => ['nullable']
                ];
            case 'PUT':
                return [
                    'title' => ['required', 'string', 'max:191', 'unique:discounts,title,' . $this->id],
                    'description' => ['nullable', 'string', 'max:20000'],
                    'type' => ['required', new Enum(DiscountType::class)],
                    'amount' => ['required', 'numeric', 'between:0,99999999.99'],
                    'active' => ['nullable'],
                    'categories' => ['nullable'],
                    'products' => ['nullable']
                ];
        }
    }
}
