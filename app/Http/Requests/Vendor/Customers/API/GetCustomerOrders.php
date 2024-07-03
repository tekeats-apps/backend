<?php

namespace App\Http\Requests\Vendor\Customers\API;

use Illuminate\Validation\Rule;
use App\Enums\Vendor\Orders\OrderStatus;
use Illuminate\Foundation\Http\FormRequest;

class GetCustomerOrders extends FormRequest
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
        // Extracting the string values of the enum cases
        $enumValues = array_map(fn($case) => $case->value, OrderStatus::cases());
        return [
            'status' => [
                'nullable',
                Rule::in(array_merge(['active'], $enumValues))
            ],
            'limit' => 'nullable|integer',
            'page' => 'nullable|integer',
        ];
    }
}
