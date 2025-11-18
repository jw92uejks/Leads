<?php

namespace App\Services;

use App\DTOs\EventDTO;
use App\Interfaces\EventRepositoryInterface;
use App\Models\Event;
use Carbon\Carbon;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;

class EventService
{
    public function __construct(
        private readonly EventRepositoryInterface $eventRepository
    ) {}

    public function createEvent(array $data): Event
    {
        $userId = $data['user_id'] ?? Auth::id();

        $eventDTO = EventDTO::fromArray([
            ...$data,
            'user_id' => $userId,
        ]);

        $this->validateEventTiming($eventDTO);
        $this->validateEventConflicts($eventDTO, null, $userId);

        return $this->eventRepository->create($eventDTO);
    }

    public function updateEvent(int $id, array $data): Event
    {
        $event = $this->getEventByUser($id);

        $eventDTO = EventDTO::fromArray([
            ...$data,
            'user_id' => $event->user_id,
        ]);

        $this->validateEventTiming($eventDTO);
        $this->validateEventConflicts($eventDTO, $id, Auth::id());

        return $this->eventRepository->update($id, $eventDTO);
    }

    public function deleteEvent(int $id): bool
    {
        $event = $this->getEventByUser($id);

        return $this->eventRepository->delete($id);
    }

    public function getEventByUser(int $id, ?int $userId = null): Event
    {
        $userId = $userId ?? Auth::id();
        $event = $this->eventRepository->findByUser($userId, $id);

        if (!$event) {
            throw new \InvalidArgumentException('Evento não encontrado.');
        }

        return $event;
    }

    public function getUserEvents(): array
    {
        return $this->eventRepository->getByUser(Auth::id());
    }

    public function getEventsInDateRange(Carbon $start, Carbon $end): array
    {
        return $this->eventRepository->getByDateRange(Auth::id(), $start, $end);
    }

    public function getEventsForFullCalendar(Carbon $start, Carbon $end): array
    {
        $events = $this->getEventsInDateRange($start, $end);

        return array_map(function ($event) {
            $eventDTO = EventDTO::fromArray($event);
            return $eventDTO->toFullCalendarFormat();
        }, $events);
    }

    public function getEventsForFullCalendarByUser(Carbon $start, Carbon $end, int $userId): array
    {
        $events = $this->eventRepository->getByDateRange($userId, $start, $end);

        return array_map(function ($event) {
            $eventDTO = EventDTO::fromArray($event);
            return $eventDTO->toFullCalendarFormat();
        }, $events);
    }

    public function getUpcomingEvents(int $limit = 10): array
    {
        return $this->eventRepository->getUpcoming(Auth::id(), $limit);
    }

    public function getEventsByStatus(string $status): array
    {
        return $this->eventRepository->getByStatus(Auth::id(), $status);
    }

    public function getEventsByType(string $type): array
    {
        return $this->eventRepository->getByType(Auth::id(), $type);
    }

    public function searchEvents(string $query): array
    {
        return $this->eventRepository->search(Auth::id(), $query);
    }

    public function paginateEvents(int $perPage = 15): LengthAwarePaginator
    {
        return $this->eventRepository->paginate(Auth::id(), $perPage);
    }

    public function markAsCompleted(int $id): Event
    {
        $event = $this->getEventByUser($id);

        $eventDTO = EventDTO::fromArray([
            ...$event->toArray(),
            'status' => 'completed',
        ]);

        return $this->eventRepository->update($id, $eventDTO);
    }

    public function markAsCompletedByUser(int $id, int $userId): Event
    {
        $event = $this->getEventByUser($id, $userId);

        $eventDTO = EventDTO::fromArray([
            ...$event->toArray(),
            'status' => 'completed',
        ]);

        return $this->eventRepository->update($id, $eventDTO);
    }

    public function markAsCancelled(int $id): Event
    {
        $event = $this->getEventByUser($id);

        $eventDTO = EventDTO::fromArray([
            ...$event->toArray(),
            'status' => 'cancelled',
        ]);

        return $this->eventRepository->update($id, $eventDTO);
    }

