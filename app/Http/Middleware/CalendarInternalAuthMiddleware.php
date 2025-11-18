<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CalendarInternalAuthMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check()) {
            if ($request->expectsJson() || $request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Unauthorized access'
                ], 401);
            }

            return redirect()->route('login');
        }

        $referer = $request->header('Referer');
        $isFromCalendarPage = $referer && (
            str_contains($referer, '/calendar') ||
            str_contains($referer, route('calendar.index'))
        );

        $hasValidHeaders = $request->ajax() ||
                          $request->hasHeader('X-Requested-With') ||
                          ($request->hasHeader('Accept') && str_contains($request->header('Accept'), 'application/json'));

        $isDirectBrowserAccess = !$hasValidHeaders &&
                                !$isFromCalendarPage &&
                                $request->hasHeader('User-Agent');

        if ($isDirectBrowserAccess) {
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Direct API access not allowed'
                ], 403);
            }

            abort(403, 'Direct access not allowed');
        }

        if (in_array($request->method(), ['POST', 'PUT', 'PATCH', 'DELETE']) && ($request->ajax() || $request->expectsJson())) {
            $token = $request->header('X-CSRF-TOKEN') ?? $request->input('_token');

            if (!$token || !hash_equals(session()->token(), $token)) {
                \Log::warning('CalendarInternalAuthMiddleware - CSRF token mismatch', [
                    'provided_token' => $token,
                    'session_token' => session()->token(),
                    'request_method' => $request->method(),
                    'request_url' => $request->fullUrl()
                ]);

                return response()->json([
                    'success' => false,
                    'message' => 'CSRF token mismatch'
                ], 419);
            }
        }

        return $next($request);
    }
}
