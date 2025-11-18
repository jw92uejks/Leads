<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WhatsAppAuthRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'ucode' => ['required', 'string', 'max:255']
        ];
    }

    public function messages(): array
    {
        return [
            'ucode.required' => 'O código do usuário é obrigatório',
            'ucode.string' => 'O código do usuário deve ser uma string válida',
            'ucode.max' => 'O código do usuário não pode ter mais de 255 caracteres'
        ];
    }
}

