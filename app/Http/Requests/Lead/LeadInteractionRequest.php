<?php

declare(strict_types=1);

namespace App\Http\Requests\Lead;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class LeadInteractionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'from_step' => 'required|integer|between:1,8',
            'to_step' => 'required|integer|between:1,8',
            'description' => 'sometimes|nullable|string|max:1000',
            'price' => 'sometimes|nullable|numeric|min:0|max:99999999.99',
            'return_date' => 'sometimes|nullable|date',
        ];
    }

    public function messages(): array
    {
        return [
            'from_step.required' => 'O step de origem é obrigatório',
            'from_step.integer' => 'O step de origem deve ser um número inteiro',
            'from_step.between' => 'O step de origem deve estar entre 1 e 8',
            'to_step.required' => 'O step de destino é obrigatório',
            'to_step.integer' => 'O step de destino deve ser um número inteiro',
            'to_step.between' => 'O step de destino deve estar entre 1 e 8',
            'description.string' => 'A descrição deve ser um texto',
            'description.max' => 'A descrição não pode ter mais de 1000 caracteres',
            'price.numeric' => 'O preço deve ser um número',
            'price.min' => 'O preço não pode ser negativo',
            'price.max' => 'O preço não pode ser maior que 99.999.999,99',
            'return_date.date' => 'A data de retorno deve ser uma data válida',
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