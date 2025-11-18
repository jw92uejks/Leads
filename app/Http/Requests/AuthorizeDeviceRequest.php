<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AuthorizeDeviceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'current_password' => ['required', 'string', 'current_password'],
            'device_fingerprint' => ['required', 'string', 'min:32'],
        ];
    }

    public function messages(): array
    {
        return [
            'current_password.required' => 'A senha atual é obrigatória.',
            'current_password.current_password' => 'A senha está incorreta.',
            'device_fingerprint.required' => 'Identificador do dispositivo é obrigatório.',
            'device_fingerprint.min' => 'Identificador do dispositivo inválido.',
        ];
    }
}

