<?php

return [
    'stripe' => [
        'model' => env('CASHIER_MODEL', env('STRIPE_MODEL')),
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
        'webhook' => [
            'secret' => env('STRIPE_WEBHOOK_SECRET'),
            'tolerance' => env('STRIPE_WEBHOOK_TOLERANCE', 300),
        ],
    ],

    'currency' => env('STRIPE_CURRENCY', 'brl'),
    'currency_locale' => env('STRIPE_CURRENCY_LOCALE', 'pt_BR'),
];