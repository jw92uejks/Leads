<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class AdminApiAuthMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        $adminToken = $request->header('Authorization');

        if (!$adminToken) {
            return response()->json([
                'error' => 'Admin token not provided',
                'message' => 'Authorization header with admin token is required'
            ], 401);
        }

        $token = str_replace('Bearer ', '', $adminToken);
        $expectedToken = env('ADMIN_API_TOKEN');

        if (!$expectedToken) {
            \Log::error('AdminApiAuthMiddleware - ADMIN_API_TOKEN not configured in .env');
            return response()->json([
                'error' => 'Server configuration error',
                'message' => 'Admin API token not configured'
            ], 500);
        }

        if (!hash_equals($expectedToken, $token)) {
            \Log::warning('AdminApiAuthMiddleware - Invalid admin token attempt', [
                'ip' => $request->ip(),
                'user_agent' => $request->header('User-Agent'),
                'url' => $request->url()
            ]);

            return response()->json([
                'error' => 'Invalid admin token',
                'message' => 'The provided admin token is invalid'
            ], 401);
        }

        $allowedMethods = ['GET', 'PUT', 'POST', 'PATCH'];

        if (!in_array($request->method(), $allowedMethods)) {
            return response()->json([
                'error' => 'Method not allowed',
                'message' => 'Admin API only supports GET, PUT, POST, and PATCH operations'
            ], 405);
        }

        return $next($request);
    }
}
