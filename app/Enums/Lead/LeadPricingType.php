<?php

namespace App\Enums\Lead;

enum LeadPricingType: string
{
    case FIXED = 'fixed';
    case EDITABLE = 'editable';
    case AUTOMATIC = 'automatic';

    public function label(): string
    {
        return match($this) {
            self::FIXED => 'Fixo',
            self::EDITABLE => 'Editável',
            self::AUTOMATIC => 'Automático',
        };
    }
}
