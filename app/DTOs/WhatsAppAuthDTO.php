<?php

namespace App\DTOs;

readonly class WhatsAppAuthDTO
{
    public function __construct(
        public string $ucode,
        public string $ip,
        public ?string $deviceFingerprint = null
    ) {}
}