    public function markAsCancelledByUser(int $id, int $userId): Event
    {
        $event = $this->getEventByUser($id, $userId);

        $eventDTO = EventDTO::fromArray([
            ...$event->toArray(),
            'status' => 'cancelled',
        ]);

        return $this->eventRepository->update($id, $eventDTO);
    }

    public function updateEventByUser(int $id, array $data, int $userId): Event
    {
        $event = $this->getEventByUser($id, $userId);

        $eventDTO = EventDTO::fromArray([
            ...$data,
            'user_id' => $event->user_id,
        ]);

        $this->validateEventTiming($eventDTO);

        return $this->eventRepository->update($id, $eventDTO);
    }

    public function deleteEventByUser(int $id, int $userId): bool
    {
        $event = $this->getEventByUser($id, $userId);

        return $this->eventRepository->delete($id);
    }

    public function getTodayEvents(): array
    {
        $today = Carbon::today();
        $tomorrow = Carbon::tomorrow();

        return $this->getEventsInDateRange($today, $tomorrow);
    }

    public function getThisWeekEvents(): array
    {
        $startOfWeek = Carbon::now()->startOfWeek();
        $endOfWeek = Carbon::now()->endOfWeek();

        return $this->getEventsInDateRange($startOfWeek, $endOfWeek);
    }

    public function getMonthEvents(int $year, int $month): array
    {
        $startOfMonth = Carbon::create($year, $month, 1)->startOfMonth();
        $endOfMonth = Carbon::create($year, $month, 1)->endOfMonth();

        return $this->getEventsInDateRange($startOfMonth, $endOfMonth);
    }

    private function validateEventTiming(EventDTO $eventDTO): void
    {
        if ($eventDTO->endDate && $eventDTO->startDate->isAfter($eventDTO->endDate)) {
            throw new \InvalidArgumentException('A data de início deve ser anterior à data de fim.');
        }

        if ($eventDTO->startDate->isPast() && !$eventDTO->startDate->isToday()) {
            throw new \InvalidArgumentException('Não é possível criar eventos no passado.');
        }
    }

    private function validateEventConflicts(EventDTO $eventDTO, ?int $excludeEventId = null, ?int $userId = null): void
    {
        $userId = $userId ?? Auth::id();


        $conflictingEvents = $this->eventRepository->getByDateRange(
            $userId,
            $eventDTO->startDate,
            $eventDTO->endDate ?? $eventDTO->startDate
        );


        foreach ($conflictingEvents as $event) {
            // Skip the current event being updated
            if ($excludeEventId && (int)$event['id'] === (int)$excludeEventId) {
                continue;
            }

            // Skip cancelled events
            if ($event['status'] === 'cancelled') {
                continue;
            }

            $existingStart = Carbon::parse($event['start_date']);
            $existingEnd = $event['end_date'] ? Carbon::parse($event['end_date']) : $existingStart->copy()->addHour();

            $newStart = $eventDTO->startDate;
            $newEnd = $eventDTO->endDate ?? $eventDTO->startDate->copy()->addHour();

            // For all-day events, be more permissive - only conflict if exact same time
            if ($eventDTO->allDay && $event['all_day']) {
                // Allow multiple all-day events on the same day
                continue;
            }

            // Only check for strict time overlaps
            if ($this->eventsOverlap($newStart, $newEnd, $existingStart, $existingEnd)) {
                \Log::warning('EventService::validateEventConflicts - Conflito de horário detectado:', [
                    'updating_event_id' => $excludeEventId,
                    'conflicting_event_id' => $event['id'],
                    'new_start' => $newStart->toISOString(),
                    'new_end' => $newEnd->toISOString(),
                    'existing_start' => $existingStart->toISOString(),
                    'existing_end' => $existingEnd->toISOString(),
                    'new_all_day' => $eventDTO->allDay ?? false,
                    'existing_all_day' => $event['all_day'] ?? false,
                ]);
                throw new \InvalidArgumentException('Já existe um evento agendado neste horário.');
            }
        }
    }

    private function eventsOverlap(Carbon $start1, Carbon $end1, Carbon $start2, Carbon $end2): bool
    {
        // Events overlap if start1 is before end2 AND end1 is after start2
        // But we need to be careful with exact times (not equal)
        return $start1->lt($end2) && $end1->gt($start2);
    }
}
