<?php

namespace App\Services;

use App\Interfaces\ContactRepositoryInterface;
use App\Models\Contact;
use App\Models\Lead;
use App\Enums\Lead\LeadStatus;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

use App\Models\User;
use App\Enums\Lead\LeadType;

class ContactService
{
    public function __construct(
        private readonly ContactRepositoryInterface $contactRepository
    ) {}

    public function getContacts(array $filters = [], int $perPage = 10): LengthAwarePaginator
    {
        $user = auth()->user();

        if ($user->broker) {
            return $this->contactRepository::getByBroker($user->broker->id, $filters, $perPage);
        }

        if ($user->supplier) {
            return $this->contactRepository::getBySupplier($user->supplier->id, $filters, $perPage);
        }

        throw new \Exception('Usuário não possui permissão para acessar contatos');
    }

    public function createContact(array $data): Contact
    {
        $user = auth()->user();

        if ($user->broker) {
            $data['broker_id'] = $user->broker->id;
        } elseif ($user->supplier) {
            $data['supplier_id'] = $user->supplier->id;
        } else {
            throw new \Exception('Usuário não possui permissão para criar contatos');
        }

        $data['source'] = 'manual';
        $data['status'] = 'active';
        $data['code'] = 'CONT' . str_pad(Contact::count() + 1, 3, '0', STR_PAD_LEFT);

        if (isset($data['isAutomation'])) {
            $data['isAutomation'] = (bool) $data['isAutomation'];
        }

        if (isset($data['acceptContestation'])) {
            $data['acceptContestation'] = (bool) $data['acceptContestation'];
        }

        if (isset($data['lead_expires_at']) && $data['lead_expires_at']) {
            $data['lead_expires_at'] = \Carbon\Carbon::parse($data['lead_expires_at']);
        }

        if (isset($data['acquired_at']) && $data['acquired_at']) {
            $data['acquired_at'] = \Carbon\Carbon::parse($data['acquired_at']);
        }

        if (isset($data['startPrice'])) {
            $data['startPrice'] = (float) $data['startPrice'];
        }

        if (isset($data['currentPrice'])) {
            $data['currentPrice'] = (float) $data['currentPrice'];
        }

        if (isset($data['lifes'])) {
            $data['lifes'] = (int) $data['lifes'];
        }

        if (isset($data['depreciationPercent'])) {
            $data['depreciationPercent'] = (int) $data['depreciationPercent'];
        }

        if (isset($data['depreciationInterval'])) {
            $data['depreciationInterval'] = (int) $data['depreciationInterval'];
        }

        return $this->contactRepository::create($data);
    }

    public function updateContact(int $id, array $data): Contact
    {
        $contact = $this->contactRepository::findById($id);

        if (!$contact) {
            throw new \Exception('Contato não encontrado');
        }

        if (!$this->canBeAccessedBy($contact, auth()->user())) {
            throw new \Exception('Sem permissão para editar este contato');
        }

        unset($data['close_modal']);

        if (isset($data['lead_expires_at']) && $data['lead_expires_at']) {
            $data['lead_expires_at'] = \Carbon\Carbon::parse($data['lead_expires_at']);
        }

        if (isset($data['acquired_at']) && $data['acquired_at']) {
            $data['acquired_at'] = \Carbon\Carbon::parse($data['acquired_at']);
        }

        if (isset($data['startPrice'])) {
            $data['startPrice'] = (float) $data['startPrice'];
        }

        if (isset($data['currentPrice'])) {
            $data['currentPrice'] = (float) $data['currentPrice'];
        }

        if (isset($data['lifes'])) {
            $data['lifes'] = (int) $data['lifes'];
        }

        if (isset($data['depreciationPercent'])) {
            $data['depreciationPercent'] = (int) $data['depreciationPercent'];
        }

        if (isset($data['depreciationInterval'])) {
            $data['depreciationInterval'] = (int) $data['depreciationInterval'];
        }

        $updated = $this->contactRepository::update($id, $data);

        if ($updated) {
            return $contact->fresh();
        }

        throw new \Exception('Erro ao atualizar contato');
    }

    public function deleteContact(int $id): bool
    {
        $contact = $this->contactRepository::findById($id);

        if (!$contact) {
            throw new \Exception('Contato não encontrado');
        }

        if (!$this->canBeAccessedBy($contact, auth()->user())) {
            throw new \Exception('Sem permissão para excluir este contato');
        }

        return $this->contactRepository::delete($id);
    }

    public function importFromLeads(array $leadIds, int $brokerId = null, int $supplierId = null): bool
    {
        return $this->contactRepository::importFromLeads($leadIds, $brokerId, $supplierId);
    }

