<?php

namespace App\Http\Requests\Lead;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class LeadApiUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'sometimes|string|max:255',
            'corporateName' => 'sometimes|nullable|string|max:255',
            'phone' => 'sometimes|string|max:255',
            'email' => 'sometimes|email|max:255',
            'type' => 'sometimes|integer|in:1,2,3,4',
            'cpf' => 'sometimes|nullable|string|max:11',
            'cnpj' => 'sometimes|nullable|string|max:14',
            'city' => 'sometimes|string|max:255',
            'state' => 'sometimes|string|max:255',
            'status' => 'sometimes|nullable|string|max:255',
            'source' => 'sometimes|nullable|string|max:255',
            'traking' => 'sometimes|nullable|string|max:255',
            'code' => 'sometimes|nullable|string|max:255',
            'isAutomation' => 'sometimes|nullable|boolean',
            'lifes' => 'sometimes|nullable|integer|min:1',
            'acceptContestation' => 'sometimes|nullable|boolean',
            'temperature' => 'sometimes|nullable|string|in:hot,warm,cold',
            'description' => 'sometimes|nullable|string',
            'startPrice' => 'sometimes|nullable|numeric|min:0|max:99999999.99',
            'currentPrice' => 'sometimes|nullable|numeric|min:0|max:99999999.99',
            'negotiatedPrice' => 'sometimes|nullable|numeric|min:0|max:99999999.99',
            'pricingType' => 'sometimes|nullable|string|in:fixed,editable,automatic',
            'depreciationPercent' => 'sometimes|nullable|integer|min:0|max:100',
            'depreciationInterval' => 'sometimes|nullable|integer|min:1',
            'lead_expires_at' => 'sometimes|nullable|date',
            'acquired_at' => 'sometimes|nullable|date',
            'step' => 'sometimes|nullable|integer|min:1|max:8',
        ];
    }

    public function messages(): array
    {
        return [
            'name.string' => 'The name must be a string.',
            'phone.string' => 'The phone must be a string.',
            'email.email' => 'The email must be valid.',
            'type.integer' => 'The lead type must be an integer.',
            'type.in' => 'The lead type must be: 1 (PF), 2 (PJ), 3 (ADESAO) or 4 (MISTA).',
            'city.string' => 'The city must be a string.',
            'state.string' => 'The state must be a string.',
            'source.string' => 'The source must be a string.',
            'temperature.in' => 'The temperature must be: hot, warm or cold.',
            'startPrice.numeric' => 'The start price must be a number.',
            'startPrice.min' => 'The start price must be greater than zero.',
            'startPrice.max' => 'The start price cannot be greater than 99,999,999.99.',
            'currentPrice.numeric' => 'The current price must be a number.',
            'currentPrice.min' => 'The current price must be greater than zero.',
            'currentPrice.max' => 'The current price cannot be greater than 99,999,999.99.',
            'negotiatedPrice.numeric' => 'The negotiated price must be a number.',
            'negotiatedPrice.min' => 'The negotiated price must be greater than zero.',
            'negotiatedPrice.max' => 'The negotiated price cannot be greater than 99,999,999.99.',
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

        if (!empty($data)) {
            $this->merge($data);
        }
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json([
                'success' => false,
                'error' => 'Validation failed',
                'message' => 'The provided data is invalid',
                'details' => $validator->errors()
            ], 422)
        );
    }
}
