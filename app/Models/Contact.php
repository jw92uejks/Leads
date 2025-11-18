<?php

namespace App\Models;

use App\Enums\Contact\ContactStatus;
use App\Enums\Contact\ContactSource;
use App\Enums\Lead\LeadType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'broker_id',
        'supplier_id',
        'responsible_id',
        'health_operator_id',
        'type',
        'status',
        'cpf',
        'cnpj',
        'name',
        'corporateName',
        'phone',
        'email',
        'company',
        'city',
        'state',
        'step',
        'temperature',
        'source',
        'isAutomation',
        'lifes',
        'acceptContestation',
        'description',
        'startPrice',
        'currentPrice',
        'pricingType',
        'depreciationPercent',
        'depreciationInterval',
        'lead_expires_at',
        'acquired_at',
        'notes',
        'last_contact_at',
        'converted_at',
        'conversion_reason',
    ];

    protected $casts = [
        'last_contact_at' => 'datetime',
        'lead_expires_at' => 'datetime',
        'acquired_at' => 'datetime',
        'converted_at' => 'datetime',
        'status' => ContactStatus::class,
        'source' => ContactSource::class,
        'type' => LeadType::class,
        'step' => 'integer',
        'isAutomation' => 'boolean',
        'acceptContestation' => 'boolean',
        'startPrice' => 'decimal:2',
        'currentPrice' => 'decimal:2',
        'lifes' => 'integer',
        'depreciationPercent' => 'integer',
        'depreciationInterval' => 'integer',
    ];

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

    public function scopeByPhone($query, string $phone)
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

    public function broker(): BelongsTo
    {
        return $this->belongsTo(Broker::class);
    }

    public function supplier(): BelongsTo
    {
        return $this->belongsTo(Supplier::class);
    }

    public function responsible(): BelongsTo
    {
        return $this->belongsTo(User::class, 'responsible_id');
    }

    public function healthOperator(): BelongsTo
    {
        return $this->belongsTo(HealthOperator::class);
    }
}
