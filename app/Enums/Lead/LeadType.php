<?php

namespace App\Enums\Lead;

enum LeadType: int
{
    case PF = 1;
    case PJ = 2;
    case ADESAO = 3;
    case MISTA = 4;

    public function label(): string
    {
        return match($this) {
            self::PF => 'Pessoa Física',
            self::PJ => 'Pessoa Jurídica',
            self::ADESAO => 'Adesão',
            self::MISTA => 'Mista (PF + PJ)',
        };
    }
}
