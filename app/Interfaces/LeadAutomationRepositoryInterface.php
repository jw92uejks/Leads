<?php

namespace App\Interfaces;

use App\Models\LeadAutomation;
use Illuminate\Database\Eloquent\Collection;

interface LeadAutomationRepositoryInterface
{
    public function all(): Collection;

    public function allByBroker(int $brokerId): Collection;

    public function find(int $id): ?LeadAutomation;

    public function findByIdAndBroker(int $id, int $brokerId): ?LeadAutomation;

    public function create(array $data): LeadAutomation;

    public function createForBroker(array $data, int $brokerId): ?LeadAutomation;

    public function update(int $id, array $data): bool;

    public function delete(int $id): bool;

    public function findByLeadId(int $leadId): ?LeadAutomation;

    public function findByLeadIdAndBroker(int $leadId, int $brokerId): ?LeadAutomation;

    public function searchByPhone(string $phone): Collection;

    public function searchByPhoneAndBroker(string $phone, int $brokerId): Collection;

    public function searchByName(string $name): Collection;

    public function searchByNameAndBroker(string $name, int $brokerId): Collection;

    public function getByAssistStatus(string $status): Collection;

    public function getByAssistStatusAndBroker(string $status, int $brokerId): Collection;

    public function getUpcomingRenewals(int $days = 30): Collection;

    public function getUpcomingRenewalsByBroker(int $days, int $brokerId): Collection;

    public function getUpcomingPayments(int $days = 7): Collection;

    public function getUpcomingPaymentsByBroker(int $days, int $brokerId): Collection;

    public function getBirthdaysInMonth(int $month, int $year): Collection;

    public function getBirthdaysInMonthByBroker(int $month, int $year, int $brokerId): Collection;

    public function getPeriodicContactsDue(): Collection;

    public function getPeriodicContactsDueByBroker(int $brokerId): Collection;
}

