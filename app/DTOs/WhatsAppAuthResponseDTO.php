<?php

namespace App\DTOs;

readonly class WhatsAppAuthResponseDTO
{
    public function __construct(
        public string $token,
        public string $redirectUrl,
        public int $userId,
        public string $userName,
        public string $userPhone
    ) {}

    public function toArray(): array
    {
        return [
            'success' => true,
            'token' => $this->token,
            'redirect_url' => $this->redirectUrl,
            'user' => [
                'id' => $this->userId,
                'name' => $this->userName,
                'phone' => $this->userPhone,
            ]
        ];
    }
}

