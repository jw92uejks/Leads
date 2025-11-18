@extends('layouts.app')
@section('title', 'Controle de Acessos - Equipe')
@section('team-panel', 'active')

@section('headlocal') @includeIf('pclient.team-panel.jscss.css') @endsection
{{-- JavaScript removido - implementar funcionalidades no backend --}}

@section('content')
    <div class="d-flex flex-column flex-column-fluid">
        <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
            <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
                <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Controle de Acessos</h1>
                    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                        <li class="breadcrumb-item text-muted">
                            <a href="{{ route('dashboard') }}" class="text-muted text-hover-primary">Início</a>
                        </li>
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-500 w-5px h-2px"></span>
                        </li>
                        <li class="breadcrumb-item text-muted">
                            <a href="{{ route('team-panel.single-team.show', $id) }}" class="text-muted text-hover-primary">Equipe Alpha</a>
                        </li>
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-500 w-5px h-2px"></span>
                        </li>
                        <li class="breadcrumb-item text-muted">Controle de Acessos</li>
                    </ul>
                </div>
                <div class="d-flex align-items-center gap-2 gap-lg-3">
                    <a href="{{ route('team-panel.index') }}" class="btn btn-light-secondary">
                        <i class="ki-duotone ki-arrow-left fs-3">
                            <span class="path1"></span>
                            <span class="path2"></span>
                        </i>Todas as Equipes
                    </a>
                </div>
            </div>
        </div>

        <div id="kt_app_content_container" class="app-container">
            <!--begin::Menu Interno da Equipe-->
            <div class="card card-flush mb-6">
                <div class="card-body p-0">
                    <div class="nav nav-tabs nav-line-tabs nav-stretch border-transparent fs-5 fw-bold" style="overflow-x: auto; overflow-y: hidden;">
                        <a class="nav-link text-active-primary border-transparent me-3" href="{{ route('team-panel.single-team.show', $id) }}">
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
                        <a class="nav-link text-active-primary border-transparent me-3 active" href="{{ route('team-panel.single-team.access', $id) }}">
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

            <!--begin::Card de Controle de Acessos-->
            <div class="card card-flush">
                <div class="card-header">
                    <div class="card-title">
                        <h3 class="fw-bold">Gerenciar Permissões dos Membros</h3>
                        <p class="text-muted fs-6 mb-0">Configure os níveis de acesso para cada membro da equipe</p>
                    </div>
                    <div class="card-toolbar">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#savePermissionsModal">
                            <i class="ki-duotone ki-check fs-2">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                            Salvar Alterações
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <!--begin::Tabela de Permissões-->
                    <div class="table-responsive">
                        <table class="table table-row-bordered table-row-gray-100 align-middle gs-0 gy-3">
                            <thead>
                                <tr class="fw-bold text-muted">
                                    <th class="w-200px">Membro</th>
                                    <th class="w-150px text-center">Dashboard</th>
                                    <th class="w-150px text-center">Leads</th>
                                    <th class="w-150px text-center">Mercado</th>
                                    <th class="w-150px text-center">Financeiro</th>
                                    <th class="w-150px text-center">Configurações</th>
                                    <th class="w-100px text-center">Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Membro 1 -->
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="symbol symbol-45px me-5">
                                                <img src="{{ asset('assets/images/avatars/blank.png') }}" alt="Avatar" />
                                            </div>
                                            <div class="d-flex justify-content-start flex-column">
                                                <a href="#" class="text-dark fw-bold text-hover-primary fs-6">João Silva</a>
                                                <span class="text-muted fw-semibold text-muted d-block fs-7">Proprietário</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="form-check form-check-custom form-check-solid d-flex justify-content-center">
                                            <input class="form-check-input" type="checkbox" style="width: 20px; height: 20px;" value="" id="dashboard1" checked disabled />
                                            <label class="form-check-label" for="dashboard1"></label>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="form-check form-check-custom form-check-solid d-flex justify-content-center">
                                            <input class="form-check-input" type="checkbox" style="width: 20px; height: 20px;" value="" id="leads1" checked disabled />
                                            <label class="form-check-label" for="leads1"></label>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="form-check form-check-custom form-check-solid d-flex justify-content-center">
                                            <input class="form-check-input" type="checkbox" style="width: 20px; height: 20px;" value="" id="marketplace1" checked disabled />
                                            <label class="form-check-label" for="marketplace1"></label>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="form-check form-check-custom form-check-solid d-flex justify-content-center">
                                            <input class="form-check-input" type="checkbox" style="width: 20px; height: 20px;" value="" id="financial1" checked disabled />
                                            <label class="form-check-label" for="financial1"></label>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="form-check form-check-custom form-check-solid d-flex justify-content-center">
                                            <input class="form-check-input" type="checkbox" style="width: 20px; height: 20px;" value="" id="config1" checked disabled />
                                            <label class="form-check-label" for="config1"></label>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <span class="badge badge-light-primary">Proprietário</span>
                                    </td>
                                </tr>

                                <!-- Membro 2 -->
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="symbol symbol-45px me-5">
                                                <img src="{{ asset('assets/images/avatars/blank.png') }}" alt="Avatar" />
                                            </div>
                                            <div class="d-flex justify-content-start flex-column">
                                                <a href="#" class="text-dark fw-bold text-hover-primary fs-6">Maria Santos</a>
                                                <span class="text-muted fw-semibold text-muted d-block fs-7">Gerente</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="form-check form-check-custom form-check-solid d-flex justify-content-center">
                                            <input class="form-check-input" type="checkbox" style="width: 20px; height: 20px;" value="" id="dashboard2" checked />
                                            <label class="form-check-label" for="dashboard2"></label>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="form-check form-check-custom form-check-solid d-flex justify-content-center">
                                            <input class="form-check-input" type="checkbox" style="width: 20px; height: 20px;" value="" id="leads2" checked />
                                            <label class="form-check-label" for="leads2"></label>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="form-check form-check-custom form-check-solid d-flex justify-content-center">
                                            <input class="form-check-input" type="checkbox" style="width: 20px; height: 20px;" value="" id="marketplace2" checked />
                                            <label class="form-check-label" for="marketplace2"></label>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="form-check form-check-custom form-check-solid d-flex justify-content-center">
                                            <input class="form-check-input" type="checkbox" style="width: 20px; height: 20px;" value="" id="financial2" />
                                            <label class="form-check-label" for="financial2"></label>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="form-check form-check-custom form-check-solid d-flex justify-content-center">
                                            <input class="form-check-input" type="checkbox" style="width: 20px; height: 20px;" value="" id="config2" />
                                            <label class="form-check-label" for="config2"></label>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <button type="button" class="btn btn-sm btn-light-danger" title="Remover membro">
                                            <i class="ki-duotone ki-trash fs-5">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                                <span class="path3"></span>
                                                <span class="path4"></span>
                                                <span class="path5"></span>
                                            </i>
                                        </button>
                                    </td>
                                </tr>

                                <!-- Membro 3 -->
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="symbol symbol-45px me-5">
                                                <img src="{{ asset('assets/images/avatars/blank.png') }}" alt="Avatar" />
                                            </div>
                                            <div class="d-flex justify-content-start flex-column">
                                                <a href="#" class="text-dark fw-bold text-hover-primary fs-6">Pedro Costa</a>
                                                <span class="text-muted fw-semibold text-muted d-block fs-7">Corretor</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="form-check form-check-custom form-check-solid d-flex justify-content-center">
                                            <input class="form-check-input" type="checkbox" style="width: 20px; height: 20px;" value="" id="dashboard3" checked />
                                            <label class="form-check-label" for="dashboard3"></label>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="form-check form-check-custom form-check-solid d-flex justify-content-center">
                                            <input class="form-check-input" type="checkbox" style="width: 20px; height: 20px;" value="" id="leads3" checked />
                                            <label class="form-check-label" for="leads3"></label>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="form-check form-check-custom form-check-solid d-flex justify-content-center">
                                            <input class="form-check-input" type="checkbox" style="width: 20px; height: 20px;" value="" id="marketplace3" />
                                            <label class="form-check-label" for="marketplace3"></label>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="form-check form-check-custom form-check-solid d-flex justify-content-center">
                                            <input class="form-check-input" type="checkbox" style="width: 20px; height: 20px;" value="" id="financial3" />
                                            <label class="form-check-label" for="financial3"></label>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="form-check form-check-custom form-check-solid d-flex justify-content-center">
                                            <input class="form-check-input" type="checkbox" style="width: 20px; height: 20px;" value="" id="config3" />
                                            <label class="form-check-label" for="config3"></label>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <button type="button" class="btn btn-sm btn-light-danger" title="Remover membro">
                                            <i class="ki-duotone ki-trash fs-5">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                                <span class="path3"></span>
                                                <span class="path4"></span>
                                                <span class="path5"></span>
                                            </i>
                                        </button>
                                    </td>
                                </tr>

                                <!-- Membro 4 -->
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="symbol symbol-45px me-5">
                                                <img src="{{ asset('assets/images/avatars/blank.png') }}" alt="Avatar" />
                                            </div>
                                            <div class="d-flex justify-content-start flex-column">
                                                <a href="#" class="text-dark fw-bold text-hover-primary fs-6">Ana Oliveira</a>
                                                <span class="text-muted fw-semibold text-muted d-block fs-7">Corretor</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="form-check form-check-custom form-check-solid d-flex justify-content-center">
                                            <input class="form-check-input" type="checkbox" style="width: 20px; height: 20px;" value="" id="dashboard4" checked />
                                            <label class="form-check-label" for="dashboard4"></label>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="form-check form-check-custom form-check-solid d-flex justify-content-center">
                                            <input class="form-check-input" type="checkbox" style="width: 20px; height: 20px;" value="" id="leads4" checked />
                                            <label class="form-check-label" for="leads4"></label>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="form-check form-check-custom form-check-solid d-flex justify-content-center">
                                            <input class="form-check-input" type="checkbox" style="width: 20px; height: 20px;" value="" id="marketplace4" />
                                            <label class="form-check-label" for="marketplace4"></label>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="form-check form-check-custom form-check-solid d-flex justify-content-center">
                                            <input class="form-check-input" type="checkbox" style="width: 20px; height: 20px;" value="" id="financial4" />
                                            <label class="form-check-label" for="financial4"></label>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="form-check form-check-custom form-check-solid d-flex justify-content-center">
                                            <input class="form-check-input" type="checkbox" style="width: 20px; height: 20px;" value="" id="config4" />
                                            <label class="form-check-label" for="config4"></label>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <button type="button" class="btn btn-sm btn-light-danger" title="Remover membro">
                                            <i class="ki-duotone ki-trash fs-5">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                                <span class="path3"></span>
                                                <span class="path4"></span>
                                                <span class="path5"></span>
                                            </i>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <!--end::Tabela de Permissões-->


                </div>
            </div>
            <!--end::Card de Controle de Acessos-->
        </div>
    </div>

    <!--begin::Modal de Confirmação-->
    <div class="modal fade" id="savePermissionsModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered mw-650px">
            <div class="modal-content">
                <div class="modal-header">
                    <h2>Confirmar Alterações</h2>
                    <div class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal">
                        <i class="ki-duotone ki-cross fs-1">
                            <span class="path1"></span>
                            <span class="path2"></span>
                        </i>
                    </div>
                </div>
                <div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
                    <div class="text-center mb-13">
                        <h1 class="mb-3">Salvar Permissões?</h1>
                        <div class="text-muted fw-semibold fs-5">As alterações nas permissões serão aplicadas imediatamente.</div>
                    </div>
                    <div class="d-flex flex-center flex-row-fluid pt-12">
                        <button type="button" class="btn btn-light me-3" data-bs-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">
                            <i class="ki-duotone ki-check fs-2">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                            Confirmar e Salvar
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--end::Modal de Confirmação-->
    
    <!-- Espaçamento final para evitar que a última seção fique colada no fim da página -->
    <div class="py-10"></div>

    {{-- Modais removidos - implementar funcionalidades no backend --}}
@endsection
