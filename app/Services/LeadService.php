<?php

declare(strict_types=1);

namespace App\Services;

use App\DTOs\LeadInteractionDTO;
use App\Events\LeadEnteredNewStep;
use App\Interfaces\LeadRepositoryInterface;
use App\Models\Lead;
use App\Models\User;
use App\Models\Broker;
use App\Models\Supplier;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Pagination\LengthAwarePaginator;

class LeadService
{
    public function __construct(
        private readonly LeadRepositoryInterface $leadRepository
    ) {}

    public function getLeadsByBroker(User $user): Collection
    {
        if (!$user->broker) {
            throw new \InvalidArgumentException('User must have an associated broker to access leads');
        }

        return $this->leadRepository->findByBrokerId($user->broker->id);
    }

    public function getLeadsWithFilters(array $filters, User $user): LengthAwarePaginator
    {
        if (!$user->broker) {
            throw new \InvalidArgumentException('User must have an associated broker to access leads');
        }

        $query = Lead::where('broker_id', $user->broker->id)
            ->with(['broker.user', 'supplier', 'responsible.user', 'healthOperator', 'automation']);

        if (isset($filters['step'])) {
            $query->where('step', $filters['step']);
        }

        if (isset($filters['isAutomation'])) {
            $query->where('isAutomation', (bool) $filters['isAutomation']);
        }

        if (isset($filters['type'])) {
            $query->where('type', $filters['type']);
        }

        if (isset($filters['name'])) {
            $query->where('name', 'like', '%' . $filters['name'] . '%');
        }

        if (isset($filters['id'])) {
            $query->where('id', $filters['id']);
        }

        if (isset($filters['email'])) {
            $query->where('email', 'like', '%' . $filters['email'] . '%');
        }

        if (isset($filters['phone'])) {
            $query->byPhone($filters['phone']);
        }

        if (isset($filters['city'])) {
            $query->where('city', 'like', '%' . $filters['city'] . '%');
        }

        if (isset($filters['DDD'])) {
            $query->DDD($filters['DDD']);
        }

        if (isset($filters['createdBetween'])) {
            $query->createdBetween($filters['createdBetween']);
        }

        if (isset($filters['movedBetween'])) {
            $query->movedBetween($filters['movedBetween']);
        }

        $sort = request()->get('sort', 'created_at');

        switch ($sort) {
            case 'name':
                $query->orderBy('name', 'asc');
                break;
            case '-name':
                $query->orderBy('name', 'desc');
                break;
            case 'created_at':
                $query->orderBy('created_at', 'desc');
                break;
            case '-created_at':
                $query->orderBy('created_at', 'asc');
                break;
            case 'price':
                $query->orderBy('currentPrice', 'desc');
                break;
            case '-price':
                $query->orderBy('currentPrice', 'asc');
                break;
            case 'moved':
                $query->orderBy('updated_at', 'desc');
                break;
            case '-moved':
                $query->orderBy('updated_at', 'asc');
                break;
            default:
                $query->orderBy('created_at', 'desc');
                break;
        }

        $perPage = isset($filters['createdBetween']) || isset($filters['movedBetween']) ? 1000 : 100;

        $result = $query->paginate($perPage)->appends(request()->query());

        return $result;
    }

    public function updateLead(int $id, array $data, User $user): Lead
    {
        if (!$user->broker) {
            throw new \InvalidArgumentException('User must have an associated broker to update leads');
        }

        $lead = $this->leadRepository->findByIdAndBrokerId($id, $user->broker->id);

        if (!$lead) {
            throw new ModelNotFoundException('Lead not found or does not belong to broker');
        }

        if (isset($data['type']) && is_string($data['type'])) {
            $typeMap = [
                'PF' => 1,
                'PJ' => 2,
                'ADESAO' => 3,
                'MISTA' => 4
            ];
            $data['type'] = $typeMap[$data['type']] ?? 1;
        }

        $lead->fill($data);
        $lead->save();

        return $lead->fresh();
    }

