<?php

namespace App\Http\Requests\Broker;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateSubscriptionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'subscription_id' => 'required|integer|exists:subscriptions,id',
        ];
    }

    public function messages(): array
    {
        return [
            'subscription_id.required' => 'O ID da assinatura é obrigatório.',
            'subscription_id.integer' => 'O ID da assinatura deve ser um número inteiro.',
            'subscription_id.exists' => 'A assinatura selecionada não existe.',
        ];
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


