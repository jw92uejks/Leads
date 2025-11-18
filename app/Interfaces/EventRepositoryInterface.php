<?php

namespace App\Interfaces;

use App\DTOs\EventDTO;
use App\Models\Event;
use Carbon\Carbon;
use Illuminate\Pagination\LengthAwarePaginator;

interface EventRepositoryInterface
{
    public function find(int $id): ?Event;

    public function findByUser(int $userId, int $id): ?Event;

    public function create(EventDTO $eventDTO): Event;

    public function update(int $id, EventDTO $eventDTO): Event;

    public function delete(int $id): bool;

    public function getByUser(int $userId): array;

    public function getByDateRange(int $userId, Carbon $start, Carbon $end): array;

    public function getUpcoming(int $userId, int $limit = 10): array;

    public function getByStatus(int $userId, string $status): array;

    public function getByType(int $userId, string $type): array;

    public function paginate(int $userId, int $perPage = 15): LengthAwarePaginator;

    public function search(int $userId, string $query): array;
}
