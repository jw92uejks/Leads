<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;

class HealthController extends Controller
{
    public function status(Request $request): JsonResponse
    {
        $isHealthy = true;

        try {
            DB::connection()->getPdo();
        } catch (\Exception $e) {
            $isHealthy = false;
        }

        $response = [
            'status' => $isHealthy ? 'ok' : 'unavailable'
        ];

        return response()->json($response, $isHealthy ? 200 : 503)
            ->header('X-Content-Type-Options', 'nosniff')
            ->header('X-Frame-Options', 'DENY')
            ->header('Cache-Control', 'no-cache, no-store, must-revalidate')
            ->header('Server', 'Ondeal');
    }
}
