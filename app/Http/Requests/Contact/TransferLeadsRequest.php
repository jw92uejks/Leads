<?php

namespace App\Http\Requests\Contact;

use Illuminate\Foundation\Http\FormRequest;

class TransferLeadsRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'lead_ids' => 'required|array|min:1|max:50',
            'lead_ids.*' => 'required|integer|exists:leads,id',
            'reason' => 'nullable|string|max:255'
        ];
    }

    public function messages(): array
    {
        return [
            'lead_ids.required' => 'É necessário informar pelo menos um lead para transferir',
            'lead_ids.array' => 'Os IDs dos leads devem ser enviados como um array',
            'lead_ids.min' => 'É necessário informar pelo menos um lead para transferir',
            'lead_ids.max' => 'Não é possível transferir mais de 50 leads por vez',

            'lead_ids.*.required' => 'Todos os IDs de leads são obrigatórios',
            'lead_ids.*.integer' => 'Os IDs dos leads devem ser números válidos',
            'lead_ids.*.exists' => 'Um ou mais leads não foram encontrados',

            'reason.string' => 'O motivo deve ser um texto válido',
            'reason.max' => 'O motivo não pode ter mais de 255 caracteres'
        ];
    }

    protected function prepareForValidation(): void
    {
        if ($this->has('reason') && empty($this->reason)) {
            $this->merge(['reason' => 'Transferido via API']);
        }

        if ($this->has('lead_ids') && is_string($this->lead_ids)) {
            $leadIds = explode(',', $this->lead_ids);
            $leadIds = array_map('intval', array_filter($leadIds));
            $this->merge(['lead_ids' => $leadIds]);
        }
    }

    public function withValidator($validator): void
    {
        $validator->after(function ($validator) {
            $user = $this->user();

            if (!$user) {
                $validator->errors()->add('auth', 'Usuário não autenticado');
                return;
            }

            if (!$user->broker && !$user->supplier) {
                $validator->errors()->add('permission', 'Usuário não possui permissão para transferir leads');
                return;
            }

            $leadIds = $this->input('lead_ids', []);

            if (empty($leadIds)) {
                return;
            }

            $leads = \App\Models\Lead::whereIn('id', $leadIds)->get();

            foreach ($leads as $lead) {
                if (!$this->canTransferLead($lead, $user)) {
                    $validator->errors()->add(
                        "lead_ids.{$lead->id}",
                        "Você não tem permissão para transferir o lead {$lead->code}"
                    );
                }
            }
        });
    }

    private function canTransferLead(\App\Models\Lead $lead, \App\Models\User $user): bool
    {
        if ($user->broker) {
            return $lead->broker_id === $user->broker->id ||
                   $lead->responsible_id === $user->broker->id;
        }

        if ($user->supplier) {
            return $lead->supplier_id === $user->supplier->id;
        }

        return false;
    }
}
