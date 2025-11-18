<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
{
    public function return(Request $request)
    {
        $paymentId = $request->get('payment_id');
        $status = $request->get('status');
        $transactionId = $request->get('transaction_id');
        $success = $status === 'paid' || $status === 'approved';
        $message = $success ? 'Pagamento realizado com sucesso!' : 'Pagamento não foi processado.';

        return view('payment.return', compact('success', 'message', 'paymentId', 'transactionId'));
    }

    public function cancel(Request $request)
    {
        $paymentId = $request->get('payment_id');
        $reason = $request->get('reason', 'Usuário cancelou o pagamento');
        return view('payment.cancel', compact('paymentId', 'reason'));
    }
}
