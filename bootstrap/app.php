<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->trustProxies(at: '*');

        $middleware->web(prepend: [
            \App\Http\Middleware\TrustProxies::class,
            \App\Http\Middleware\DynamicUrlMiddleware::class,
        ]);

        $middleware->web(append: [
            // \App\Http\Middleware\StealthModeMiddleware::class,
            \App\Http\Middleware\BlockCrawlersMiddleware::class,
            \App\Http\Middleware\SecurityHeadersMiddleware::class,
        ]);

        $middleware->api(prepend: [
            \App\Http\Middleware\TrustProxies::class,
            \App\Http\Middleware\DynamicUrlMiddleware::class,
        ]);

        $middleware->api(append: [
            \App\Http\Middleware\StealthModeMiddleware::class,
            \App\Http\Middleware\BlockCrawlersMiddleware::class,
            \App\Http\Middleware\SecurityHeadersMiddleware::class,
        ]);

        $middleware->alias([
            'api.web.auth' => \App\Http\Middleware\ApiWebAuthMiddleware::class,
            'calendar.internal' => \App\Http\Middleware\CalendarInternalAuthMiddleware::class,
            'broker' => \App\Http\Middleware\BrokerMiddleware::class,
            'ucode.auth' => \App\Http\Middleware\UCodeApiAuthMiddleware::class,
            'supplier.auth' => \App\Http\Middleware\SupplierApiAuthMiddleware::class,
            'admin.api.auth' => \App\Http\Middleware\AdminApiAuthMiddleware::class,
            'force.json' => \App\Http\Middleware\ForceJsonResponse::class,
            'basic.user' => \App\Http\Middleware\BasicUserMiddleware::class,
            'premium.access' => \App\Http\Middleware\PremiumAccessMiddleware::class,
            'lead.limit' => \App\Http\Middleware\LeadLimitMiddleware::class,
            'basic.restriction' => \App\Http\Middleware\BasicUserRestrictionMiddleware::class,
            'can.manage.teams' => \App\Http\Middleware\CanManageTeamsMiddleware::class,
            'subscription.access' => \App\Http\Middleware\SubscriptionAccessMiddleware::class,
            'mobile.only' => \App\Http\Middleware\MobileOnlyMiddleware::class,
            'whatsapp.token' => \App\Http\Middleware\WhatsAppTokenAuthMiddleware::class,
            'whatsapp.not.blocked' => \App\Http\Middleware\EnsureWhatsAppNotBlocked::class,
            'whatsapp.verified' => \App\Http\Middleware\EnsureWhatsAppVerified::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })
    ->withProviders([
        \App\Providers\AuthServiceProvider::class,
    ])->create();
