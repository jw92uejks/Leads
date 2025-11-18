<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Payment\Services\PaymentService;
use App\Payment\DTOs\PaymentRequestDTO;
use Symfony\Component\Uid\UuidV7;

class CheckoutController extends Controller
{
    public function __construct(
        private PaymentService $paymentService
    ) {}

    public function index()
    {
        $cart = CartItem::where('broker_id', auth()->user()->broker->id)->get();
        return view('pclient.checkout.index', compact('cart'));
    }

    public function process()
    {
        $cart = CartItem::where('broker_id', auth()->user()->broker->id)->get();
        $total = $cart->sum(fn($item) => $item->lead->currentPrice ?? 0);

        $paymentData = [
            'amount' => $total,
            'orderId' => (string) UuidV7::generate(),
            'description' => 'Compra de Leads',
            'paymentMethod' => 'all',
            'callbackUrl' => env('APP_PAYMENT_CALLBACK_URL'),
            'redirectUrl' => env('APP_PAYMENT_RETURN_URL'),
            'cancelUrl' => env('APP_PAYMENT_CANCEL_URL'),
            'expireAt' => now()->addMinutes(5)->format('Y-m-d H:i:s'),
        ];

        $response = $this->paymentService->createLinkPaymentWithUser(auth()->user(), $paymentData);

        if (!$response->isSuccess()) {
            return back()->withErrors(['payment' => $response->error ?? 'Erro ao processar pagamento']);
        }

        return redirect($response->paymentUrl);
    }
}
