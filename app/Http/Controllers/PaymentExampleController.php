<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Payment\Services\PaymentService;
use App\Payment\DTOs\PaymentRequestDTO;
use App\Helpers\PaymentHelper;
use Illuminate\Http\Request;

class PaymentExampleController extends Controller
{
    public function __construct(
        private PaymentService $paymentService
    ) {}

    public function showCurrentGateway()
    {
        $currentGateway = $this->paymentService->getCurrentGateway();
        $availableGateways = array_keys(config('payments.gateways', []));

        return response()->json([
            'current_gateway' => $currentGateway,
            'available_gateways' => $availableGateways,
            'is_configured' => $this->paymentService->getCurrentGateway() !== null,
        ]);
    }

    public function switchGateway(Request $request)
    {
        $request->validate([
            'gateway' => 'required|string|in:' . implode(',', array_keys(config('payments.gateways', []))),
        ]);

        try {
            $this->paymentService->switchGateway($request->gateway);

            return response()->json([
                'success' => true,
                'message' => "Gateway alterado para: {$request->gateway}",
                'current_gateway' => $this->paymentService->getCurrentGateway(),
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erro ao trocar gateway: ' . $e->getMessage(),
            ], 500);
        }
    }

    public function createTestPayment()
    {
        try {
            $user = auth()->user();

            if (!$user) {
                return response()->json([
                    'success' => false,
                    'message' => 'Usuário não autenticado',
                ], 401);
            }

            $response = PaymentHelper::createLinkPaymentWithUser(
                user: $user,
                amount: 50.00,
                orderId: 'TEST-' . time(),
                description: 'Pagamento de teste',
                options: [
                    'callback_url' => route('payment.callback'),
                    'expire_at' => now()->addMinutes(30)->format('Y-m-d H:i:s'),
                ]
            );

            return response()->json([
                'success' => $response->isSuccess(),
                'gateway' => $response->gateway,
                'payment_url' => $response->paymentUrl,
                'payment_id' => $response->paymentId,
                'status' => $response->status,
                'error' => $response->error,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erro ao criar pagamento: ' . $e->getMessage(),
            ], 500);
        }
    }

    public function getPaymentStatus(Request $request)
    {
        $request->validate([
            'payment_id' => 'required|string',
        ]);

        try {
            $response = $this->paymentService->getPayment($request->payment_id);

            return response()->json([
                'success' => $response->isSuccess(),
                'payment_id' => $response->paymentId,
                'transaction_id' => $response->transactionId,
                'status' => $response->status,
                'gateway' => $response->gateway,
                'metadata' => $response->metadata,
                'error' => $response->error,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erro ao consultar pagamento: ' . $e->getMessage(),
            ], 500);
        }
    }
}
