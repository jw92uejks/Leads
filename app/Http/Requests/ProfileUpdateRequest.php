<?php

namespace App\Http\Requests;

use App\Enums\Lead\LeadType;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                Rule::unique(User::class)->ignore($this->user()->id),
            ],
            'phone' => ['required', 'string', 'regex:/^[0-9]+$/', 'min:9', 'max:15', Rule::unique(User::class)->ignore($this->user()->id)],
            'type' => ['nullable', 'integer', 'in:1,2,3'],
            'cpf' => ['nullable', 'string', 'regex:/^[\d.-]+$/', function ($attribute, $value, $fail) {
                if (empty($value)) {
                    return;
                }
                $cleanValue = preg_replace('/\D/', '', $value);
                if (strlen($cleanValue) > 0 && strlen($cleanValue) !== 11) {
                    $fail('O CPF deve ter exatamente 11 dígitos.');
                }
            }],
            'cnpj' => ['nullable', 'string', 'regex:/^[\d.-\/]+$/', function ($attribute, $value, $fail) {
                if (empty($value)) {
                    return;
                }
                $cleanValue = preg_replace('/\D/', '', $value);
                if (strlen($cleanValue) > 0 && strlen($cleanValue) !== 14) {
                    $fail('O CNPJ deve ter exatamente 14 dígitos.');
                }
            }],
            'ucode' => ['nullable', 'string', 'max:255'],
            'selected_menu' => ['nullable', 'integer', 'min:1', 'max:2147483647'],
            'current_state' => ['nullable', 'string', 'max:255'],
            'avatar' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
            'current_password' => ['nullable', 'required_with:password', 'current_password'],
            'password' => ['nullable', 'confirmed', 'min:8'],
            'password_confirmation' => ['nullable'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'O campo nome é obrigatório.',
            'name.max' => 'O nome não pode ter mais de 255 caracteres.',

            'email.required' => 'O campo email é obrigatório.',
            'email.email' => 'Por favor, insira um email válido.',
            'email.unique' => 'Este email já está sendo usado por outro usuário.',

            'phone.required' => 'O campo telefone é obrigatório.',
            'phone.regex' => 'O telefone deve conter apenas números.',
            'phone.min' => 'O telefone deve ter no mínimo 9 dígitos.',
            'phone.max' => 'O telefone deve ter no máximo 15 dígitos (incluindo DDI).',
            'phone.unique' => 'Este telefone já está sendo usado por outro usuário.',

            'type.integer' => 'O tipo de documento deve ser um valor válido.',
            'type.in' => 'O tipo de documento selecionado é inválido.',

            'cpf.regex' => 'O CPF deve conter apenas números, pontos e hífens.',
            'cnpj.regex' => 'O CNPJ deve conter apenas números, pontos, barras e hífens.',

            'avatar.image' => 'O arquivo deve ser uma imagem.',
            'avatar.mimes' => 'A imagem deve ser nos formatos: jpeg, png, jpg ou gif.',
            'avatar.max' => 'A imagem não pode ter mais de 2MB.',

            'current_password.required_with' => 'A senha atual é obrigatória ao alterar a senha.',
            'current_password.current_password' => 'A senha atual está incorreta.',

            'password.confirmed' => 'As senhas não coincidem.',
            'password.min' => 'A senha deve ter no mínimo 8 caracteres.',
        ];
    }

    public function attributes(): array
    {
        return [
            'name' => 'nome',
            'email' => 'email',
            'phone' => 'telefone',
            'type' => 'tipo de documento',
            'cpf' => 'CPF',
            'cnpj' => 'CNPJ',
            'avatar' => 'imagem',
            'current_password' => 'senha atual',
            'password' => 'nova senha',
        ];
    }

    protected function getRedirectUrl()
    {
        return route('profile.edit');
    }
}
