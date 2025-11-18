<?php

declare(strict_types=1);

namespace App\Providers;

use App\Events\LeadEnteredNewStep;
use App\Listeners\SendLeadWebhookListener;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        LeadEnteredNewStep::class => [
            SendLeadWebhookListener::class,
        ],
    ];
}


