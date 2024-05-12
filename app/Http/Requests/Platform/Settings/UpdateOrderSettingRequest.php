<?php

namespace App\Http\Requests\Platform\Settings;

use Illuminate\Foundation\Http\FormRequest;

class UpdateOrderSettingRequest extends FormRequest
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
            'dine_in' => 'boolean',
            'pickup' => 'boolean',
            'delivery' => 'boolean',
            'cash_on_delivery' => 'boolean',
            'orders_auto_accept' => 'boolean',
            'allow_special_instructions' => 'boolean',
            'allow_order_discounts' => 'boolean',
            'minimum_order' => 'nullable|numeric',
            'order_preparation_time' => 'nullable|string',
            'order_lead_time' => 'nullable|string',
            'order_cutoff_time' => 'nullable|string',
        ];
    }
}
