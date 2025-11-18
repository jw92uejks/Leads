@extends('layouts.app')

@section('title', 'Pagamento Cancelado')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">Pagamento Cancelado</h4>
                </div>
                <div class="card-body text-center">
                    <div class="alert alert-warning">
                        <i class="fas fa-times-circle fa-3x mb-3"></i>
                        <h5>Pagamento foi cancelado</h5>
                        <p class="mb-0">Você cancelou o processo de pagamento.</p>
                    </div>

                    @if($paymentId)
                        <p><strong>ID do Pagamento:</strong> {{ $paymentId }}</p>
                    @endif

                    @if($reason)
                        <p><strong>Motivo:</strong> {{ $reason }}</p>
                    @endif

                    <div class="mt-4">
                        <a href="{{ route('checkout.index') }}" class="btn btn-primary">
                            <i class="fas fa-redo"></i> Tentar Novamente
                        </a>

                        <a href="{{ route('homepage.index') }}" class="btn btn-secondary">
                            <i class="fas fa-home"></i> Ir para Dashboard
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
