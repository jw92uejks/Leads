<?php

namespace App\Enums\Participant;

enum RelationshipType: string
{
    case SPOUSE = 'spouse';
    case FATHER = 'father';
    case MOTHER = 'mother';
    case EMPLOYEE = 'employee';
    case PARTNER = 'partner';
    case OTHER_FAMILY = 'other_family';
    case OTHER = 'other';

    public function label(): string
    {
        return match ($this) {
            self::SPOUSE => 'Cônjuge',
            self::FATHER => 'Pai',
            self::MOTHER => 'Mãe',
            self::EMPLOYEE => 'Colaborador',
            self::PARTNER => 'Sócio',
            self::OTHER_FAMILY => 'Outro Familiar',
            self::OTHER => 'Outro',
        };
    }
}
