<?php

declare(strict_types=1);

namespace App\Events;

use App\Models\Lead;
use App\Models\User;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class LeadEnteredNewStep
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct(
        public readonly Lead $lead,
        public readonly User $user,
        public readonly int $step
    ) {}
}


