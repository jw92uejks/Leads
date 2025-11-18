@extends('layouts.app')
@section('title', 'Contestação')
@section('contestation', 'active')

@section('headlocal') @includeIf('pclient.contestation.jscss.css') @endsection
@section('jslocal') @includeIf('pclient.contestation.jscss.javascript') @endsection

@section('content')
<div class="d-flex flex-column flex-column-fluid">
    <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
        <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Contestação de Leads</h1>
                <span class="text-muted">Conteste a qualidade dos leads adquiridos e acompanhe seus tickets</span>
            </div>
            <div class="d-flex align-items-center gap-2 gap-lg-3">
                <button type="button" class="btn btn-sm btn-pink" data-bs-toggle="modal" data-bs-target="#kt_modal_new_ticket" style="font-size: 1.15rem;">
                    Nova Contestação
                </button>
            </div>
        </div>
    </div>

    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-fluid">
            <div class="card">
                <div class="card-header border-0 pt-6">
                    <div class="card-title">
                        <div class="d-flex align-items-center position-relative my-1">
                            <i class="ki-duotone ki-magnifier fs-3 position-absolute ms-5">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                            <input type="text" data-kt-table-filter="search" class="form-control w-250px ps-13" style="background-color: white; border: 1px solid #e4e6ef;" placeholder="Buscar tickets...">
                        </div>
                    </div>
                    <div class="card-toolbar">
                        <div class="d-flex justify-content-end" data-kt-table-toolbar="base">
                            <button type="button" class="btn btn-light-secondary me-3" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                <i class="ki-duotone ki-filter fs-2">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i>
                                Filtro
                            </button>
                            <div class="menu menu-sub menu-sub-dropdown w-300px w-md-325px" data-kt-menu="true">
                                <div class="px-7 py-5">
                                    <div class="fs-5 text-dark fw-bold">Opções de Filtro</div>
                                </div>
                                <div class="separator border-gray-200"></div>
                                <div class="px-7 py-5" data-kt-table-filter="form">
                                    <div class="mb-10">
                                        <label class="form-label fs-6 fw-semibold">Status:</label>
                                        <select class="form-select form-select-solid fw-bold" data-kt-select2="true" data-placeholder="Selecione um status" data-allow-clear="true" data-kt-table-filter="status" data-hide-search="true">
                                            <option></option>
                                            <option value="Aberto">Aberto</option>
                                            <option value="Em Análise">Em Análise</option>
                                            <option value="Resolvido">Resolvido</option>
                                            <option value="Fechado">Fechado</option>
                                        </select>
                                    </div>

                                    <div class="d-flex justify-content-end">
                                        <button type="reset" class="btn btn-light btn-active-light-primary fw-semibold me-2 px-6" data-kt-menu-dismiss="true" data-kt-table-filter="reset">Limpar</button>
                                        <button type="submit" class="btn btn-pink fw-semibold px-6" data-kt-menu-dismiss="true" data-kt-table-filter="filter">Aplicar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body pt-0">
                    <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_contestation_table">
                        <thead>
                            <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                                <th class="min-w-125px">ID do Ticket</th>
                                <th class="min-w-125px">Data/Hora</th>
                                <th class="min-w-125px">Assunto</th>
                                <th class="min-w-125px">Status</th>
                                <th class="min-w-125px">Última Resposta</th>
                                <th class="text-center min-w-150px">Ações</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600 fw-semibold">
                            <tr>
                                <td>
                                    <a href="#" class="text-dark fw-bold text-hover-primary fs-6 ticket-link" data-ticket-id="CTT-001">#CTT-001</a>
                                </td>
                                <td>
                                    <span class="text-dark fw-bold">15/01/2024</span>
                                    <span class="text-muted fs-7 d-block">14:30</span>
                                </td>
                                <td>
                                    <a href="#" class="text-dark fw-bold text-hover-primary ticket-subject-link" data-ticket-id="CTT-001">Lead com dados incorretos</a>
                                    <span class="text-muted fs-7 d-block mt-1">Telefone inválido e e-mail inexistente</span>
                                </td>
                                <td>
                                    <span class="badge badge-light-warning">Em Análise</span>
                                </td>
                                <td>
                                    <span class="text-muted fs-7">Há 2 horas</span>
                                    <span class="text-dark fw-bold d-block">Equipe Suporte</span>
                                </td>
                                <td class="text-center">
                                    <a href="#" class="btn btn-icon btn-sm btn-light-secondary me-1 ticket-view-btn" data-ticket-id="CTT-001" title="Ver Thread">
                                        <i class="ki-duotone ki-eye fs-4">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                            <span class="path3"></span>
                                        </i>
                                    </a>
                                    <a href="#" class="btn btn-icon btn-sm btn-light-secondary me-1 ticket-close-btn" data-ticket-id="CTT-001" title="Encerrar Ticket">
                                        <i class="ki-duotone ki-check fs-4">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                        </i>
                                    </a>
                                    <a href="#" class="btn btn-icon btn-sm btn-light-secondary ticket-delete-btn" data-ticket-id="CTT-001" title="Excluir Ticket">
                                        <i class="ki-duotone ki-trash fs-4">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                            <span class="path3"></span>
                                            <span class="path4"></span>
                                            <span class="path5"></span>
                                        </i>
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <a href="#" class="text-dark fw-bold text-hover-primary fs-6 ticket-link" data-ticket-id="CTT-002">#CTT-002</a>
                                </td>
                                <td>
                                    <span class="text-dark fw-bold">14/01/2024</span>
                                    <span class="text-muted fs-7 d-block">09:15</span>
                                </td>
                                <td>
                                    <a href="#" class="text-dark fw-bold text-hover-primary ticket-subject-link" data-ticket-id="CTT-002">Lead duplicado</a>
                                    <span class="text-muted fs-7 d-block mt-1">Mesmo contato recebido 3 vezes</span>
                                </td>
                                <td>
                                    <span class="badge badge-light-success">Resolvido</span>
                                </td>
                                <td>
                                    <span class="text-muted fs-7">Ontem</span>
                                    <span class="text-dark fw-bold d-block">João Silva</span>
                                </td>
                                <td class="text-center">
                                    <a href="#" class="btn btn-icon btn-sm btn-light-secondary me-1 ticket-view-btn" data-ticket-id="CTT-002" title="Ver Thread">
                                        <i class="ki-duotone ki-eye fs-4">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                            <span class="path3"></span>
                                        </i>
                                    </a>
                                    <a href="#" class="btn btn-icon btn-sm btn-light-secondary me-1 ticket-close-btn" data-ticket-id="CTT-002" title="Encerrar Ticket">
                                        <i class="ki-duotone ki-check fs-4">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                        </i>
                                    </a>
                                    <a href="#" class="btn btn-icon btn-sm btn-light-secondary ticket-delete-btn" data-ticket-id="CTT-002" title="Excluir Ticket">
                                        <i class="ki-duotone ki-trash fs-4">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                            <span class="path3"></span>
                                            <span class="path4"></span>
                                            <span class="path5"></span>
                                        </i>
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <a href="#" class="text-dark fw-bold text-hover-primary fs-6 ticket-link" data-ticket-id="CTT-003">#CTT-003</a>
                                </td>
                                <td>
                                    <span class="text-dark fw-bold">13/01/2024</span>
                                    <span class="text-muted fs-7 d-block">16:45</span>
                                </td>
                                <td>
                                    <a href="#" class="text-dark fw-bold text-hover-primary ticket-subject-link" data-ticket-id="CTT-003">Lead fora do segmento</a>
                                    <span class="text-muted fs-7 d-block mt-1">Empresa não está no ramo solicitado</span>
                                </td>
                                <td>
                                    <span class="badge badge-light-primary">Aberto</span>
                                </td>
                                <td>
                                    <span class="text-muted fs-7">Há 1 dia</span>
                                    <span class="text-dark fw-bold d-block">Você</span>
                                </td>
                                <td class="text-center">
                                    <a href="#" class="btn btn-icon btn-sm btn-light-secondary me-1 ticket-view-btn" data-ticket-id="CTT-003" title="Ver Thread">
                                        <i class="ki-duotone ki-eye fs-4">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                            <span class="path3"></span>
                                        </i>
                                    </a>
                                    <a href="#" class="btn btn-icon btn-sm btn-light-secondary me-1 ticket-close-btn" data-ticket-id="CTT-003" title="Encerrar Ticket">
                                        <i class="ki-duotone ki-check fs-4">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                        </i>
                                    </a>
                                    <a href="#" class="btn btn-icon btn-sm btn-light-secondary ticket-delete-btn" data-ticket-id="CTT-003" title="Excluir Ticket">
                                        <i class="ki-duotone ki-trash fs-4">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                            <span class="path3"></span>
                                            <span class="path4"></span>
                                            <span class="path5"></span>
                                        </i>
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <a href="#" class="text-dark fw-bold text-hover-primary fs-6 ticket-link" data-ticket-id="CTT-004">#CTT-004</a>
                                </td>
                                <td>
                                    <span class="text-dark fw-bold">12/01/2024</span>
                                    <span class="text-muted fs-7 d-block">11:20</span>
                                </td>
                                <td>
                                    <a href="#" class="text-dark fw-bold text-hover-primary ticket-subject-link" data-ticket-id="CTT-004">Contato inativo</a>
                                    <span class="text-muted fs-7 d-block mt-1">Número de telefone desatualizado</span>
                                </td>
                                <td>
                                    <span class="badge badge-light-warning">Em Análise</span>
                                </td>
                                <td>
                                    <span class="text-muted fs-7">Há 3 horas</span>
                                    <span class="text-dark fw-bold d-block">Maria Santos</span>
                                </td>
                                <td class="text-center">
                                    <a href="#" class="btn btn-icon btn-sm btn-light-secondary me-1 ticket-view-btn" data-ticket-id="CTT-004" title="Ver Thread">
                                        <i class="ki-duotone ki-eye fs-4">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                            <span class="path3"></span>
                                        </i>
                                    </a>
                                    <a href="#" class="btn btn-icon btn-sm btn-light-secondary me-1 ticket-close-btn" data-ticket-id="CTT-004" title="Encerrar Ticket">
                                        <i class="ki-duotone ki-check fs-4">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                        </i>
                                    </a>
                                    <a href="#" class="btn btn-icon btn-sm btn-light-secondary ticket-delete-btn" data-ticket-id="CTT-004" title="Excluir Ticket">
                                        <i class="ki-duotone ki-trash fs-4">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                            <span class="path3"></span>
                                            <span class="path4"></span>
                                            <span class="path5"></span>
                                        </i>
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <a href="#" class="text-dark fw-bold text-hover-primary fs-6 ticket-link" data-ticket-id="CTT-005">#CTT-005</a>
                                </td>
                                <td>
                                    <span class="text-dark fw-bold">11/01/2024</span>
                                    <span class="text-muted fs-7 d-block">08:35</span>
                                </td>
                                <td>
                                    <a href="#" class="text-dark fw-bold text-hover-primary ticket-subject-link" data-ticket-id="CTT-005">Empresa fechada</a>
                                    <span class="text-muted fs-7 d-block mt-1">Empresa não existe mais no endereço</span>
                                </td>
                                <td>
                                    <span class="badge badge-light-success">Resolvido</span>
                                </td>
                                <td>
                                    <span class="text-muted fs-7">Há 2 dias</span>
                                    <span class="text-dark fw-bold d-block">Pedro Costa</span>
                                </td>
                                <td class="text-center">
                                    <a href="#" class="btn btn-icon btn-sm btn-light-secondary me-1 ticket-view-btn" data-ticket-id="CTT-005" title="Ver Thread">
                                        <i class="ki-duotone ki-eye fs-4">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                            <span class="path3"></span>
                                        </i>
                                    </a>
                                    <a href="#" class="btn btn-icon btn-sm btn-light-secondary me-1 ticket-close-btn" data-ticket-id="CTT-005" title="Encerrar Ticket">
                                        <i class="ki-duotone ki-check fs-4">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                        </i>
                                    </a>
                                    <a href="#" class="btn btn-icon btn-sm btn-light-secondary ticket-delete-btn" data-ticket-id="CTT-005" title="Excluir Ticket">
                                        <i class="ki-duotone ki-trash fs-4">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                            <span class="path3"></span>
                                            <span class="path4"></span>
                                            <span class="path5"></span>
                                        </i>
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <a href="#" class="text-dark fw-bold text-hover-primary fs-6 ticket-link" data-ticket-id="CTT-006">#CTT-006</a>
                                </td>
                                <td>
                                    <span class="text-dark fw-bold">10/01/2024</span>
                                    <span class="text-muted fs-7 d-block">15:10</span>
                                </td>
                                <td>
                                    <a href="#" class="text-dark fw-bold text-hover-primary ticket-subject-link" data-ticket-id="CTT-006">Lead com informações falsas</a>
                                    <span class="text-muted fs-7 d-block mt-1">Dados pessoais não conferem</span>
                                </td>
                                <td>
                                    <span class="badge badge-light-primary">Aberto</span>
                                </td>
                                <td>
                                    <span class="text-muted fs-7">Há 5 horas</span>
                                    <span class="text-dark fw-bold d-block">Você</span>
                                </td>
                                <td class="text-center">
                                    <a href="#" class="btn btn-icon btn-sm btn-light-secondary me-1 ticket-view-btn" data-ticket-id="CTT-006" title="Ver Thread">
                                        <i class="ki-duotone ki-eye fs-4">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                            <span class="path3"></span>
                                        </i>
                                    </a>
                                    <a href="#" class="btn btn-icon btn-sm btn-light-secondary me-1 ticket-close-btn" data-ticket-id="CTT-006" title="Encerrar Ticket">
                                        <i class="ki-duotone ki-check fs-4">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                        </i>
                                    </a>
                                    <a href="#" class="btn btn-icon btn-sm btn-light-secondary ticket-delete-btn" data-ticket-id="CTT-006" title="Excluir Ticket">
                                        <i class="ki-duotone ki-trash fs-4">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                            <span class="path3"></span>
                                            <span class="path4"></span>
                                            <span class="path5"></span>
                                        </i>
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <a href="#" class="text-dark fw-bold text-hover-primary fs-6 ticket-link" data-ticket-id="CTT-007">#CTT-007</a>
                                </td>
                                <td>
                                    <span class="text-dark fw-bold">09/01/2024</span>
                                    <span class="text-muted fs-7 d-block">13:25</span>
                                </td>
                                <td>
                                    <a href="#" class="text-dark fw-bold text-hover-primary ticket-subject-link" data-ticket-id="CTT-007">Lead sem interesse</a>
                                    <span class="text-muted fs-7 d-block mt-1">Cliente não demonstrou interesse real</span>
                                </td>
                                <td>
                                    <span class="badge badge-light-warning">Em Análise</span>
                                </td>
                                <td>
                                    <span class="text-muted fs-7">Há 1 hora</span>
                                    <span class="text-dark fw-bold d-block">Ana Silva</span>
                                </td>
                                <td class="text-center">
                                    <a href="#" class="btn btn-icon btn-sm btn-light-secondary me-1 ticket-view-btn" data-ticket-id="CTT-007" title="Ver Thread">
                                        <i class="ki-duotone ki-eye fs-4">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                            <span class="path3"></span>
                                        </i>
                                    </a>
                                    <a href="#" class="btn btn-icon btn-sm btn-light-secondary me-1 ticket-close-btn" data-ticket-id="CTT-007" title="Encerrar Ticket">
                                        <i class="ki-duotone ki-check fs-4">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                        </i>
                                    </a>
                                    <a href="#" class="btn btn-icon btn-sm btn-light-secondary ticket-delete-btn" data-ticket-id="CTT-007" title="Excluir Ticket">
                                        <i class="ki-duotone ki-trash fs-4">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                            <span class="path3"></span>
                                            <span class="path4"></span>
                                            <span class="path5"></span>
                                        </i>
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <a href="#" class="text-dark fw-bold text-hover-primary fs-6 ticket-link" data-ticket-id="CTT-008">#CTT-008</a>
                                </td>
                                <td>
                                    <span class="text-dark fw-bold">08/01/2024</span>
                                    <span class="text-muted fs-7 d-block">10:50</span>
                                </td>
                                <td>
                                    <a href="#" class="text-dark fw-bold text-hover-primary ticket-subject-link" data-ticket-id="CTT-008">Lead já cliente</a>
                                    <span class="text-muted fs-7 d-block mt-1">Contato já é cliente ativo da empresa</span>
                                </td>
                                <td>
                                    <span class="badge badge-light-success">Resolvido</span>
                                </td>
                                <td>
                                    <span class="text-muted fs-7">Há 3 dias</span>
                                    <span class="text-dark fw-bold d-block">Carlos Mendes</span>
                                </td>
                                <td class="text-center">
                                    <a href="#" class="btn btn-icon btn-sm btn-light-secondary me-1 ticket-view-btn" data-ticket-id="CTT-008" title="Ver Thread">
                                        <i class="ki-duotone ki-eye fs-4">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                            <span class="path3"></span>
                                        </i>
                                    </a>
                                    <a href="#" class="btn btn-icon btn-sm btn-light-secondary me-1 ticket-close-btn" data-ticket-id="CTT-008" title="Encerrar Ticket">
                                        <i class="ki-duotone ki-check fs-4">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                        </i>
                                    </a>
                                    <a href="#" class="btn btn-icon btn-sm btn-light-secondary ticket-delete-btn" data-ticket-id="CTT-008" title="Excluir Ticket">
                                        <i class="ki-duotone ki-trash fs-4">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                            <span class="path3"></span>
                                            <span class="path4"></span>
                                            <span class="path5"></span>
                                        </i>
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Nova Contestação -->
<div class="modal fade" id="kt_modal_new_ticket" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <div class="modal-content">
            <div class="modal-header" id="kt_modal_new_ticket_header">
                <h2 class="fw-bold">Nova Contestação</h2>
                <div class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal" aria-label="Close">
                    <i class="ki-duotone ki-cross fs-1">
                        <span class="path1"></span>
                        <span class="path2"></span>
                    </i>
                </div>
            </div>
            <div class="modal-body px-5 my-7">
                <form id="kt_modal_new_ticket_form" class="form" action="#">
                    <div class="d-flex flex-column scroll-y px-5 px-lg-10" id="kt_modal_new_ticket_scroll" data-kt-scroll="true" data-kt-scroll-activate="true" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_new_ticket_header" data-kt-scroll-wrappers="#kt_modal_new_ticket_scroll" data-kt-scroll-offset="300px">
                        <div class="fv-row mb-7">
                            <label class="fw-semibold fs-6 mb-2">Lead Contestado</label>
                            <select name="lead_id" id="lead_select" class="form-select form-select-solid fw-bold" data-kt-select2="true" data-placeholder="Selecione o lead" data-allow-clear="true" data-dropdown-parent="#kt_modal_new_ticket">
                                <option></option>
                                <option value="1">João Silva - 11987654321 - joao@empresa.com</option>
                                <option value="2">Maria Santos - 11876543210 - maria@negocio.com</option>
                                <option value="3">Pedro Costa - 11765432109 - pedro@comercio.com</option>
                            </select>
                        </div>
                        <div class="fv-row mb-7">
                            <label class="required fw-semibold fs-6 mb-2">Tipo de Problema</label>
                            <select name="problem_type" class="form-select form-select-solid fw-bold" data-kt-select2="true" data-placeholder="Selecione o tipo de problema" data-dropdown-parent="#kt_modal_new_ticket">
                                <option></option>
                                <option value="dados_incorretos">Dados Incorretos</option>
                                <option value="lead_duplicado">Lead Duplicado</option>
                                <option value="fora_segmento">Fora do Segmento</option>
                                <option value="contato_inativo">Contato Inativo</option>
                                <option value="empresa_fechada">Empresa Fechada</option>
                                <option value="outro">Outro</option>
                            </select>
                        </div>
                        <div class="fv-row mb-7">
                            <label class="fw-semibold fs-6 mb-2">Anexar Screenshots</label>
                            <div class="upload-area">
                                <input type="file" class="form-control form-control-solid upload-input" name="screenshots" accept="image/*" multiple id="screenshots_upload" />
                                <div class="upload-placeholder" id="upload_placeholder">
                                    <i class="ki-duotone ki-file-up fs-2 text-muted mb-3">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                        <span class="path3"></span>
                                        <span class="path4"></span>
                                    </i>
                                    <div class="text-muted fs-6">Clique para selecionar arquivos ou arraste aqui</div>
                                    <div class="text-muted fs-7 mt-1">Formatos aceitos: JPG, PNG, GIF (máximo 5 arquivos)</div>
                                </div>
                                <div class="upload-preview" id="upload_preview" style="display: none;">
                                    <div class="selected-files" id="selected_files"></div>
                                    <button type="button" class="btn btn-sm btn-light-danger mt-3" id="clear_files">
                                        <i class="ki-duotone ki-trash fs-4 me-2">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                            <span class="path3"></span>
                                        </i>
                                        Limpar arquivos
                                    </button>
                                </div>
                            </div>
                            <div class="form-text">Anexe prints ou imagens que comprovem o problema (máximo 5 arquivos)</div>
                        </div>
                        <div class="fv-row mb-15">
                            <label class="required fw-semibold fs-6 mb-2">Descrição do Problema</label>
                            <textarea name="description" class="form-control form-control-solid" placeholder="Descreva detalhadamente o problema encontrado..." rows="5"></textarea>
                        </div>
                    </div>
                    <div class="text-center pt-10">
                        <button type="button" class="btn btn-light me-3" data-kt-tickets-modal-action="cancel">Cancelar</button>
                        <button type="submit" class="btn btn-pink" data-kt-tickets-modal-action="submit">
                            <span class="indicator-label">Enviar Contestação</span>
                            <span class="indicator-progress">Enviando...
                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Thread do Ticket -->
