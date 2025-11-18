<?php

namespace App\Services;

use App\DTOs\WhatsAppAuthDTO;
use App\DTOs\WhatsAppAuthResponseDTO;
use App\Interfaces\WhatsAppAuthRepositoryInterface;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class WhatsAppAuthService
{
    public function __construct(
        private readonly WhatsAppAuthRepositoryInterface $authRepository
    ) {}

    public function generateToken(WhatsAppAuthDTO $dto): WhatsAppAuthResponseDTO
    {
        $user = $this->authRepository->findUserByUcode($dto->ucode);

        if (!$user) {
            Log::warning('WhatsApp Auth: Usuário não encontrado', [
                'ucode' => $dto->ucode,
                'ip' => $dto->ip
            ]);

            throw new NotFoundHttpException('Usuário não encontrado');
        }

        if (!$user->broker && !$user->supplier) {
            Log::warning('WhatsApp Auth: Usuário sem permissão', [
                'user_id' => $user->id,
                'ucode' => $dto->ucode
            ]);

            throw new AccessDeniedHttpException('Sem permissão');
        }

        $cachedToken = $this->authRepository->findActiveCachedToken($user);


        if ($cachedToken) {
            $encodedToken = $cachedToken->encoded_token;
        } else {
            $expiresAt = now()->addHours(2);
            $newToken = $user->createToken(
                'whatsapp-mobile',
                ['*'],
                $expiresAt
            );

            $encodedToken = $this->encodeTokenForUrl($newToken->plainTextToken);

            $this->authRepository->cacheToken(
                $user,
                $newToken->accessToken->id,
                $encodedToken,
                $expiresAt
            );
        }

        $redirectUrl = route('whatsapp.leads', ['token' => $encodedToken]);

        return new WhatsAppAuthResponseDTO(
            token: $encodedToken,
            redirectUrl: $redirectUrl,
            userId: $user->id,
            userName: $user->name,
            userPhone: $user->phone
        );
    }

    private function encodeTokenForUrl(string $token): string
    {
        return rtrim(strtr(base64_encode($token), '+/', '-_'), '=');
    }

    public static function decodeTokenFromUrl(string $encodedToken): string
    {
        return base64_decode(strtr($encodedToken, '-_', '+/'));
    }
}

