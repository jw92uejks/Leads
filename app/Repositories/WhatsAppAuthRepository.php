<?php

namespace App\Repositories;

use App\Interfaces\WhatsAppAuthRepositoryInterface;
use App\Models\User;
use App\Models\WhatsAppTokenCache;

class WhatsAppAuthRepository implements WhatsAppAuthRepositoryInterface
{
    public function findUserByUcode(string $ucode): ?User
    {
        return User::where('ucode', $ucode)->first();
    }

    public function findActiveCachedToken(User $user): ?WhatsAppTokenCache
    {
        return WhatsAppTokenCache::query()
            ->where('user_id', $user->id)
            ->where('expires_at', '>', now())
            ->whereHas('personalAccessToken')
            ->orderBy('created_at', 'desc')
            ->first();
    }

    public function cacheToken(User $user, int $tokenId, string $encodedToken, \DateTime $expiresAt, ?string $deviceFingerprint = null): WhatsAppTokenCache
    {
        return WhatsAppTokenCache::create([
            'user_id' => $user->id,
            'personal_access_token_id' => $tokenId,
            'encoded_token' => $encodedToken,
            'expires_at' => $expiresAt,
        ]);
    }

    public function saveWhatsAppVerification(User $user, string $phone, string $fingerprint): bool
    {
        return $user->update([
            'whatsapp_phone' => $phone,
            'device_fingerprint' => $fingerprint,
            'whatsapp_verified_at' => now(),
        ]);
    }

    public function validateWhatsAppSecurity(User $user, string $phone, string $fingerprint): bool
    {
        if (!$user->isWhatsAppVerified()) {
            return true;
        }

        $phoneMatch = $user->whatsapp_phone === $phone;
        $deviceMatch = $user->hasDeviceFingerprintMatch($fingerprint);

        return $phoneMatch && $deviceMatch;
    }

    public function blockTokenCache(WhatsAppTokenCache $cache, string $reason): bool
    {
        return $cache->update([
            'is_blocked' => true,
            'blocked_reason' => $reason,
        ]);
    }

    public function resetWhatsAppVerification(User $user): bool
    {
        return $user->update([
            'whatsapp_phone' => null,
            'device_fingerprint' => null,
            'whatsapp_verified_at' => null,
        ]);
    }

    public function updateDeviceFingerprint(User $user, string $fingerprint): bool
    {
        return $user->update([
            'device_fingerprint' => $fingerprint,
        ]);
    }
}

