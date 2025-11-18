<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Configurações de Segurança
    |--------------------------------------------------------------------------
    |
    | Configurações para bloquear crawlers, bots e melhorar a segurança
    | da aplicação.
    |
    */

    'block_crawlers' => env('BLOCK_CRAWLERS', true),

    'allowed_ips' => [
        // IPs permitidos (opcional)
        // '127.0.0.1',
        // '::1',
    ],

    'blocked_user_agents' => [
        'googlebot',
        'bingbot',
        'slurp',
        'duckduckbot',
        'baiduspider',
        'yandexbot',
        'facebookexternalhit',
        'twitterbot',
        'linkedinbot',
        'whatsapp',
        'telegrambot',
        'discordbot',
        'slackbot',
        'crawler',
        'spider',
        'bot',
        'scraper',
        'indexer',
        'semrushbot',
        'ahrefsbot',
        'mj12bot',
        'dotbot',
        'rogerbot',
        'exabot',
        'ia_archiver',
        'archive.org_bot',
        'wget',
        'curl',
        'python-requests',
        'scrapy',
        'phantomjs',
        'headless',
        'selenium',
    ],

    'security_headers' => [
        'X-Frame-Options' => 'DENY',
        'X-Content-Type-Options' => 'nosniff',
        'X-XSS-Protection' => '1; mode=block',
        'Referrer-Policy' => 'no-referrer',
        'Permissions-Policy' => 'geolocation=(), microphone=(), camera=()',
    ],

    'rate_limiting' => [
        'enabled' => env('RATE_LIMITING_ENABLED', true),
        'max_requests' => env('RATE_LIMITING_MAX_REQUESTS', 60),
        'decay_minutes' => env('RATE_LIMITING_DECAY_MINUTES', 1),
    ],
];
