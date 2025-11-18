<?php

namespace App\DTOs;

use App\Helpers\PhoneHelper;

readonly class PhoneDTO
{
    public function __construct(
        public ?string $jid,
        public ?string $national,
        public ?string $formatted,
        public ?string $ddd,
        public bool $isValid
    ) {}

    public static function from(?string $phone): self
    {
        if (empty($phone)) {
            return new self(
                jid: null,
                national: null,
                formatted: null,
                ddd: null,
                isValid: false
            );
        }

        $jid = PhoneHelper::toJid($phone);
        $national = PhoneHelper::fromJid($jid);
        $formatted = PhoneHelper::formatPhone($phone);
        $ddd = PhoneHelper::getDDD($phone);
        $isValid = PhoneHelper::isValid($phone);

        return new self(
            jid: $jid,
            national: $national,
            formatted: $formatted,
            ddd: $ddd,
            isValid: $isValid
        );
    }

    public function toArray(): array
    {
        return [
            'jid' => $this->jid,
            'national' => $this->national,
            'formatted' => $this->formatted,
            'ddd' => $this->ddd,
            'isValid' => $this->isValid,
        ];
    }

    public function getForWhatsApp(): ?string
    {
        return $this->jid;
    }

    public function getForDisplay(): ?string
    {
        return $this->formatted ?? $this->national;
    }
}

