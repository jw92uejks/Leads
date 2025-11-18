@extends('layouts.app')

@section('title', 'Retorno de Pagamento')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">Status do Pagamento</h4>
                </div>
                <div class="card-body text-center">
                    @if($success)
                        <div class="alert alert-success">
                            <i class="fas fa-check-circle fa-3x mb-3"></i>
                            <h5>{{ $message }}</h5>
                        </div>
                    @else
                        <div class="alert alert-danger">
                            <i class="fas fa-times-circle fa-3x mb-3"></i>
                            <h5>{{ $message }}</h5>
                        </div>
                    @endif

                    @if($paymentId)
                        <p><strong>ID do Pagamento:</strong> {{ $paymentId }}</p>
                    @endif

                    @if($transactionId)
                        <p><strong>ID da Transação:</strong> {{ $transactionId }}</p>
                    @endif

                    <div class="mt-4">
                        @if($success)
                            <a href="{{ route('dashboard') }}" class="btn btn-primary">
                                <i class="fas fa-home"></i> Ir para Dashboard
                            </a>
                        @else
                            <a href="{{ route('checkout.index') }}" class="btn btn-warning">
                                <i class="fas fa-redo"></i> Tentar Novamente
                            </a>
                        @endif

                        <a href="{{ route('homepage.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Voltar ao Início
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
