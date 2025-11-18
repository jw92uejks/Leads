<?php

namespace App\Services;

use App\Models\Lead;
use App\Models\Supplier;
use App\Enums\Lead\LeadStatus;
use App\Enums\SupplierStatus;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;

class MarketplaceService
{
    public function getApprovedSuppliersWithLeads()
    {
        return Supplier::where('status', SupplierStatus::APPROVED)
            ->whereHas('leads', function ($query) {
                $query->where('status', LeadStatus::AVAILABLE);
            })
            ->with('leads')
            ->withMin('leads', 'currentPrice')
            ->withMax('leads', 'currentPrice')
            ->withCount('leads')
            ->get();
    }

    public function getSupplierLeads(int $supplierId, array $filters = []): LengthAwarePaginator
    {
        $query = Lead::where('supplier_id', $supplierId)
            ->where('status', LeadStatus::AVAILABLE)
            ->with(['healthOperator']);

        $this->applyFilters($query, $filters);
        $this->applySorting($query, $filters['sort'] ?? 'newest');

        return $query->paginate(18);
    }

    private function applyFilters(Builder $query, array $filters): void
    {
        if (!empty($filters['search'])) {
            $search = $filters['search'];
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('corporateName', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        if (!empty($filters['lead_type'])) {
            $query->where('type', $filters['lead_type']);
        }

        if (!empty($filters['ddd'])) {
            $query->DDD($filters['ddd']);
        }

        if (!empty($filters['operadora'])) {
            $query->whereHas('healthOperator', function($q) use ($filters) {
                $q->where('name', 'like', "%{$filters['operadora']}%");
            });
        }

        if (!empty($filters['price_range'])) {
            $this->applyPriceFilter($query, $filters['price_range']);
        }

        if (!empty($filters['date_range'])) {
            $this->applyDateFilter($query, $filters['date_range']);
        }
    }

    private function applyPriceFilter(Builder $query, string $priceRange): void
    {
        $range = explode('-', $priceRange);
        if (count($range) === 2) {
            $query->whereBetween('currentPrice', [$range[0], $range[1]]);
        } elseif ($priceRange === '1000+') {
            $query->where('currentPrice', '>=', 1000);
        }
    }

    private function applyDateFilter(Builder $query, string $dateRange): void
    {
        switch ($dateRange) {
            case 'today':
                $query->whereDate('created_at', today());
                break;
            case 'week':
                $query->where('created_at', '>=', now()->subWeek());
                break;
            case 'month':
                $query->where('created_at', '>=', now()->subMonth());
                break;
            case '3months':
                $query->where('created_at', '>=', now()->subMonths(3));
                break;
        }
    }

    private function applySorting(Builder $query, string $sort): void
    {
        switch ($sort) {
            case 'oldest':
                $query->orderBy('created_at', 'asc');
                break;
            case 'price_asc':
                $query->orderBy('currentPrice', 'asc');
                break;
            case 'price_desc':
                $query->orderBy('currentPrice', 'desc');
                break;
            default:
                $query->orderBy('created_at', 'desc');
                break;
        }
    }
}