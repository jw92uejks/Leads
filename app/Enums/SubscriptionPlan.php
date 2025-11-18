<?php

namespace App\Enums;

enum SubscriptionPlan: string
{
    case INDIVIDUAL = 'individual';
    case TEAMS = 'teams';
    case ENTERPRISE = 'enterprise';

    public function label(): string
    {
        return match($this) {
            self::INDIVIDUAL => 'Plano Individual',
            self::TEAMS => 'Plano por Equipe',
            self::ENTERPRISE => 'Plano Empresarial',
        };
    }

    public function features(): array
    {
        return match($this) {
            self::INDIVIDUAL => ['contacts', 'leads'],
            self::TEAMS => ['contacts', 'leads', 'team_panel'],
            self::ENTERPRISE => ['contacts', 'leads', 'team_panel', 'enterprise_panel'],
        };
    }
}
