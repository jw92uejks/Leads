<?php

namespace App\Http\Controllers;

use App\DTOs\WhatsAppAuthDTO;
use App\Http\Requests\WhatsAppAuthRequest;
use App\Services\WhatsAppAuthService;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class WhatsAppAuthController extends Controller
{
    public function __construct(
        private readonly WhatsAppAuthService $authService
    ) {}

    public function generateToken(WhatsAppAuthRequest $request): JsonResponse
    {
        try {
            $dto = new WhatsAppAuthDTO(
                ucode: $request->validated('ucode'),
                ip: $request->ip(),
                deviceFingerprint: $request->header('X-Device-Fingerprint')
            );

            $response = $this->authService->generateToken($dto);

            return response()->json($response->toArray());

        } catch (NotFoundHttpException $e) {
            return response()->json([
                'success' => false,
                'error' => $e->getMessage()
            ], 404);

        } catch (AccessDeniedHttpException $e) {
            return response()->json([
                'success' => false,
                'error' => $e->getMessage()
            ], 403);
        }
    }
}