    public function bulkImport(array $contacts, int $brokerId = null, int $supplierId = null): bool
    {
        return $this->contactRepository::bulkImport($contacts, $brokerId, $supplierId);
    }

    public function getLeadsForImport(int $brokerId = null, int $supplierId = null): Collection
    {
        return $this->contactRepository::getLeadsForImport($brokerId, $supplierId);
    }

    public function updateLastContact(int $contactId): bool
    {
        return $this->contactRepository::updateLastContact($contactId);
    }

    public function getStats(int $brokerId = null, int $supplierId = null): array
    {
        $user = auth()->user();

        if ($user->broker) {
            $brokerId = $user->broker->id;
        } elseif ($user->supplier) {
            $supplierId = $user->supplier->id;
        }

        return $this->contactRepository::getStats($brokerId, $supplierId);
    }

    public function isOwnedByBroker(Contact $contact): bool
    {
        return !is_null($contact->broker_id);
    }

    public function isOwnedBySupplier(Contact $contact): bool
    {
        return !is_null($contact->supplier_id);
    }

    public function canBeAccessedBy(Contact $contact, User $user): bool
    {
        if ($this->isOwnedByBroker($contact)) {
            return $user->broker && $user->broker->id === $contact->broker_id;
        }

        if ($this->isOwnedBySupplier($contact)) {
            return $user->supplier && $user->supplier->id === $contact->supplier_id;
        }

        return false;
    }

    public function getTypeLabel(Contact $contact): string
    {
        if (!$contact->type) {
            return 'N/A';
        }

        return match($contact->type) {
            LeadType::PF => 'Pessoa Física',
            LeadType::PJ => 'Pessoa Jurídica',
            LeadType::ADESAO => 'Adesão',
            LeadType::MISTA => 'Mista (PF + PJ)',
            default => 'N/A'
        };
    }

    public function convertToLead(int $contactId, string $reason = null): bool
    {
        return $this->contactRepository::convertToLead($contactId, $reason);
    }

    public function convertLeadToContact(int $leadId, string $reason = 'Transferido'): Contact
    {
        $lead = Lead::find($leadId);

        if (!$lead) {
            throw new \Exception('Lead não encontrado');
        }

        $user = auth()->user();

        if (!$this->canAccessLead($lead, $user)) {
            throw new \Exception('Sem permissão para converter este lead');
        }

        return $this->contactRepository::convertLeadToContact($lead, $reason);
    }

    private function canAccessLead(Lead $lead, User $user): bool
    {
        if ($user->broker) {
            return $lead->broker_id === $user->broker->id;
        }

        if ($user->supplier) {
            return $lead->supplier_id === $user->supplier->id;
        }

        return false;
    }

    public function transferLeadsToContacts(array $leadIds, string $reason = 'Transferido via API'): array
    {
        $user = auth()->user();
        $results = [
            'transferred_count' => 0,
            'failed_count' => 0,
            'contacts' => collect(),
            'errors' => []
        ];

        if (!$user) {
            throw new \Exception('Usuário não autenticado');
        }

        if (!$user->broker && !$user->supplier) {
            throw new \Exception('Usuário não possui permissão para transferir leads');
        }

        $leads = Lead::whereIn('id', $leadIds)->get();

        if ($leads->isEmpty()) {
            throw new \InvalidArgumentException('Nenhum lead encontrado com os IDs fornecidos');
        }

        DB::beginTransaction();

        try {
            foreach ($leads as $lead) {
                try {
                    if (!$this->canAccessLead($lead, $user)) {
                        $results['failed_count']++;
                        $results['errors'][] = [
                            'lead_id' => $lead->id,
                            'lead_code' => $lead->code,
                            'error' => 'Sem permissão para transferir este lead'
                        ];
                        continue;
                    }

                    $existingContact = Contact::where('email', $lead->email)
                        ->when($user->broker, function ($query) use ($user) {
                            return $query->where('broker_id', $user->broker->id);
                        })
                        ->when($user->supplier, function ($query) use ($user) {
                            return $query->where('supplier_id', $user->supplier->id);
                        })
                        ->first();

                    if ($existingContact) {
                        $results['failed_count']++;
                        $results['errors'][] = [
                            'lead_id' => $lead->id,
                            'lead_code' => $lead->code,
                            'error' => 'Já existe um contato com este email'
                        ];
                        continue;
                    }

                    $contact = $this->convertLeadToContactData($lead, $user, $reason);
                    $newContact = Contact::create($contact);

                    if ($newContact) {
                        $lead->update([
                            'status' => 'sold',
                            'converted_at' => now(),
                            'conversion_reason' => $reason
                        ]);

                        $lead->delete();

                        $results['transferred_count']++;
                        $results['contacts']->push($newContact->load(['broker', 'supplier', 'responsible', 'healthOperator']));
                    } else {
                        $results['failed_count']++;
                        $results['errors'][] = [
                            'lead_id' => $lead->id,
                            'lead_code' => $lead->code,
                            'error' => 'Erro ao criar contato'
                        ];
                    }

                } catch (\Exception $e) {
                    $results['failed_count']++;
                    $results['errors'][] = [
                        'lead_id' => $lead->id,
                        'lead_code' => $lead->code,
                        'error' => $e->getMessage()
                    ];
                }
            }

            DB::commit();

            return $results;

        } catch (\Exception $e) {
            DB::rollBack();
            throw new \Exception('Erro na transferência de leads: ' . $e->getMessage());
        }
    }

