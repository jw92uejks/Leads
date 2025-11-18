<?php

namespace App\Http\Requests\Contact;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ContactApiUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $contactId = $this->route('contact') ?? $this->route('id');

        return [
            'name' => 'sometimes|required|string|max:255',
            'corporateName' => 'nullable|string|max:255',
            'email' => [
                'sometimes',
                'required',
                'email',
                'max:255',
                Rule::unique('contacts', 'email')->ignore($contactId)->where(function ($query) {
                    $user = auth()->user();

                    if (!$user) {
                        return $query;
                    }

                    if (isset($user->broker) && $user->broker) {
                        return $query->where('broker_id', $user->broker->id);
                    }

                    if (isset($user->supplier) && $user->supplier) {
                        return $query->where('supplier_id', $user->supplier->id);
                    }

                    return $query;
                })
            ],
            'phone' => 'nullable|string|regex:/^[0-9]+$/|min:9|max:15',
            'cpf' => 'nullable|string|max:14',
            'cnpj' => 'nullable|string|max:18',
            'city' => 'nullable|string|max:100',
            'state' => 'nullable|string|max:2',
            'company' => 'nullable|string|max:255',
            'type' => 'nullable|integer|in:1,2,3,4',
            'status' => 'nullable|string|in:active,inactive',
            'source' => 'nullable|string|in:manual,import,lead_funnel,api',
            'temperature' => 'nullable|string|in:hot,warm,cold',
            'step' => 'nullable|integer|min:1|max:8',
            'lifes' => 'nullable|integer|min:0|max:50',
            'isAutomation' => 'nullable|boolean',
            'acceptContestation' => 'nullable|boolean',
            'description' => 'nullable|string|max:1000',
            'startPrice' => 'nullable|numeric|min:0|max:999999.99',
            'currentPrice' => 'nullable|numeric|min:0|max:999999.99',
            'pricingType' => 'nullable|string|in:fixed,editable,automatic',
            'depreciationPercent' => 'nullable|integer|min:0|max:100',
            'depreciationInterval' => 'nullable|integer|min:1|max:365',
            'lead_expires_at' => 'nullable|date|after:now',
            'acquired_at' => 'nullable|date|before_or_equal:now',
            'notes' => 'nullable|string|max:2000',
            'responsible_id' => 'nullable|integer|exists:brokers,id',
            'health_operator_id' => 'nullable|integer|exists:health_operators,id',
            'last_contact_at' => 'nullable|date|before_or_equal:now',
            'conversion_reason' => 'nullable|string|max:255'
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'O nome é obrigatório',
            'name.string' => 'O nome deve ser um texto válido',
            'name.max' => 'O nome não pode ter mais de 255 caracteres',

            'email.required' => 'O email é obrigatório',
            'email.email' => 'O email deve ter um formato válido',
            'email.max' => 'O email não pode ter mais de 255 caracteres',
            'email.unique' => 'Este email já está sendo usado por outro contato',

            'phone.string' => 'O telefone deve ser um texto válido',
            'phone.max' => 'O telefone não pode ter mais de 20 caracteres',

            'cpf.string' => 'O CPF deve ser um texto válido',
            'cpf.max' => 'O CPF não pode ter mais de 14 caracteres',

            'cnpj.string' => 'O CNPJ deve ser um texto válido',
            'cnpj.max' => 'O CNPJ não pode ter mais de 18 caracteres',

            'city.string' => 'A cidade deve ser um texto válido',
            'city.max' => 'A cidade não pode ter mais de 100 caracteres',

            'state.string' => 'O estado deve ser um texto válido',
            'state.max' => 'O estado deve ter no máximo 2 caracteres',

            'type.integer' => 'O tipo deve ser um número válido',
            'type.in' => 'O tipo deve ser: 1 (PF), 2 (PJ), 3 (Adesão) ou 4 (Outro)',

            'status.in' => 'O status deve ser: active ou inactive',

            'source.in' => 'A origem deve ser: manual, import, lead_funnel ou api',

            'temperature.in' => 'A temperatura deve ser: hot, warm ou cold',

            'step.integer' => 'A etapa deve ser um número válido',
            'step.min' => 'A etapa deve ser no mínimo 1',
            'step.max' => 'A etapa deve ser no máximo 8',

            'lifes.integer' => 'O número de vidas deve ser um número válido',
            'lifes.min' => 'O número de vidas deve ser no mínimo 0',
            'lifes.max' => 'O número de vidas deve ser no máximo 50',

            'isAutomation.boolean' => 'O campo automação deve ser verdadeiro ou falso',
            'acceptContestation.boolean' => 'O campo aceita contestação deve ser verdadeiro ou falso',

            'description.string' => 'A descrição deve ser um texto válido',
            'description.max' => 'A descrição não pode ter mais de 1000 caracteres',

            'startPrice.numeric' => 'O preço inicial deve ser um número válido',
            'startPrice.min' => 'O preço inicial deve ser no mínimo 0',
            'startPrice.max' => 'O preço inicial deve ser no máximo 999999.99',

            'currentPrice.numeric' => 'O preço atual deve ser um número válido',
            'currentPrice.min' => 'O preço atual deve ser no mínimo 0',
            'currentPrice.max' => 'O preço atual deve ser no máximo 999999.99',

            'pricingType.in' => 'O tipo de preço deve ser: fixed, editable ou automatic',

            'depreciationPercent.integer' => 'A porcentagem de depreciação deve ser um número válido',
            'depreciationPercent.min' => 'A porcentagem de depreciação deve ser no mínimo 0',
            'depreciationPercent.max' => 'A porcentagem de depreciação deve ser no máximo 100',

            'depreciationInterval.integer' => 'O intervalo de depreciação deve ser um número válido',
            'depreciationInterval.min' => 'O intervalo de depreciação deve ser no mínimo 1 dia',
            'depreciationInterval.max' => 'O intervalo de depreciação deve ser no máximo 365 dias',

            'lead_expires_at.date' => 'A data de expiração deve ser uma data válida',
            'lead_expires_at.after' => 'A data de expiração deve ser no futuro',

            'acquired_at.date' => 'A data de aquisição deve ser uma data válida',
            'acquired_at.before_or_equal' => 'A data de aquisição não pode ser no futuro',

            'notes.string' => 'As notas devem ser um texto válido',
            'notes.max' => 'As notas não podem ter mais de 2000 caracteres',

            'responsible_id.integer' => 'O ID do responsável deve ser um número válido',
            'responsible_id.exists' => 'O responsável selecionado não existe',

            'health_operator_id.integer' => 'O ID da operadora deve ser um número válido',
            'health_operator_id.exists' => 'A operadora selecionada não existe',

            'last_contact_at.date' => 'A data do último contato deve ser uma data válida',
            'last_contact_at.before_or_equal' => 'A data do último contato não pode ser no futuro',

            'conversion_reason.string' => 'O motivo da conversão deve ser um texto válido',
            'conversion_reason.max' => 'O motivo da conversão não pode ter mais de 255 caracteres'
        ];
    }

    protected function prepareForValidation(): void
    {
        $data = [];

        if ($this->has('currentPrice') && empty($this->currentPrice) && !empty($this->startPrice)) {
            $data['currentPrice'] = $this->startPrice;
        }

        if ($this->has('type') && is_string($this->type) && is_numeric($this->type)) {
            $data['type'] = (int) $this->type;
        }

        if ($this->has('step') && is_string($this->step) && is_numeric($this->step)) {
            $data['step'] = (int) $this->step;
        }

        if ($this->has('lifes') && is_string($this->lifes) && is_numeric($this->lifes)) {
            $data['lifes'] = (int) $this->lifes;
        }

        if ($this->has('depreciationPercent') && is_string($this->depreciationPercent) && is_numeric($this->depreciationPercent)) {
            $data['depreciationPercent'] = (int) $this->depreciationPercent;
        }

        if ($this->has('depreciationInterval') && is_string($this->depreciationInterval) && is_numeric($this->depreciationInterval)) {
            $data['depreciationInterval'] = (int) $this->depreciationInterval;
        }

        if ($this->has('responsible_id') && is_string($this->responsible_id) && is_numeric($this->responsible_id)) {
            $data['responsible_id'] = (int) $this->responsible_id;
        }

        if ($this->has('health_operator_id') && is_string($this->health_operator_id) && is_numeric($this->health_operator_id)) {
            $data['health_operator_id'] = (int) $this->health_operator_id;
        }

        if (!empty($data)) {
            $this->merge($data);
        }
    }
}
