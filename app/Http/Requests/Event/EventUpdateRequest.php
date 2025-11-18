<?php

namespace App\Http\Requests\Event;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class EventUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255', 'regex:/^[\p{L}\p{N}\s\-\.,:;!?()]+$/u'],
            'description' => ['nullable', 'string', 'max:1000', 'regex:/^[\p{L}\p{N}\s\-\.,:;!?()\n\r]+$/u'],
            'start_date' => ['required', 'date'],
            'end_date' => ['nullable', 'date', 'after_or_equal:start_date'],
            'all_day' => ['boolean'],
            'color' => ['nullable', 'string', 'regex:/^#[0-9A-Fa-f]{6}$/'],
            'status' => ['nullable', 'string', 'in:scheduled,completed,cancelled'],
            'type' => ['nullable', 'string', 'in:appointment,meeting,reminder,task,personal'],
            'location' => ['nullable', 'string', 'max:255', 'regex:/^[\p{L}\p{N}\s\-\.,:;!?()]+$/u'],
            'attendees' => ['nullable', 'array', 'max:50'],
            'attendees.*' => ['string', 'email', 'max:254'],
            'metadata' => ['nullable', 'array', 'max:20'],
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'O título é obrigatório.',
            'title.max' => 'O título não pode ter mais de 255 caracteres.',
            'start_date.required' => 'A data de início é obrigatória.',
            'start_date.date' => 'A data de início deve ser uma data válida.',
            'end_date.date' => 'A data de fim deve ser uma data válida.',
            'end_date.after_or_equal' => 'A data de fim deve ser igual ou posterior à data de início.',
            'color.regex' => 'A cor deve estar no formato hexadecimal (#FFFFFF).',
            'status.in' => 'O status deve ser: scheduled, completed ou cancelled.',
            'type.in' => 'O tipo deve ser: appointment, meeting, reminder, task ou personal.',
            'location.max' => 'A localização não pode ter mais de 255 caracteres.',
            'attendees.array' => 'Os participantes devem ser uma lista.',
            'attendees.*.email' => 'Cada participante deve ter um email válido.',
            'metadata.array' => 'Os metadados devem ser um objeto.',
        ];
    }

    protected function prepareForValidation(): void
    {
        if ($this->has('all_day')) {
            $this->merge([
                'all_day' => filter_var($this->all_day, FILTER_VALIDATE_BOOLEAN),
            ]);
        }
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
