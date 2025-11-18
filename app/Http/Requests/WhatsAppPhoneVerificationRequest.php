<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WhatsAppPhoneVerificationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'phone' => [
                'required',
                'string',
            ],
            'password' => [
                'required',
                'string',
            ],
            'device_fingerprint' => [
                'nullable',
                'string',
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'phone.required' => 'O número de telefone é obrigatório.',
            'password.required' => 'A senha é obrigatória.',
            'device_fingerprint.required' => 'Identificação do dispositivo é obrigatória.',
            'device_fingerprint.min' => 'Identificação do dispositivo inválida.',
        ];
    }
}


