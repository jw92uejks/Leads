<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Carbon\Carbon;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'description',
        'start_date',
        'end_date',
        'all_day',
        'color',
        'status',
        'type',
        'location',
        'attendees',
        'metadata',
    ];

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
        'all_day' => 'boolean',
        'attendees' => 'array',
        'metadata' => 'array',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function scopeForUser($query, int $userId)
    {
        return $query->where('user_id', $userId);
    }

    public function scopeInDateRange($query, Carbon $start, Carbon $end)
    {
        return $query->where(function ($q) use ($start, $end) {
            $q->whereBetween('start_date', [$start, $end])
              ->orWhereBetween('end_date', [$start, $end])
              ->orWhere(function ($q2) use ($start, $end) {
                  $q2->where('start_date', '<=', $start)
                     ->where('end_date', '>=', $end);
              });
        });
    }

    public function scopeByStatus($query, string $status)
    {
        return $query->where('status', $status);
    }

    public function scopeByType($query, string $type)
    {
        return $query->where('type', $type);
    }

    public function isCompleted(): bool
    {
        return $this->status === 'completed';
    }

    public function isCancelled(): bool
    {
        return $this->status === 'cancelled';
    }

    public function isScheduled(): bool
    {
        return $this->status === 'scheduled';
    }

    public function isPast(): bool
    {
        return $this->start_date->isPast();
    }

    public function isToday(): bool
    {
        return $this->start_date->isToday();
    }

    public function getDurationInMinutes(): int
    {
        if (!$this->end_date) {
            return 60;
        }

        return $this->start_date->diffInMinutes($this->end_date);
    }

    public function getFormattedDateRange(): string
    {
        if ($this->all_day) {
            return $this->start_date->format('d/m/Y');
        }

        if ($this->end_date && !$this->start_date->isSameDay($this->end_date)) {
            return $this->start_date->format('d/m/Y H:i') . ' - ' . $this->end_date->format('d/m/Y H:i');
        }

        if ($this->end_date) {
            return $this->start_date->format('d/m/Y H:i') . ' - ' . $this->end_date->format('H:i');
        }

        return $this->start_date->format('d/m/Y H:i');
    }
}