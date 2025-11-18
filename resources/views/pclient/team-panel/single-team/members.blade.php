@extends('layouts.app')
@section('title', 'Membros da Equipe')
@section('team-panel', 'active')

@section('headlocal') @includeIf('pclient.team-panel.jscss.css') @endsection
{{-- JavaScript removido - implementar funcionalidades no backend --}}

@section('content')
    <div class="d-flex flex-column flex-column-fluid">
        <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
            <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
                <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Membros da Equipe</h1>
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
                        <li class="breadcrumb-item text-muted">
                            <a href="{{ route('team-panel.single-team.show', $id) }}" class="text-muted text-hover-primary">Equipe Alpha</a>
                        </li>
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-500 w-5px h-2px"></span>
                        </li>
                        <li class="breadcrumb-item text-muted">Membros</li>
                    </ul>
                </div>
                <div class="d-flex align-items-center gap-2 gap-lg-3">
                    <a href="{{ route('team-panel.index') }}" class="btn btn-light-secondary">
                        <i class="ki-duotone ki-arrow-left fs-3">
                            <span class="path1"></span>
                            <span class="path2"></span>
                        </i>Todas as Equipes
                    </a>
                    <button type="button" class="btn btn-light-primary" data-bs-toggle="modal" data-bs-target="#kt_modal_add_member">
                        <i class="ki-duotone ki-plus-square fs-3">
                            <span class="path1"></span>
                            <span class="path2"></span>
                            <span class="path3"></span>
                        </i>Adicionar Membro
                    </button>
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
                        <a class="nav-link text-active-primary border-transparent me-3 active" href="{{ route('team-panel.single-team.members', $id) }}">
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

            <!--begin::Card de Estatísticas dos Membros-->
            <div class="row g-6 g-xl-9 mb-6">
                <div class="col-md-6 col-xl-3">
                    <div class="card card-flush h-xl-100">
                        <div class="card-header pt-5">
                            <div class="card-title d-flex flex-column">
                                <div class="d-flex align-items-center">
                                    <span class="fs-4 fw-semibold text-gray-400 me-1 align-self-start">Total de</span>
                                    <span class="fs-2hx fw-bold text-dark me-2 lh-1 ls-n2">4</span>
                                    <span class="badge badge-light-success fs-7 fw-bold">Membros</span>
                                </div>
                                <span class="text-gray-500 pt-1 fw-semibold fs-6">Na equipe</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-xl-3">
                    <div class="card card-flush h-xl-100">
                        <div class="card-header pt-5">
                            <div class="card-title d-flex flex-column">
                                <div class="d-flex align-items-center">
                                    <span class="fs-4 fw-semibold text-gray-400 me-1 align-self-start">Membros</span>
                                    <span class="fs-2hx fw-bold text-dark me-2 lh-1 ls-n2">3</span>
                                    <span class="badge badge-light-success fs-7 fw-bold">Ativos</span>
                                </div>
                                <span class="text-gray-500 pt-1 fw-semibold fs-6">Corretores ativos</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-xl-3">
                    <div class="card card-flush h-xl-100">
                        <div class="card-header pt-5">
                            <div class="card-title d-flex flex-column">
                                <div class="d-flex align-items-center">
                                    <span class="fs-4 fw-semibold text-gray-400 me-1 align-self-start">Performance</span>
                                    <span class="fs-2hx fw-bold text-dark me-2 lh-1 ls-n2">85%</span>
                                    <span class="badge badge-light-primary fs-7 fw-bold">Média</span>
                                </div>
                                <span class="text-gray-500 pt-1 fw-semibold fs-6">Da equipe</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-xl-3">
                    <div class="card card-flush h-xl-100">
                        <div class="card-header pt-5">
                            <div class="card-title d-flex flex-column">
                                <div class="d-flex align-items-center">
                                    <span class="fs-4 fw-semibold text-gray-400 me-1 align-self-start">Novos</span>
                                    <span class="fs-2hx fw-bold text-dark me-2 lh-1 ls-n2">1</span>
                                    <span class="badge badge-light-warning fs-7 fw-bold">Membro</span>
                                </div>
                                <span class="text-gray-500 pt-1 fw-semibold fs-6">Este mês</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end::Card de Estatísticas dos Membros-->

            <!--begin::Tabela de Membros-->
            <div class="card card-flush">
                <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                    <div class="card-title">
                        <!-- Input de busca removido conforme solicitado -->
                    </div>
                    <div class="card-toolbar flex-row-fluid justify-content-end gap-5">
                        <button type="button" class="btn btn-light-warning" id="kt_bulk_actions_members" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end" style="display: none;">
                            <i class="ki-duotone ki-gear fs-3">
                                <span class="path1"></span>
                                <span class="path2"></span>
                                <span class="path3"></span>
                                <span class="path4"></span>
                                <span class="path5"></span>
                            </i>Ações em Massa
                        </button>
                        <div class="menu menu-sub menu-sub-dropdown w-200px" data-kt-menu="true" id="kt_bulk_actions_members_menu">
                            <div class="menu-item px-3">
                                <a href="#" class="menu-link px-3" data-kt-bulk-action="activate-members">
                                    <i class="ki-duotone ki-toggle-on-circle fs-3 me-2">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                    Ativar Selecionados
                                </a>
                            </div>
                            <div class="menu-item px-3">
                                <a href="#" class="menu-link px-3" data-kt-bulk-action="deactivate-members">
                                    <i class="ki-duotone ki-toggle-off-circle fs-3 me-2">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                    Desativar Selecionados
                                </a>
                            </div>
                            <div class="menu-separator my-2 opacity-75"></div>
                            <div class="menu-item px-3">
                                <a href="#" class="menu-link px-3 text-danger" data-kt-bulk-action="remove-members">
                                    <i class="ki-duotone ki-trash fs-3 me-2">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                        <span class="path3"></span>
                                        <span class="path4"></span>
                                        <span class="path5"></span>
                                    </i>
                                    Remover da Equipe
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body pt-0">
                    <div class="table-responsive">
                        <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_members_table">
                            <thead>
                                <tr class="text-start text-gray-500 fw-bold fs-7 text-uppercase gs-0">
                                    <th class="w-10px pe-2">
                                        <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                                            <input class="form-check-input" type="checkbox" data-kt-select="select_all" data-kt-members-table-select="all" value="1" />

                                    </th>
                                    <th class="min-w-200px">Membro</th>
                                    <th class="min-w-150px">Cargo</th>
                                    <th class="min-w-150px">Status</th>

                                    <th class="min-w-150px">Data de Entrada</th>
                                    <th class="text-end min-w-100px">Excluir</th>
                                </tr>
                            </thead>
                            <tbody class="fw-semibold text-gray-600">
                                <tr>
                                    <td>
                                        <div class="form-check form-check-sm form-check-custom form-check-solid">
                                            <input class="form-check-input" type="checkbox" value="1" />

                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="symbol symbol-45px symbol-circle me-4">
                                                <img src="{{ asset('assets/images/avatars/blank.png') }}" alt="João Silva" />
                                            </div>
                                            <div class="d-flex flex-column">
                                                <div class="fw-bold text-dark">João Silva</div>
                                                <div class="text-muted fs-7">joao.silva@email.com</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge badge-light-primary">Líder da Equipe</span>
                                    </td>
                                    <td><span class="badge badge-light-success">Ativo</span></td>

                                    <td data-order="2025-01-15">15/01/2025</td>
                                    <td class="text-end">
                                        <button class="btn btn-sm btn-light-danger btn-flex btn-center" data-kt-members-table-filter="remove_member" title="Remover da Equipe">
                                            <i class="ki-duotone ki-trash fs-3">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                                <span class="path3"></span>
                                                <span class="path4"></span>
                                                <span class="path5"></span>
                                            </i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-check form-check-sm form-check-custom form-check-solid">
                                            <input class="form-check-input" type="checkbox" value="2" />

                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="symbol symbol-45px symbol-circle me-4">
                                                <img src="{{ asset('assets/images/avatars/blank.png') }}" alt="Ana Lima" />
                                            </div>
                                            <div class="d-flex flex-column">
                                                <div class="fw-bold text-dark">Ana Lima</div>
                                                <div class="text-muted fs-7">ana.lima@email.com</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge badge-light-info">Corretora Sênior</span>
                                    </td>
                                    <td><span class="badge badge-light-success">Ativo</span></td>

                                    <td data-order="2025-01-20">20/01/2025</td>
                                    <td class="text-end">
                                        <button class="btn btn-sm btn-light-danger btn-flex btn-center" data-kt-members-table-filter="remove_member" title="Remover da Equipe">
                                            <i class="ki-duotone ki-trash fs-3">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                                <span class="path3"></span>
                                                <span class="path4"></span>
                                                <span class="path5"></span>
                                            </i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-check form-check-sm form-check-custom form-check-solid">
                                            <input class="form-check-input" type="checkbox" value="3" />

                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="symbol symbol-45px symbol-circle me-4">
                                                <img src="{{ asset('assets/images/avatars/blank.png') }}" alt="Carlos Oliveira" />
                                            </div>
                                            <div class="d-flex flex-column">
                                                <div class="fw-bold text-dark">Carlos Oliveira</div>
                                                <div class="text-muted fs-7">carlos.oliveira@email.com</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge badge-light-warning">Corretor</span>
                                    </td>
                                    <td><span class="badge badge-light-success">Ativo</span></td>

                                    <td data-order="2025-02-01">01/02/2025</td>
                                    <td class="text-end">
                                        <button class="btn btn-sm btn-light-danger btn-flex btn-center" data-kt-members-table-filter="remove_member" title="Remover da Equipe">
                                            <i class="ki-duotone ki-trash fs-3">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                                <span class="path3"></span>
                                                <span class="path4"></span>
                                                <span class="path5"></span>
                                            </i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="form-check form-check-sm form-check-custom form-check-solid">
                                            <input class="form-check-input" type="checkbox" value="4" />

                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="symbol symbol-45px symbol-circle me-4">
                                                <img src="{{ asset('assets/images/avatars/blank.png') }}" alt="Mariana Costa" />
                                            </div>
                                            <div class="d-flex flex-column">
                                                <div class="fw-bold text-dark">Mariana Costa</div>
                                                <div class="text-muted fs-7">mariana.costa@email.com</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge badge-light-warning">Corretora</span>
                                    </td>
                                    <td><span class="badge badge-light-warning">Inativo</span></td>

                                    <td data-order="2025-02-15">15/02/2025</td>
                                    <td class="text-end">
                                        <button class="btn btn-sm btn-light-danger btn-flex btn-center" data-kt-members-table-filter="remove_member" title="Remover da Equipe">
                                            <i class="ki-duotone ki-trash fs-3">
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
                </div>
            </div>
            <!--end::Tabela de Membros-->
        </div>
    </div>

    <!--begin::Modal - Add Member-->
    <div class="modal fade" id="kt_modal_add_member" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered mw-650px">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="fw-bold">Adicionar Membro à Equipe</h2>
                    <div class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal">
                        <i class="ki-duotone ki-cross fs-1">
                            <span class="path1"></span>
                            <span class="path2"></span>
                        </i>
                    </div>
                </div>
                <div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
                    <form id="kt_modal_add_member_form" class="form">
                        <div class="fv-row mb-7">
                            <label class="fs-6 fw-semibold form-label mb-2">
                                <span class="required">Buscar Usuário</span>
                            </label>
                            <input class="form-control form-control-solid" placeholder="Digite nome ou email do usuário" name="search_user" id="kt_search_user" />
                            <div class="mt-3" id="kt_search_results" style="display: none;">
                                <div class="border rounded p-3">
                                    <div class="d-flex align-items-center mb-2">
                                        <div class="symbol symbol-35px symbol-circle me-3">
                                            <img src="{{ asset('assets/images/avatars/blank.png') }}" alt="Usuário" />

                                        <div class="flex-grow-1">
                                            <div class="fw-bold">Usuário Encontrado</div>
                                            <div class="text-muted">usuario@email.com</div>

                                        <button type="button" class="btn btn-sm btn-pink">
                                            Adicionar
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="fv-row mb-7">
                            <label class="fs-6 fw-semibold form-label mb-2">
                                <span class="required">Cargo na Equipe</span>
                            </label>
                            <select class="form-select form-select-solid" name="member_role" required>
                                <option value="">Selecione um cargo</option>
                                <option value="leader">Líder da Equipe</option>
                                <option value="senior">Corretor Sênior</option>
                                <option value="corretor">Corretor</option>
                                <option value="trainee">Trainee</option>
                            </select>
                        </div>
                        <div class="text-center pt-15">
                            <button type="reset" class="btn btn-light me-3" data-bs-dismiss="modal">
                                Cancelar
                            </button>
                            <button type="submit" class="btn btn-pink">
                                <span class="indicator-label">Adicionar</span>
                                <span class="indicator-progress">
                                    Aguarde... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                </span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--end::Modal - Add Member-->
    
    <!-- Espaçamento final para evitar que a última seção fique colada no fim da página -->
    <div class="py-10"></div>

    {{-- Modais removidos - implementar funcionalidades no backend --}}
@endsection
