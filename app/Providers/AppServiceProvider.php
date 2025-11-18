<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Interfaces\BrokerRepositoryInterface;
use App\Repositories\BrokerRepository;
use App\Interfaces\EventRepositoryInterface;
use App\Repositories\EventRepository;
use App\Interfaces\LeadRepositoryInterface;
use App\Repositories\LeadRepository;
use App\Interfaces\ContactRepositoryInterface;
use App\Repositories\ContactRepository;
use App\Interfaces\LeadAutomationRepositoryInterface;
use App\Repositories\LeadAutomationRepository;
use App\Interfaces\HealthOperatorRepositoryInterface;
use App\Repositories\HealthOperatorRepository;
use App\Interfaces\WhatsAppAuthRepositoryInterface;
use App\Repositories\WhatsAppAuthRepository;
use App\Models\User;
use App\Observers\UserObserver;
use App\Services\StripeSubscriptionService;
use App\Services\StripePaymentService;
use App\Services\StripePlanService;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(BrokerRepositoryInterface::class, BrokerRepository::class);
        $this->app->bind(EventRepositoryInterface::class, EventRepository::class);
        $this->app->bind(LeadRepositoryInterface::class, LeadRepository::class);
        $this->app->bind(ContactRepositoryInterface::class, ContactRepository::class);
        $this->app->bind(LeadAutomationRepositoryInterface::class, LeadAutomationRepository::class);
        $this->app->bind(HealthOperatorRepositoryInterface::class, HealthOperatorRepository::class);
        $this->app->bind(WhatsAppAuthRepositoryInterface::class, WhatsAppAuthRepository::class);
        $this->app->bind(StripeSubscriptionService::class);
        $this->app->bind(StripePaymentService::class);
        $this->app->bind(StripePlanService::class);
    }

    public function boot(): void
    {
        User::observe(UserObserver::class);
    }
}
