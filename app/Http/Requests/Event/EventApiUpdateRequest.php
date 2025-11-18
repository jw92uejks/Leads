<?php

namespace App\Http\Requests\Event;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class EventApiUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
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
            'title.required' => 'Title is required',
            'title.max' => 'Title cannot be longer than 255 characters',
            'title.regex' => 'Title contains invalid characters',
            'description.max' => 'Description cannot be longer than 1000 characters',
            'description.regex' => 'Description contains invalid characters',
            'start_date.required' => 'Start date is required',
            'start_date.date' => 'Start date must be a valid date',
            'end_date.date' => 'End date must be a valid date',
            'end_date.after_or_equal' => 'End date must be equal to or after start date',
            'all_day.boolean' => 'All day must be a boolean value',
            'color.regex' => 'Color must be in hexadecimal format (#FFFFFF)',
            'status.in' => 'Status must be: scheduled, completed or cancelled',
            'type.in' => 'Type must be: appointment, meeting, reminder, task or personal',
            'location.max' => 'Location cannot be longer than 255 characters',
            'location.regex' => 'Location contains invalid characters',
            'attendees.array' => 'Attendees must be an array',
            'attendees.max' => 'Maximum 50 attendees allowed',
            'attendees.*.email' => 'Each attendee must have a valid email',
            'attendees.*.max' => 'Email cannot be longer than 254 characters',
            'metadata.array' => 'Metadata must be an object',
            'metadata.max' => 'Maximum 20 metadata fields allowed',
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
