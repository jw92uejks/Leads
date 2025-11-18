<?php

namespace App\Services;

use App\DTOs\EventDTO;
use App\Interfaces\EventRepositoryInterface;
use App\Models\Event;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Pagination\LengthAwarePaginator;

class EventApiService
{
    public function __construct(
        private readonly EventRepositoryInterface $eventRepository
    ) {}

    public function createEventForBroker(array $data, User $user): Event
    {
        $eventDTO = EventDTO::fromArray([
            ...$data,
            'user_id' => $user->id,
        ]);

        $this->validateEventTiming($eventDTO);
        $this->validateEventConflicts($eventDTO, $user->id);

        return $this->eventRepository->create($eventDTO);
    }

    public function updateEventForBroker(int $id, array $data, User $user): Event
    {
        $event = $this->getEventByBroker($id, $user);

        $eventDTO = EventDTO::fromArray([
            ...$data,
            'user_id' => $user->id,
        ]);

        $this->validateEventTiming($eventDTO);
        $this->validateEventConflicts($eventDTO, $user->id, $id);

        return $this->eventRepository->update($id, $eventDTO);
    }

    public function deleteEventForBroker(int $id, User $user): bool
    {
        $this->getEventByBroker($id, $user);
        return $this->eventRepository->delete($id);
    }

    public function getEventByBroker(int $id, User $user): Event
    {
        $event = $this->eventRepository->findByUser($user->id, $id);

        if (!$event) {
            throw new \Exception('Event not found or does not belong to this broker');
        }

        return $event;
    }

    public function getBrokerEvents(User $user, array $filters = []): LengthAwarePaginator
    {
        $perPage = $filters['per_page'] ?? 15;
        $page = $filters['page'] ?? 1;

        if (isset($filters['start_date']) && isset($filters['end_date'])) {
            $events = $this->eventRepository->getByDateRange(
                $user->id,
                Carbon::parse($filters['start_date']),
                Carbon::parse($filters['end_date'])
            );

            $total = count($events);
            $offset = ($page - 1) * $perPage;
            $items = array_slice($events, $offset, $perPage);

            return new LengthAwarePaginator(
                $items,
                $total,
                $perPage,
                $page,
                ['path' => request()->url()]
            );
        }

        if (isset($filters['status'])) {
            $events = $this->eventRepository->getByStatus($user->id, $filters['status']);

            $total = count($events);
            $offset = ($page - 1) * $perPage;
            $items = array_slice($events, $offset, $perPage);

            return new LengthAwarePaginator(
                $items,
                $total,
                $perPage,
                $page,
                ['path' => request()->url()]
            );
        }

        if (isset($filters['type'])) {
            $events = $this->eventRepository->getByType($user->id, $filters['type']);

            $total = count($events);
            $offset = ($page - 1) * $perPage;
            $items = array_slice($events, $offset, $perPage);

            return new LengthAwarePaginator(
                $items,
                $total,
                $perPage,
                $page,
                ['path' => request()->url()]
            );
        }

        return $this->eventRepository->paginate($user->id, $perPage);
    }

    public function getUpcomingEventsForBroker(User $user, int $limit = 10): array
    {
        return $this->eventRepository->getUpcoming($user->id, $limit);
    }

    public function markEventAsCompleted(int $id, User $user): Event
    {
        $event = $this->getEventByBroker($id, $user);

        $eventDTO = EventDTO::fromArray([
            ...$event->toArray(),
            'status' => 'completed',
        ]);

        return $this->eventRepository->update($id, $eventDTO);
    }

    public function markEventAsCancelled(int $id, User $user): Event
    {
        $event = $this->getEventByBroker($id, $user);

        $eventDTO = EventDTO::fromArray([
            ...$event->toArray(),
            'status' => 'cancelled',
        ]);

        return $this->eventRepository->update($id, $eventDTO);
    }

    public function getBrokerTodayEvents(User $user): array
    {
        $today = Carbon::today();
        $tomorrow = Carbon::tomorrow();

        return $this->eventRepository->getByDateRange($user->id, $today, $tomorrow);
    }

    public function getBrokerThisWeekEvents(User $user): array
    {
        $startOfWeek = Carbon::now()->startOfWeek();
        $endOfWeek = Carbon::now()->endOfWeek();

        return $this->eventRepository->getByDateRange($user->id, $startOfWeek, $endOfWeek);
    }

    public function getBrokerMonthEvents(User $user, int $year, int $month): array
    {
        $startOfMonth = Carbon::create($year, $month, 1)->startOfMonth();
        $endOfMonth = Carbon::create($year, $month, 1)->endOfMonth();

        return $this->eventRepository->getByDateRange($user->id, $startOfMonth, $endOfMonth);
    }

