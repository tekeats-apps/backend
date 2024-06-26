<?php

namespace App\Http\Requests\Platform\Settings;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBusinessTimingRequest extends FormRequest
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
            'opening_hours' => 'required|array',
            'opening_hours.*.is_closed' => 'sometimes|boolean',
            'opening_hours.*.slots' => 'required|array',
            'opening_hours.*.slots.*.open_time' => 'required',
            'opening_hours.*.slots.*.close_time' => 'required|after_or_equal:opening_hours.*.slots.*.open_time',
        ];
    }

    public function messages(): array
    {
        return [
            'opening_hours.required' => 'Please, provide opening hours for your restaurant. Your customers need to know when you\'re open! 🕰️🍽️',
            'opening_hours.array' => 'The provided opening hours format seems incorrect. Please, provide it in the right format.',
            'opening_hours.*.slots.required' => 'Please, provide at least one opening time slot for each day.',
            'opening_hours.*.slots.array' => 'The provided time slots format seems incorrect. Please, provide it in the right format.',
            'opening_hours.*.slots.*.open_time.required' => 'Opening time is required for each day. Let your customers know when they can start ordering! 🌞',
            'opening_hours.*.slots.*.open_time.date_format' => 'The opening time provided seems to be in an incorrect format. It should be in 24-hour format like "13:00" for 1 PM.',
            'opening_hours.*.slots.*.close_time.required' => 'Closing time is required for each day. Let your customers know when they should finish their orders! 🌜',
            'opening_hours.*.slots.*.close_time.date_format' => 'The closing time provided seems to be in an incorrect format. It should be in 24-hour format like "22:00" for 10 PM.',
            'opening_hours.*.slots.*.close_time.after_or_equal' => 'The closing time should be later than or equal to the opening time. We can\'t close before we open, right? 😉',
        ];
    }
}
