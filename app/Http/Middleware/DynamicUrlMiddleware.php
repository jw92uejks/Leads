<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Symfony\Component\HttpFoundation\Response;

class DynamicUrlMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        $host = $request->header('X-Forwarded-Host') ?: $request->getHost();

        if (str_contains($host, 'ngrok')) {
            $scheme = $request->header('X-Forwarded-Proto', 'https');
            $dynamicUrl = "{$scheme}://{$host}";

            URL::forceScheme($scheme);
            URL::forceRootUrl($dynamicUrl);

            config(['app.url' => $dynamicUrl]);
            config(['session.domain' => null]);
            config(['sanctum.stateful' => array_merge(
                config('sanctum.stateful', []),
                [$host, "*.{$host}"]
            )]);
        }

        return $next($request);
    }
}