    private function validateEventTiming(EventDTO $eventDTO): void
    {
        if ($eventDTO->endDate && $eventDTO->startDate->isAfter($eventDTO->endDate)) {
            throw new \Exception('Start date must be before end date');
        }

        if ($eventDTO->startDate->isPast() && !$eventDTO->startDate->isToday()) {
            throw new \Exception('Cannot create events in the past');
        }
    }

    private function validateEventConflicts(EventDTO $eventDTO, int $userId, ?int $excludeEventId = null): void
    {
        $conflictingEvents = $this->eventRepository->getByDateRange(
            $userId,
            $eventDTO->startDate,
            $eventDTO->endDate ?? $eventDTO->startDate
        );

        foreach ($conflictingEvents as $event) {
            if ($excludeEventId && $event['id'] === $excludeEventId) {
                continue;
            }

            if ($event['status'] === 'cancelled') {
                continue;
            }

            $existingStart = Carbon::parse($event['start_date']);
            $existingEnd = $event['end_date'] ? Carbon::parse($event['end_date']) : $existingStart->copy()->addHour();

            if ($this->eventsOverlap($eventDTO->startDate, $eventDTO->endDate ?? $eventDTO->startDate->copy()->addHour(), $existingStart, $existingEnd)) {
                throw new \Exception('There is already an event scheduled at this time');
            }
        }
    }

    private function eventsOverlap(Carbon $start1, Carbon $end1, Carbon $start2, Carbon $end2): bool
    {
        return $start1->isBefore($end2) && $end1->isAfter($start2);
    }

    public function getWeekEvents(User $user, int $year, int $week): array
    {
        $startOfWeek = Carbon::now()->setISODate($year, $week)->startOfWeek();
        $endOfWeek = Carbon::now()->setISODate($year, $week)->endOfWeek();

        return $this->eventRepository->getByDateRange($user->id, $startOfWeek, $endOfWeek);
    }

    public function getMonthEvents(User $user, int $year, int $month): array
    {
        $startOfMonth = Carbon::create($year, $month, 1)->startOfMonth();
        $endOfMonth = Carbon::create($year, $month, 1)->endOfMonth();

        return $this->eventRepository->getByDateRange($user->id, $startOfMonth, $endOfMonth);
    }

    public function searchEvents(User $user, string $query): array
    {
        return $this->eventRepository->search($user->id, $query);
    }

    public function getAvailableSlots(User $user, Carbon $date, int $slotDuration = 60): array
    {
        $startOfDay = $date->copy()->startOfDay()->addHours(8);
        $endOfDay = $date->copy()->startOfDay()->addHours(18);

        $existingEvents = $this->eventRepository->getByDateRange($user->id, $startOfDay, $endOfDay);

        $availableSlots = [];
        $currentSlot = $startOfDay->copy();

        while ($currentSlot->isBefore($endOfDay)) {
            $slotEnd = $currentSlot->copy()->addMinutes($slotDuration);

            $isAvailable = true;
            foreach ($existingEvents as $event) {
                if ($event['status'] === 'cancelled') {
                    continue;
                }

                $eventStart = Carbon::parse($event['start_date']);
                $eventEnd = $event['end_date'] ? Carbon::parse($event['end_date']) : $eventStart->copy()->addHour();

                if ($this->eventsOverlap($currentSlot, $slotEnd, $eventStart, $eventEnd)) {
                    $isAvailable = false;
                    break;
                }
            }

            if ($isAvailable) {
                $availableSlots[] = [
                    'start' => $currentSlot->toISOString(),
                    'end' => $slotEnd->toISOString(),
                    'duration_minutes' => $slotDuration
                ];
            }

            $currentSlot->addMinutes($slotDuration);
        }

        return $availableSlots;
    }

    public function bulkCreateEvents(array $events, User $user): array
    {
        $createdEvents = [];
        $errors = [];

        foreach ($events as $index => $eventData) {
            try {
                $eventDTO = EventDTO::fromArray([
                    ...$eventData,
                    'user_id' => $user->id,
                ]);

                $this->validateEventTiming($eventDTO);
                $this->validateEventConflicts($eventDTO, $user->id);

                $createdEvent = $this->eventRepository->create($eventDTO);
                $createdEvents[] = $createdEvent;

            } catch (\Exception $e) {
                $errors[] = [
                    'index' => $index,
                    'data' => $eventData,
                    'error' => $e->getMessage()
                ];
            }
        }

        return [
            'created' => $createdEvents,
            'errors' => $errors,
            'total_requested' => count($events),
            'total_created' => count($createdEvents),
            'total_errors' => count($errors)
        ];
    }
}
