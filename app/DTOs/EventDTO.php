<?php

namespace App\DTOs;

use Carbon\Carbon;

class EventDTO
{
    public function __construct(
        public readonly ?int $id,
        public readonly int $userId,
        public readonly string $title,
        public readonly ?string $description,
        public readonly Carbon $startDate,
        public readonly ?Carbon $endDate,
        public readonly bool $allDay,
        public readonly string $color,
        public readonly string $status,
        public readonly string $type,
        public readonly ?string $location,
        public readonly ?array $attendees,
        public readonly ?array $metadata,
        public readonly ?Carbon $createdAt,
        public readonly ?Carbon $updatedAt,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            id: $data['id'] ?? null,
            userId: $data['user_id'],
            title: $data['title'],
            description: $data['description'] ?? null,
            startDate: $data['start_date'] instanceof Carbon ? $data['start_date'] : Carbon::parse($data['start_date']),
            endDate: isset($data['end_date']) ?
                ($data['end_date'] instanceof Carbon ? $data['end_date'] : Carbon::parse($data['end_date'])) : null,
            allDay: $data['all_day'] ?? false,
            color: $data['color'] ?? '#3788d8',
            status: $data['status'] ?? 'scheduled',
            type: $data['type'] ?? 'appointment',
            location: $data['location'] ?? null,
            attendees: $data['attendees'] ?? null,
            metadata: $data['metadata'] ?? null,
            createdAt: isset($data['created_at']) ?
                ($data['created_at'] instanceof Carbon ? $data['created_at'] : Carbon::parse($data['created_at'])) : null,
            updatedAt: isset($data['updated_at']) ?
                ($data['updated_at'] instanceof Carbon ? $data['updated_at'] : Carbon::parse($data['updated_at'])) : null,
        );
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'user_id' => $this->userId,
            'title' => $this->title,
            'description' => $this->description,
            'start_date' => $this->startDate->toISOString(),
            'end_date' => $this->endDate?->toISOString(),
            'all_day' => $this->allDay,
            'color' => $this->color,
            'status' => $this->status,
            'type' => $this->type,
            'location' => $this->location,
            'attendees' => $this->attendees,
            'metadata' => $this->metadata,
            'created_at' => $this->createdAt?->toISOString(),
            'updated_at' => $this->updatedAt?->toISOString(),
        ];
    }

    public function toFullCalendarFormat(): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'start' => $this->startDate->format('Y-m-d H:i:s'),
            'end' => $this->endDate?->format('Y-m-d H:i:s'),
            'allDay' => $this->allDay,
            'color' => $this->color,
            'className' => "fc-event-{$this->status}",
            'extendedProps' => [
                'description' => $this->description,
                'status' => $this->status,
                'type' => $this->type,
                'location' => $this->location,
                'attendees' => $this->attendees,
                'metadata' => $this->metadata,
            ],
        ];
    }
}
