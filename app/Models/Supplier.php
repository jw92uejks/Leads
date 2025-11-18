<?php

namespace App\Models;

use App\Enums\SupplierStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Supplier extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'cnpj',
        'classification',
        'phone',
        'city',
        'state',
        'stateRegistration',
        'rating',
        'lgpdTerm',
        'status',
        'approval_date_at',
    ];

    protected function casts(): array
    {
        return [
            'lgpdTerm' => 'boolean',
            'approval_date_at' => 'datetime',
            'status' => SupplierStatus::class
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

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function leads(): HasMany
    {
        return $this->hasMany(Lead::class);
    }
}
