<?php

namespace App\Enums\Lead;

enum LeadTemperature: string
{
    case HOT = 'hot';
    case WARM = 'warm';
    case COLD = 'cold';

    public function label(): string
    {
        return match ($this) {
            self::HOT => 'Quente',
            self::WARM => 'Morno',
            self::COLD => 'Frio',
        };
    }
}
