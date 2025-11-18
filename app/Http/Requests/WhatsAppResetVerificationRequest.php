<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WhatsAppResetVerificationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'current_password' => ['required', 'string', 'current_password'],
            'confirm' => ['required', 'accepted'],
        ];
    }

    public function messages(): array
    {
        return [
            'current_password.required' => 'A senha atual é obrigatória.',
            'current_password.current_password' => 'A senha está incorreta.',
            'confirm.required' => 'Você precisa confirmar a ação.',
            'confirm.accepted' => 'Você precisa confirmar a ação.',
        ];
    }
}

