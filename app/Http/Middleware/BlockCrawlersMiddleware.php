<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BlockCrawlersMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->is('api/*')) {
            return $next($request);
        }

        $userAgent = $request->header('User-Agent');

        if ($userAgent) {
            $userAgent = strtolower($userAgent);

            $blockedBots = [
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
                'scraper',
                'indexer'
            ];

            foreach ($blockedBots as $bot) {
                if (str_contains($userAgent, $bot)) {
                    return response()->json([
                        'error' => 'Access denied',
                        'message' => 'Crawlers and bots are not allowed'
                    ], 403);
                }
            }
        }

        return $next($request);
    }
}
