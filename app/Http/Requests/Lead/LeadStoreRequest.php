<?php

namespace App\Http\Requests\Lead;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class LeadStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'nullable|string|max:255',
            'corporateName' => 'nullable|string|max:255',
            'phone' => 'nullable|string|regex:/^[0-9]+$/|min:9|max:15',
            'email' => 'nullable|email|max:255',
            'type' => 'nullable|integer|in:1,2,3,4',
            'cpf' => 'nullable|string|max:255',
            'cnpj' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
            'state' => 'nullable|string|max:255',
            'source' => 'nullable|string|in:fixed,editable,automatic',
            'temperature' => 'nullable|string|in:hot,warm,cold',
            'traking' => 'nullable|string|max:255',
            'startPrice' => 'nullable|numeric|min:0|max:99999999.99',
            'currentPrice' => 'nullable|numeric|min:0|max:99999999.99',
            'lifes' => 'nullable|integer|min:1',
            'description' => 'nullable|string',
            'dono_id' => 'nullable|integer|min:1',
            'dono_type' => ['nullable', Rule::in(['App\\Models\\Broker', 'App\\Models\\Supplier'])],
            'responsavel_id' => 'nullable|integer|exists:brokers,id',
        ];
    }



    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'email.email' => 'O email deve ser válido.',
            'type.in' => 'O tipo de lead deve ser válido.',
            'temperature.in' => 'A temperatura deve ser: fixed, editable ou automatic.',
            'startPrice.numeric' => 'O preço inicial deve ser um número.',
            'startPrice.min' => 'O preço inicial deve ser maior que zero.',
            'startPrice.max' => 'O preço inicial não pode ser maior que 99.999.999,99.',
            'currentPrice.numeric' => 'O preço atual deve ser um número.',
            'currentPrice.min' => 'O preço atual deve ser maior que zero.',
            'currentPrice.max' => 'O preço atual não pode ser maior que 99.999.999,99.',
            'lifes.integer' => 'O número de vidas deve ser um número inteiro.',
            'lifes.min' => 'O número de vidas deve ser maior que zero.',
        ];
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
