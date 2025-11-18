<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class HideServerMiddleware
{
        public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        $response->headers->set('Server', 'Ondeal');

        $response->headers->remove('X-Powered-By');
        $response->headers->remove('X-PHP-Version');
        $response->headers->remove('X-AspNet-Version');
        $response->headers->remove('X-AspNetMvc-Version');

        $headersToRemove = [
            'Server',
            'X-Powered-By',
            'X-PHP-Version',
            'X-Framework',
            'X-Turbo-Charged-By'
        ];

        foreach ($headersToRemove as $header) {
            $response->headers->remove($header);
        }

        $response->headers->set('Server', 'Ondeal');

        if ($response->headers->has('Set-Cookie')) {
            $cookies = $response->headers->get('Set-Cookie', null, false);
            $cleanedCookies = [];

            foreach ($cookies as $cookie) {
                $cookie = str_replace('laravel_session', 'app_session', $cookie);
                $cleanedCookies[] = $cookie;
            }

            $response->headers->set('Set-Cookie', $cleanedCookies, false);
        }

        return $response;
    }
}
