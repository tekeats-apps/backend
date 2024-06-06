<?php

namespace App\Http\Requests\Vendor\Orders;

use Illuminate\Validation\Rules\Enum;
use App\Enums\Vendor\Orders\OrderType;
use Illuminate\Foundation\Http\FormRequest;
use App\Enums\Vendor\Orders\OrderPaymentMethod;

class PlaceOrderRequest extends FormRequest
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
        return [
            'payment_method' => ['required', new Enum(OrderPaymentMethod::class)],
            'order_type' => ['required', new Enum(OrderType::class)],
            'coupon_code' => 'nullable|string|exists:coupons,code',
            'notes' => 'nullable|string',

            'address_id' => 'nullable|required_if:order_type,delivery|exists:addresses,id',

            // For order items
            'items' => 'required|array',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.variant_id' => 'nullable|exists:variants,id',
            'items.*.extras' => 'nullable|array',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.special_instructions' => 'nullable|string',
        ];
    }
}
