<?php

namespace App\Enums\Contact;

enum ContactStatus: string
{
    case ACTIVE = 'active';
    case INACTIVE = 'inactive';
    case BLOCKED = 'blocked';
    case CONVERTED = 'converted';

    public function label(): string
    {
        return match ($this) {
            self::ACTIVE => 'Ativo',
            self::INACTIVE => 'Inativo',
            self::BLOCKED => 'Bloqueado',
            self::CONVERTED => 'Convertido',
        };
    }

    public function color(): string
    {
        return match ($this) {
            self::ACTIVE => 'success',
            self::INACTIVE => 'warning',
            self::BLOCKED => 'danger',
            self::CONVERTED => 'primary',
        };
    }
}
