<?php

namespace App\Http\Requests\Lead;

use Illuminate\Foundation\Http\FormRequest;

class LeadStoreByPhoneRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'broker_phone' => 'required|string|regex:/^[0-9]+$/|min:9|max:15',
            'name' => 'required|string|max:255',
            'corporateName' => 'nullable|string|max:255',
            'phone' => 'required|string|regex:/^[0-9]+$/|min:9|max:15',
            'email' => 'required|email|max:255',
            'type' => 'required|integer|in:1,2,3,4',
            'cpf' => 'nullable|string|max:255',
            'cnpj' => 'nullable|string|max:255',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'source' => 'required|string|max:255',
            'traking' => 'nullable|string|max:255',
            'temperature' => 'required|string|in:fixed,editable,automatic',
            'startPrice' => 'required|numeric|min:0|max:99999999.99',
            'currentPrice' => 'nullable|numeric|min:0|max:99999999.99',
            'lifes' => 'nullable|integer|min:1',
            'description' => 'nullable|string',
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $type = $this->input('type');
            $cpf = $this->input('cpf');
            $cnpj = $this->input('cnpj');
            $corporateName = $this->input('corporateName');

            if ($type == 1 || $type == 3) {
                if (empty($cpf)) {
                    $validator->errors()->add('cpf', 'CPF é obrigatório para Pessoa Física e Adesão.');
                }
            }

            if ($type == 2) {
                if (empty($cnpj)) {
                    $validator->errors()->add('cnpj', 'CNPJ é obrigatório para Pessoa Jurídica.');
                }
                if (empty($corporateName)) {
                    $validator->errors()->add('corporateName', 'Razão Social é obrigatória para Pessoa Jurídica.');
                }
            }
        });
    }

    public function messages(): array
    {
        return [
            'broker_phone.required' => 'O telefone do corretor é obrigatório.',
            'broker_phone.regex' => 'O telefone do corretor deve conter apenas números (ex: 11999887766).',
            'broker_phone.min' => 'O telefone do corretor deve ter no mínimo 9 dígitos.',
            'broker_phone.max' => 'O telefone do corretor deve ter no máximo 15 dígitos (incluindo DDI).',
            'name.required' => 'O nome é obrigatório.',
            'phone.required' => 'O telefone é obrigatório.',
            'phone.regex' => 'O telefone deve conter apenas números (ex: 11999887766).',
            'phone.min' => 'O telefone deve ter no mínimo 9 dígitos.',
            'phone.max' => 'O telefone deve ter no máximo 15 dígitos (incluindo DDI).',
            'email.required' => 'O email deve ser válido.',
            'email.email' => 'O email deve ser válido.',
            'type.required' => 'O tipo de lead é obrigatório.',
            'type.in' => 'O tipo de lead deve ser válido.',
            'city.required' => 'A cidade é obrigatória.',
            'state.required' => 'O estado é obrigatório.',
            'source.required' => 'A fonte do lead é obrigatória.',
            'temperature.required' => 'A temperatura do lead é obrigatória.',
            'temperature.in' => 'A temperatura deve ser: fixed, editable ou automatic.',
            'startPrice.required' => 'O preço inicial é obrigatório.',
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
}