    public function updateLeadStep(int $id, int $fromStep, int $toStep, array $interactionData, User $user): bool
    {
        if (!$user->broker) {
            throw new \InvalidArgumentException('User must have an associated broker to update lead steps');
        }

        $lead = $this->leadRepository->findByIdAndBrokerId($id, $user->broker->id);

        if (!$lead) {
            throw new \Illuminate\Database\Eloquent\ModelNotFoundException('Lead not found or does not belong to broker');
        }

        $interactionDTO = LeadInteractionDTO::fromArray([
            'from_step' => $fromStep,
            'to_step' => $toStep,
            'description' => $interactionData['description'] ?? null,
            'negotiatedPrice' => $interactionData['negotiatedPrice'] ?? null,
            'return_date' => $interactionData['return_date'] ?? null,
        ]);

        $entered = $this->leadRepository->updateStep($id, $fromStep, $toStep, $interactionDTO->toArray());

        if ($entered && $toStep === 1) {
            $freshLead = $this->leadRepository->findByIdAndBrokerId($id, $user->broker->id);
            if ($freshLead) {
                event(new LeadEnteredNewStep($freshLead, $user, $toStep));
            }
        }

        return $entered;
    }

    public function createLead(array $data, User $user): Lead
    {
        if (!$user->broker) {
            throw new \InvalidArgumentException('User must have an associated broker to create leads');
        }

        if (!$user->broker->id) {
            throw new \InvalidArgumentException('Invalid broker ID');
        }

        // Regra: Lead criado por broker
        $data['supplier_id'] = 1; // Fornecedor padrão do sistema
        $data['broker_id'] = $user->broker->id;
        $data['responsible_id'] = $user->broker->id;

        if (!array_key_exists('step', $data) || (int) ($data['step'] ?? 0) < 1) {
            $data['step'] = 1;
        }

        $lead = $this->leadRepository->create($data);

        if ((int) ($lead->step ?? 0) === 1) {
            event(new LeadEnteredNewStep($lead, $user, 1));
        }

        return $lead;
    }

    public function createLeadViaApi(array $data, User $user): Lead
    {
        if (!$user->broker) {
            throw new \InvalidArgumentException('User must have an associated broker to create leads');
        }

        if (!$user->broker->id) {
            throw new \InvalidArgumentException('Invalid broker ID');
        }

        // Regra: Lead criado por broker via API
        $data['supplier_id'] = 1; // Fornecedor padrão do sistema
        $data['broker_id'] = $user->broker->id;
        $data['responsible_id'] = $user->broker->id;

        if (isset($data['type']) && is_string($data['type'])) {
            $typeMap = [
                'PF' => 1,
                'PJ' => 2,
                'ADESAO' => 3,
                'MISTA' => 4
            ];
            $data['type'] = $typeMap[$data['type']] ?? 1;
        }

        if (!array_key_exists('step', $data) || (int) ($data['step'] ?? 0) < 1) {
            $data['step'] = 1;
        }

        if (!array_key_exists('isAutomation', $data)) {
            $data['isAutomation'] = false;
        }

        if (!array_key_exists('acceptContestation', $data)) {
            $data['acceptContestation'] = false;
        }

        if (!array_key_exists('status', $data)) {
            $data['status'] = 'available';
        }

        if (!array_key_exists('pricingType', $data)) {
            $data['pricingType'] = 'fixed';
        }

        if (!array_key_exists('currentPrice', $data) && isset($data['startPrice'])) {
            $data['currentPrice'] = $data['startPrice'];
        }

        if (!array_key_exists('lifes', $data)) {
            $data['lifes'] = 1;
        }

        $lead = $this->leadRepository->create($data);

        if ((int) ($lead->step ?? 0) === 1) {
            event(new LeadEnteredNewStep($lead, $user, 1));
        }

        return $lead;
    }

    public function deleteLead(int $id, User $user): bool
    {
        if (!$user->broker) {
            throw new \InvalidArgumentException('User must have an associated broker to delete leads');
        }

        $lead = $this->leadRepository->findByIdAndBrokerId($id, $user->broker->id);

        if (!$lead) {
            throw new ModelNotFoundException('Lead not found or does not belong to broker');
        }

        return $this->leadRepository->delete($lead);
    }

