<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MobileOnlyMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        $userAgent = $request->header('User-Agent', '');

        if (!preg_match('/(android|iphone|ipad|mobile|whatsapp)/i', $userAgent)) {
            return response()->view('mobile.access-denied', [], 403);
        }

        return $next($request);
    }
}

