<?php

return [
    'pdf' => [
        'enabled' => true,
        'binary' => env('WKHTMLTOPDF_BINARY', '/usr/local/bin/wkhtmltopdf'),
        'timeout' => false,
        'options' => [],
        'env'     => [],
    ],
    'image' => [
        'enabled' => true,
        'binary' => env('WKHTMLTOIMAGE_BINARY', '/usr/local/bin/wkhtmltoimage'),
        'timeout' => 30,
        'options' => [
            'format' => 'png',
            'quality' => 90,
            'width' => 1920,
        ],
        'env'     => [],
    ],
];
