<?php

namespace App\Repositories;

use App\Interfaces\LeadAutomationRepositoryInterface;
use App\Models\LeadAutomation;
use Illuminate\Database\Eloquent\Collection;

class LeadAutomationRepository implements LeadAutomationRepositoryInterface
{
    public function __construct(
        private readonly LeadAutomation $model
    ) {}

    public function all(): Collection
    {
        return $this->model->with('lead')->get();
    }

    public function allByBroker(int $brokerId): Collection
    {
        return $this->model
            ->whereHas('lead', function ($query) use ($brokerId) {
                $query->where('broker_id', $brokerId);
            })
            ->with('lead')
            ->get();
    }

    public function find(int $id): ?LeadAutomation
    {
        return $this->model->with('lead')->find($id);
    }

    public function findByIdAndBroker(int $id, int $brokerId): ?LeadAutomation
    {
        return $this->model
            ->whereHas('lead', function ($query) use ($brokerId) {
                $query->where('broker_id', $brokerId);
            })
            ->with('lead')
            ->find($id);
    }

    public function create(array $data): LeadAutomation
    {
        return $this->model->create($data);
    }

    public function createForBroker(array $data, int $brokerId): ?LeadAutomation
    {
        $lead = \App\Models\Lead::where('id', $data['lead_id'])
            ->where('broker_id', $brokerId)
            ->first();

        if (!$lead) {
            return null;
        }

        return $this->model->create($data);
    }

    public function update(int $id, array $data): bool
    {
        return $this->model->where('id', $id)->update($data) > 0;
    }

    public function delete(int $id): bool
    {
        $automation = $this->model->find($id);

        if (!$automation) {
            return false;
        }

        return $automation->delete();
    }

    public function findByLeadId(int $leadId): ?LeadAutomation
    {
        return $this->model
            ->where('lead_id', $leadId)
            ->with('lead')
            ->first();
    }

    public function findByLeadIdAndBroker(int $leadId, int $brokerId): ?LeadAutomation
    {
        return $this->model
            ->where('lead_id', $leadId)
            ->whereHas('lead', function ($query) use ($brokerId) {
                $query->where('broker_id', $brokerId);
            })
            ->with('lead')
            ->first();
    }

    public function getByAssistStatus(string $status): Collection
    {
        return $this->model
            ->where('assist_status', $status)
            ->with('lead')
            ->get();
    }

    public function getByAssistStatusAndBroker(string $status, int $brokerId): Collection
    {
        return $this->model
            ->where('assist_status', $status)
            ->whereHas('lead', function ($query) use ($brokerId) {
                $query->where('broker_id', $brokerId);
            })
            ->with('lead')
            ->get();
    }

    public function getUpcomingRenewals(int $days = 30): Collection
    {
        return $this->model
            ->whereNotNull('renewal_date')
            ->whereBetween('renewal_date', [now(), now()->addDays($days)])
            ->with('lead')
            ->orderBy('renewal_date', 'asc')
            ->get();
    }

    public function getUpcomingRenewalsByBroker(int $days, int $brokerId): Collection
    {
        return $this->model
            ->whereNotNull('renewal_date')
            ->whereBetween('renewal_date', [now(), now()->addDays($days)])
            ->whereHas('lead', function ($query) use ($brokerId) {
                $query->where('broker_id', $brokerId);
            })
            ->with('lead')
            ->orderBy('renewal_date', 'asc')
            ->get();
    }

    public function getUpcomingPayments(int $days = 7): Collection
    {
        return $this->model
            ->whereNotNull('estimated_payment')
            ->whereBetween('estimated_payment', [now(), now()->addDays($days)])
            ->with('lead')
            ->orderBy('estimated_payment', 'asc')
            ->get();
    }

    public function getUpcomingPaymentsByBroker(int $days, int $brokerId): Collection
    {
        return $this->model
            ->whereNotNull('estimated_payment')
            ->whereBetween('estimated_payment', [now(), now()->addDays($days)])
            ->whereHas('lead', function ($query) use ($brokerId) {
                $query->where('broker_id', $brokerId);
            })
            ->with('lead')
            ->orderBy('estimated_payment', 'asc')
            ->get();
    }

    public function getBirthdaysInMonth(int $month, int $year): Collection
    {
        return $this->model
            ->whereNotNull('birthday')
            ->whereMonth('birthday', $month)
            ->with('lead')
            ->orderByRaw('DAY(birthday) ASC')
            ->get();
    }

    public function getBirthdaysInMonthByBroker(int $month, int $year, int $brokerId): Collection
    {
        return $this->model
            ->whereNotNull('birthday')
            ->whereMonth('birthday', $month)
            ->whereHas('lead', function ($query) use ($brokerId) {
                $query->where('broker_id', $brokerId);
            })
            ->with('lead')
            ->orderByRaw('DAY(birthday) ASC')
            ->get();
    }

    public function getPeriodicContactsDue(): Collection
    {
        return $this->model
            ->whereNotNull('periodic_contact')
            ->where('periodic_contact', '<=', now())
            ->with('lead')
            ->orderBy('periodic_contact', 'asc')
            ->get();
    }

    public function getPeriodicContactsDueByBroker(int $brokerId): Collection
    {
        return $this->model
            ->whereNotNull('periodic_contact')
            ->where('periodic_contact', '<=', now())
            ->whereHas('lead', function ($query) use ($brokerId) {
                $query->where('broker_id', $brokerId);
            })
            ->with('lead')
            ->orderBy('periodic_contact', 'asc')
            ->get();
    }

    public function searchByPhone(string $phone): Collection
    {
        $cleanPhone = preg_replace('/[^0-9]/', '', $phone);

        return $this->model
            ->whereHas('lead', function ($query) use ($cleanPhone, $phone) {
                $query->where('phone', 'like', "%{$phone}%")
                    ->orWhere('phone', 'like', "%{$cleanPhone}%");
            })
            ->with('lead')
            ->get();
    }

    public function searchByPhoneAndBroker(string $phone, int $brokerId): Collection
    {
        $cleanPhone = preg_replace('/[^0-9]/', '', $phone);

        return $this->model
            ->whereHas('lead', function ($query) use ($cleanPhone, $phone, $brokerId) {
                $query->where('broker_id', $brokerId)
                    ->where(function ($q) use ($cleanPhone, $phone) {
                        $q->where('phone', 'like', "%{$phone}%")
                            ->orWhere('phone', 'like', "%{$cleanPhone}%");
                    });
            })
            ->with('lead')
            ->get();
    }

    public function searchByName(string $name): Collection
    {
        return $this->model
            ->whereHas('lead', function ($query) use ($name) {
                $query->where('name', 'like', "%{$name}%")
                    ->orWhere('corporateName', 'like', "%{$name}%");
            })
            ->with('lead')
            ->get();
    }

    public function searchByNameAndBroker(string $name, int $brokerId): Collection
    {
        return $this->model
            ->whereHas('lead', function ($query) use ($name, $brokerId) {
                $query->where('broker_id', $brokerId)
                    ->where(function ($q) use ($name) {
                        $q->where('name', 'like', "%{$name}%")
                            ->orWhere('corporateName', 'like', "%{$name}%");
                    });
            })
            ->with('lead')
            ->get();
    }
}