    public function getLeadById(int $id): ?Lead
    {
        return $this->leadRepository->findById($id);
    }

    public function getLeadByIdAndBroker(int $id, User $user): Lead
    {
        if (!$user->broker) {
            throw new \InvalidArgumentException('User must have an associated broker to access leads');
        }

        $lead = $this->leadRepository->findByIdAndBrokerId($id, $user->broker->id);

        if (!$lead) {
            throw new ModelNotFoundException('Lead not found or does not belong to broker');
        }

        return $lead;
    }

    public function findBrokerByPhone(string $phone): ?int
    {
        $user = User::byPhone($phone)->first();

        if (!$user || !$user->broker) {
            return null;
        }

        return $user->broker->id;
    }

    public function createLeadByPhone(array $data, string $phone): Lead
    {
        $brokerId = $this->findBrokerByPhone($phone);

        if (!$brokerId) {
            throw new \InvalidArgumentException('No broker found with this phone number');
        }

        // Regra: Lead criado por broker via telefone
        $data['supplier_id'] = 1; // Fornecedor padrão do sistema
        $data['broker_id'] = $brokerId;
        $data['responsible_id'] = $brokerId;

        if (!array_key_exists('step', $data) || (int) ($data['step'] ?? 0) < 1) {
            $data['step'] = 1;
        }

        $lead = $this->leadRepository->create($data);

        return $lead;
    }

    public function createLeadForSupplier(array $data, Supplier $supplier): Lead
    {
        // Regra: Lead criado por supplier
        $data['supplier_id'] = $supplier->id; // Origem do lead
        $data['broker_id'] = null; // Supplier é o dono
        $data['responsible_id'] = null; // Supplier não tem responsável

        if (!array_key_exists('step', $data) || (int) ($data['step'] ?? 0) < 1) {
            $data['step'] = 1;
        }

        if (!array_key_exists('isAutomation', $data)) {
            $data['isAutomation'] = false;
        }

        if (!array_key_exists('acceptContestation', $data)) {
            $data['acceptContestation'] = false;
        }

        if (!array_key_exists('status', $data)) {
            $data['status'] = 'available';
        }

        if (!array_key_exists('pricingType', $data)) {
            $data['pricingType'] = 'fixed';
        }

        if (!array_key_exists('currentPrice', $data) && isset($data['startPrice'])) {
            $data['currentPrice'] = $data['startPrice'];
        }

        if (!array_key_exists('lifes', $data)) {
            $data['lifes'] = 1;
        }

        $lead = $this->leadRepository->create($data);

        if ((int) ($lead->step ?? 0) === 1) {
            event(new LeadEnteredNewStep($lead, $supplier, 1));
        }

        return $lead;
    }

    public function getLeadsBySupplier(int $supplierId): Collection
    {
        return $this->leadRepository->findBySupplierId($supplierId);
    }

    public function getLeadByIdAndSupplier(int $id, int $supplierId): Lead
    {
        return $this->leadRepository->findByIdAndSupplierId($id, $supplierId);
    }

    public function transferLeadOwnership(int $leadId, int $newBrokerId, User $user): Lead
    {
        $lead = $this->leadRepository->findById($leadId);

        if (!$lead) {
            throw new ModelNotFoundException('Lead not found');
        }

        if (!$lead->canTransferOwnership($user)) {
            throw new \InvalidArgumentException('User does not have permission to transfer ownership of this lead');
        }

        $newBroker = Broker::find($newBrokerId);
        if (!$newBroker) {
            throw new \InvalidArgumentException('Broker not found');
        }

        // Guardar estado original da automação antes da transferência
        $originalAutomation = $lead->isAutomation;

        // Regra: Transferência de titularidade
        // O supplier_id permanece (origem do lead)
        // Apenas broker_id e responsible_id mudam
        $lead->broker_id = $newBrokerId;
        $lead->responsible_id = $newBrokerId; // Novo broker se torna responsável

        // Regra: Desativar automação durante transferência
        // Automação deve ser desativada independente da etapa do lead
        if ($originalAutomation) {
            $lead->isAutomation = false;
        }

        // Step e status são mantidos automaticamente (não são alterados na transferência)
        $lead->save();

        return $lead->fresh();
    }