    private function convertLeadToContactData(Lead $lead, User $user, string $reason): array
    {
        $contactData = [
            'code' => 'CONT' . str_pad(Contact::count() + 1, 6, '0', STR_PAD_LEFT),
            'name' => $lead->name,
            'corporateName' => $lead->corporateName,
            'email' => $lead->email,
            'phone' => $lead->phone,
            'cpf' => $lead->cpf,
            'cnpj' => $lead->cnpj,
            'city' => $lead->city,
            'state' => $lead->state,
            'company' => $lead->corporateName,
            'type' => $lead->type,
            'status' => 'active',
            'source' => 'lead_funnel',
            'temperature' => $lead->temperature ?? 'warm',
            'step' => $lead->step,
            'lifes' => $lead->lifes,
            'isAutomation' => $lead->isAutomation ?? false,
            'acceptContestation' => $lead->acceptContestation ?? false,
            'description' => $lead->description,
            'startPrice' => $lead->startPrice,
            'currentPrice' => $lead->currentPrice,
            'pricingType' => $lead->pricingType,
            'depreciationPercent' => $lead->depreciationPercent,
            'depreciationInterval' => $lead->depreciationInterval,
            'lead_expires_at' => $lead->lead_expires_at,
            'acquired_at' => $lead->acquired_at,
            'converted_at' => now(),
            'conversion_reason' => $reason,
            'health_operator_id' => $lead->health_operator_id
        ];

        if ($user->broker) {
            $contactData['broker_id'] = $user->broker->id;
            $contactData['responsible_id'] = $lead->responsible_id ?? $user->broker->id;
            $contactData['supplier_id'] = $lead->supplier_id;
        } elseif ($user->supplier) {
            $contactData['supplier_id'] = $user->supplier->id;
            $contactData['broker_id'] = $lead->broker_id;
            $contactData['responsible_id'] = $lead->responsible_id;
        }

        return $contactData;
    }

    public function getContactsForApi(array $filters = [], int $perPage = 10): LengthAwarePaginator
    {
        $user = auth()->user();

        if (!$user) {
            throw new \Exception('Usuário não autenticado');
        }

        if ($user->broker) {
            return $this->contactRepository::getByBroker($user->broker->id, $filters, $perPage);
        }

        if ($user->supplier) {
            return $this->contactRepository::getBySupplier($user->supplier->id, $filters, $perPage);
        }

        throw new \Exception('Usuário não possui permissão para acessar contatos');
    }

    public function getContactForApi(int $id, User $user): ?Contact
    {
        $contact = Contact::find($id);

        if (!$contact) {
            return null;
        }

        if (!$this->canBeAccessedBy($contact, $user)) {
            throw new \Exception('Sem permissão para acessar este contato');
        }

        return $contact;
    }

    public function createContactForApi(array $data, User $user): Contact
    {
        if ($user->broker) {
            $data['broker_id'] = $user->broker->id;
        } elseif ($user->supplier) {
            $data['supplier_id'] = $user->supplier->id;
        } else {
            throw new \Exception('Usuário não possui permissão para criar contatos');
        }

        if (!isset($data['source'])) {
            $data['source'] = 'api';
        }

        if (!isset($data['status'])) {
            $data['status'] = 'active';
        }

        if (!isset($data['code'])) {
            $data['code'] = 'CONT' . str_pad(Contact::count() + 1, 6, '0', STR_PAD_LEFT);
        }

        if (isset($data['isAutomation'])) {
            $data['isAutomation'] = (bool) $data['isAutomation'];
        }

        if (isset($data['acceptContestation'])) {
            $data['acceptContestation'] = (bool) $data['acceptContestation'];
        }

        if (isset($data['lead_expires_at']) && $data['lead_expires_at']) {
            $data['lead_expires_at'] = \Carbon\Carbon::parse($data['lead_expires_at']);
        }

        if (isset($data['acquired_at']) && $data['acquired_at']) {
            $data['acquired_at'] = \Carbon\Carbon::parse($data['acquired_at']);
        }

        return $this->contactRepository::create($data);
    }

