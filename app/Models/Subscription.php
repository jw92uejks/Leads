<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Subscription extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'durationDays',
        'isActive',
        'plan_type',
        'features',
        'max_team_members',
        'has_team_access',
        'has_enterprise_access',
        'stripe_product_id',
        'stripe_price_id',
        'last_synced_at'
    ];

    protected $casts = [
        'features' => 'array',
        'has_team_access' => 'boolean',
        'has_enterprise_access' => 'boolean',
        'last_synced_at' => 'datetime',
    ];

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    public function brokers(): HasMany
    {
        return $this->hasMany(Broker::class);
    }

    public function paymentLinks(): HasMany
    {
        return $this->hasMany(\App\Models\PaymentLink::class);
    }

    public function isSyncedWithStripe(): bool
    {
        return !is_null($this->stripe_product_id) && !is_null($this->stripe_price_id);
    }

    public function markAsSynced(): void
    {
        $this->update(['last_synced_at' => now()]);
    }
}
