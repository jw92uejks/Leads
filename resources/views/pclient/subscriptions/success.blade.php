@extends('layouts.app')
@section('title', 'Pagamento Realizado com Sucesso')

@section('content')
<div class="d-flex flex-column flex-column-fluid">
    <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
        <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Pagamento Realizado</h1>
                <span class="text-muted">Sua assinatura foi ativada com sucesso</span>
            </div>
        </div>
    </div>

    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-xxl">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-body text-center p-15">
                            <div class="mb-10">
                                <i class="ki-duotone ki-check-circle fs-5x text-success border border-success rounded-circle">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i>
                            </div>

                            <h2 class="text-success fw-bold mb-5">Pagamento Realizado com Sucesso!</h2>

                            <div class="text-muted fs-5 mb-8">
                                <p class="mb-3">Olá <strong>{{ auth()->user()->name ?? 'Usuário' }}</strong>!</p>
                                <p class="mb-5">Sua assinatura foi ativada com sucesso. Agora você tem acesso a todas as funcionalidades do seu plano.</p>
                            </div>

                            <div class="row g-5 mb-10">
                                <div class="col-md-4">
                                    <div class="d-flex flex-column align-items-center">
                                        <div class="symbol symbol-75px mb-3">
                                            <div class="symbol-label bg-light-success">
                                                <i class="ki-duotone ki-credit-cart fs-2x text-success">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                </i>
                                            </div>
                                        </div>
                                        <h4 class="fw-bold text-gray-900 mb-1">Pagamento Aprovado</h4>
                                        <span class="text-muted fs-7">Transação processada com sucesso</span>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="d-flex flex-column align-items-center">
                                        <div class="symbol symbol-75px mb-3">
                                            <div class="symbol-label bg-light-primary">
                                                <i class="ki-duotone ki-crown fs-2x text-primary">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                </i>
                                            </div>
                                        </div>
                                        <h4 class="fw-bold text-gray-900 mb-1">Assinatura Ativa</h4>
                                        <span class="text-muted fs-7">Seu plano está funcionando</span>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="d-flex flex-column align-items-center">
                                        <div class="symbol symbol-75px mb-3">
                                            <div class="symbol-label bg-light-warning">
                                                <i class="ki-duotone ki-rocket fs-2x text-warning">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                </i>
                                            </div>
                                        </div>
                                        <h4 class="fw-bold text-gray-900 mb-1">Pronto para Usar</h4>
                                        <span class="text-muted fs-7">Acesse todas as funcionalidades</span>
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex flex-column flex-sm-row gap-3 justify-content-center">
                                <a href="{{ route('dashboard') }}" class="btn btn-primary btn-lg">
                                    <i class="ki-duotone ki-home fs-2">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                    Ir para Dashboard
                                </a>

                                <a href="{{ route('pricing.index') }}" class="btn btn-light btn-lg">
                                    <i class="ki-duotone ki-crown fs-2">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                    Ver Planos
                                </a>
                            </div>

                            <div class="mt-10">
                                <div class="notice d-flex bg-light-info rounded border-info border border-dashed p-6">
                                    <i class="ki-duotone ki-information-5 fs-2tx text-info me-4">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                        <span class="path3"></span>
                                    </i>
                                    <div class="d-flex flex-stack flex-grow-1">
                                        <div class="fw-semibold">
                                            <h4 class="text-gray-900 fw-bold">Próximos Passos</h4>
                                            <div class="fs-6 text-gray-700">
                                                <ul class="list-unstyled mb-0">
                                                    <li class="mb-2">• Acesse seu dashboard para começar a usar o sistema</li>
                                                    <li class="mb-2">• Configure suas integrações e conexões</li>
                                                    <li class="mb-0">• Explore todas as funcionalidades do seu plano</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
