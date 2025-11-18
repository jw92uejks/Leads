@extends('layouts.app')
@section('title', 'Editar Equipe')
@section('team-panel', 'active')

@section('headlocal') @includeIf('pclient.team-panel.jscss.css') @includeIf('pclient.team-panel.single-team.jscss.switch-styles') @endsection
{{-- JavaScript removido - implementar funcionalidades no backend --}}

@section('content')
    <div class="d-flex flex-column flex-column-fluid">
        <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
            <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
                <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Editar Equipe</h1>
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
                        <li class="breadcrumb-item text-muted">Editar</li>
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
                        <a class="nav-link text-active-primary border-transparent me-3 active" href="{{ route('team-panel.single-team.edit', $id) }}">
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

            <!--begin::Formulário de Edição-->
            <div class="card card-flush">
                <div class="card-header">
                    <h3 class="card-title pt-5">Informações da Equipe</h3>
                    <!--begin::Switch de Status-->
                    <div class="card-toolbar">
                        <div class="d-flex align-items-center">
                            <span class="fs-6 fw-semibold text-muted me-3">Status da Equipe</span>
                                                            <div class="form-check form-switch form-check-custom form-check-solid">
                                    <input class="form-check-input" type="checkbox" value="" id="team_status_switch" checked style="--bs-form-switch-width: 3rem; --bs-form-switch-height: 1.5rem;" />
                                    <label class="form-check-label" for="team_status_switch"></label>
                                </div>
                        </div>
                    </div>
                    <!--end::Switch de Status-->
                </div>
                <div class="card-body">
                    <form id="kt_edit_team_form" class="form">
                        <div class="row g-6">
                            <div class="col-md-6">
                                <div class="fv-row mb-7">
                                    <label class="fs-6 fw-semibold form-label mb-2">
                                        <span class="required">Nome da Equipe</span>
                                    </label>
                                    <input type="text" class="form-control form-control-solid" name="team_name" value="Equipe Alpha" required />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="fv-row mb-7">
                                    <label class="fs-6 fw-semibold form-label mb-2">
                                        <span class="required">Líder da Equipe</span>
                                    </label>
                                    <select class="form-select form-select-solid" name="team_leader" required>
                                        <option value="">Selecione um líder</option>
                                        <option value="1" selected>João Silva</option>
                                        <option value="2">Ana Lima</option>
                                        <option value="3">Carlos Oliveira</option>
                                        <option value="4">Mariana Costa</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        
                        <div class="fv-row mb-7">
                            <label class="fs-6 fw-semibold form-label mb-2">
                                <span class="text-muted">Descrição da Equipe</span>
                            </label>
                            <textarea class="form-control form-control-solid" name="team_description" rows="4" placeholder="Descreva os objetivos, responsabilidades e características da sua equipe...">Equipe especializada em vendas de planos de saúde, focada em atendimento personalizado e resultados excepcionais.</textarea>
                        </div>

                        <!--begin::Configurações Avançadas-->
                        <div class="fv-row mb-7">
                            <label class="fs-6 fw-semibold form-label mb-4">
                                <span class="text-dark">Configurações Avançadas</span>
                            </label>
                            <div class="row g-9">
                                <div class="col-md-6">
                                    <div class="d-flex align-items-center justify-content-between p-5 bg-light-secondary rounded border border-secondary">
                                        <div class="d-flex align-items-center">
                                            <i class="ki-duotone ki-shuffle text-secondary fs-2 me-3">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                                <span class="path3"></span>
                                                <span class="path4"></span>
                                            </i>
                                            <div>
                                                <div class="fw-bold text-dark fs-6">Atribuição Automática de Leads</div>
                                                <div class="text-muted fs-7">Permite que leads sejam distribuídos automaticamente entre os membros da equipe</div>
                                            </div>
                                        </div>
                                        <div class="form-check form-switch form-check-custom form-check-solid">
                                            <input class="form-check-input" type="checkbox" value="1" name="auto_assign_leads" id="kt_team_auto_assign" checked />
                                            <label class="form-check-label" for="kt_team_auto_assign"></label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="d-flex align-items-center justify-content-between p-5 bg-light-secondary rounded border border-secondary">
                                        <div class="d-flex align-items-center">
                                            <i class="ki-duotone ki-notification-bing text-secondary fs-2 me-3">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                                <span class="path3"></span>
                                            </i>
                                            <div>
                                                <div class="fw-bold text-dark fs-6">Notificações de Equipe</div>
                                                <div class="text-muted fs-7">Envia notificações para todos os membros sobre atividades importantes</div>
                                            </div>
                                        </div>
                                        <div class="form-check form-switch form-check-custom form-check-solid">
                                            <input class="form-check-input" type="checkbox" value="1" name="team_notifications" id="kt_team_notifications" checked />
                                            <label class="form-check-label" for="kt_team_notifications"></label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row g-9 mt-5">
                                <div class="col-md-6">
                                    <div class="d-flex align-items-center justify-content-between p-5 bg-light-secondary rounded border border-secondary">
                                        <div class="d-flex align-items-center">
                                            <i class="ki-duotone ki-graph-up text-secondary fs-2 me-3">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                                <span class="path3"></span>
                                                <span class="path4"></span>
                                                <span class="path5"></span>
                                                <span class="path6"></span>
                                            </i>
                                            <div>
                                                <div class="fw-bold text-dark fs-6">Relatórios Automáticos</div>
                                                <div class="text-muted fs-7">Gera relatórios semanais de performance da equipe</div>
                                            </div>
                                        </div>
                                        <div class="form-check form-switch form-check-custom form-check-solid">
                                            <input class="form-check-input" type="checkbox" value="1" name="auto_reports" id="kt_team_reports" />
                                            <label class="form-check-label" for="kt_team_reports"></label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="d-flex align-items-center justify-content-between p-5 bg-light-secondary rounded border border-secondary">
                                        <div class="d-flex align-items-center">
                                            <i class="ki-duotone ki-chart-simple text-secondary fs-2 me-3">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                                <span class="path3"></span>
                                                <span class="path4"></span>
                                            </i>
                                            <div>
                                                <div class="fw-bold text-dark fs-6">Analytics Avançados</div>
                                                <div class="text-muted fs-7">Habilita métricas detalhadas de performance individual e coletiva</div>
                                            </div>
                                        </div>
                                        <div class="form-check form-switch form-check-custom form-check-solid">
                                            <input class="form-check-input" type="checkbox" value="1" name="advanced_analytics" id="kt_team_analytics" checked />
                                            <label class="form-check-label" for="kt_team_analytics"></label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--end::Configurações Avançadas-->

                        <div class="text-end pt-15">
                            <button type="reset" class="btn btn-light me-3">
                                <i class="ki-duotone ki-arrow-left fs-3">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i>Cancelar
                            </button>
                            <button type="submit" class="btn btn-primary">
                                <span class="indicator-label">Salvar Alterações</span>
                                <span class="indicator-progress">
                                    Aguarde... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                </span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            <!--end::Formulário de Edição-->

            <!--begin::Ações Perigosas-->
            <div class="card card-flush mt-6 border-danger">
                <div class="card-header border-danger">
                    <h3 class="card-title text-danger pt-5">Ações Perigosas</h3>
                </div>
                <div class="card-body">
                    <div class="row g-6">
                        <div class="col-md-6">
                            <div class="d-flex flex-column">
                                <span class="text-gray-500 fs-7 fw-semibold mb-2">Desativar Equipe</span>
                                <span class="fs-6 fw-bold text-dark mb-3">Temporariamente desabilita a equipe sem perder dados</span>
                                <button type="button" class="btn btn-light-warning btn-sm w-150px">
                                    <i class="ki-duotone ki-toggle-off-circle fs-3">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>Desativar
                                </button>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="d-flex flex-column">
                                <span class="text-gray-500 fs-7 fw-semibold mb-2">Excluir Equipe</span>
                                <span class="fs-6 fw-bold text-dark mb-3">Remove permanentemente a equipe e todos os dados associados</span>
                                <button type="button" class="btn btn-light-danger btn-sm w-150px">
                                    <i class="ki-duotone ki-trash fs-3">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                        <span class="path3"></span>
                                        <span class="path4"></span>
                                        <span class="path5"></span>
                                    </i>Excluir
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end::Ações Perigosas-->
        </div>
    </div>
    
    <!-- Espaçamento final para evitar que a última seção fique colada no fim da página -->
    <div class="py-10"></div>

    {{-- Modais removidos - implementar funcionalidades no backend --}}
@endsection
