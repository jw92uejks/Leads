<?php

namespace App\Http\Requests\Auth;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class RegisterRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'phone' => ['required', 'string', 'regex:/^[0-9]+$/', 'min:9', 'max:15', 'unique:'.User::class],
            'toc' => ['accepted'],
            'password' => ['required', 'confirmed', Password::defaults()],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'O campo nome é obrigatório.',
            'name.max' => 'O nome não pode ter mais de 255 caracteres.',

            'email.required' => 'O campo email é obrigatório.',
            'email.email' => 'Por favor, insira um email válido.',
            'email.unique' => 'Este email já está cadastrado no sistema.',

            'phone.required' => 'O campo telefone é obrigatório.',
            'phone.regex' => 'O telefone deve conter apenas números.',
            'phone.min' => 'O telefone deve ter no mínimo 9 dígitos.',
            'phone.max' => 'O telefone deve ter no máximo 15 dígitos (incluindo DDI).',
            'phone.unique' => 'Este telefone já está cadastrado no sistema.',

            'toc.accepted' => 'Você deve aceitar os termos e condições.',

            'password.required' => 'O campo senha é obrigatório.',
            'password.confirmed' => 'As senhas não coincidem.',
        ];
    }

    public function attributes(): array
    {
        return [
            'name' => 'nome',
            'email' => 'email',
            'phone' => 'telefone',
            'toc' => 'termos e condições',
            'password' => 'senha',
        ];
    }
}
