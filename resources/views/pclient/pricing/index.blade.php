@extends('layouts.app')
@section('title', 'Fornecedores de Créditos')
@section('pricing', 'active')

@section('headlocal') @includeIf('pclient.pricing.jscss.css') @endsection
@section('jslocal') @includeIf('pclient.pricing.jscss.javascript') @endsection

@section('content')
<div class="d-flex flex-column flex-column-fluid">
    <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
        <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Escolha Seu Pacote de Créditos</h1>
                <span class="text-muted">Use créditos para turbinar suas vendas com leads e recursos extras.</span>
            </div>
        </div>
    </div>

    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-xxl">
            <div class="card">
                <div class="card-body p-lg-17">
                    <div class="d-flex flex-column">
                        <div class="mb-13 text-center">
                            <h1 class="pricing-main-title">Escolha Seu Pacote de Créditos</h1>
                            <div class="pricing-subtitle">Use créditos para turbinar suas vendas com leads e recursos extras.</div>
                        </div>

                        <div class="nav-group nav-group-outline mx-auto mb-15" data-kt-buttons="true">
                            <button class="btn btn-color-gray-400 btn-active btn-active-secondary px-6 py-3 me-2 active" data-kt-plan="month">Mensal</button>
                            <button class="btn btn-color-gray-400 btn-active btn-active-secondary px-6 py-3" data-kt-plan="annual">Anual</button>
                        </div>

                        <div class="row g-10 justify-content-center">
                            <div class="col-xl-4 col-lg-6">
                                <div class="pricing-card d-flex h-100 align-items-center">
                                    <div class="w-100 d-flex flex-column flex-center rounded-3 bg-light bg-opacity-75 py-15 px-10">
                                        <div class="mb-7 text-center">
                                            <h1 class="text-dark mb-5 fw-bolder">Individual</h1>
                                            <div class="plan-description fw-semibold mb-5">Ideal para profissionais<br />autônomos e freelancers</div>
                                            <div class="text-center">
                                                <span class="mb-2 pricing-primary price-currency">R$</span>
                                                <span class="price-display pricing-primary" data-kt-plan-price-month="99" data-kt-plan-price-annual="990">99</span>
                                                <span class="price-period">/<span data-kt-element="period">Mês</span></span>
                                            </div>
                                        </div>
                                        <div class="w-100 mb-10">
                                            <div class="d-flex align-items-center mb-5 feature-item">
                                                <span class="fw-semibold fs-6 feature-included flex-grow-1 pe-3 feature-text">100 Créditos Mensais</span>
                                                <i class="ki-duotone ki-check-circle fs-1 check-icon-custom">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                </i>
                                            </div>
                                            <div class="d-flex align-items-center mb-5 feature-item">
                                                <span class="fw-semibold fs-6 feature-included flex-grow-1 pe-3 feature-text">Acesso ao Marketplace</span>
                                                <i class="ki-duotone ki-check-circle fs-1 check-icon-custom">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                </i>
                                            </div>
                                            <div class="d-flex align-items-center mb-5 feature-item">
                                                <span class="fw-semibold fs-6 feature-included flex-grow-1 pe-3 feature-text">Relatórios Básicos</span>
                                                <i class="ki-duotone ki-check-circle fs-1 check-icon-custom">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                </i>
                                            </div>
                                            <div class="d-flex align-items-center mb-5 feature-item">
                                                <span class="fw-semibold fs-6 feature-not-included flex-grow-1">Leads Premium</span>
                                                <i class="ki-duotone ki-cross-circle fs-1 text-gray-400">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                </i>
                                            </div>
                                            <div class="d-flex align-items-center feature-item">
                                                <span class="fw-semibold fs-6 feature-not-included flex-grow-1">Suporte Prioritário</span>
                                                <i class="ki-duotone ki-cross-circle fs-1 text-gray-400">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                </i>
                                            </div>
                                        </div>
                                        <a href="{{ route('pricing.select', 1) }}" class="btn pricing-select-btn">Selecionar</a>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-4 col-lg-6">
                                <div class="pricing-card pricing-card-featured d-flex h-100 align-items-center">
                                    <div class="w-100 d-flex flex-column flex-center rounded-3 bg-light bg-opacity-75 py-15 px-10 position-relative">
                                        <div class="position-absolute top-0 start-50 translate-middle">
                                            <span class="badge bg-primary px-4 py-2 fs-7 text-white fw-bold">POPULAR</span>
                                        </div>
                                        <div class="mb-7 text-center">
                                            <h1 class="text-dark mb-5 fw-bolder">Equipe</h1>
                                            <div class="plan-description fw-semibold mb-5">Ideal para empresas<br />e equipes de vendas</div>
                                            <div class="text-center">
                                                <span class="mb-2 pricing-primary price-currency">R$</span>
                                                <span class="price-display pricing-primary" data-kt-plan-price-month="299" data-kt-plan-price-annual="2990">299</span>
                                                <span class="price-period">/<span data-kt-element="period">Mês</span></span>
                                            </div>
                                        </div>
                                        <div class="w-100 mb-10">
                                            <div class="d-flex align-items-center mb-5 feature-item">
                                                <span class="fw-semibold fs-6 feature-included flex-grow-1 pe-3 feature-text">500 Créditos Mensais</span>
                                                <i class="ki-duotone ki-check-circle fs-1 check-icon-custom">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                </i>
                                            </div>
                                            <div class="d-flex align-items-center mb-5 feature-item">
                                                <span class="fw-semibold fs-6 feature-included flex-grow-1 pe-3 feature-text">Acesso ao Marketplace</span>
                                                <i class="ki-duotone ki-check-circle fs-1 check-icon-custom">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                </i>
                                            </div>
                                            <div class="d-flex align-items-center mb-5 feature-item">
                                                <span class="fw-semibold fs-6 feature-included flex-grow-1 pe-3 feature-text">Relatórios Avançados</span>
                                                <i class="ki-duotone ki-check-circle fs-1 check-icon-custom">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                </i>
                                            </div>
                                            <div class="d-flex align-items-center mb-5 feature-item">
                                                <span class="fw-semibold fs-6 feature-included flex-grow-1 pe-3 feature-text">Leads Premium</span>
                                                <i class="ki-duotone ki-check-circle fs-1 check-icon-custom">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                </i>
                                            </div>
                                            <div class="d-flex align-items-center mb-5 feature-item">
                                                <span class="fw-semibold fs-6 feature-included flex-grow-1 pe-3 feature-text">Suporte Prioritário</span>
                                                <i class="ki-duotone ki-check-circle fs-1 check-icon-custom">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                </i>
                                            </div>
                                        </div>
                                        <a href="{{ route('pricing.select', 2) }}" class="btn pricing-select-btn">Selecionar</a>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-4 col-lg-6">
                                <div class="pricing-card d-flex h-100 align-items-center">
                                    <div class="w-100 d-flex flex-column flex-center rounded-3 bg-light bg-opacity-75 py-15 px-10">
                                        <div class="mb-7 text-center">
                                            <h1 class="text-dark mb-5 fw-bolder">Enterprise</h1>
                                            <div class="plan-description fw-semibold mb-5">Soluções personalizadas<br />para grandes empresas</div>
                                            <div class="text-center">
                                                <span class="mb-2 text-primary fw-bold" style="font-size: 2.25rem;">Personalizado</span>
                                            </div>
                                        </div>
                                        <div class="w-100 mb-10">
                                            <div class="d-flex align-items-center mb-5 feature-item">
                                                <span class="fw-semibold fs-6 feature-included flex-grow-1 pe-3 feature-text">Créditos Ilimitados</span>
                                                <i class="ki-duotone ki-check-circle fs-1 check-icon-custom">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                </i>
                                            </div>
                                            <div class="d-flex align-items-center mb-5 feature-item">
                                                <span class="fw-semibold fs-6 feature-included flex-grow-1 pe-3 feature-text">API Completa</span>
                                                <i class="ki-duotone ki-check-circle fs-1 check-icon-custom">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                </i>
                                            </div>
                                            <div class="d-flex align-items-center mb-5 feature-item">
                                                <span class="fw-semibold fs-6 feature-included flex-grow-1 pe-3 feature-text">Relatórios Customizados</span>
                                                <i class="ki-duotone ki-check-circle fs-1 check-icon-custom">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                </i>
                                            </div>
                                            <div class="d-flex align-items-center mb-5 feature-item">
                                                <span class="fw-semibold fs-6 feature-included flex-grow-1 pe-3 feature-text">Suporte Dedicado</span>
                                                <i class="ki-duotone ki-check-circle fs-1 check-icon-custom">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                </i>
                                            </div>
                                            <div class="d-flex align-items-center mb-5 feature-item">
                                                <span class="fw-semibold fs-6 feature-included flex-grow-1 pe-3 feature-text">Implementação Personalizada</span>
                                                <i class="ki-duotone ki-check-circle fs-1 check-icon-custom">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                </i>
                                            </div>
                                        </div>
                                        <a href="{{ route('pricing.select', 3) }}" class="btn pricing-select-btn">Selecionar</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="text-center mt-15">
                            <div class="text-gray-600 fw-semibold fs-6">
                                Todos os planos incluem:
                                <span class="fw-bold text-gray-800">Créditos mensais</span> e
                                <span class="fw-bold text-gray-800">Relatórios de consumo de créditos</span>
                            </div>
                            <div class="mt-5">
                                <a href="#" class="text-primary fw-bold">Dúvidas sobre nossos planos? Entre em contato</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('components.alert')
@endsection
