<?php

namespace App\Http\Requests\Lead;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class LeadUpdateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'supplier_id' => [
                'nullable',
                'integer'
            ],
            'name' => [
                'nullable',
                'string'
            ],
            'email' => [
                'nullable',
                'email'
            ],
            'phone' => [
                'nullable',
                'string',
                'regex:/^[0-9]+$/',
                'min:9',
                'max:15'
            ],
            'city' => [
                'nullable',
                'string'
            ],
            'source' => [
                'nullable',
                'string'
            ],
            'traking' => [
                'nullable',
                'string'
            ],
            'state' => [
                'nullable',
                'string'
            ],
            'status' => [
                'nullable',
                'in:'
            ],
            'credits' => [
                'nullable',
                'integer'
            ],
            'isAutomation' => [
                'nullable',
                'boolean'
            ],
            'rating' => [
                'nullable',
                'integer'
            ],
            'leadCode' => [
                'nullable',
                'string'
            ],
            'negotiation' => [
                'nullable',
                'decimal:0,9999'
            ],
            'corporateName' => [
                'nullable',
                'string'
            ],
            'typeLead' => [
                'nullable',
                'in:'
            ],
            'lifes' => [
                'nullable',
                'integer'
            ],
            'description' => [
                'nullable',
                'string'
            ],
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
