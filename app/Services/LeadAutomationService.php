<?php

namespace App\Services;

use App\Interfaces\LeadAutomationRepositoryInterface;
use App\Models\LeadAutomation;
use Illuminate\Database\Eloquent\Collection;

class LeadAutomationService
{
    public function __construct(
        private readonly LeadAutomationRepositoryInterface $repository
    ) {}

    public function getAll(): Collection
    {
        return $this->repository->all();
    }

    public function getAllByBroker(int $brokerId): Collection
    {
        return $this->repository->allByBroker($brokerId);
    }

    public function findById(int $id): ?LeadAutomation
    {
        return $this->repository->find($id);
    }

    public function findByIdAndBroker(int $id, int $brokerId): ?LeadAutomation
    {
        return $this->repository->findByIdAndBroker($id, $brokerId);
    }

    public function findByLeadId(int $leadId): ?LeadAutomation
    {
        return $this->repository->findByLeadId($leadId);
    }

    public function findByLeadIdAndBroker(int $leadId, int $brokerId): ?LeadAutomation
    {
        return $this->repository->findByLeadIdAndBroker($leadId, $brokerId);
    }

    public function create(array $data): LeadAutomation
    {
        return $this->repository->create($data);
    }

    public function createForBroker(array $data, int $brokerId): ?LeadAutomation
    {
        return $this->repository->createForBroker($data, $brokerId);
    }

    public function update(int $id, array $data): ?LeadAutomation
    {
        $automation = $this->repository->find($id);

        if (!$automation) {
            return null;
        }

        $this->repository->update($id, $data);

        return $this->repository->find($id);
    }

    public function updateForBroker(int $id, array $data, int $brokerId): ?LeadAutomation
    {
        $automation = $this->repository->findByIdAndBroker($id, $brokerId);

        if (!$automation) {
            return null;
        }

        $this->repository->update($id, $data);

        return $this->repository->findByIdAndBroker($id, $brokerId);
    }

    public function delete(int $id): bool
    {
        return $this->repository->delete($id);
    }

    public function deleteForBroker(int $id, int $brokerId): bool
    {
        $automation = $this->repository->findByIdAndBroker($id, $brokerId);

        if (!$automation) {
            return false;
        }

        return $this->repository->delete($id);
    }

    public function getByAssistStatus(string $status): Collection
    {
        return $this->repository->getByAssistStatus($status);
    }

    public function getByAssistStatusAndBroker(string $status, int $brokerId): Collection
    {
        return $this->repository->getByAssistStatusAndBroker($status, $brokerId);
    }

    public function getUpcomingRenewals(int $days = 30): Collection
    {
        return $this->repository->getUpcomingRenewals($days);
    }

    public function getUpcomingRenewalsByBroker(int $days, int $brokerId): Collection
    {
        return $this->repository->getUpcomingRenewalsByBroker($days, $brokerId);
    }

    public function getUpcomingPayments(int $days = 7): Collection
    {
        return $this->repository->getUpcomingPayments($days);
    }

    public function getUpcomingPaymentsByBroker(int $days, int $brokerId): Collection
    {
        return $this->repository->getUpcomingPaymentsByBroker($days, $brokerId);
    }

    public function getBirthdaysInMonth(int $month, int $year): Collection
    {
        return $this->repository->getBirthdaysInMonth($month, $year);
    }

    public function getBirthdaysInMonthByBroker(int $month, int $year, int $brokerId): Collection
    {
        return $this->repository->getBirthdaysInMonthByBroker($month, $year, $brokerId);
    }

    public function getPeriodicContactsDue(): Collection
    {
        return $this->repository->getPeriodicContactsDue();
    }

    public function getPeriodicContactsDueByBroker(int $brokerId): Collection
    {
        return $this->repository->getPeriodicContactsDueByBroker($brokerId);
    }

    public function updateAssistStatus(int $id, string $status, ?string $substatus = null): ?LeadAutomation
    {
        $data = ['assist_status' => $status];

        if ($substatus) {
            $data['assist_substatus'] = $substatus;
        }

        return $this->update($id, $data);
    }

    public function updateCurrentState(int $id, string $state): ?LeadAutomation
    {
        return $this->update($id, ['current_state' => $state]);
    }

    public function schedulePeriodicContact(int $id, string $date): ?LeadAutomation
    {
        return $this->update($id, ['periodic_contact' => $date]);
    }

    public function searchByPhone(string $phone): Collection
    {
        return $this->repository->searchByPhone($phone);
    }

    public function searchByPhoneAndBroker(string $phone, int $brokerId): Collection
    {
        return $this->repository->searchByPhoneAndBroker($phone, $brokerId);
    }

    public function searchByName(string $name): Collection
    {
        return $this->repository->searchByName($name);
    }

    public function searchByNameAndBroker(string $name, int $brokerId): Collection
    {
        return $this->repository->searchByNameAndBroker($name, $brokerId);
    }
}

