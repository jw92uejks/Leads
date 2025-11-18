<?php

namespace App\Interfaces;

use App\Models\Contact;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

interface ContactRepositoryInterface
{
    public static function getByBroker(int $brokerId, array $filters = [], int $perPage = 10): LengthAwarePaginator;

    public static function getBySupplier(int $supplierId, array $filters = [], int $perPage = 10): LengthAwarePaginator;

    public static function findById(int $id): ?Contact;

    public static function create(array $data): Contact;

    public static function update(int $id, array $data): bool;

    public static function delete(int $id): bool;

    public static function importFromLeads(array $leadIds, int $brokerId = null, int $supplierId = null): bool;

    public static function bulkImport(array $contacts, int $brokerId = null, int $supplierId = null): bool;

    public static function getLeadsForImport(int $brokerId = null, int $supplierId = null): Collection;

    public static function updateLastContact(int $id): bool;

    public static function getStats(int $brokerId = null, int $supplierId = null): array;
}
