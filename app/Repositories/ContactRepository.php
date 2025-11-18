<?php

namespace App\Repositories;

use App\Interfaces\ContactRepositoryInterface;
use App\Models\Contact;
use App\Models\Lead;
use App\Enums\Lead\LeadStatus;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class ContactRepository extends AbstractRepository implements ContactRepositoryInterface
{
    protected static $model = Contact::class;

    public static function getByBroker(int $brokerId, array $filters = [], int $perPage = 10): LengthAwarePaginator
    {
        $query = static::loadModel()::query()->where('broker_id', $brokerId);

        if (isset($filters['per_page']) && is_numeric($filters['per_page'])) {
            $perPage = (int) $filters['per_page'];
        }

        return static::applyFilters($query, $filters)->paginate($perPage);
    }

    public static function getBySupplier(int $supplierId, array $filters = [], int $perPage = 10): LengthAwarePaginator
    {
        $query = static::loadModel()::query()->where('supplier_id', $supplierId);

        if (isset($filters['per_page']) && is_numeric($filters['per_page'])) {
            $perPage = (int) $filters['per_page'];
        }

        return static::applyFilters($query, $filters)->paginate($perPage);
    }

    public static function scopeByBroker($query, int $brokerId)
    {
        return $query->where('broker_id', $brokerId);
    }

    public static function scopeBySupplier($query, int $supplierId)
    {
        return $query->where('supplier_id', $supplierId);
    }

    public static function scopeByStatus($query, string $status)
    {
        return $query->where('status', $status);
    }

    public static function scopeBySource($query, string $source)
    {
        return $query->where('source', $source);
    }

    public static function scopeSearch($query, string $search)
    {
        return $query->where(function ($q) use ($search) {
            $q->where('name', 'like', "%{$search}%")
              ->orWhere('email', 'like', "%{$search}%")
              ->orWhere('company', 'like', "%{$search}%")
              ->orWhere('corporateName', 'like', "%{$search}%");

            if (preg_match('/^[0-9]+$/', $search)) {
                Contact::scopeByPhone($q, $search);
            }
        });
    }

    public static function findById(int $id): ?Contact
    {
        return static::loadModel()::find($id);
    }

    public static function create(array $data): Contact
    {
        return static::loadModel()::create($data);
    }

    public static function update(int $id, array $data): bool
    {
        $contact = static::findById($id);

        if (!$contact) {
            return false;
        }

        try {
            $updated = $contact->update($data);
            return $updated;
        } catch (\Exception $e) {
            \Log::error('Erro ao atualizar contato: ' . $e->getMessage());
            return false;
        }
    }

    public static function delete(int $id): bool
    {
        $contact = static::findById($id);

        if (!$contact) {
            return false;
        }

        try {
            $deleted = $contact->delete();
            return $deleted;
        } catch (\Exception $e) {
            \Log::error('Erro ao deletar contato: ' . $e->getMessage());
            return false;
        }
    }

    public static function importFromLeads(array $leadIds, int $brokerId = null, int $supplierId = null): bool
    {
        try {
            $leads = Lead::whereIn('id', $leadIds)->get();
            $imported = 0;

            foreach ($leads as $lead) {
                $contactData = [
                    'name' => $lead->name ?? $lead->corporateName,
                    'email' => $lead->email,
                    'phone' => $lead->phone,
                    'company' => $lead->corporateName,
                    'city' => $lead->city,
                    'state' => $lead->state,
                    'source' => 'lead_funnel',
                    'status' => 'active',
                    'notes' => "Importado do lead #{$lead->id} - {$lead->status?->label()}",
                    'broker_id' => $brokerId ?? $lead->broker_id,
                    'supplier_id' => $supplierId ?? $lead->supplier_id,
                ];

                if (!static::contactExists($contactData['email'], $brokerId, $supplierId)) {
                    static::create($contactData);
                    $imported++;
                }
            }

            return $imported > 0;
        } catch (\Exception $e) {
            return false;
        }
    }

    public static function bulkImport(array $contacts, int $brokerId = null, int $supplierId = null): bool
    {
        try {
            $imported = 0;

            foreach ($contacts as $contactData) {
                $contactData['broker_id'] = $brokerId;
                $contactData['supplier_id'] = $supplierId;
                $contactData['source'] = 'import';

                if (!static::contactExists($contactData['email'], $brokerId, $supplierId)) {
                    static::create($contactData);
                    $imported++;
                }
            }

            return $imported > 0;
        } catch (\Exception $e) {
            return false;
        }
    }

    public static function getLeadsForImport(int $brokerId = null, int $supplierId = null): Collection
    {
        $query = Lead::query();

        if ($brokerId) {
            $query->where('broker_id', $brokerId);
        } elseif ($supplierId) {
            $query->where('supplier_id', $supplierId);
        }

        return $query->where('status', 'available')
            ->select('id', 'name', 'corporateName', 'email', 'phone', 'city', 'state', 'status')
            ->get();
    }

    public static function updateLastContact(int $id): bool
    {
        $contact = static::findById($id);

        if (!$contact) {
            return false;
        }

        try {
            $contact->update(['last_contact_at' => now()]);
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    public static function getStats(int $brokerId = null, int $supplierId = null): array
    {
        $query = static::loadModel()::query();

        if ($brokerId) {
            $query->where('broker_id', $brokerId);
        } elseif ($supplierId) {
            $query->where('supplier_id', $supplierId);
        }

        $total = $query->count();
        $active = (clone $query)->where('status', 'active')->count();
        $inactive = (clone $query)->where('status', 'inactive')->count();
        $converted = (clone $query)->whereNotNull('converted_at')->count();

        return [
            'total' => $total,
            'active' => $active,
            'inactive' => $inactive,
            'converted' => $converted,
        ];
    }

    public static function convertToLead(int $contactId, string $reason = null): bool
    {
        $contact = static::findById($contactId);

        if (!$contact) {
            return false;
        }

        try {
            DB::beginTransaction();

            $leadData = [
                'name' => $contact->name,
                'email' => $contact->email,
                'phone' => $contact->phone,
                'corporateName' => $contact->company,
                'city' => $contact->city,
                'state' => $contact->state,
                'status' => 'available',
                'step' => 1,
                'source' => 'contact_base',
                'broker_id' => $contact->broker_id,
                'supplier_id' => $contact->supplier_id,
            ];

            Lead::create($leadData);

            $contact->update([
                'status' => 'inactive',
                'converted_at' => now(),
                'conversion_reason' => $reason
            ]);

            DB::commit();
            return true;

        } catch (\Exception $e) {
            DB::rollBack();
            return false;
        }
    }

    public static function convertLeadToContact(Lead $lead, string $reason = 'Transferido'): Contact
    {
        try {
            DB::beginTransaction();

            $contactData = [
                'code' => 'CONT' . str_pad(Contact::count() + 1, 3, '0', STR_PAD_LEFT),
                'broker_id' => $lead->broker_id,
                'supplier_id' => $lead->supplier_id,
                'responsible_id' => $lead->responsible_id,
                'health_operator_id' => $lead->health_operator_id,
                'type' => $lead->type,
                'status' => 'converted',
                'cpf' => $lead->cpf,
                'cnpj' => $lead->cnpj,
                'name' => $lead->name,
                'corporateName' => $lead->corporateName,
                'phone' => $lead->phone,
                'email' => $lead->email,
                'company' => $lead->corporateName,
                'city' => $lead->city,
                'state' => $lead->state,
                'step' => $lead->step,
                'temperature' => $lead->temperature ?? 'warm',
                'source' => static::mapLeadSourceToContactSource($lead->source),
                'isAutomation' => $lead->isAutomation,
                'lifes' => $lead->lifes,
                'acceptContestation' => $lead->acceptContestation,
                'description' => $lead->description,
                'startPrice' => $lead->startPrice,
                'currentPrice' => $lead->currentPrice,
                'pricingType' => $lead->pricingType,
                'depreciationPercent' => $lead->depreciationPercent,
                'depreciationInterval' => $lead->depreciationInterval,
                'lead_expires_at' => $lead->lead_expires_at,
                'acquired_at' => $lead->acquired_at,
                'notes' => "Convertido do lead #{$lead->id} - {$reason}",
                'last_contact_at' => now(),
                'converted_at' => now(),
                'conversion_reason' => $reason,
            ];

            $contact = static::create($contactData);

            $lead->delete();

            DB::commit();
            return $contact;

        } catch (\Exception $e) {
            DB::rollBack();
            throw new \Exception('Erro ao converter lead para contato: ' . $e->getMessage());
        }
    }

    private static function applyFilters($query, array $filters)
    {
        if (isset($filters['search']) && !empty($filters['search'])) {
            $searchTerm = trim($filters['search']);
            $query = $query->where(function ($q) use ($searchTerm) {
                $q->where('name', 'like', "%{$searchTerm}%")
                  ->orWhere('email', 'like', "%{$searchTerm}%")
                  ->orWhere('company', 'like', "%{$searchTerm}%")
                  ->orWhere('corporateName', 'like', "%{$searchTerm}%");

                if (preg_match('/^[0-9]+$/', $searchTerm)) {
                    $q->orWhereHas('phone', function($phoneQuery) use ($searchTerm) {
                        Contact::scopeByPhone($phoneQuery, $searchTerm);
                    });
                }
            });
        }

        if (isset($filters['search_field']) && !empty($filters['search_field'])) {
            switch (strtolower($filters['search_field'])) {
                case 'pj':
                    $query->where('type', 2);
                    break;
                case 'pf':
                    $query->where('type', 1);
                    break;
                case 'adesão':
                    $query->where('type', 3);
                    break;
            }
        }

        if (isset($filters['status']) && !empty($filters['status'])) {
            $query = static::scopeByStatus($query, $filters['status']);
        }

        if (isset($filters['source']) && !empty($filters['source'])) {
            $query = static::scopeBySource($query, $filters['source']);
        }

        if (isset($filters['date_from']) && !empty($filters['date_from'])) {
            $query->whereDate('created_at', '>=', $filters['date_from']);
        }

        if (isset($filters['date_to']) && !empty($filters['date_to'])) {
            $query->whereDate('created_at', '<=', $filters['date_to']);
        }

        if (isset($filters['sort_by'])) {
            $direction = $filters['sort_direction'] ?? 'desc';
            $query->orderBy($filters['sort_by'], $direction);
        } else {
            $query->orderBy('id', 'desc');
        }

        return $query;
    }

    private static function contactExists(string $email, ?int $brokerId, ?int $supplierId): bool
    {
        $query = static::loadModel()::query()->where('email', $email);

        if ($brokerId) {
            $query->where('broker_id', $brokerId);
        }

        if ($supplierId) {
            $query->where('supplier_id', $supplierId);
        }

        return $query->exists();
    }

    private static function mapLeadSourceToContactSource(?string $leadSource): string
    {
        if (!$leadSource) {
            return 'lead_conversion';
        }

        $sourceMap = [
            'Google Ads' => 'google_ads',
            'Facebook' => 'facebook',
            'Indicação' => 'indicacao',
            'LinkedIn' => 'linkedin',
            'Instagram' => 'instagram',
            'Site' => 'site',
            'Outros' => 'outros',
            'manual' => 'manual',
            'lead_funnel' => 'lead_funnel',
            'import' => 'import',
            'api' => 'api',
            'lead_conversion' => 'lead_conversion',
        ];

        return $sourceMap[$leadSource] ?? 'lead_conversion';
    }
}
