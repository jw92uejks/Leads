@extends('layouts.app')
@section('title', 'Perfil do Usuário')
@section('profile', 'active')

@section('headlocal') @includeIf('pclient.profile.jscss.css') @endsection
@section('jslocal') @includeIf('pclient.profile.jscss.javascript') @endsection

@section('content')
<div class="d-flex flex-column flex-column-fluid">
    <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
        <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Perfil do Usuário</h1>
                <span class="text-muted">Visualize suas informações pessoais</span>
            </div>
        </div>
    </div>

    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div class="app-container container-fluid">
            <div class="row g-5 g-xl-8">
                <div class="col-xl-4">
                    <div class="card card-flush h-100">
                        <div class="card-body text-center d-flex flex-column justify-content-center">
                            <div class="position-relative mb-7">
                                <div class="symbol symbol-100px symbol-circle">
                                    <img src="{{ $user->avatar ? asset('storage/'.$user->avatar) : asset('assets/images/avatars/blank.png') }}" alt="Avatar do usuário" id="user-avatar" />
                                </div>
                            </div>

                            <h4 class="fw-bold text-dark mb-2" id="user-name">{{ $user->name }}</h4>
                            <div class="text-muted mb-4" id="user-email">{{ $user->email }}</div>

                            <div class="d-flex justify-content-center mb-4">
                                <div class="badge badge-light-success fs-7 fw-bold">
                                    <i class="ki-duotone ki-check-circle fs-6 me-1">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                    Conta Ativa
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-8">
                    <div class="card card-flush h-100">
                        <div class="card-header">
                            <div class="card-title">
                                <h3 class="fw-bold">Dados Pessoais</h3>
                            </div>
                            <div class="card-toolbar">
                                <a href="{{ route('profile.edit') }}" class="btn btn-icon btn-sm btn-light-primary" title="Editar Perfil">
                                    <i class="ki-duotone ki-pencil fs-6">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row g-9 mb-7">
                                <div class="col-md-6 fv-row">
                                    <label class="fs-6 fw-semibold mb-2">Nome Completo</label>
                                    <div class="form-control form-control-solid" style="background-color: #F9F9F9;">
                                        <span id="display-name">{{ $user->name }}</span>
                                    </div>
                                </div>
                                <div class="col-md-6 fv-row">
                                    <label class="fs-6 fw-semibold mb-2">E-mail</label>
                                    <div class="form-control form-control-solid" style="background-color: #F9F9F9;">
                                        <span id="display-email">{{ $user->email }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="row g-9 mb-7">
                                <div class="col-md-6 fv-row">
                                    <label class="fs-6 fw-semibold mb-2">Whatsapp do principal</label>
                                    <div class="form-control form-control-solid" style="background-color: #F9F9F9;">
                                        <span id="display-phone">{{ $user->phone ?? 'Não informado' }}</span>
                                    </div>
                                </div>
                                <div class="col-md-6 fv-row">
                                    <label class="fs-6 fw-semibold mb-2">Api Token</label>
                                    <div class="form-control form-control-solid position-relative" style="background-color: #F9F9F9;">
                                        <span id="display-ucode" class="api-token-text" data-token="{{ $user->ucode }}">••••••••••••••••••••</span>
                                        <button type="button" class="btn btn-icon btn-sm btn-light-primary position-absolute top-50 end-0 translate-middle-y me-2" id="toggle-token" title="Mostrar/Ocultar Token">
                                            <i class="fas fa-eye-slash fs-7" id="token-icon"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="row g-9 mb-7">
                                <div class="col-md-4 fv-row">
                                    <label class="fs-6 fw-semibold mb-2">Tipo de Documento</label>
                                    <div class="form-control form-control-solid" style="background-color: #F9F9F9;">
                                        <span id="display-document-type">
                                            @if($user->type)
                                                {{ $user->type->label() }}
                                            @else
                                                Não informado
                                            @endif
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-4 fv-row">
                                    <label class="fs-6 fw-semibold mb-2">CPF</label>
                                    <div class="form-control form-control-solid" style="background-color: #F9F9F9;">
                                        <span id="display-cpf">{{ $user->cpf ?? 'Não informado' }}</span>
                                    </div>
                                </div>
                                <div class="col-md-4 fv-row">
                                    <label class="fs-6 fw-semibold mb-2">CNPJ</label>
                                    <div class="form-control form-control-solid" style="background-color: #F9F9F9;">
                                        <span id="display-cnpj">{{ $user->cnpj ?? 'Não informado' }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row g-5 g-xl-8 mt-5">
                <div class="col-xl-12">
                    <div class="card card-flush">
                        <div class="card-header">
                            <div class="card-title">
                                <h3 class="fw-bold">
                                    <i class="fas fa-shield-alt text-primary me-2"></i>Segurança WhatsApp
                                </h3>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="d-flex align-items-center justify-content-between">
                                <div class="flex-grow-1">
                                    @if($user->isWhatsAppVerified())
                                    <div class="d-flex align-items-center mb-2">
                                        <span class="badge badge-light-success fs-7 fw-bold me-2">
                                            <i class="fas fa-check-circle me-1"></i>Verificado
                                        </span>
                                        <span class="text-muted fs-7">
                                            em {{ $user->whatsapp_verified_at->format('d/m/Y H:i') }}
                                        </span>
                                    </div>
                                    <div class="text-gray-600 fs-7">
                                        <i class="fas fa-phone me-1"></i>
                                        Telefone: {{ $user->whatsapp_phone }}
                                    </div>
                                    @else
                                    <div class="d-flex align-items-center mb-2">
                                        <span class="badge badge-light-warning fs-7 fw-bold">
                                            <i class="fas fa-exclamation-triangle me-1"></i>Não Verificado
                                        </span>
                                    </div>
                                    <div class="text-gray-600 fs-7">
                                        Proteja sua conta validando seu telefone WhatsApp
                                    </div>
                                    @endif
                                </div>
                                <div>
                                    <a href="{{ route('profile.whatsapp-security') }}" class="btn btn-sm btn-light-primary">
                                        <i class="fas fa-cog me-1"></i>Gerenciar Segurança
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row g-5 g-xl-8 mt-5">
                <div class="col-xl-12">
                    <div class="card card-flush">
                        <div class="card-header">
                            <div class="card-title">
                                <h3 class="fw-bold">Transações Realizadas</h3>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="timeline">
                                <div class="timeline-item">
                                    <div class="timeline-line w-40px"></div>
                                    <div class="timeline-icon symbol symbol-circle symbol-40px">
                                        <div class="symbol-label bg-light-danger">
                                            <i class="ki-duotone ki-handcart fs-2 text-danger">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                                <span class="path3"></span>
                                                <span class="path4"></span>
                                                <span class="path5"></span>
                                            </i>
                                        </div>
                                    </div>
                                    <div class="timeline-content mb-10 mt-n1">
                                        <div class="pe-3 mb-5">
                                            <div class="fs-5 fw-semibold mb-2">Compra de leads realizada</div>
                                            <div class="d-flex align-items-center mt-1 fs-6">
                                                <div class="text-muted me-2 fs-7">Processado às 14:30 por</div>
                                                <div class="fw-bold text-gray-800">João Silva</div>
                                            </div>
                                        </div>
                                        <div class="overflow-auto pb-5">
                                            <div class="d-flex align-items-center border border-dashed border-gray-300 rounded min-w-750px px-7 py-3 mb-5">
                                                <div class="flex-shrink-0 me-4" style="width: 100px; max-width: 100px;">
                                                    <img src="{{ asset('assets/images/placeholders/logo__0001_Ello-Budget.png') }}" alt="AutoLeads Corp" class="w-100 h-100 rounded object-fit-cover" />
                                                </div>
                                                <div class="flex-grow-1 me-4">
                                                    <div class="fs-5 fw-bold text-gray-800 mb-1">Leads Automotivos Premium</div>
                                                </div>
                                                <div class="flex-shrink-0 me-4" style="width: 120px; min-width: 120px;">
                                                    <div class="text-muted fw-semibold fs-6 mb-1">Fornecedor</div>
                                                    <div class="fw-bold text-gray-800 fs-6">AutoLeads Corp</div>
                                                </div>
                                                <div class="flex-shrink-0 me-4" style="width: 120px; min-width: 120px;">
                                                    <div class="text-muted fw-semibold fs-6 mb-1">Quantidade</div>
                                                    <div class="fw-bold text-gray-800 fs-6">500 leads</div>
                                                </div>
                                                <div class="flex-shrink-0 me-4" style="width: 120px; min-width: 120px;">
                                                    <div class="text-muted fw-semibold fs-6 mb-1">Data da Compra</div>
                                                    <div class="fw-bold text-gray-800 fs-6">15/01/2025</div>
                                                    <div class="text-muted fs-7">14:30</div>
                                                </div>
                                                <div class="flex-shrink-0 text-end" style="min-width: 120px;">
                                                    <div class="text-muted fw-semibold fs-6 mb-1">Valor Pago</div>
                                                    <div class="fs-5 fw-bold text-gray-900 mb-1">R$ 750,00</div>
                                                    <div class="text-muted fs-7">PIX</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="timeline-item">
                                    <div class="timeline-line w-40px"></div>
                                    <div class="timeline-icon symbol symbol-circle symbol-40px">
                                        <div class="symbol-label bg-light-warning">
                                            <i class="ki-duotone ki-handcart fs-2 text-warning">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                                <span class="path3"></span>
                                                <span class="path4"></span>
                                                <span class="path5"></span>
                                            </i>
                                        </div>
                                    </div>
                                    <div class="timeline-content mb-10 mt-n1">
                                        <div class="pe-3 mb-5">
                                            <div class="fs-5 fw-semibold mb-2">Compra de leads realizada</div>
                                            <div class="d-flex align-items-center mt-1 fs-6">
                                                <div class="text-muted me-2 fs-7">Processado às 09:15 por</div>
                                                <div class="fw-bold text-gray-800">João Silva</div>
                                            </div>
                                        </div>
                                        <div class="overflow-auto pb-5">
                                            <div class="d-flex align-items-center border border-dashed border-gray-300 rounded min-w-750px px-7 py-3 mb-5">
                                                <div class="flex-shrink-0 me-4" style="width: 100px; max-width: 100px;">
                                                    <img src="{{ asset('assets/images/placeholders/logo__0002_E-Consulter.png') }}" alt="DigitalGrowth Pro" class="w-100 h-100 rounded object-fit-cover" />
                                                </div>
                                                <div class="flex-grow-1 me-4">
                                                    <div class="fs-5 fw-bold text-gray-800 mb-1">Leads E-commerce Growth</div>
                                                </div>
                                                <div class="flex-shrink-0 me-4" style="width: 120px; min-width: 120px;">
                                                    <div class="text-muted fw-semibold fs-6 mb-1">Fornecedor</div>
                                                    <div class="fw-bold text-gray-800 fs-6">DigitalGrowth Pro</div>
                                                </div>
                                                <div class="flex-shrink-0 me-4" style="width: 120px; min-width: 120px;">
                                                    <div class="text-muted fw-semibold fs-6 mb-1">Quantidade</div>
                                                    <div class="fw-bold text-gray-800 fs-6">300 leads</div>
                                                </div>
                                                <div class="flex-shrink-0 me-4" style="width: 120px; min-width: 120px;">
                                                    <div class="text-muted fw-semibold fs-6 mb-1">Data da Compra</div>
                                                    <div class="fw-bold text-gray-800 fs-6">12/01/2025</div>
                                                    <div class="text-muted fs-7">09:15</div>
                                                </div>
                                                <div class="flex-shrink-0 text-end" style="min-width: 120px;">
                                                    <div class="text-muted fw-semibold fs-6 mb-1">Valor Pago</div>
                                                    <div class="fs-5 fw-bold text-gray-900 mb-1">R$ 689,00</div>
                                                    <div class="text-muted fs-7">Cartão</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="timeline-item">
                                    <div class="timeline-line w-40px"></div>
                                    <div class="timeline-icon symbol symbol-circle symbol-40px">
                                        <div class="symbol-label bg-light-info">
                                            <i class="ki-duotone ki-handcart fs-2 text-info">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                                <span class="path3"></span>
                                                <span class="path4"></span>
                                                <span class="path5"></span>
                                            </i>
                                        </div>
                                    </div>
                                    <div class="timeline-content mb-10 mt-n1">
                                        <div class="pe-3 mb-5">
                                            <div class="fs-5 fw-semibold mb-2">Compra de leads realizada</div>
                                            <div class="d-flex align-items-center mt-1 fs-6">
                                                <div class="text-muted me-2 fs-7">Processado às 16:45 por</div>
                                                <div class="fw-bold text-gray-800">João Silva</div>
                                            </div>
                                        </div>
                                        <div class="overflow-auto pb-5">
                                            <div class="d-flex align-items-center border border-dashed border-gray-300 rounded min-w-750px px-7 py-3 mb-5">
                                                <div class="flex-shrink-0 me-4" style="width: 100px; max-width: 100px;">
                                                    <img src="{{ asset('assets/images/placeholders/logo__0003_Renova-Leads.png') }}" alt="RealEstate Leads" class="w-100 h-100 rounded object-fit-cover" />
                                                </div>
                                                <div class="flex-grow-1 me-4">
                                                    <div class="fs-5 fw-bold text-gray-800 mb-1">Leads Imobiliários</div>
                                                </div>
                                                <div class="flex-shrink-0 me-4" style="width: 120px; min-width: 120px;">
                                                    <div class="text-muted fw-semibold fs-6 mb-1">Fornecedor</div>
                                                    <div class="fw-bold text-gray-800 fs-6">RealEstate Leads</div>
                                                </div>
                                                <div class="flex-shrink-0 me-4" style="width: 120px; min-width: 120px;">
                                                    <div class="text-muted fw-semibold fs-6 mb-1">Quantidade</div>
                                                    <div class="fw-bold text-gray-800 fs-6">200 leads</div>
                                                </div>
                                                <div class="flex-shrink-0 me-4" style="width: 120px; min-width: 120px;">
                                                    <div class="text-muted fw-semibold fs-6 mb-1">Data da Compra</div>
                                                    <div class="fw-bold text-gray-800 fs-6">10/01/2025</div>
                                                    <div class="text-muted fs-7">16:45</div>
                                                </div>
                                                <div class="flex-shrink-0 text-end" style="min-width: 120px;">
                                                    <div class="text-muted fw-semibold fs-6 mb-1">Valor Pago</div>
                                                    <div class="fs-5 fw-bold text-gray-900 mb-1">R$ 450,00</div>
                                                    <div class="text-muted fs-7">PIX</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="timeline-item">
                                    <div class="timeline-line w-40px"></div>
                                    <div class="timeline-icon symbol symbol-circle symbol-40px">
                                        <div class="symbol-label bg-light-success">
                                            <i class="ki-duotone ki-handcart fs-2 text-success">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                                <span class="path3"></span>
                                                <span class="path4"></span>
                                                <span class="path5"></span>
                                            </i>
                                        </div>
                                    </div>
                                    <div class="timeline-content mb-10 mt-n1">
                                        <div class="pe-3 mb-5">
                                            <div class="fs-5 fw-semibold mb-2">Compra de leads realizada</div>
                                            <div class="d-flex align-items-center mt-1 fs-6">
                                                <div class="text-muted me-2 fs-7">Processado às 11:20 por</div>
                                                <div class="fw-bold text-gray-800">João Silva</div>
                                            </div>
                                        </div>
                                        <div class="overflow-auto pb-5">
                                            <div class="d-flex align-items-center border border-dashed border-gray-300 rounded min-w-750px px-7 py-3 mb-5">
                                                <div class="flex-shrink-0 me-4" style="width: 100px; max-width: 100px;">
                                                    <img src="{{ asset('assets/images/placeholders/logo__0004_Neo-Enterprise.png') }}" alt="FinanceLeads Pro" class="w-100 h-100 rounded object-fit-cover" />
                                                </div>
                                                <div class="flex-grow-1 me-4">
                                                    <div class="fs-5 fw-bold text-gray-800 mb-1">Leads Financeiros</div>
                                                </div>
                                                <div class="flex-shrink-0 me-4" style="width: 120px; min-width: 120px;">
                                                    <div class="text-muted fw-semibold fs-6 mb-1">Fornecedor</div>
                                                    <div class="fw-bold text-gray-800 fs-6">FinanceLeads Pro</div>
                                                </div>
                                                <div class="flex-shrink-0 me-4" style="width: 120px; min-width: 120px;">
                                                    <div class="text-muted fw-semibold fs-6 mb-1">Quantidade</div>
                                                    <div class="fw-bold text-gray-800 fs-6">150 leads</div>
                                                </div>
                                                <div class="flex-shrink-0 me-4" style="width: 120px; min-width: 120px;">
                                                    <div class="text-muted fw-semibold fs-6 mb-1">Data da Compra</div>
                                                    <div class="fw-bold text-gray-800 fs-6">08/01/2025</div>
                                                    <div class="text-muted fs-7">11:20</div>
                                                </div>
                                                <div class="flex-shrink-0 text-end" style="min-width: 120px;">
                                                    <div class="text-muted fw-semibold fs-6 mb-1">Valor Pago</div>
                                                    <div class="fs-5 fw-bold text-gray-900 mb-1">R$ 320,00</div>
                                                    <div class="text-muted fs-7">Boleto</div>
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
</div>
@include('components.alert')
@endsection