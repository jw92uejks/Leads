<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Log;

class LogHelper
{
    public static function info(string $message, array $context = []): void
    {
        $message = mb_convert_encoding($message, 'UTF-8', 'auto');
        Log::info($message, $context);
    }

    public static function error(string $message, array $context = []): void
    {
        $message = mb_convert_encoding($message, 'UTF-8', 'auto');
        Log::error($message, $context);
    }

    public static function warning(string $message, array $context = []): void
    {
        $message = mb_convert_encoding($message, 'UTF-8', 'auto');
        Log::warning($message, $context);
    }

    public static function debug(string $message, array $context = []): void
    {
        $message = mb_convert_encoding($message, 'UTF-8', 'auto');
        Log::debug($message, $context);
    }
}
