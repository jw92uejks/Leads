<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Broker extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'subscription_id',
        'plan_type',
        'is_active',
        'subscription_expires_at',
    ];

    protected function casts(): array
    {
        return [
            'plan_type' => \App\Enums\PlanType::class,
            'is_active' => 'boolean',
            'subscription_expires_at' => 'datetime',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function subscription(): BelongsTo
    {
        return $this->belongsTo(Subscription::class);
    }

    public function team(): HasOneThrough {
        return $this->hasOneThrough(
            Team::class,           // Model final
            TeamMember::class,     // Model intermediário
            'broker_id',           // FK em member_team apontando pro broker
            'id',                  // FK em team (normalmente id)
            'id',                  // PK do broker
            'team_id'              // FK em member_team apontando pro team
        );
    }

    public function leads(): HasMany
    {
        return $this->hasMany(Lead::class);
    }
}
