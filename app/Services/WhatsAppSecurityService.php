<?php

namespace App\Services;

use App\Models\User;
use App\Models\WhatsAppTokenCache;
use Illuminate\Support\Facades\Hash;

class WhatsAppSecurityService
{
    public function validatePhoneAndDevice(User $user, string $phone, string $fingerprint): bool
    {
        if (!$user->isWhatsAppVerified()) {
            return true;
        }

        $phoneMatch = $this->normalizePhone($user->whatsapp_phone) === $this->normalizePhone($phone);
        $deviceMatch = $user->hasDeviceFingerprintMatch($fingerprint);

        return $phoneMatch && $deviceMatch;
    }

    public function saveFirstVerification(User $user, string $phone, string $fingerprint): void
    {
        $user->update([
            'whatsapp_phone' => $this->normalizePhone($phone),
            'device_fingerprint' => $fingerprint,
            'whatsapp_verified_at' => now(),
        ]);
    }

    public function detectSuspiciousAttempt(User $user, string $phone, string $fingerprint): array
    {
        $normalizedPhone = $this->normalizePhone($phone);
        $phoneMatch = $user->whatsapp_phone === $normalizedPhone;
        $deviceMatch = $user->hasDeviceFingerprintMatch($fingerprint);

        $suspicious = false;
        $reason = '';

        if ($phoneMatch && !$deviceMatch && !$user->allow_multiple_devices) {
            $suspicious = true;
            $reason = 'Device fingerprint mismatch';
        } elseif (!$phoneMatch) {
            $suspicious = true;
            $reason = 'Phone number mismatch';
        }

        return [
            'is_suspicious' => $suspicious,
            'reason' => $reason,
            'phone_match' => $phoneMatch,
            'device_match' => $deviceMatch,
        ];
    }

    public function blockAccess(WhatsAppTokenCache $cache, string $reason): void
    {
        $cache->update([
            'is_blocked' => true,
            'blocked_reason' => $reason,
        ]);
    }

    public function resetVerification(User $user, string $password): bool
    {
        if (!Hash::check($password, $user->password)) {
            return false;
        }

        $user->update([
            'whatsapp_phone' => null,
            'device_fingerprint' => null,
            'whatsapp_verified_at' => null,
        ]);

        return true;
    }

    public function authorizeNewDevice(User $user, string $fingerprint, string $password): bool
    {
        if (!Hash::check($password, $user->password)) {
            return false;
        }

        $user->update([
            'device_fingerprint' => $fingerprint,
        ]);

        WhatsAppTokenCache::where('user_id', $user->id)
            ->where('is_blocked', true)
            ->update([
                'is_blocked' => false,
                'blocked_reason' => null,
            ]);

        return true;
    }

    public function toggleMultipleDevices(User $user, bool $allow): void
    {
        $user->update([
            'allow_multiple_devices' => $allow,
        ]);
    }

    private function normalizePhone(string $phone): string
    {
        $normalized = preg_replace('/\D/', '', $phone);

        if (strlen($normalized) === 11) {
            $normalized = '55' . $normalized;
        }

        return $normalized;
    }
}

