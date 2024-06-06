<?php

namespace App\Http\Requests\Platform\Settings;

use App\Enums\Tenant\DistanceUnit;
use App\Enums\Tenant\DeliveryTypes;
use Illuminate\Foundation\Http\FormRequest;

class UpdateDeliverySettingRequest extends FormRequest
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
            'free_delivery' => 'boolean',
            'free_delivery_charge_type' => ['required', 'in:' . implode(',', DeliveryTypes::getAll())],
            'free_delivery_radius' => 'required_if:free_delivery_charge_type,' . DeliveryTypes::DISTANCE . '|numeric',
            'delivery_charge_type' => ['required', 'in:' . implode(',', DeliveryTypes::getAll())],
            'distance_unit' => ['required', 'in:' . implode(',', DistanceUnit::getAll())],
            'distance_based_radius' => 'required_if:delivery_charge_type,' . DeliveryTypes::DISTANCE . '|numeric',
            'delivery_charges' => 'required_if:delivery_charge_type,'.DeliveryTypes::FLAT.'|numeric',
            'range_based_charges' => 'nullable|array', // assuming it's an array
            'range_based_charges.*.start' => 'required_with:range_based_charges|numeric',
            'range_based_charges.*.end' => 'required_with:range_based_charges|numeric',
            'range_based_charges.*.charge' => 'required_with:range_based_charges|numeric',
        ];
    }
}
