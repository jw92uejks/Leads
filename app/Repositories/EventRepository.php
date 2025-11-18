<?php

namespace App\Repositories;

use App\DTOs\EventDTO;
use App\Interfaces\EventRepositoryInterface;
use App\Models\Event;
use Carbon\Carbon;
use Illuminate\Pagination\LengthAwarePaginator;

class EventRepository implements EventRepositoryInterface
{
    public function find(int $id): ?Event
    {
        return Event::find($id);
    }

    public function findByUser(int $userId, int $id): ?Event
    {
        return Event::forUser($userId)->find($id);
    }

    public function create(EventDTO $eventDTO): Event
    {
        return Event::create([
            'user_id' => $eventDTO->userId,
            'title' => $eventDTO->title,
            'description' => $eventDTO->description,
            'start_date' => $eventDTO->startDate,
            'end_date' => $eventDTO->endDate,
            'all_day' => $eventDTO->allDay,
            'color' => $eventDTO->color,
            'status' => $eventDTO->status,
            'type' => $eventDTO->type,
            'location' => $eventDTO->location,
            'attendees' => $eventDTO->attendees,
            'metadata' => $eventDTO->metadata,
        ]);
    }

    public function update(int $id, EventDTO $eventDTO): Event
    {
        $event = Event::findOrFail($id);

        $event->update([
            'title' => $eventDTO->title,
            'description' => $eventDTO->description,
            'start_date' => $eventDTO->startDate,
            'end_date' => $eventDTO->endDate,
            'all_day' => $eventDTO->allDay,
            'color' => $eventDTO->color,
            'status' => $eventDTO->status,
            'type' => $eventDTO->type,
            'location' => $eventDTO->location,
            'attendees' => $eventDTO->attendees,
            'metadata' => $eventDTO->metadata,
        ]);

        return $event->fresh();
    }

    public function delete(int $id): bool
    {
        $event = Event::find($id);

        if (!$event) {
            return false;
        }

        return $event->delete();
    }

    public function getByUser(int $userId): array
    {
        return Event::forUser($userId)
            ->orderBy('start_date')
            ->get()
            ->toArray();
    }

    public function getByDateRange(int $userId, Carbon $start, Carbon $end): array
    {
        return Event::forUser($userId)
            ->inDateRange($start, $end)
            ->orderBy('start_date')
            ->get()
            ->toArray();
    }

    public function getUpcoming(int $userId, int $limit = 10): array
    {
        return Event::forUser($userId)
            ->where('start_date', '>=', now())
            ->byStatus('scheduled')
            ->orderBy('start_date')
            ->limit($limit)
            ->get()
            ->toArray();
    }

    public function getByStatus(int $userId, string $status): array
    {
        return Event::forUser($userId)
            ->byStatus($status)
            ->orderBy('start_date')
            ->get()
            ->toArray();
    }

    public function getByType(int $userId, string $type): array
    {
        return Event::forUser($userId)
            ->byType($type)
            ->orderBy('start_date')
            ->get()
            ->toArray();
    }

    public function paginate(int $userId, int $perPage = 15): LengthAwarePaginator
    {
        return Event::forUser($userId)
            ->orderBy('start_date', 'desc')
            ->paginate($perPage);
    }

    public function search(int $userId, string $query): array
    {
        return Event::forUser($userId)
            ->where(function ($q) use ($query) {
                $q->where('title', 'LIKE', "%{$query}%")
                  ->orWhere('description', 'LIKE', "%{$query}%")
                  ->orWhere('location', 'LIKE', "%{$query}%");
            })
            ->orderBy('start_date')
            ->get()
            ->toArray();
    }
}
