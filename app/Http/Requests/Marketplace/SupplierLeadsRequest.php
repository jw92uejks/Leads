<?php

namespace App\Http\Requests\Marketplace;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class SupplierLeadsRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'search' => 'nullable|string|max:255',
            'lead_type' => 'nullable|in:1,2,3,4',
            'ddd' => 'nullable|string|max:2',
            'operadora' => 'nullable|string|max:100',
            'price_range' => 'nullable|string|in:0-200,200-500,500-1000,1000+',
            'date_range' => 'nullable|string|in:today,week,month,3months',
            'sort' => 'nullable|string|in:newest,oldest,price_asc,price_desc',
            'page' => 'nullable|integer|min:1',
        ];
    }

    public function messages(): array
    {
        return [
            'lead_type.in' => 'O tipo de lead deve ser Pessoa Física (1), Pessoa Jurídica (2), Adesão (3) ou Mista (4)',
            'ddd.max' => 'O DDD deve ter no máximo 2 dígitos',
            'operadora.max' => 'O nome da operadora deve ter no máximo 100 caracteres',
            'price_range.in' => 'Faixa de preço inválida',
            'date_range.in' => 'Período de data inválido',
            'sort.in' => 'Tipo de ordenação inválido',
            'page.integer' => 'Número da página deve ser um número inteiro',
            'page.min' => 'Número da página deve ser maior que zero',
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