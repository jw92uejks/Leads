@extends('layouts.app')
@section('title', 'Detalhes da Equipe')
@section('team-panel', 'active')

@section('headlocal') @includeIf('pclient.team-panel.jscss.css') @endsection
{{-- JavaScript removido - implementar funcionalidades no backend --}}

@section('content')
    <div class="d-flex flex-column flex-column-fluid">
        <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
            <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
                <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Equipe Alpha</h1>
                    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                        <li class="breadcrumb-item text-muted">
                            <a href="{{ route('dashboard') }}" class="text-muted text-hover-primary">Início</a>
                        </li>
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-500 w-5px h-2px"></span>
                        </li>
                        <li class="breadcrumb-item text-muted">
                            <a href="{{ route('team-panel.index') }}" class="text-muted text-hover-primary">Painel da Equipe</a>
                        </li>
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-500 w-5px h-2px"></span>
                        </li>
                        <li class="breadcrumb-item text-muted">Equipe Alpha</li>
                    </ul>
                </div>
                <div class="d-flex align-items-center gap-2 gap-lg-3">
                    <a href="{{ route('team-panel.index') }}" class="btn btn-light-secondary">
                        <i class="ki-duotone ki-arrow-left fs-3">
                            <span class="path1"></span>
                            <span class="path2"></span>
                        </i>Todas as Equipes
                    </a>
                    <a href="{{ route('team-panel.single-team.edit', $id) }}" class="btn btn-light-primary">
                        <i class="ki-duotone ki-setting-3 fs-3">
                            <span class="path1"></span>
                            <span class="path2"></span>
                            <span class="path3"></span>
                            <span class="path4"></span>
                            <span class="path5"></span>
                        </i>Editar Equipe
                    </a>
                </div>
            </div>
        </div>

        <div id="kt_app_content_container" class="app-container">
            <!--begin::Menu Interno da Equipe-->
            <div class="card card-flush mb-6">
                <div class="card-body p-0">
                    <div class="nav nav-tabs nav-line-tabs nav-stretch border-transparent fs-5 fw-bold" style="overflow-x: auto; overflow-y: hidden;">
                        <a class="nav-link text-active-primary border-transparent me-3 active" href="{{ route('team-panel.single-team.show', $id) }}">
                            <i class="ki-duotone ki-element-11 fs-3 me-2">
                                <span class="path1"></span>
                                <span class="path2"></span>
                                <span class="path3"></span>
                                <span class="path4"></span>
                            </i>Visão Geral
                        </a>
                        <a class="nav-link text-active-primary border-transparent me-3" href="{{ route('team-panel.single-team.edit', $id) }}">
                            <i class="ki-duotone ki-pencil fs-3 me-2">
                                <span class="path1"></span>
                                <span class="path2"></span>
                                <span class="path3"></span>
                                <span class="path4"></span>
                            </i>Editar Equipe
                        </a>
                        <a class="nav-link text-active-primary border-transparent me-3" href="{{ route('team-panel.single-team.members', $id) }}">
                            <i class="ki-duotone ki-profile-user fs-3 me-2">
                                <span class="path1"></span>
                                <span class="path2"></span>
                                <span class="path3"></span>
                                <span class="path4"></span>
                            </i>Membros
                        </a>
                        <a class="nav-link text-active-primary border-transparent me-3" href="{{ route('team-panel.single-team.access', $id) }}">
                            <i class="ki-duotone ki-lock fs-3 me-2">
                                <span class="path1"></span>
                                <span class="path2"></span>
                                <span class="path3"></span>
                            </i>Controle de Acessos
                        </a>
                        <a class="nav-link text-active-primary border-transparent me-3" href="{{ route('team-panel.single-team.transfer', $id) }}">
                            <i class="ki-duotone ki-arrow-right-left fs-3 me-2">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>Transferência de Leads
                        </a>
                    </div>
                </div>
            </div>
            <!--end::Menu Interno da Equipe-->

            <!--begin::Card de Visão Geral-->
            <div class="row g-6 g-xl-9">
                <!--begin::Card de Estatísticas-->
                <div class="col-md-6 col-xl-3">
                    <div class="card card-flush h-xl-100">
                        <div class="card-header pt-5">
                            <div class="card-title d-flex flex-column">
                                <div class="d-flex align-items-center">
                                    <span class="fs-4 fw-semibold text-gray-400 me-1 align-self-start">Total de</span>
                                    <span class="fs-2hx fw-bold text-dark me-2 lh-1 ls-n2">4</span>
                                    <span class="badge badge-light-success fs-7 fw-bold">Membros</span>
                                </div>
                                <span class="text-gray-500 pt-1 fw-semibold fs-6">Corretores ativos</span>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end::Card de Estatísticas-->

                <!--begin::Card de Performance-->
                <div class="col-md-6 col-xl-3">
                    <div class="card card-flush h-xl-100">
                        <div class="card-header pt-5">
                            <div class="card-title d-flex flex-column">
                                <div class="d-flex align-items-center">
                                    <span class="fs-4 fw-semibold text-gray-400 me-1 align-self-start">Leads</span>
                                    <span class="fs-2hx fw-bold text-dark me-2 lh-1 ls-n2">127</span>
                                    <span class="badge badge-light-primary fs-7 fw-bold">Este mês</span>
                                </div>
                                <span class="text-gray-500 pt-1 fw-semibold fs-6">Total processados</span>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end::Card de Performance-->

                <!--begin::Card de Conversão-->
                <div class="col-md-6 col-xl-3">
                    <div class="card card-flush h-xl-100">
                        <div class="card-header pt-5">
                            <div class="card-title d-flex flex-column">
                                <div class="d-flex align-items-center">
                                    <span class="fs-4 fw-semibold text-gray-400 me-1 align-self-start">Taxa de</span>
                                    <span class="fs-2hx fw-bold text-dark me-2 lh-1 ls-n2">68%</span>
                                    <span class="badge badge-light-warning fs-7 fw-bold">Conversão</span>
                                </div>
                                <span class="text-gray-500 pt-1 fw-semibold fs-6">Média da equipe</span>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end::Card de Conversão-->

                <!--begin::Card de Status-->
                <div class="col-md-6 col-xl-3">
                    <div class="card card-flush h-xl-100">
                        <div class="card-header pt-5">
                            <div class="card-title d-flex flex-column">
                                <div class="d-flex align-items-center">
                                    <span class="fs-4 fw-semibold text-gray-400 me-1 align-self-start">Status</span>
                                    <span class="badge badge-light-success fs-7 fw-bold">Ativa</span>
                                </div>
                                <span class="text-gray-500 pt-1 fw-semibold fs-6">Equipe operacional</span>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end::Card de Status-->
            </div>
            <!--end::Card de Visão Geral-->

            <!--begin::Card de Informações da Equipe-->
            <div class="card card-flush mt-6">
                <div class="card-header">
                    <h3 class="card-title">Informações da Equipe</h3>
                </div>
                <div class="card-body">
                    <div class="row g-6">
                        <div class="col-md-6">
                            <div class="d-flex flex-column">
                                <span class="text-gray-500 fs-7 fw-semibold mb-2">Nome da Equipe</span>
                                <span class="fs-6 fw-bold text-dark">Equipe Alpha</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="d-flex flex-column">
                                <span class="text-gray-500 fs-7 fw-semibold mb-2">Data de Criação</span>
                                <span class="fs-6 fw-bold text-dark">15/01/2025</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="d-flex flex-column">
                                <span class="text-gray-500 fs-7 fw-semibold mb-2">Líder da Equipe</span>
                                <span class="fs-6 fw-bold text-dark">João Silva</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="d-flex flex-column">
                                <span class="text-gray-500 fs-7 fw-semibold mb-2">Descrição</span>
                                <span class="fs-6 fw-bold text-dark">Equipe principal de corretores especializada em leads de saúde</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end::Card de Informações da Equipe-->

            <!--begin::Card de Membros Principais-->
            <div class="card card-flush mt-6">
                <div class="card-header">
                    <h3 class="card-title">Membros Principais</h3>
                    <div class="card-toolbar">
                        <a href="{{ route('team-panel.single-team.members', $id) }}" class="btn btn-light-primary btn-sm">
                            Ver Todos os Membros
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row g-6">
                        <div class="col-md-6 col-lg-3">
                            <div class="d-flex align-items-center p-4 border rounded">
                                <div class="symbol symbol-50px symbol-circle me-4">
                                    <img src="{{ asset('assets/images/avatars/blank.png') }}" alt="João Silva" />
                                </div>
                                <div class="flex-grow-1">
                                    <div class="fw-bold text-dark">João Silva</div>
                                    <div class="text-muted fs-7">Líder da Equipe</div>
                                    <div class="badge badge-light-success fs-8 mt-1">Ativo</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-3">
                            <div class="d-flex align-items-center p-4 border rounded">
                                <div class="symbol symbol-50px symbol-circle me-4">
                                    <img src="{{ asset('assets/images/avatars/blank.png') }}" alt="Ana Lima" />
                                </div>
                                <div class="flex-grow-1">
                                    <div class="fw-bold text-dark">Ana Lima</div>
                                    <div class="text-muted fs-7">Corretora Sênior</div>
                                    <div class="badge badge-light-success fs-8 mt-1">Ativo</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-3">
                            <div class="d-flex align-items-center p-4 border rounded">
                                <div class="symbol symbol-50px symbol-circle me-4">
                                    <img src="{{ asset('assets/images/avatars/blank.png') }}" alt="Carlos Oliveira" />
                                </div>
                                <div class="flex-grow-1">
                                    <div class="fw-bold text-dark">Carlos Oliveira</div>
                                    <div class="text-muted fs-7">Corretor</div>
                                    <div class="badge badge-light-success fs-8 mt-1">Ativo</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-3">
                            <div class="d-flex align-items-center p-4 border rounded">
                                <div class="symbol symbol-50px symbol-circle me-4">
                                    <img src="{{ asset('assets/images/avatars/blank.png') }}" alt="Mariana Costa" />
                                </div>
                                <div class="flex-grow-1">
                                    <div class="fw-bold text-dark">Mariana Costa</div>
                                    <div class="text-muted fs-7">Corretora</div>
                                    <div class="badge badge-light-success fs-8 mt-1">Ativo</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end::Card de Membros Principais-->
        </div>
    </div>
    
    <!-- Espaçamento final para evitar que a última seção fique colada no fim da página -->
    <div class="py-10"></div>

    {{-- Modais removidos - implementar funcionalidades no backend --}}
@endsection
