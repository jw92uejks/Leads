@extends('layouts.app')
@section('title', 'Início')
@section('homepage', 'active')

@section('headlocal') @includeIf('pclient.menu.jscss.css') @endsection
@section('jslocal') @includeIf('pclient.menu.jscss.javascript') @endsection

@section('content')
<div class="d-flex flex-column flex-column-fluid">
    <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
        <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Início</h1>
                <span class="text-muted">Painel de navegação do sistema</span>
            </div>
        </div>
    </div>

    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div class="app-container container-fluid">
            <div class="row g-5 gx-xl-10 mb-5 mb-xl-10 justify-content-center">
                <div class="col-12 col-xl-10 col-xxl-8">
                    <div class="row g-5 gx-xl-8">
                    <!-- Dashboard -->
                    <div class="col-xl-4 col-md-6">
                        <a href="{{ route('dashboard') }}" class="text-decoration-none">
                            <div class="card card-flush h-xl-100 shadow-sm border-0 menu-card">
                                <div class="card-body d-flex flex-column justify-content-center align-items-center text-center py-8 px-6">
                                    <div class="mb-4">
                                        <i class="ki-duotone ki-element-11" style="color: #ffffff; font-size: 3rem;">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                            <span class="path3"></span>
                                            <span class="path4"></span>
                                        </i>
                                    </div>
                                    <h3 class="text-white fw-medium fs-4 mb-0">Dashboard</h3>
                                </div>
                            </div>
                        </a>
                    </div>

                    <!-- Conexões -->
                    @can('can-access-connections')
                    <div class="col-xl-4 col-md-6">
                        <a href="{{ route('connect.index') }}" class="text-decoration-none">
                            <div class="card card-flush h-xl-100 shadow-sm border-0 menu-card">
                                <div class="card-body d-flex flex-column justify-content-center align-items-center text-center py-8 px-6">
                                    <div class="mb-4">
                                        <i class="ki-duotone ki-scan-barcode" style="color: #ffffff; font-size: 3rem;">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                            <span class="path3"></span>
                                            <span class="path4"></span>
                                            <span class="path5"></span>
                                            <span class="path6"></span>
                                            <span class="path7"></span>
                                            <span class="path8"></span>
                                        </i>
                                    </div>
                                    <h3 class="text-white fw-medium fs-4 mb-0">Conexões</h3>
                                </div>
                            </div>
                        </a>
                    </div>
                    @endcan

                    <!-- Agenda da Secretária -->
                    <div class="col-xl-4 col-md-6">
                        <a href="{{ route('calendar.index') }}" class="text-decoration-none">
                            <div class="card card-flush h-xl-100 shadow-sm border-0 menu-card">
                                <div class="card-body d-flex flex-column justify-content-center align-items-center text-center py-8 px-6">
                                    <div class="mb-4">
                                        <i class="ki-duotone ki-calendar" style="color: #ffffff; font-size: 3rem;">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                        </i>
                                    </div>
                                    <h3 class="text-white fw-medium fs-4 mb-0">Agenda da Secretária</h3>
                                </div>
                            </div>
                        </a>
                    </div>

                    <!-- Funil de Vendas -->
                    <div class="col-xl-4 col-md-6">
                        <a href="{{ route('funnel.index') }}" class="text-decoration-none">
                            <div class="card card-flush h-xl-100 shadow-sm border-0 menu-card">
                                <div class="card-body d-flex flex-column justify-content-center align-items-center text-center py-8 px-6">
                                    <div class="mb-4">
                                        <i class="ki-duotone ki-graph-up" style="color: #ffffff; font-size: 3rem;">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                            <span class="path3"></span>
                                            <span class="path4"></span>
                                            <span class="path5"></span>
                                            <span class="path6"></span>
                                        </i>
                                    </div>
                                    <h3 class="text-white fw-medium fs-4 mb-0">Funil de Vendas</h3>
                                </div>
                            </div>
                        </a>
                    </div>

                    <!-- Carteira de Clientes -->
                    <div class="col-xl-4 col-md-6">
                        <a href="{{ route('customer.index') }}" class="text-decoration-none">
                            <div class="card card-flush h-xl-100 shadow-sm border-0 menu-card">
                                <div class="card-body d-flex flex-column justify-content-center align-items-center text-center py-8 px-6">
                                    <div class="mb-4">
                                        <i class="ki-duotone ki-wallet" style="color: #ffffff; font-size: 3rem;">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                            <span class="path3"></span>
                                            <span class="path4"></span>
                                        </i>
                                    </div>
                                    <h3 class="text-white fw-medium fs-4 mb-0">Carteira de Clientes</h3>
                                </div>
                            </div>
                        </a>
                    </div>

                    <!-- Base de Contatos -->
                    <div class="col-xl-4 col-md-6">
                        <a href="{{ route('contact.index') }}" class="text-decoration-none">
                            <div class="card card-flush h-xl-100 shadow-sm border-0 menu-card">
                                <div class="card-body d-flex flex-column justify-content-center align-items-center text-center py-8 px-6">
                                    <div class="mb-4">
                                        <i class="ki-duotone ki-address-book" style="color: #ffffff; font-size: 3rem;">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                            <span class="path3"></span>
                                        </i>
                                    </div>
                                    <h3 class="text-white fw-medium fs-4 mb-0">Base de Contatos</h3>
                                </div>
                            </div>
                        </a>
                    </div>

                    <!-- Mercado de Leads -->
                    <div class="col-xl-4 col-md-6">
                        <a href="{{ route('marketplace.index') }}" class="text-decoration-none">
                            <div class="card card-flush h-xl-100 shadow-sm border-0 menu-card">
                                <div class="card-body d-flex flex-column justify-content-center align-items-center text-center py-8 px-6">
                                    <div class="mb-4">
                                        <i class="ki-duotone ki-shop" style="color: #ffffff; font-size: 3rem;">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                            <span class="path3"></span>
                                            <span class="path4"></span>
                                            <span class="path5"></span>
                                        </i>
                                    </div>
                                    <h3 class="text-white fw-medium fs-4 mb-0">Mercado de Leads</h3>
                                </div>
                            </div>
                        </a>
                    </div>

                    <!-- Controle de Acesso -->
                    <div class="col-xl-4 col-md-6">
                        <a href="{{ route('access.index') }}" class="text-decoration-none">
                            <div class="card card-flush h-xl-100 shadow-sm border-0 menu-card">
                                <div class="card-body d-flex flex-column justify-content-center align-items-center text-center py-8 px-6">
                                    <div class="mb-4">
                                        <i class="ki-duotone ki-lock" style="color: #ffffff; font-size: 3rem;">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                            <span class="path3"></span>
                                        </i>
                                    </div>
                                    <h3 class="text-white fw-medium fs-4 mb-0">Controle de Acesso</h3>
                                </div>
                            </div>
                        </a>
                    </div>

                    <!-- Painel da Equipe -->
                    <div class="col-xl-4 col-md-6">
                        <a href="#" class="text-decoration-none" data-bs-toggle="modal" data-bs-target="#kt_modal_equipe">
                            <div class="card card-flush h-xl-100 shadow-sm border-0 menu-card">
                                <div class="card-body d-flex flex-column justify-content-center align-items-center text-center py-8 px-6">
                                    <div class="mb-4">
                                        <i class="ki-duotone ki-profile-user" style="color: #ffffff; font-size: 3rem;">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                            <span class="path3"></span>
                                            <span class="path4"></span>
                                        </i>
                                    </div>
                                    <h3 class="text-white fw-medium fs-4 mb-0">Painel da Equipe</h3>
                                </div>
                            </div>
                        </a>
                    </div>

                    <!-- Suporte -->
                    <div class="col-xl-4 col-md-6">
                        <a href="{{ route('support.index') }}" class="text-decoration-none">
                            <div class="card card-flush h-xl-100 shadow-sm border-0 menu-card">
                                <div class="card-body d-flex flex-column justify-content-center align-items-center text-center py-8 px-6">
                                    <div class="mb-4">
                                        <i class="ki-duotone ki-message-question" style="color: #ffffff; font-size: 3rem;">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                            <span class="path3"></span>
                                        </i>
                                    </div>
                                    <h3 class="text-white fw-medium fs-4 mb-0">Suporte</h3>
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

{{-- Inclui todos os modais do menu --}}
@include('pclient.menu.modals.includes')

@endsection