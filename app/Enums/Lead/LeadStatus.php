<?php

namespace App\Enums\Lead;

enum LeadStatus: string
{
    case AVAILABLE = 'available';
    case SOLD = 'sold';
    case PAUSED = 'paused';
    case ARCHIVED = 'archived';
    case IN_CONTESTATION = 'in_contestation';
    case REJECT_CONTESTATION = 'reject_contestation';

    public function label(): string
    {
        return match ($this) {
            self::AVAILABLE => 'disponível',
            self::SOLD => 'vendido',
            self::PAUSED => 'pausado',
            self::ARCHIVED => 'arquivado',
            self::IN_CONTESTATION => 'em contestação',
            self::REJECT_CONTESTATION => 'contestação rejeitada',
        };
    }
}
