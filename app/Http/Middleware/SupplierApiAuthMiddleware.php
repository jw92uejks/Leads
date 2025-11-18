<?php

namespace App\Http\Middleware;

use App\Models\Supplier;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class SupplierApiAuthMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        $apiKey = $request->header('apiKey') ?? $request->query('apiKey');

        if (!$apiKey) {
            return response()->json([
                'error' => 'API key not provided',
                'message' => 'It is necessary to provide the apiKey header or apiKey parameter'
            ], 401);
        }

        $supplier = Supplier::where('api_key', $apiKey)->first();

        if (!$supplier) {
            return response()->json([
                'error' => 'Invalid API key',
                'message' => 'The provided API key was not found in the system'
            ], 401);
        }

        if ($supplier->status !== 'active') {
            return response()->json([
                'error' => 'Inactive supplier',
                'message' => 'This supplier is not active in the system'
            ], 403);
        }

        $request->merge(['authenticated_supplier' => $supplier]);
        $request->setUserResolver(fn() => $supplier);

        return $next($request);
    }
}