    public function updateContactForApi(int $id, array $data, User $user): Contact
    {
        $contact = Contact::find($id);

        if (!$contact) {
            throw new \Exception('Contato não encontrado');
        }

        if (!$this->canBeAccessedBy($contact, $user)) {
            throw new \Exception('Sem permissão para editar este contato');
        }

        if (isset($data['lead_expires_at']) && $data['lead_expires_at']) {
            $data['lead_expires_at'] = \Carbon\Carbon::parse($data['lead_expires_at']);
        }

        if (isset($data['acquired_at']) && $data['acquired_at']) {
            $data['acquired_at'] = \Carbon\Carbon::parse($data['acquired_at']);
        }

        if (isset($data['last_contact_at']) && $data['last_contact_at']) {
            $data['last_contact_at'] = \Carbon\Carbon::parse($data['last_contact_at']);
        }

        $updated = $this->contactRepository::update($id, $data);

        if (!$updated) {
            throw new \Exception('Erro ao atualizar contato');
        }

        return $contact->fresh();
    }

    public function deleteContactForApi(int $id, User $user): bool
    {
        $contact = Contact::find($id);

        if (!$contact) {
            throw new \Exception('Contato não encontrado');
        }

        if (!$this->canBeAccessedBy($contact, $user)) {
            throw new \Exception('Sem permissão para excluir este contato');
        }

        return $this->contactRepository::delete($id);
    }

    public function getContactsByBroker(int $brokerId, array $filters = [], int $perPage = 10): LengthAwarePaginator
    {
        return $this->contactRepository::getByBroker($brokerId, $filters, $perPage);
    }

    public function getContactsBySupplier(int $supplierId, array $filters = [], int $perPage = 10): LengthAwarePaginator
    {
        return $this->contactRepository::getBySupplier($supplierId, $filters, $perPage);
    }

    public function transferLeadsToContactsForUser(array $leadIds, string $reason, User $user): array
    {
        $results = [
            'transferred_count' => 0,
            'failed_count' => 0,
            'contacts' => collect(),
            'errors' => []
        ];

        if (!$user->broker && !$user->supplier) {
            throw new \Exception('Usuário não possui permissão para transferir leads');
        }

        $leads = Lead::whereIn('id', $leadIds)->get();

        if ($leads->isEmpty()) {
            throw new \InvalidArgumentException('Nenhum lead encontrado com os IDs fornecidos');
        }

        DB::beginTransaction();

        try {
            foreach ($leads as $lead) {
                try {
                    if (!$this->canAccessLead($lead, $user)) {
                        $results['failed_count']++;
                        $results['errors'][] = [
                            'lead_id' => $lead->id,
                            'lead_code' => $lead->code,
                            'error' => 'Sem permissão para transferir este lead'
                        ];
                        continue;
                    }

                    $existingContact = Contact::where('email', $lead->email)
                        ->when($user->broker, function ($query) use ($user) {
                            return $query->where('broker_id', $user->broker->id);
                        })
                        ->when($user->supplier, function ($query) use ($user) {
                            return $query->where('supplier_id', $user->supplier->id);
                        })
                        ->first();

                    if ($existingContact) {
                        $results['failed_count']++;
                        $results['errors'][] = [
                            'lead_id' => $lead->id,
                            'lead_code' => $lead->code,
                            'error' => 'Já existe um contato com este email'
                        ];
                        continue;
                    }

                    $contact = $this->convertLeadToContactData($lead, $user, $reason);
                    $newContact = Contact::create($contact);

                    if ($newContact) {
                        $lead->update([
                            'status' => 'sold',
                            'converted_at' => now(),
                            'conversion_reason' => $reason
                        ]);

                        $lead->delete();

                        $results['transferred_count']++;
                        $results['contacts']->push($newContact->load(['broker', 'supplier', 'responsible', 'healthOperator']));
                    } else {
                        $results['failed_count']++;
                        $results['errors'][] = [
                            'lead_id' => $lead->id,
                            'lead_code' => $lead->code,
                            'error' => 'Erro ao criar contato'
                        ];
                    }

                } catch (\Exception $e) {
                    $results['failed_count']++;
                    $results['errors'][] = [
                        'lead_id' => $lead->id,
                        'lead_code' => $lead->code,
                        'error' => $e->getMessage()
                    ];
                }
            }

            DB::commit();

            return $results;

        } catch (\Exception $e) {
            DB::rollBack();
            throw new \Exception('Erro na transferência de leads: ' . $e->getMessage());
        }
    }
}
