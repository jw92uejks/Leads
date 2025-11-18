<?php

namespace App\Models;

use App\Enums\Lead\LeadPricingType;
use App\Enums\Lead\LeadStatus;
use App\Enums\Lead\LeadTemperature;
use App\Enums\Lead\LeadType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\Log;

class Lead extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'corporateName',
        'phone',
        'email',
        'type',
        'cpf',
        'cnpj',
        'city',
        'state',
        'status',
        'source',
        'code',
        'isAutomation',
        'lifes',
        'acceptContestation',
        'temperature',
        'traking',
        'description',
        'startPrice',
        'currentPrice',
        'negotiatedPrice',
        'pricingType',
        'depreciationPercent',
        'depreciationInterval',
        'lead_expires_at',
        'acquired_at',
        'supplier_id',
        'broker_id',
        'responsible_id',
        'health_operator_id',
        'step'
    ];

    protected function casts(): array
    {
        return [
            'lead_expires_at' => 'datetime',
            'acquired_at' => 'datetime',
            'status' => LeadStatus::class,
            'pricingType' => LeadPricingType::class,
            'temperature' => LeadTemperature::class,
            'type' => LeadType::class,
            'currentPrice' => 'float',
            'startPrice' => 'float',
            'negotiatedPrice' => 'float',
            'isAutomation' => 'boolean',
            'acceptContestation' => 'boolean',
            'lifes' => 'integer',
            'depreciationPercent' => 'integer',
            'depreciationInterval' => 'integer',
            'step' => 'integer'
        ];
    }

    public function setPhoneAttribute(?string $value): void
    {
        $this->attributes['phone'] = \App\Helpers\PhoneHelper::toJid($value);
    }

    public function getPhoneFormattedAttribute(): ?string
    {
        return \App\Helpers\PhoneHelper::formatPhone($this->phone);
    }

    public function getPhoneJidAttribute(): ?string
    {
        return $this->phone;
    }

    public function supplier(): BelongsTo
    {
        return $this->belongsTo(Supplier::class);
    }

    public function broker(): BelongsTo
    {
        return $this->belongsTo(Broker::class)->with('user');
    }

    public function responsible(): BelongsTo
    {
        return $this->belongsTo(Broker::class, 'responsible_id')->with('user');
    }

    public function healthOperator(): BelongsTo
    {
        return $this->belongsTo(HealthOperator::class);
    }

    public function scopeCreatedBetween(Builder $query, $value) {

        if (empty($value)) {
            return $query;
        }

        $dates = explode(',', $value);
        $startDate = trim($dates[0] ?? '');
        $endDate = trim($dates[1] ?? $startDate);


        if (!$startDate || !preg_match('/^\d{4}-\d{2}-\d{2}$/', $startDate)) {
            Log::warning('Lead::scopeCreatedBetween - Data inicial inválida:', ['startDate' => $startDate]);
            return $query;
        }

        if (!$endDate || !preg_match('/^\d{4}-\d{2}-\d{2}$/', $endDate)) {
            Log::warning('Lead::scopeCreatedBetween - Data final inválida:', ['endDate' => $endDate]);
            return $query;
        }

        $startDateTime = $startDate . ' 00:00:00';
        $endDateTime = $endDate . ' 23:59:59';


        return $query->whereBetween('created_at', [$startDateTime, $endDateTime]);
    }

    public function scopeMovedBetween(Builder $query, $value) {
        if (empty($value)) {
            return $query;
        }

        $dates = explode(',', $value);
        $startDate = $dates[0] ?? null;
        $endDate = $dates[1] ?? $startDate;

        if ($startDate && $endDate) {
            return $query->whereHas('interactions', function ($q) use ($startDate, $endDate) {
                $q->whereBetween('created_at', [$startDate . ' 00:00:00', $endDate . ' 23:59:59']);
            });
        }

        return $query;
    }

    public function scopeDDD(Builder $query, $ddd) {
        $cleanDdd = preg_replace('/[^0-9]/', '', $ddd);

        if (empty($cleanDdd)) {
            return $query;
        }

        return $query->where('phone', 'like', '55' . $cleanDdd . '%');
    }

    public function scopeByPhone(Builder $query, string $phone)
    {
        $variations = \App\Helpers\PhoneHelper::searchVariations($phone);

        return $query->where(function($q) use ($variations) {
            foreach ($variations as $variation) {
                if (str_contains($variation, '%')) {
                    $q->orWhere('phone', 'like', $variation);
                } else {
                    $q->orWhere('phone', $variation);
                }
            }
        });
    }

    public function interactions(): HasMany
    {
        return $this->hasMany(LeadInteraction::class);
    }

    public function participants(): HasMany
    {
        return $this->hasMany(Participant::class);
    }

    public function automation(): HasOne
    {
        return $this->hasOne(LeadAutomation::class);
    }

    public function isOwnedByBroker(): bool
    {
        return !is_null($this->broker_id);
    }

    public function isOwnedBySupplier(): bool
    {
        return is_null($this->broker_id);
    }

    public function canTransferOwnership(User $user): bool
    {
        if ($this->isOwnedByBroker()) {
            return $user->broker && $user->broker->id === $this->broker_id;
        }

        if ($this->isOwnedBySupplier()) {
            return $user->supplier && $user->supplier->id === $this->supplier_id;
        }

        return false;
    }

    public function canDelegateResponsibility(User $user): bool
    {
        if ($this->isOwnedByBroker()) {
            return $user->broker && $user->broker->id === $this->broker_id;
        }

        return false;
    }

    public function getOriginSupplier(): ?Supplier
    {
        return $this->supplier;
    }

    public function getCurrentOwner(): mixed
    {
        return $this->broker ?? $this->supplier;
    }

    public function getCurrentResponsible(): ?Broker
    {
        return $this->responsible;
    }
}