    public function delegateLeadResponsibility(int $leadId, int $newResponsibleId, User $user): Lead
    {
        $lead = $this->leadRepository->findById($leadId);

        if (!$lead) {
            throw new ModelNotFoundException('Lead not found');
        }

        if (!$lead->canDelegateResponsibility($user)) {
            throw new \InvalidArgumentException('User does not have permission to delegate responsibility of this lead');
        }

        $newResponsible = Broker::find($newResponsibleId);
        if (!$newResponsible) {
            throw new \InvalidArgumentException('Broker not found');
        }

        if ($lead->isOwnedByBroker()) {
            $ownerBroker = Broker::find($lead->broker_id);
            if (!$ownerBroker || !$ownerBroker->team) {
                throw new \InvalidArgumentException('Lead owner broker does not have a team');
            }

            $isTeamMember = $ownerBroker->team->members()
                ->where('broker_id', $newResponsibleId)
                ->exists();

            if (!$isTeamMember) {
                throw new \InvalidArgumentException('Broker is not a member of the lead owner team');
            }
        }

        // Guardar estado original da automação antes da delegação
        $originalAutomation = $lead->isAutomation;

        // Regra: Delegação de responsabilidade
        // O broker_id permanece o mesmo, apenas o responsible_id muda
        $lead->responsible_id = $newResponsibleId;

        // Regra: Desativar automação durante delegação
        // Automação deve ser desativada independente da etapa do lead
        if ($originalAutomation) {
            $lead->isAutomation = false;
        }

        // Step e status são mantidos automaticamente (não são alterados na delegação)
        $lead->save();

        return $lead->fresh();
    }

    public function getLeadsByBrokerId(int $brokerId): Collection
    {
        return $this->leadRepository->findByBrokerId($brokerId);
    }

    public function getLeadsByResponsible(int $responsibleId): Collection
    {
        return $this->leadRepository->findByResponsible($responsibleId);
    }

    public function transferBulkLeads(array $leadIds, int $newBrokerId, string $transferType, User $user): array
    {
        $results = [];

        foreach ($leadIds as $leadId) {
            try {
                if ($transferType === 'ownership') {
                    $lead = $this->transferLeadOwnership($leadId, $newBrokerId, $user);
                } else {
                    $lead = $this->delegateLeadResponsibility($leadId, $newBrokerId, $user);
                }

                $results[] = [
                    'lead_id' => $leadId,
                    'success' => true,
                    'message' => 'Transferido com sucesso'
                ];
            } catch (\Exception $e) {
                $results[] = [
                    'lead_id' => $leadId,
                    'success' => false,
                    'message' => $e->getMessage()
                ];
            }
        }

        return $results;
    }

    public function searchByPhone(string $phone, User $user): Collection
    {
        if (!$user->broker) {
            throw new \InvalidArgumentException('User must have an associated broker to search leads');
        }

        return $this->leadRepository->searchByPhone($user->broker->id, $phone);
    }

    public function searchByName(string $name, User $user): Collection
    {
        if (!$user->broker) {
            throw new \InvalidArgumentException('User must have an associated broker to search leads');
        }

        return $this->leadRepository->searchByName($user->broker->id, $name);
    }

    public function searchByEmail(string $email, User $user): Collection
    {
        if (!$user->broker) {
            throw new \InvalidArgumentException('User must have an associated broker to search leads');
        }

        return $this->leadRepository->searchByEmail($user->broker->id, $email);
    }

    public function getLeadsByStep(int $step, User $user): Collection
    {
        if (!$user->broker) {
            throw new \InvalidArgumentException('User must have an associated broker to access leads');
        }

        return $this->leadRepository->findByBrokerIdAndStep($user->broker->id, $step);
    }

    public function getLeadsByIsAutomation(bool $isAutomation, User $user): Collection
    {
        if (!$user->broker) {
            throw new \InvalidArgumentException('User must have an associated broker to access leads');
        }

        return $this->leadRepository->findByBrokerIdAndIsAutomation($user->broker->id, $isAutomation);
    }
}