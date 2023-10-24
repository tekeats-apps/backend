<?php

namespace App\Http\Requests\Vendor;

use App\Enums\Vendor\CouponAmountType;
use App\Enums\Vendor\CouponOption;
use App\Enums\Vendor\CouponType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class CouponRequest extends FormRequest
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
                    'coupon_code' => ['required', 'unique:coupons,coupon_code', 'max:191'],
                    'amount_type' => ['required', new Enum(CouponAmountType::class)],
                    'amount' => ['required', 'numeric', 'between:0,99999999.99'],
                    'start_date' => ['nullable', 'date'],
                    'expiry_date' => ['nullable', 'date', 'after_or_equal:today'],
                    'description' => ['nullable', 'string', 'max:20000'],
                    'allowed_time' => ['required_without:is_unlimited'],
                    'is_unlimited' => ['required_without:allowed_time'],
                    'active' => ['nullable']
                ];
            case 'PUT':
                return [
                    'coupon_code' => ['required', 'unique:coupons,coupon_code,' . $this->id, 'max:191'],
                    'amount_type' => ['required', new Enum(CouponAmountType::class)],
                    'amount' => ['required', 'numeric', 'between:0,99999999.99'],
                    'start_date' => ['nullable', 'date'],
                    'expiry_date' => ['nullable', 'date', 'after_or_equal:today'],
                    'description' => ['nullable', 'string', 'max:20000'],
                    'allowed_time' => ['required_without:is_unlimited'],
                    'is_unlimited' => ['required_without:allowed_time'],
                    'active' => ['nullable']
                ];
        }
    }

    public function messages(): array
    {
        return [
            'expiry_date.after_or_equal' => 'The :attribute cannot be a past date.'
        ];
    }
}
