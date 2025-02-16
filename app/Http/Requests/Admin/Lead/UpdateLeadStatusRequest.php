<?php

namespace App\Http\Requests\Admin\Lead;

use App\Enums\LeadStatus;
use Illuminate\Validation\Rules\Enum;
use Illuminate\Foundation\Http\FormRequest;

class UpdateLeadStatusRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'lead_id' => ['required', 'integer'],
            'status' => ['required', new Enum(LeadStatus::class)],
            'reason' => ['nullable', 'string']
        ];
    }
}
