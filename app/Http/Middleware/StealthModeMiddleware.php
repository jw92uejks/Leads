<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class StealthModeMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        if (function_exists('header_remove')) {
            header_remove('Server');
            header_remove('X-Powered-By');
        }

        $response->headers->remove('Server');
        $response->headers->remove('X-Powered-By');
        $response->headers->remove('X-PHP-Version');

        $response->headers->set('Server', 'Ondeal');

        if ($response->headers->has('Set-Cookie')) {
            $cookies = $response->headers->get('Set-Cookie', null, false);
            if ($cookies) {
                $cleanedCookies = [];
                foreach ((array)$cookies as $cookie) {
                    $cookie = str_replace('laravel_session', 'app_session', $cookie);
                    $cleanedCookies[] = $cookie;
                }
                $response->headers->set('Set-Cookie', $cleanedCookies, false);
            }
        }

        return $response;
    }
}
