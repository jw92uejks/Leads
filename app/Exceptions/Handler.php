<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    public function render($request, Throwable $e)
    {
        if ($request->is('api/*') || $request->expectsJson()) {
            return $this->handleApiException($request, $e);
        }

        return parent::render($request, $e);
    }

    protected function handleApiException(Request $request, Throwable $e): JsonResponse
    {
        if ($e instanceof ValidationException) {
            return response()->json([
                'success' => false,
                'error' => 'Validation failed',
                'message' => 'The provided data is invalid',
                'errors' => $e->errors(),
                'timestamp' => now()->toISOString()
            ], 422);
        }

        if ($e instanceof AuthenticationException) {
            return response()->json([
                'success' => false,
                'error' => 'Unauthenticated',
                'message' => $e->getMessage() ?: 'Authentication required',
                'timestamp' => now()->toISOString()
            ], 401);
        }

        if ($e instanceof AuthorizationException) {
            return response()->json([
                'success' => false,
                'error' => 'Forbidden',
                'message' => $e->getMessage() ?: 'You do not have permission to perform this action',
                'timestamp' => now()->toISOString()
            ], 403);
        }

        if ($e instanceof ModelNotFoundException) {
            return response()->json([
                'success' => false,
                'error' => 'Not found',
                'message' => 'The requested resource was not found',
                'timestamp' => now()->toISOString()
            ], 404);
        }

        if ($e instanceof NotFoundHttpException) {
            return response()->json([
                'success' => false,
                'error' => 'Not found',
                'message' => 'The requested endpoint was not found',
                'timestamp' => now()->toISOString()
            ], 404);
        }

        if ($e instanceof MethodNotAllowedHttpException) {
            return response()->json([
                'success' => false,
                'error' => 'Method not allowed',
                'message' => 'The HTTP method used is not allowed for this endpoint',
                'timestamp' => now()->toISOString()
            ], 405);
        }

        if ($e instanceof HttpException) {
            return response()->json([
                'success' => false,
                'error' => 'HTTP exception',
                'message' => $e->getMessage() ?: 'An HTTP error occurred',
                'timestamp' => now()->toISOString()
            ], $e->getStatusCode());
        }

        if ($e instanceof InsufficientCreditsException) {
            return response()->json([
                'success' => false,
                'error' => 'Insufficient credits',
                'message' => $e->getMessage(),
                'timestamp' => now()->toISOString()
            ], 402);
        }

        $statusCode = method_exists($e, 'getStatusCode') ? $e->getStatusCode() : 500;

        if (config('app.debug')) {
            return response()->json([
                'success' => false,
                'error' => 'Server error',
                'message' => $e->getMessage(),
                'exception' => get_class($e),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTrace(),
                'timestamp' => now()->toISOString()
            ], $statusCode);
        }

        return response()->json([
            'success' => false,
            'error' => 'Server error',
            'message' => 'An unexpected error occurred',
            'timestamp' => now()->toISOString()
        ], $statusCode);
    }

    protected function unauthenticated($request, AuthenticationException $exception)
    {
        if ($request->expectsJson() || $request->is('api/*')) {
            return response()->json([
                'success' => false,
                'error' => 'Unauthenticated',
                'message' => 'Authentication required',
                'timestamp' => now()->toISOString()
            ], 401);
        }

        return redirect()->guest(route('login'));
    }
}

