<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LeadAutomationStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'lead_id' => ['required', 'integer', 'exists:leads,id'],
            'assist_status' => ['nullable', 'string', 'max:255'],
            'assist_substatus' => ['nullable', 'string', 'max:255'],
            'estimated_payment' => ['nullable', 'date'],
            'billetdue_date' => ['nullable', 'date'],
            'renewal_date' => ['required', 'date', 'after:today'],
            'selected_menu' => ['nullable', 'integer', 'min:1'],
            'current_state' => ['nullable', 'string', 'max:255'],
            'birthday' => ['nullable', 'date', 'before:today'],
            'wedding' => ['nullable', 'date', 'before_or_equal:today'],
            'company_niver' => ['nullable', 'date', 'before_or_equal:today'],
            'holidays' => ['nullable', 'string', 'max:255'],
            'important_updates' => ['nullable', 'string', 'max:255'],
            'active_days' => ['nullable', 'array'],
            'active_days.*' => ['string', 'in:monday,tuesday,wednesday,thursday,friday,saturday,sunday'],
            'periodic_contact' => ['nullable', 'date'],
        ];
    }

    public function messages(): array
    {
        return [
            'lead_id.required' => 'O ID do lead é obrigatório.',
            'lead_id.exists' => 'O lead informado não existe.',
            'renewal_date.required' => 'A data de renovação é obrigatória.',
            'renewal_date.after' => 'A data de renovação deve ser posterior a hoje.',
            'birthday.before' => 'A data de aniversário deve ser anterior a hoje.',
            'wedding.before_or_equal' => 'A data de casamento deve ser anterior ou igual a hoje.',
            'company_niver.before_or_equal' => 'A data de aniversário da empresa deve ser anterior ou igual a hoje.',
        ];
    }
}
