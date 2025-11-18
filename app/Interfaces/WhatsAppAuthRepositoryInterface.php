<?php

namespace App\Interfaces;

use App\Models\User;
use App\Models\WhatsAppTokenCache;

interface WhatsAppAuthRepositoryInterface
{
    public function findUserByUcode(string $ucode): ?User;
    public function findActiveCachedToken(User $user): ?WhatsAppTokenCache;
    public function cacheToken(User $user, int $tokenId, string $encodedToken, \DateTime $expiresAt): WhatsAppTokenCache;
    public function saveWhatsAppVerification(User $user, string $phone, string $fingerprint): bool;
    public function validateWhatsAppSecurity(User $user, string $phone, string $fingerprint): bool;
    public function blockTokenCache(WhatsAppTokenCache $cache, string $reason): bool;
    public function resetWhatsAppVerification(User $user): bool;
    public function updateDeviceFingerprint(User $user, string $fingerprint): bool;
}

