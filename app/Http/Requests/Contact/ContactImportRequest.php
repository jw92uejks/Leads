<?php

namespace App\Http\Requests\Contact;

use Illuminate\Foundation\Http\FormRequest;

class ContactImportRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'lead_ids' => 'sometimes|required|array',
            'lead_ids.*' => 'integer|exists:leads,id',
            'contacts' => 'sometimes|required|array',
            'contacts.*.name' => 'required|string|max:255',
            'contacts.*.email' => 'required|email|max:255',
            'contacts.*.phone' => 'nullable|string|regex:/^[0-9]+$/|min:9|max:15',
            'contacts.*.company' => 'nullable|string|max:255',
            'contacts.*.city' => 'nullable|string|max:100',
            'contacts.*.state' => 'nullable|string|max:100',
            'contacts.*.notes' => 'nullable|string|max:1000',
        ];
    }

    public function messages(): array
    {
        return [
            'lead_ids.required' => 'É necessário selecionar pelo menos um lead para importar',
            'lead_ids.array' => 'Os leads devem ser selecionados em formato de lista',
            'lead_ids.*.integer' => 'O ID do lead deve ser um número inteiro',
            'lead_ids.*.exists' => 'Um ou mais leads selecionados não existem',
            'contacts.required' => 'É necessário fornecer os dados dos contatos',
            'contacts.array' => 'Os contatos devem ser fornecidos em formato de lista',
            'contacts.*.name.required' => 'O nome é obrigatório para todos os contatos',
            'contacts.*.name.max' => 'O nome não pode ter mais de 255 caracteres',
            'contacts.*.email.required' => 'O e-mail é obrigatório para todos os contatos',
            'contacts.*.email.email' => 'O e-mail deve ser válido para todos os contatos',
            'contacts.*.email.max' => 'O e-mail não pode ter mais de 255 caracteres',
            'contacts.*.phone.max' => 'O telefone não pode ter mais de 20 caracteres',
            'contacts.*.company.max' => 'A empresa não pode ter mais de 255 caracteres',
            'contacts.*.city.max' => 'A cidade não pode ter mais de 100 caracteres',
            'contacts.*.state.max' => 'O estado não pode ter mais de 100 caracteres',
            'contacts.*.notes.max' => 'As observações não podem ter mais de 1000 caracteres',
        ];
    }
}
