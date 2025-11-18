<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WhatsAppTokenCache extends Model
{
    protected $table = 'whatsapp_token_cache';

    protected $fillable = [
        'user_id',
        'personal_access_token_id',
        'encoded_token',
        'expires_at',
        'is_blocked',
        'blocked_reason',
    ];

    protected $casts = [
        'expires_at' => 'datetime',
        'is_blocked' => 'boolean',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function personalAccessToken(): BelongsTo
    {
        return $this->belongsTo(\Laravel\Sanctum\PersonalAccessToken::class, 'personal_access_token_id');
    }

    public function isExpired(): bool
    {
        return $this->expires_at->isPast();
    }

    public function isValid(): bool
    {
        return !$this->isExpired() && $this->personalAccessToken()->exists();
    }

    public function isBlocked(): bool
    {
        return $this->is_blocked === true;
    }
}

