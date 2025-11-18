<?php

namespace App\Http\Requests\Lead;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class LeadApiStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'supplier_id' => 'nullable|integer|exists:suppliers,id',
            'name' => 'nullable|string|max:255',
            'corporateName' => 'nullable|string|max:255',
            'phone' => 'nullable|string|regex:/^[0-9]+$/|min:9|max:15',
            'email' => 'nullable|email|max:255',
            'type' => 'nullable|integer|in:1,2,3,4',
            'cpf' => 'nullable|string|max:11',
            'cnpj' => 'nullable|string|max:14',
            'city' => 'nullable|string|max:255',
            'state' => 'nullable|string|max:255',
            'status' => 'nullable|string|max:255',
            'source' => 'nullable|string|max:255',
            'traking' => 'nullable|string|max:255',
            'code' => 'nullable|string|max:255',
            'isAutomation' => 'nullable|boolean',
            'lifes' => 'nullable|integer|min:1',
            'acceptContestation' => 'nullable|boolean',
            'temperature' => 'nullable|string|in:hot,warm,cold',
            'description' => 'nullable|string',
            'startPrice' => 'nullable|numeric|min:0|max:99999999.99',
            'currentPrice' => 'nullable|numeric|min:0|max:99999999.99',
            'negotiatedPrice' => 'nullable|numeric|min:0|max:99999999.99',
            'pricingType' => 'nullable|string|in:fixed,editable,automatic',
            'depreciationPercent' => 'nullable|integer|min:0|max:100',
            'depreciationInterval' => 'nullable|integer|min:1',
            'lead_expires_at' => 'nullable|date',
            'acquired_at' => 'nullable|date',
            'step' => 'nullable|integer|min:1|max:8',
            'owner_id' => 'nullable|integer|min:1',
            'owner_type' => ['nullable', Rule::in(['App\\Models\\Broker', 'App\\Models\\Supplier'])],
            'responsible_id' => 'nullable|integer|exists:brokers,id',
        ];
    }

    public function messages(): array
    {
        return [
            'email.email' => 'The email must be valid.',
            'type.integer' => 'The lead type must be an integer.',
            'type.in' => 'The lead type must be: 1 (PF), 2 (PJ), 3 (ADESAO) or 4 (MISTA).',
            'cpf.max' => 'The CPF must have a maximum of 11 digits.',
            'cnpj.max' => 'The CNPJ must have a maximum of 14 digits.',
            'temperature.in' => 'The temperature must be: hot, warm or cold.',
            'startPrice.numeric' => 'The start price must be a number.',
            'startPrice.min' => 'The start price must be greater than zero.',
            'startPrice.max' => 'The start price cannot be greater than 99,999,999.99.',
            'currentPrice.numeric' => 'The current price must be a number.',
            'currentPrice.min' => 'The current price must be greater than zero.',
            'currentPrice.max' => 'The current price cannot be greater than 99,999,999.99.',
            'lifes.integer' => 'The number of lives must be an integer.',
            'lifes.min' => 'The number of lives must be greater than zero.',
            'depreciationPercent.integer' => 'The depreciation percentage must be an integer.',
            'depreciationPercent.min' => 'The depreciation percentage must be greater than or equal to zero.',
            'depreciationPercent.max' => 'The depreciation percentage cannot be greater than 100.',
            'depreciationInterval.integer' => 'The depreciation interval must be an integer.',
            'depreciationInterval.min' => 'The depreciation interval must be greater than zero.',
            'step.integer' => 'The step must be an integer.',
            'step.min' => 'The step must be greater than zero.',
            'step.max' => 'The step cannot be greater than 8.',
            'lead_expires_at.date' => 'The expiration date must be a valid date.',
            'acquired_at.date' => 'The acquisition date must be a valid date.',
        ];
    }

    protected function prepareForValidation(): void
    {
        $data = [];

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

        if ($this->has('supplier_id') && is_string($this->supplier_id) && is_numeric($this->supplier_id)) {
            $data['supplier_id'] = (int) $this->supplier_id;
        }

        if ($this->has('owner_id') && is_string($this->owner_id) && is_numeric($this->owner_id)) {
            $data['owner_id'] = (int) $this->owner_id;
        }

        if ($this->has('responsible_id') && is_string($this->responsible_id) && is_numeric($this->responsible_id)) {
            $data['responsible_id'] = (int) $this->responsible_id;
        }

        if (!empty($data)) {
            $this->merge($data);
        }
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success' => false,
            'message' => 'Validation errors',
            'data' => $validator->errors()
        ], 422));
    }
}