<div class="modal fade" id="kt_modal_ticket_thread" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-900px">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="fw-bold">Thread do Ticket <span id="thread_ticket_id"></span></h2>
                <div class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal" aria-label="Close">
                    <i class="ki-duotone ki-cross fs-1">
                        <span class="path1"></span>
                        <span class="path2"></span>
                    </i>
                </div>
            </div>
            <div class="modal-body px-5 my-7">
                <div class="timeline">
                    <div class="timeline-item" id="ticket_thread_content">
                        <!-- Conteúdo da thread será carregado aqui -->
                    </div>
                </div>

                <!-- Formulário para adicionar resposta -->
                <div class="mt-10 pt-5 border-top">
                    <h5 class="fw-bold mb-5">Adicionar Resposta</h5>
                    <form id="kt_ticket_response_form">
                        <div class="mb-5">
                            <textarea class="form-control form-control-solid" placeholder="Digite sua resposta..." rows="4" name="response_text"></textarea>
                        </div>
                        <div class="text-end">
                            <button type="button" class="btn btn-light me-3" data-bs-dismiss="modal">Fechar</button>
                            <button type="submit" class="btn btn-pink">Enviar Resposta</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@if(isset($openModal) && $openModal)
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Aguardar um pouco para garantir que o modal esteja pronto
    setTimeout(function() {
        // Abrir o modal
        var modal = new bootstrap.Modal(document.getElementById('kt_modal_new_ticket'));
        modal.show();
        
        // Selecionar o lead se fornecido
        @if(isset($selectedLeadId) && $selectedLeadId)
        var leadSelect = document.getElementById('lead_select');
        if (leadSelect) {
            leadSelect.value = '{{ $selectedLeadId }}';
            // Trigger change event para atualizar o select2
            var event = new Event('change', { bubbles: true });
            leadSelect.dispatchEvent(event);
        }
        @endif
    }, 500);
});
</script>
@endif
@endsection