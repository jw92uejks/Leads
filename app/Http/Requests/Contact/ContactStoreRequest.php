<?php

namespace App\Http\Requests\Contact;

use Illuminate\Foundation\Http\FormRequest;

class ContactStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'name' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|regex:/^[0-9]+$/|min:9|max:15',
            'company' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:100',
            'state' => 'nullable|string|max:100',
            'cpf' => 'nullable|string|max:14',
            'cnpj' => 'nullable|string|max:18',
            'type' => 'nullable|integer|in:1,2,3',
            'lifes' => 'nullable|integer|min:0',
            'temperature' => 'nullable|string|in:hot,warm,cold',
            'startPrice' => 'nullable|numeric|min:0',
            'currentPrice' => 'nullable|numeric|min:0',
            'pricingType' => 'nullable|string|in:fixed,monthly,annual',
            'depreciationPercent' => 'nullable|integer|min:0|max:100',
            'depreciationInterval' => 'nullable|integer|min:0',
            'lead_expires_at' => 'nullable|date|after:today',
            'acquired_at' => 'nullable|date|before_or_equal:today',
            'description' => 'nullable|string|max:65535',
            'notes' => 'nullable|string|max:1000',
            'isAutomation' => 'nullable|boolean',
            'acceptContestation' => 'nullable|boolean',
        ];
    }

    public function messages(): array
    {
        return [
            'name.max' => 'O nome não pode ter mais de 255 caracteres',
            'email.email' => 'O e-mail deve ser válido',
            'email.max' => 'O e-mail não pode ter mais de 255 caracteres',
            'phone.max' => 'O telefone não pode ter mais de 20 caracteres',
            'company.max' => 'A empresa não pode ter mais de 255 caracteres',
            'city.max' => 'A cidade não pode ter mais de 100 caracteres',
            'state.max' => 'O estado não pode ter mais de 100 caracteres',
            'cpf.max' => 'O CPF não pode ter mais de 14 caracteres',
            'cnpj.max' => 'O CNPJ não pode ter mais de 18 caracteres',
            'type.in' => 'O tipo de cadastro deve ser válido',
            'lifes.integer' => 'A quantidade de vidas deve ser um número inteiro',
            'lifes.min' => 'A quantidade de vidas não pode ser negativa',
            'temperature.in' => 'A temperatura do lead deve ser válida',
            'startPrice.numeric' => 'O preço inicial deve ser um número',
            'startPrice.min' => 'O preço inicial não pode ser negativo',
            'currentPrice.numeric' => 'O preço atual deve ser um número',
            'currentPrice.min' => 'O preço atual não pode ser negativo',
            'pricingType.in' => 'O tipo de precificação deve ser válido',
            'depreciationPercent.integer' => 'O percentual de depreciação deve ser um número inteiro',
            'depreciationPercent.min' => 'O percentual de depreciação não pode ser negativo',
            'depreciationPercent.max' => 'O percentual de depreciação não pode ser maior que 100',
            'depreciationInterval.integer' => 'O intervalo de depreciação deve ser um número inteiro',
            'depreciationInterval.min' => 'O intervalo de depreciação não pode ser negativo',
            'lead_expires_at.date' => 'A data de expiração deve ser válida',
            'lead_expires_at.after' => 'A data de expiração deve ser posterior a hoje',
            'acquired_at.date' => 'A data de aquisição deve ser válida',
            'acquired_at.before_or_equal' => 'A data de aquisição não pode ser posterior a hoje',
            'description.max' => 'A descrição não pode ter mais de 65535 caracteres',
            'notes.max' => 'As observações não podem ter mais de 1000 caracteres',
        ];
    }
}
