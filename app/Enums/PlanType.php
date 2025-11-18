<?php

namespace App\Enums;

enum PlanType: int
{
    case BASIC = 0;
    case INDIVIDUAL = 1;
    case TEAMS = 2;
    case ENTERPRISE = 3;

    public function label(): string
    {
        return match($this) {
            self::BASIC => 'Básico',
            self::INDIVIDUAL => 'Individual',
            self::TEAMS => 'Equipe',
            self::ENTERPRISE => 'Empresarial',
        };
    }
}

