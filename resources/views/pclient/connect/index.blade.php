@extends('layouts.app')
@section('title', 'Conexões WhatsApp')
@section('connect', 'active')

@section('headlocal') @includeIf('pclient.connect.jscss.css') @endsection
@section('jslocal') @includeIf('pclient.connect.jscss.javascript') @endsection

@section('content')
<div class="d-flex flex-column flex-column-fluid">
    <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
        <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Conexões WhatsApp</h1>
                <span class="text-muted">Gerenciamento de Instâncias</span>
            </div>
            <div class="d-flex align-items-center gap-2 gap-lg-3">
                <a href="{{ route('connect.create') }}" class="btn btn-primary">
                    <i class="ki-duotone ki-plus fs-2"></i>
                    Criar Nova Conexão
                </a>
            </div>
        </div>
    </div>
    
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-xxl">
            <!-- KPIs Section -->
            <div class="card connection-kpi-section">
                <div class="card-body pt-9 pb-0">
                    <div class="d-flex justify-content-between align-items-start">
                        <div class="d-flex flex-column">
                            <div class="d-flex align-items-center mb-2">
                                <a href="#" class="text-gray-900 text-hover-primary fs-1 fw-bold me-1">{{ auth()->user()->name ?? 'Usuário' }}</a>
                            </div>
                            <div class="d-flex flex-wrap fw-semibold fs-6 mb-4">
                                <a href="#" class="d-flex align-items-center text-muted-dark text-hover-primary me-5 mb-2">
                                    <i class="ki-duotone ki-sms fs-4 me-1">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>{{ auth()->user()->email ?? 'email@exemplo.com' }}
                                </a>
                                <a href="#" class="d-flex align-items-center text-muted-dark text-hover-primary mb-2">
                                    <i class="ki-duotone ki-user fs-4 me-1">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>{{ auth()->user()->username ?? 'username' }}
                                </a>
                            </div>
                        </div>
                        <div class="d-flex gap-4">
                            <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4">
                                <div class="d-flex align-items-center">
                                    <i class="ki-duotone ki-people fs-3 text-pink me-2">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                        <span class="path3"></span>
                                        <span class="path4"></span>
                                        <span class="path5"></span>
                                    </i>
                                    <div class="fs-2 fw-bold" data-kt-countup="true" data-kt-countup-value="790">0</div>
                                </div>
                                <div class="fw-semibold fs-6 text-muted-dark">Contatos</div>
                            </div>
                            <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4">
                                <div class="d-flex align-items-center">
                                    <i class="ki-duotone ki-message-text-2 fs-3 text-pink me-2">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                        <span class="path3"></span>
                                        <span class="path4"></span>
                                    </i>
                                    <div class="fs-2 fw-bold" data-kt-countup="true" data-kt-countup-value="55">0</div>
                                </div>
                                <div class="fw-semibold fs-6 text-muted-dark">Chats</div>
                            </div>
                            <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4">
                                <div class="d-flex align-items-center">
                                    <i class="ki-duotone ki-sms fs-3 text-pink me-2">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                    <div class="fs-2 fw-bold" data-kt-countup="true" data-kt-countup-value="2595">0</div>
                                </div>
                                <div class="fw-semibold fs-6 text-muted-dark">Mensagens</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Connections List -->
            <div class="card mt-5 connections-list">
                <div class="card-header card-header-stretch">
                  <div class="card-title">
                      <h3 class="fw-bold m-0 text-gray-800">Instâncias Conectadas</h3>
                  </div>
                </div>
                <div class="card-body">
                    <div class="row g-4">
                        <!-- Connection Card - Active -->
                        <div class="col-12 col-md-6 col-lg-4 connection-card">
                            <a href="{{ route('connect.edit', 'tbottestes') }}" class="card card-custom h-100 hoverable">
                                <div class="card-body text-center p-6">
                                    <div class="symbol symbol-80px symbol-circle mb-4 mx-auto">
                                        <div class="symbol-label bg-light-success">
                                          <i class="ki-duotone ki-like">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                          </i>
                                        </div>
                                    </div>
                                    <h4 class="fw-bold text-gray-800 fs-2 mb-2">tbottestes</h4>
                                    <p class="text-muted fs-7 mb-3">C8A471E2-5C70-4172-8DC0-B6027B692CF9</p>
                                    <div class="d-flex flex-column align-items-center">
                                        <span class="text-muted fs-7 mb-1">Telefone</span>
                                        <span class="fw-semibold text-gray-800">(21) 46782-0484</span>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <!-- Connection Card - Paused -->
                        <div class="col-12 col-md-6 col-lg-4 connection-card">
                            <a href="{{ route('connect.edit', 'instance2') }}" class="card card-custom h-100 hoverable">
                                <div class="card-body text-center p-6">
                                    <div class="symbol symbol-80px symbol-circle mb-4 mx-auto">
                                        <div class="symbol-label bg-light-warning">
                                        <i class="ki-duotone ki-information-5">
                                          <span class="path1"></span>
                                          <span class="path2"></span>
                                          <span class="path3"></span>
                                        </i>
                                        </div>
                                    </div>
                                    <h4 class="fw-bold text-gray-800 fs-2 mb-2">instance2</h4>
                                    <p class="text-muted fs-7 mb-3">D9B582F3-6C81-4283-9DC1-C7138B793DF0</p>
                                    <div class="d-flex flex-column align-items-center">
                                        <span class="text-muted fs-7 mb-1">Telefone</span>
                                        <span class="fw-semibold text-gray-800">(11) 98765-4321</span>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <!-- Empty Slot for New Connection -->
                        <div class="col-12 col-md-6 col-lg-4 connection-card">
                            <a href="{{ route('connect.create') }}" class="card card-custom h-100 hoverable empty-slot">
                                <div class="card-body text-center p-6">
                                    <div class="symbol symbol-80px symbol-circle mb-4 mx-auto">
                                        <div class="symbol-label bg-light-secondary border-2 border-dashed border-gray-400">
                                            <i class="ki-duotone ki-plus text-gray-500 fs-1">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                            </i>
                                        </div>
                                    </div>
                                    <h4 class="fw-bold text-gray-500 fs-2 mb-2">Nova Conexão</h4>
                                    <p class="text-muted fs-7 mb-3">Clique para adicionar uma nova instância</p>
                                    <div class="d-flex flex-column align-items-center">
                                        <span class="text-muted fs-7 mb-1">Status</span>
                                        <span class="fw-semibold text-gray-500">Disponível</span>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

<style>
.empty-slot {
    transition: all 0.3s ease;
    background-color: #fafbfc !important;
    border: 2px dashed #dee2e6 !important;
}

.empty-slot:hover {
    transform: translateY(-2px);
    background-color: #f8f9fa !important;
    border-color: #adb5bd !important;
}

.empty-slot .symbol-label {
    background-color: #f8f9fa !important;
    border: 2px dashed #dee2e6 !important;
}

.empty-slot:hover .symbol-label {
    background-color: #e9ecef !important;
    border-color: #adb5bd !important;
}

.empty-slot:hover .ki-plus {
    color: #6c757d !important;
}
</style>
