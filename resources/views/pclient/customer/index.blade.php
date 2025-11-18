@extends('layouts.app')
@section('title', 'Carteira de Clientes')
@section('customer', 'active')

@section('headlocal') @includeIf('pclient.customer.jscss.css') @endsection
@section('jslocal') @includeIf('pclient.customer.jscss.javascript') @endsection

@section('content')
    <div class="d-flex flex-column flex-column-fluid">
        <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
            <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
                <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Carteira de Clientes</h1>
                    <span class="text-muted">Gerenciamento de Relacionamento Inteligente</span>
                </div>
            </div>
        </div>

        <div class="d-flex flex-column flex-column-fluid">
            <div id="kt_app_content" class="app-content flex-column-fluid">
                <div id="kt_app_content_container" class="app-container w-100 px-6">

                    <!-- Switch de Visualização -->
                    <div class="d-flex justify-content-between align-items-center mb-6">
                        <div class="d-flex align-items-center">
                            <div class="btn-group" role="group">
                                <button type="button" class="btn btn-sm btn-light-primary active" id="view-columns" data-view="columns">
                                    <i class="ki-duotone ki-calendar-8 fs-4 me-2">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                        <span class="path3"></span>
                                        <span class="path4"></span>
                                        <span class="path5"></span>
                                        <span class="path6"></span>
                                    </i>
                                    Por Vigência
                                </button>
                                <button type="button" class="btn btn-sm btn-secondary" id="view-list" data-view="list">
                                    <i class="ki-duotone ki-row-horizontal fs-4 me-2">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                    Lista
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header border-0 pt-6">
                            <div class="card-title">
                                <div class="d-flex align-items-center position-relative my-1">
                                    <i class="ki-duotone ki-magnifier fs-3 position-absolute ms-5"><span class="path1"></span><span class="path2"></span></i>
                                    <input type="text" data-kt-customer-table-filter="search" class="form-control form-control-solid w-250px ps-12" placeholder="Buscar Clientes">
                                </div>
                            </div>

                        </div>
                        <div class="card-body pt-0">
                            <div id="kt_customers_table_wrapper" class="dt-container dt-bootstrap5 dt-empty-footer">
                                <div id="" class="table-responsive">
                                    <table class="table align-middle table-row-dashed fs-6 gy-5 dataTable" id="kt_customers_table" style="width: 100%;">
                                        <colgroup>
                                            <col data-dt-column="0" style="width: 36px;">
                                            <col data-dt-column="1" style="width: 200px;">
                                            <col data-dt-column="2" style="width: 120px;">
                                            <col data-dt-column="3" style="width: 150px;">
                                            <col data-dt-column="4" style="width: 120px;">
                                            <col data-dt-column="5" style="width: 150px;">
                                            <col data-dt-column="6" style="width: 200px;">
                                        </colgroup>
                                        <thead>
                                            <tr class="text-start text-gray-500 fw-bold fs-7 text-uppercase gs-0">
                                                <th class="w-10px pe-2 dt-orderable-none" data-dt-column="0" rowspan="1" colspan="1" aria-label="">
                                                    <span class="dt-column-title">
                                                        <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                                                            <input class="form-check-input" type="checkbox" data-kt-check="true" data-kt-check-target="#kt_customers_table .form-check-input" value="1">
                                                        </div>
                                                    </span><span class="dt-column-order"></span></th>
                                                <th class="min-w-200px dt-orderable-asc dt-orderable-desc" data-dt-column="1" rowspan="1" colspan="1" aria-label="Nome do Contato: Ative para ordenar" tabindex="0"><span class="dt-column-title" role="button">Nome do Contato</span><span class="dt-column-order"></span></th>
                                                <th class="min-w-120px dt-orderable-asc dt-orderable-desc" data-dt-column="2" rowspan="1" colspan="1" aria-label="Tipo: Ative para ordenar" tabindex="0"><span class="dt-column-title" role="button">Tipo</span><span class="dt-column-order"></span></th>
                                                <th class="min-w-150px dt-orderable-asc dt-orderable-desc" data-dt-column="3" rowspan="1" colspan="1" aria-label="Telefone: Ative para ordenar" tabindex="0"><span class="dt-column-title" role="button">Telefone (WhatsApp)</span><span class="dt-column-order"></span></th>
                                                <th class="min-w-120px dt-orderable-asc dt-orderable-desc" data-dt-column="4" rowspan="1" colspan="1" aria-label="Cidade: Ative para ordenar" tabindex="0"><span class="dt-column-title" role="button">Cidade</span><span class="dt-column-order"></span></th>
                                                <th class="min-w-150px dt-orderable-asc dt-orderable-desc" data-dt-column="5" rowspan="1" colspan="1" aria-label="Data de Criação: Ative para ordenar" tabindex="0"><span class="dt-column-title" role="button">Data de Criação</span><span class="dt-column-order"></span></th>
                                                <th class="text-center min-w-200px dt-orderable-none" data-dt-column="6" rowspan="1" colspan="1" aria-label="Relacionamento"><span class="dt-column-title">Ativar Contato para Relacionamento</span><span class="dt-column-order"></span></th>
                                            </tr>
                                        </thead>
                                        <tbody class="fw-semibold text-gray-600">
                                            <!-- Cliente Pessoa Física -->
                                            <tr>
                                                <td>
                                                    <div class="form-check form-check-sm form-check-custom form-check-solid">
                                                        <input class="form-check-input" type="checkbox" value="1">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="d-flex flex-column">
                                                        <a href="#" class="text-gray-800 text-hover-primary mb-1 fw-bold" data-bs-toggle="modal" data-bs-target="#kt_modal_relationship_management" data-customer-id="1">João Silva</a>
                                                        <span class="text-muted fs-7">Pessoa Física</span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <span class="badge badge-light-primary">PF</span>
                                                </td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <i class="ki-duotone ki-sms fs-3 text-success me-2">
                                                            <span class="path1"></span>
                                                            <span class="path2"></span>
                                                        </i>
                                                        <span class="text-gray-800">(11) 99999-9999</span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <span class="text-gray-800">São Paulo</span>
                                                </td>
                                                <td data-order="2024-01-15T10:30:00-03:00">
                                                    <span class="text-gray-800">15 Jan 2024, 10:30</span>
                                                </td>
                                                <td class="text-center">
                                                    <div class="form-check form-switch form-check-custom form-check-solid d-flex justify-content-center">
                                                        <input class="form-check-input" type="checkbox" value="1" id="relationship_1" data-customer-id="1">
                                                        <label class="form-check-label fw-semibold text-muted ms-2" for="relationship_1">
                                                            <span class="switch-label">Ativo</span>
                                                        </label>
                                                    </div>
                                                </td>
                                            </tr>

                                            <!-- Cliente Pessoa Jurídica -->
                                            <tr>
                                                <td>
                                                    <div class="form-check form-check-sm form-check-custom form-check-solid">
                                                        <input class="form-check-input" type="checkbox" value="2">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="d-flex flex-column">
                                                        <a href="#" class="text-gray-800 text-hover-primary mb-1 fw-bold" data-bs-toggle="modal" data-bs-target="#kt_modal_relationship_management" data-customer-id="2">Maria Santos</a>
                                                        <span class="text-muted fs-7">Tech Solutions Ltda</span>
                                                        <span class="text-muted fs-8">Diretora Comercial</span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <span class="badge badge-light-info">PJ</span>
                                                </td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <i class="ki-duotone ki-sms fs-3 text-success me-2">
                                                            <span class="path1"></span>
                                                            <span class="path2"></span>
                                                        </i>
                                                        <span class="text-gray-800">(11) 88888-8888</span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <span class="text-gray-800">Rio de Janeiro</span>
                                                </td>
                                                <td data-order="2024-01-20T14:15:00-03:00">
                                                    <span class="text-gray-800">20 Jan 2024, 14:15</span>
                                                </td>
                                                <td class="text-center">
                                                    <div class="form-check form-switch form-check-custom form-check-solid d-flex justify-content-center">
                                                        <input class="form-check-input" type="checkbox" value="1" id="relationship_2" data-customer-id="2" checked>
                                                        <label class="form-check-label fw-semibold text-muted ms-2" for="relationship_2">
                                                            <span class="switch-label">Ativo</span>
                                                        </label>
                                                    </div>
                                                </td>
                                            </tr>

                                            <!-- Cliente Adesão -->
                                            <tr>
                                                <td>
                                                    <div class="form-check form-check-sm form-check-custom form-check-solid">
                                                        <input class="form-check-input" type="checkbox" value="3">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="d-flex flex-column">
                                                        <a href="#" class="text-gray-800 text-hover-primary mb-1 fw-bold" data-bs-toggle="modal" data-bs-target="#kt_modal_relationship_management" data-customer-id="3">Carlos Oliveira</a>
                                                        <span class="text-muted fs-7">Pessoa Física</span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <span class="badge badge-light-success">Adesão</span>
                                                </td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <i class="ki-duotone ki-sms fs-3 text-success me-2">
                                                            <span class="path1"></span>
                                                            <span class="path2"></span>
                                                        </i>
                                                        <span class="text-gray-800">(11) 77777-7777</span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <span class="text-gray-800">Belo Horizonte</span>
                                                </td>
                                                <td data-order="2024-02-01T09:45:00-03:00">
                                                    <span class="text-gray-800">01 Fev 2024, 09:45</span>
                                                </td>
                                                <td class="text-center">
                                                    <div class="form-check form-switch form-check-custom form-check-solid d-flex justify-content-center">
                                                        <input class="form-check-input" type="checkbox" value="0" id="relationship_3" data-customer-id="3"                                                        <label class="form-check-label fw-semibold text-muted ms-2" for="relationship_3">
                                                            <span class="switch-label">Inativo</span>
                                                        </label>
                                                    </div>
                                                </td>
                                            </tr>

                                            <!-- Mais clientes para demonstrar paginação -->
                                            <tr>
                                                <td>
                                                    <div class="form-check form-check-sm form-check-custom form-check-solid">
                                                        <input class="form-check-input" type="checkbox" value="4">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="d-flex flex-column">
                                                        <a href="#" class="text-gray-800 text-hover-primary mb-1 fw-bold" data-bs-toggle="modal" data-bs-target="#kt_modal_relationship_management" data-customer-id="4">Ana Costa</a>
                                                        <span class="text-muted fs-7">Pessoa Física</span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <span class="badge badge-light-primary">PF</span>
                                                </td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <i class="ki-duotone ki-sms fs-3 text-success me-2">
                                                            <span class="path1"></span>
                                                            <span class="path2"></span>
                                                        </i>
                                                        <span class="text-gray-800">(11) 66666-6666</span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <span class="text-gray-800">Brasília</span>
                                                </td>
                                                <td data-order="2024-02-05T11:20:00-03:00">
                                                    <span class="text-gray-800">05 Fev 2024, 11:20</span>
                                                </td>
                                                <td class="text-center">
                                                    <div class="form-check form-switch form-check-custom form-check-solid d-flex justify-content-center">
                                                        <input class="form-check-input" type="checkbox" value="1" id="relationship_4" data-customer-id="4" checked>
                                                        <label class="form-check-label fw-semibold text-muted ms-2" for="relationship_4">
                                                            <span class="switch-label">Ativo</span>
                                                        </label>
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>
                                                    <div class="form-check form-check-sm form-check-custom form-check-solid">
                                                        <input class="form-check-input" type="checkbox" value="5">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="d-flex flex-column">
                                                        <a href="#" class="text-gray-800 text-hover-primary mb-1 fw-bold" data-bs-toggle="modal" data-bs-target="#kt_modal_relationship_management" data-customer-id="5">Roberto Lima</a>
                                                        <span class="text-muted fs-7">Construtora ABC Ltda</span>
                                                        <span class="text-muted fs-8">Gerente de Vendas</span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <span class="badge badge-light-info">PJ</span>
                                                </td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <i class="ki-duotone ki-sms fs-3 text-success me-2">
                                                            <span class="path1"></span>
                                                            <span class="path2"></span>
                                                        </i>
                                                        <span class="text-gray-800">(11) 55555-5555</span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <span class="text-gray-800">São Paulo</span>
                                                </td>
                                                <td data-order="2024-02-10T16:45:00-03:00">
                                                    <span class="text-gray-800">10 Fev 2024, 16:45</span>
                                                </td>
                                                <td class="text-center">
                                                    <div class="form-check form-switch form-check-custom form-check-solid d-flex justify-content-center">
                                                        <input class="form-check-input" type="checkbox" value="0" id="relationship_5" data-customer-id="5"                                                        <label class="form-check-label fw-semibold text-muted ms-2" for="relationship_5">
                                                            <span class="switch-label">Inativo</span>
                                                        </label>
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>
                                                    <div class="form-check form-check-sm form-check-custom form-check-solid">
                                                        <input class="form-check-input" type="checkbox" value="6">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="d-flex flex-column">
                                                        <a href="#" class="text-gray-800 text-hover-primary mb-1 fw-bold" data-bs-toggle="modal" data-bs-target="#kt_modal_relationship_management" data-customer-id="6">Fernanda Alves</a>
                                                        <span class="text-muted fs-7">Pessoa Física</span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <span class="badge badge-light-success">Adesão</span>
                                                </td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <i class="ki-duotone ki-sms fs-3 text-success me-2">
                                                            <span class="path1"></span>
                                                            <span class="path2"></span>
                                                        </i>
                                                        <span class="text-gray-800">(11) 44444-4444</span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <span class="text-gray-800">Salvador</span>
                                                </td>
                                                <td data-order="2024-02-15T09:30:00-03:00">
                                                    <span class="text-gray-800">15 Fev 2024, 09:30</span>
                                                </td>
                                                <td class="text-center">
                                                    <div class="form-check form-switch form-check-custom form-check-solid d-flex justify-content-center">
                                                        <input class="form-check-input" type="checkbox" value="1" id="relationship_6" data-customer-id="6" checked>
                                                        <label class="form-check-label fw-semibold text-muted ms-2" for="relationship_6">
                                                            <span class="switch-label">Ativo</span>
                                                        </label>
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>
                                                    <div class="form-check form-check-sm form-check-custom form-check-solid">
                                                        <input class="form-check-input" type="checkbox" value="7">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="d-flex flex-column">
                                                        <a href="#" class="text-gray-800 text-hover-primary mb-1 fw-bold" data-bs-toggle="modal" data-bs-target="#kt_modal_relationship_management" data-customer-id="7">Pedro Mendes</a>
                                                        <span class="text-muted fs-7">Pessoa Física</span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <span class="badge badge-light-primary">PF</span>
                                                </td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <i class="ki-duotone ki-sms fs-3 text-success me-2">
                                                            <span class="path1"></span>
                                                            <span class="path2"></span>
                                                        </i>
                                                        <span class="text-gray-800">(11) 33333-3333</span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <span class="text-gray-800">Curitiba</span>
                                                </td>
                                                <td data-order="2024-02-20T14:15:00-03:00">
                                                    <span class="text-gray-800">20 Fev 2024, 14:15</span>
                                                </td>
                                                <td class="text-center">
                                                    <div class="form-check form-switch form-check-custom form-check-solid d-flex justify-content-center">
                                                        <input class="form-check-input" type="checkbox" value="0" id="relationship_7" data-customer-id="7"                                                        <label class="form-check-label fw-semibold text-muted ms-2" for="relationship_7">
                                                            <span class="switch-label">Inativo</span>
                                                        </label>
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>
                                                    <div class="form-check form-check-sm form-check-custom form-check-solid">
                                                        <input class="form-check-input" type="checkbox" value="8">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="d-flex flex-column">
                                                        <a href="#" class="text-gray-800 text-hover-primary mb-1 fw-bold" data-bs-toggle="modal" data-bs-target="#kt_modal_relationship_management" data-customer-id="8">Lucia Ferreira</a>
                                                        <span class="text-muted fs-7">Imobiliária XYZ</span>
                                                        <span class="text-muted fs-8">Proprietária</span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <span class="badge badge-light-info">PJ</span>
                                                </td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <i class="ki-duotone ki-sms fs-3 text-success me-2">
                                                            <span class="path1"></span>
                                                            <span class="path2"></span>
                                                        </i>
                                                        <span class="text-gray-800">(11) 22222-2222</span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <span class="text-gray-800">Recife</span>
                                                </td>
                                                <td data-order="2024-02-25T10:00:00-03:00">
                                                    <span class="text-gray-800">25 Fev 2024, 10:00</span>
                                                </td>
                                                <td class="text-center">
                                                    <div class="form-check form-switch form-check-custom form-check-solid d-flex justify-content-center">
                                                        <input class="form-check-input" type="checkbox" value="1" id="relationship_8" data-customer-id="8" checked>
                                                        <label class="form-check-label fw-semibold text-muted ms-2" for="relationship_8">
                                                            <span class="switch-label">Ativo</span>
                                                        </label>
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>
                                                    <div class="form-check form-check-sm form-check-custom form-check-solid">
                                                        <input class="form-check-input" type="checkbox" value="9">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="d-flex flex-column">
                                                        <a href="#" class="text-gray-800 text-hover-primary mb-1 fw-bold" data-bs-toggle="modal" data-bs-target="#kt_modal_relationship_management" data-customer-id="9">Marcos Rodrigues</a>
                                                        <span class="text-muted fs-7">Pessoa Física</span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <span class="badge badge-light-success">Adesão</span>
                                                </td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <i class="ki-duotone ki-sms fs-3 text-success me-2">
                                                            <span class="path1"></span>
                                                            <span class="path2"></span>
                                                        </i>
                                                        <span class="text-gray-800">(11) 11111-1111</span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <span class="text-gray-800">Porto Alegre</span>
                                                </td>
                                                <td data-order="2024-03-01T13:45:00-03:00">
                                                    <span class="text-gray-800">01 Mar 2024, 13:45</span>
                                                </td>
                                                <td class="text-center">
                                                    <div class="form-check form-switch form-check-custom form-check-solid d-flex justify-content-center">
                                                        <input class="form-check-input" type="checkbox" value="0" id="relationship_9" data-customer-id="9"                                                        <label class="form-check-label fw-semibold text-muted ms-2" for="relationship_9">
                                                            <span class="switch-label">Inativo</span>
                                                        </label>
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>
                                                    <div class="form-check form-check-sm form-check-custom form-check-solid">
                                                        <input class="form-check-input" type="checkbox" value="10">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="d-flex flex-column">
                                                        <a href="#" class="text-gray-800 text-hover-primary mb-1 fw-bold" data-bs-toggle="modal" data-bs-target="#kt_modal_relationship_management" data-customer-id="10">Juliana Santos</a>
                                                        <span class="text-muted fs-7">Pessoa Física</span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <span class="badge badge-light-primary">PF</span>
                                                </td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <i class="ki-duotone ki-sms fs-3 text-success me-2">
                                                            <span class="path1"></span>
                                                            <span class="path2"></span>
                                                        </i>
                                                        <span class="text-gray-800">(11) 00000-0000</span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <span class="text-gray-800">Fortaleza</span>
                                                </td>
                                                <td data-order="2024-03-05T16:20:00-03:00">
                                                    <span class="text-gray-800">05 Mar 2024, 16:20</span>
                                                </td>
                                                <td class="text-center">
                                                    <div class="form-check form-switch form-check-custom form-check-solid d-flex justify-content-center">
                                                        <input class="form-check-input" type="checkbox" value="1" id="relationship_10" data-customer-id="10" checked>
                                                        <label class="form-check-label fw-semibold text-muted ms-2" for="relationship_10">
                                                            <span class="switch-label">Ativo</span>
                                                        </label>
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>
                                                    <div class="form-check form-check-sm form-check-custom form-check-solid">
                                                        <input class="form-check-input" type="checkbox" value="11">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="d-flex flex-column">
                                                        <a href="#" class="text-gray-800 text-hover-primary mb-1 fw-bold" data-bs-toggle="modal" data-bs-target="#kt_modal_relationship_management" data-customer-id="11">Rafael Costa</a>
                                                        <span class="text-muted fs-7">Consultoria Empresarial</span>
                                                        <span class="text-muted fs-8">Sócio-Diretor</span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <span class="badge badge-light-info">PJ</span>
                                                </td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <i class="ki-duotone ki-sms fs-3 text-success me-2">
                                                            <span class="path1"></span>
                                                            <span class="path2"></span>
                                                        </i>
                                                        <span class="text-gray-800">(11) 99999-8888</span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <span class="text-gray-800">Manaus</span>
                                                </td>
                                                <td data-order="2024-03-10T11:30:00-03:00">
                                                    <span class="text-gray-800">10 Mar 2024, 11:30</span>
                                                </td>
                                                <td class="text-center">
                                                    <div class="form-check form-switch form-check-custom form-check-solid d-flex justify-content-center">
                                                        <input class="form-check-input" type="checkbox" value="0" id="relationship_11" data-customer-id="11"                                                        <label class="form-check-label fw-semibold text-muted ms-2" for="relationship_11">
                                                            <span class="switch-label">Inativo</span>
                                                        </label>
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>
                                                    <div class="form-check form-check-sm form-check-custom form-check-solid">
                                                        <input class="form-check-input" type="checkbox" value="12">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="d-flex flex-column">
                                                        <a href="#" class="text-gray-800 text-hover-primary mb-1 fw-bold" data-bs-toggle="modal" data-bs-target="#kt_modal_relationship_management" data-customer-id="12">Patricia Lima</a>
                                                        <span class="text-muted fs-7">Pessoa Física</span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <span class="badge badge-light-success">Adesão</span>
                                                </td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <i class="ki-duotone ki-sms fs-3 text-success me-2">
                                                            <span class="path1"></span>
                                                            <span class="path2"></span>
                                                        </i>
                                                        <span class="text-gray-800">(11) 88888-7777</span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <span class="text-gray-800">Goiânia</span>
                                                </td>
                                                <td data-order="2024-03-15T09:15:00-03:00">
                                                    <span class="text-gray-800">15 Mar 2024, 09:15</span>
                                                </td>
                                                <td class="text-center">
                                                    <div class="form-check form-switch form-check-custom form-check-solid d-flex justify-content-center">
                                                        <input class="form-check-input" type="checkbox" value="1" id="relationship_12" data-customer-id="12" checked>
                                                        <label class="form-check-label fw-semibold text-muted ms-2" for="relationship_12">
                                                            <span class="switch-label">Ativo</span>
                                                        </label>
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>
                                                    <div class="form-check form-check-sm form-check-custom form-check-solid">
                                                        <input class="form-check-input" type="checkbox" value="13">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="d-flex flex-column">
                                                        <a href="#" class="text-gray-800 text-hover-primary mb-1 fw-bold" data-bs-toggle="modal" data-bs-target="#kt_modal_relationship_management" data-customer-id="13">Diego Almeida</a>
                                                        <span class="text-muted fs-7">Pessoa Física</span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <span class="badge badge-light-primary">PF</span>
                                                </td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <i class="ki-duotone ki-sms fs-3 text-success me-2">
                                                            <span class="path1"></span>
                                                            <span class="path2"></span>
                                                        </i>
                                                        <span class="text-gray-800">(11) 77777-6666</span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <span class="text-gray-800">Belém</span>
                                                </td>
                                                <td data-order="2024-03-20T15:45:00-03:00">
                                                    <span class="text-gray-800">20 Mar 2024, 15:45</span>
                                                </td>
                                                <td class="text-center">
                                                    <div class="form-check form-switch form-check-custom form-check-solid d-flex justify-content-center">
                                                        <input class="form-check-input" type="checkbox" value="0" id="relationship_13" data-customer-id="13"                                                        <label class="form-check-label fw-semibold text-muted ms-2" for="relationship_13">
                                                            <span class="switch-label">Inativo</span>
                                                        </label>
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>
                                                    <div class="form-check form-check-sm form-check-custom form-check-solid">
                                                        <input class="form-check-input" type="checkbox" value="14">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="d-flex flex-column">
                                                        <a href="#" class="text-gray-800 text-hover-primary mb-1 fw-bold" data-bs-toggle="modal" data-bs-target="#kt_modal_relationship_management" data-customer-id="14">Camila Rocha</a>
                                                        <span class="text-muted fs-7">Agência de Marketing Digital</span>
                                                        <span class="text-muted fs-8">CEO</span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <span class="badge badge-light-info">PJ</span>
                                                </td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <i class="ki-duotone ki-sms fs-3 text-success me-2">
                                                            <span class="path1"></span>
                                                            <span class="path2"></span>
                                                        </i>
                                                        <span class="text-gray-800">(11) 66666-5555</span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <span class="text-gray-800">Campinas</span>
                                                </td>
                                                <td data-order="2024-03-25T12:00:00-03:00">
                                                    <span class="text-gray-800">25 Mar 2024, 12:00</span>
                                                </td>
                                                <td class="text-center">
                                                    <div class="form-check form-switch form-check-custom form-check-solid d-flex justify-content-center">
                                                        <input class="form-check-input" type="checkbox" value="1" id="relationship_14" data-customer-id="14" checked>
                                                        <label class="form-check-label fw-semibold text-muted ms-2" for="relationship_14">
                                                            <span class="switch-label">Ativo</span>
                                                        </label>
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td>
                                                    <div class="form-check form-check-sm form-check-custom form-check-solid">
                                                        <input class="form-check-input" type="checkbox" value="15">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="d-flex flex-column">
                                                        <a href="#" class="text-gray-800 text-hover-primary mb-1 fw-bold" data-bs-toggle="modal" data-bs-target="#kt_modal_relationship_management" data-customer-id="15">Thiago Silva</a>
                                                        <span class="text-muted fs-7">Pessoa Física</span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <span class="badge badge-light-success">Adesão</span>
                                                </td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <i class="ki-duotone ki-sms fs-3 text-success me-2">
                                                            <span class="path1"></span>
                                                            <span class="path2"></span>
                                                        </i>
                                                        <span class="text-gray-800">(11) 55555-4444</span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <span class="text-gray-800">Vitória</span>
                                                </td>
                                                <td data-order="2024-03-30T08:30:00-03:00">
                                                    <span class="text-gray-800">30 Mar 2024, 08:30</span>
                                                </td>
                                                <td class="text-center">
                                                    <div class="form-check form-switch form-check-custom form-check-solid d-flex justify-content-center">
                                                        <input class="form-check-input" type="checkbox" value="0" id="relationship_15" data-customer-id="15"                                                        <label class="form-check-label fw-semibold text-muted ms-2" for="relationship_15">
                                                            <span class="switch-label">Inativo</span>
                                                        </label>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                        <tfoot></tfoot>
                                    </table>
                                </div>
                                <div id="" class="row">
                                    <div id="" class="col-sm-12 col-md-5 d-flex align-items-center justify-content-center justify-content-md-start dt-toolbar">
                                        <div><select name="kt_customers_table_length" aria-controls="kt_customers_table" class="form-select form-select-solid form-select-sm" id="dt-length-0">
                                                <option value="10">10</option>
                                                <option value="25">25</option>
                                                <option value="50">50</option>
                                                <option value="100">100</option>
                                            </select><label for="dt-length-0"></label></div>
                                    </div>
                                    <div id="" class="col-sm-12 col-md-7 d-flex align-items-center justify-content-center justify-content-md-end">
                                        <div class="dt-paging paging_simple_numbers">
                                            <nav aria-label="paginação">
                                                <ul class="pagination">
                                                    <li class="dt-paging-button page-item"><button class="page-link previous" role="link" type="button" aria-controls="kt_customers_table" aria-label="Anterior" data-dt-idx="previous"><i class="previous"></i></button></li>
                                                    <li class="dt-paging-button page-item"><button class="page-link" role="link" type="button" aria-controls="kt_customers_table" data-dt-idx="0">1</button></li>
                                                    <li class="dt-paging-button page-item active"><button class="page-link" role="link" type="button" aria-controls="kt_customers_table" aria-current="page" data-dt-idx="1">2</button></li>
                                                    <li class="dt-paging-button page-item"><button class="page-link" role="link" type="button" aria-controls="kt_customers_table" data-dt-idx="2">3</button></li>
                                                    <li class="dt-paging-button page-item"><button class="page-link" role="link" type="button" aria-controls="kt_customers_table" data-dt-idx="3">4</button></li>
                                                    <li class="dt-paging-button page-item"><button class="page-link next" role="link" type="button" aria-controls="kt_customers_table" aria-label="Próximo" data-dt-idx="next"><i class="next"></i></button></li>
                                                </ul>
                                            </nav>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Visualização por Colunas (12 Meses) -->
                    <div class="card d-none" id="view-columns-container">
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <div class="d-flex" style="overflow-x: auto;">
                                    <!-- Janeiro -->
                                    <div class="flex-shrink-0 border-end" style="min-width: 280px; max-width: 280px;">
                                        <div class="bg-light p-4 border-bottom">
                                            <h5 class="fw-bold text-gray-800 mb-1">Janeiro</h5>
                                            <span class="text-muted fs-7">2024</span>
                                        </div>
                                        <div class="p-3" style="min-height: 400px;">
                                            <!-- Card do Cliente -->
                                            <div class="card mb-3 shadow-sm hover-elevate-up cursor-pointer" data-customer-id="1">
                                                <div class="card-body p-4">
                                                    <div class="d-flex justify-content-between align-items-start mb-3">
                                                        <div class="flex-grow-1">
                                                            <h6 class="fw-bold text-gray-800 mb-1">João Silva</h6>
                                                            <span class="badge badge-light-primary fs-8 mb-2">PF</span>
                                                        </div>
                                                        <div class="form-check form-switch form-check-custom form-check-solid">
                                                            <input class="form-check-input" type="checkbox" value="1" data-customer-id="1">
                                                        </div>
                                                    </div>
                                                    <div class="d-flex align-items-center mb-2">
                                                        <i class="ki-duotone ki-sms fs-5 text-success me-2">
                                                            <span class="path1"></span>
                                                            <span class="path2"></span>
                                                        </i>
                                                        <span class="text-gray-700 fs-7">(11) 99999-9999</span>
                                                    </div>
                                                    <div class="d-flex align-items-center">
                                                        <i class="ki-duotone ki-geolocation fs-5 text-primary me-2">
                                                            <span class="path1"></span>
                                                            <span class="path2"></span>
                                                        </i>
                                                        <span class="text-gray-700 fs-7">São Paulo</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Fevereiro -->
                                    <div class="flex-shrink-0 border-end" style="min-width: 280px; max-width: 280px;">
                                        <div class="bg-light p-4 border-bottom">
                                            <h5 class="fw-bold text-gray-800 mb-1">Fevereiro</h5>
                                            <span class="text-muted fs-7">2024</span>
                                        </div>
                                        <div class="p-3" style="min-height: 400px;">
                                            <!-- Card do Cliente -->
                                            <div class="card mb-3 shadow-sm hover-elevate-up cursor-pointer" data-customer-id="3">
                                                <div class="card-body p-4">
                                                    <div class="d-flex justify-content-between align-items-start mb-3">
                                                        <div class="flex-grow-1">
                                                            <h6 class="fw-bold text-gray-800 mb-1">Carlos Oliveira</h6>
                                                            <span class="badge badge-light-success fs-8 mb-2">Adesão</span>
                                                        </div>
                                                        <div class="form-check form-switch form-check-custom form-check-solid">
                                                            <input class="form-check-input" type="checkbox" value="0" data-customer-id="3">
                                                        </div>
                                                    </div>
                                                    <div class="d-flex align-items-center mb-2">
                                                        <i class="ki-duotone ki-sms fs-5 text-success me-2">
                                                            <span class="path1"></span>
                                                            <span class="path2"></span>
                                                        </i>
                                                        <span class="text-gray-700 fs-7">(11) 77777-7777</span>
                                                    </div>
                                                    <div class="d-flex align-items-center">
                                                        <i class="ki-duotone ki-geolocation fs-5 text-primary me-2">
                                                            <span class="path1"></span>
                                                            <span class="path2"></span>
                                                        </i>
                                                        <span class="text-gray-700 fs-7">Belo Horizonte</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Março -->
                                    <div class="flex-shrink-0 border-end" style="min-width: 280px; max-width: 280px;">
                                        <div class="bg-light p-4 border-bottom">
                                            <h5 class="fw-bold text-gray-800 mb-1">Março</h5>
                                            <span class="text-muted fs-7">2024</span>
                                        </div>
                                        <div class="p-3" style="min-height: 400px;">
                                            <!-- Vazio por enquanto -->
                                        </div>
                                    </div>

                                    <!-- Abril -->
                                    <div class="flex-shrink-0 border-end" style="min-width: 280px; max-width: 280px;">
                                        <div class="bg-light p-4 border-bottom">
                                            <h5 class="fw-bold text-gray-800 mb-1">Abril</h5>
                                            <span class="text-muted fs-7">2024</span>
                                        </div>
                                        <div class="p-3" style="min-height: 400px;">
                                            <!-- Vazio por enquanto -->
                                        </div>
                                    </div>

                                    <!-- Maio -->
                                    <div class="flex-shrink-0 border-end" style="min-width: 280px; max-width: 280px;">
                                        <div class="bg-light p-4 border-bottom">
                                            <h5 class="fw-bold text-gray-800 mb-1">Maio</h5>
                                            <span class="text-muted fs-7">2024</span>
                                        </div>
                                        <div class="p-3" style="min-height: 400px;">
                                            <!-- Vazio por enquanto -->
                                        </div>
                                    </div>

                                    <!-- Junho -->
                                    <div class="flex-shrink-0 border-end" style="min-width: 280px; max-width: 280px;">
                                        <div class="bg-light p-4 border-bottom">
                                            <h5 class="fw-bold text-gray-800 mb-1">Junho</h5>
                                            <span class="text-muted fs-7">2024</span>
                                        </div>
                                        <div class="p-3" style="min-height: 400px;">
                                            <!-- Vazio por enquanto -->
                                        </div>
                                    </div>

                                    <!-- Julho -->
                                    <div class="flex-shrink-0 border-end" style="min-width: 280px; max-width: 280px;">
                                        <div class="bg-light p-4 border-bottom">
                                            <h5 class="fw-bold text-gray-800 mb-1">Julho</h5>
                                            <span class="text-muted fs-7">2024</span>
                                        </div>
                                        <div class="p-3" style="min-height: 400px;">
                                            <!-- Vazio por enquanto -->
                                        </div>
                                    </div>

                                    <!-- Agosto -->
                                    <div class="flex-shrink-0 border-end" style="min-width: 280px; max-width: 280px;">
                                        <div class="bg-light p-4 border-bottom">
                                            <h5 class="fw-bold text-gray-800 mb-1">Agosto</h5>
                                            <span class="text-muted fs-7">2024</span>
                                        </div>
                                        <div class="p-3" style="min-height: 400px;">
                                            <!-- Vazio por enquanto -->
                                        </div>
                                    </div>

                                    <!-- Setembro -->
                                    <div class="flex-shrink-0 border-end" style="min-width: 280px; max-width: 280px;">
                                        <div class="bg-light p-4 border-bottom">
                                            <h5 class="fw-bold text-gray-800 mb-1">Setembro</h5>
                                            <span class="text-muted fs-7">2024</span>
                                        </div>
                                        <div class="p-3" style="min-height: 400px;">
                                            <!-- Vazio por enquanto -->
                                        </div>
                                    </div>

                                    <!-- Outubro -->
                                    <div class="flex-shrink-0 border-end" style="min-width: 280px; max-width: 280px;">
                                        <div class="bg-light p-4 border-bottom">
                                            <h5 class="fw-bold text-gray-800 mb-1">Outubro</h5>
                                            <span class="text-muted fs-7">2024</span>
                                        </div>
                                        <div class="p-3" style="min-height: 400px;">
                                            <!-- Vazio por enquanto -->
                                        </div>
                                    </div>

                                    <!-- Novembro -->
                                    <div class="flex-shrink-0 border-end" style="min-width: 280px; max-width: 280px;">
                                        <div class="bg-light p-4 border-bottom">
                                            <h5 class="fw-bold text-gray-800 mb-1">Novembro</h5>
                                            <span class="text-muted fs-7">2024</span>
                                        </div>
                                        <div class="p-3" style="min-height: 400px;">
                                            <!-- Vazio por enquanto -->
                                        </div>
                                    </div>

                                    <!-- Dezembro -->
                                    <div class="flex-shrink-0" style="min-width: 280px; max-width: 280px;">
                                        <div class="bg-light p-4 border-bottom">
                                            <h5 class="fw-bold text-gray-800 mb-1">Dezembro</h5>
                                            <span class="text-muted fs-7">2024</span>
                                        </div>
                                        <div class="p-3" style="min-height: 400px;">
                                            <!-- Vazio por enquanto -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal de Gerenciamento de Relacionamento -->
                    <div class="modal fade" id="kt_modal_relationship_management" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-xl">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h2 class="fw-bold">Gerenciamento de Relacionamento</h2>
                                    <div id="kt_modal_relationship_management_close" class="btn btn-icon btn-sm btn-active-icon-primary">
                                        <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                                    </div>
                                </div>
                                <div class="modal-body py-10 px-lg-17">
                                    <div class="scroll-y me-n7 pe-7" id="kt_modal_relationship_management_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_relationship_management_header" data-kt-scroll-wrappers="#kt_modal_relationship_management_scroll" data-kt-scroll-offset="300px" style="max-height: 70vh;">

                                        <!-- Informações do Cliente -->
                                        <div class="card mb-8">
                                            <div class="card-header">
                                                <h3 class="card-title">Informações do Cliente</h3>
                                            </div>
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="d-flex flex-column mb-5">
                                                            <label class="fs-6 fw-semibold mb-2">Nome do Cliente:</label>
                                                            <span class="text-gray-800 fw-bold" id="customer_name">-</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="d-flex flex-column mb-5">
                                                            <label class="fs-6 fw-semibold mb-2">Tipo:</label>
                                                            <span class="text-gray-800" id="customer_type">-</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="d-flex flex-column mb-5">
                                                            <label class="fs-6 fw-semibold mb-2">Telefone:</label>
                                                            <span class="text-gray-800" id="customer_phone">-</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="d-flex flex-column mb-5">
                                                            <label class="fs-6 fw-semibold mb-2">Cidade:</label>
                                                            <span class="text-gray-800" id="customer_city">-</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Configurações de Automação -->
                                        <div class="card">
                                            <div class="card-header">
                                                <h3 class="card-title">Configurações de Automação de Relacionamento</h3>
                                                <div class="card-toolbar">
                                                    <span class="text-muted fs-7">Configure sua secretária inteligente</span>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <form id="kt_relationship_management_form">
                                                    <input type="hidden" id="customer_id" name="customer_id">

                                                    <!-- 1. Aniversário dos Membros do Plano -->
                                                    <div class="mb-10">
                                                        <div class="d-flex align-items-center mb-5">
                                                            <h4 class="fw-bold text-gray-800 me-3">1. Aniversário dos Membros do Plano</h4>
                                                            <div class="form-check form-switch form-check-custom form-check-solid">
                                                                <input class="form-check-input" type="checkbox" name="anniversary_members_active" id="anniversary_members_active">
                                                                <label class="form-check-label fw-semibold text-muted ms-2" for="anniversary_members_active">
                                                                    Ativo
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="row mb-5">
                                                            <div class="col-md-6">
                                                                <label class="form-label fs-6 fw-semibold mb-3">Ação:</label>
                                                                <select class="form-select form-select-solid" name="anniversary_members_action">
                                                                    <option value="message">Enviar mensagem automática</option>
                                                                    <option value="reminder">Apenas lembrete ao corretor</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div id="anniversary_members_form" class="border rounded p-5 bg-light">
                                                            <div class="row mb-5">
                                                                <div class="col-md-4">
                                                                    <label class="form-label fs-6 fw-semibold mb-2">Nome</label>
                                                                    <input type="text" class="form-control form-control-solid" name="member_name[]" placeholder="Nome do membro">
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <label class="form-label fs-6 fw-semibold mb-2">Data de Nascimento</label>
                                                                    <input type="date" class="form-control form-control-solid" name="member_birthdate[]">
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <label class="form-label fs-6 fw-semibold mb-2">Sexo</label>
                                                                    <select class="form-select form-select-solid" name="member_gender[]">
                                                                        <option value="">Selecione</option>
                                                                        <option value="M">Masculino</option>
                                                                        <option value="F">Feminino</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="row mb-5">
                                                                <div class="col-md-12">
                                                                    <label class="form-label fs-6 fw-semibold mb-2">Grau de Relacionamento</label>
                                                                    <select class="form-select form-select-solid" name="member_relationship[]">
                                                                        <option value="">Selecione</option>
                                                                        <option value="titular">Titular</option>
                                                                        <option value="marido">Marido</option>
                                                                        <option value="esposa">Esposa</option>
                                                                        <option value="parceiro">Parceiro(a)</option>
                                                                        <option value="filho">Filho(a)</option>
                                                                        <option value="mae">Mãe</option>
                                                                        <option value="pai">Pai</option>
                                                                        <option value="avo">Avô</option>
                                                                        <option value="ava">Avó</option>
                                                                        <option value="tio">Tio(a)</option>
                                                                        <option value="sogro">Sogro(a)</option>
                                                                        <option value="socio">Sócio(a)</option>
                                                                        <option value="funcionario">Funcionário/colaborador</option>
                                                                        <option value="outro">Outro</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <button type="button" class="btn btn-light-primary btn-sm" onclick="addMemberRow()">
                                                                <i class="ki-duotone ki-plus fs-4"><span class="path1"></span><span class="path2"></span></i>
                                                                Adicionar Membro
                                                            </button>
                                                        </div>
                                                    </div>

                                                    <!-- 2. Aniversário da Empresa -->
                                                    <div class="mb-10">
                                                        <div class="d-flex align-items-center mb-5">
                                                            <h4 class="fw-bold text-gray-800 me-3">2. Aniversário da Empresa</h4>
                                                            <div class="form-check form-switch form-check-custom form-check-solid">
                                                                <input class="form-check-input" type="checkbox" name="company_anniversary_active" id="company_anniversary_active">
                                                                <label class="form-check-label fw-semibold text-muted ms-2" for="company_anniversary_active">
                                                                    Ativo
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="row mb-5">
                                                            <div class="col-md-6">
                                                                <label class="form-label fs-6 fw-semibold mb-3">Ação:</label>
                                                                <select class="form-select form-select-solid" name="company_anniversary_action">
                                                                    <option value="message">Enviar mensagem automática</option>
                                                                    <option value="reminder">Apenas lembrete ao corretor</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div id="company_anniversary_form" class="border rounded p-5 bg-light">
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <label class="form-label fs-6 fw-semibold mb-2">Nome da Empresa</label>
                                                                    <input type="text" class="form-control form-control-solid" name="company_name" placeholder="Nome da empresa">
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label class="form-label fs-6 fw-semibold mb-2">Data de Fundação</label>
                                                                    <input type="date" class="form-control form-control-solid" name="company_foundation_date">
                                                                    <div class="form-text">Pode ser encontrada no CNPJ</div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- 3. Aniversário de Casamento -->
                                                    <div class="mb-10">
                                                        <div class="d-flex align-items-center mb-5">
                                                            <h4 class="fw-bold text-gray-800 me-3">3. Aniversário de Casamento</h4>
                                                            <div class="form-check form-switch form-check-custom form-check-solid">
                                                                <input class="form-check-input" type="checkbox" name="marriage_anniversary_active" id="marriage_anniversary_active">
                                                                <label class="form-check-label fw-semibold text-muted ms-2" for="marriage_anniversary_active">
                                                                    Ativo
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="row mb-5">
                                                            <div class="col-md-6">
                                                                <label class="form-label fs-6 fw-semibold mb-3">Ação:</label>
                                                                <select class="form-select form-select-solid" name="marriage_anniversary_action">
                                                                    <option value="message">Enviar mensagem automática</option>
                                                                    <option value="reminder">Apenas lembrete ao corretor</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div id="marriage_anniversary_form" class="border rounded p-5 bg-light">
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <label class="form-label fs-6 fw-semibold mb-2">Nome(s) do Casal</label>
                                                                    <input type="text" class="form-control form-control-solid" name="couple_names" placeholder="Ex: João e Maria">
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label class="form-label fs-6 fw-semibold mb-2">Data do Casamento</label>
                                                                    <input type="date" class="form-control form-control-solid" name="marriage_date">
                                                                    <div class="form-text">Ex: certidão de casamento</div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- 4. Dia dos Pais -->
                                                    <div class="mb-10">
                                                        <div class="d-flex align-items-center mb-5">
                                                            <h4 class="fw-bold text-gray-800 me-3">4. Dia dos Pais</h4>
                                                            <div class="form-check form-switch form-check-custom form-check-solid">
                                                                <input class="form-check-input" type="checkbox" name="fathers_day_active" id="fathers_day_active">
                                                                <label class="form-check-label fw-semibold text-muted ms-2" for="fathers_day_active">
                                                                    Ativo
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="row mb-5">
                                                            <div class="col-md-6">
                                                                <label class="form-label fs-6 fw-semibold mb-3">Ação:</label>
                                                                <select class="form-select form-select-solid" name="fathers_day_action">
                                                                    <option value="message">Enviar mensagem automática</option>
                                                                    <option value="reminder">Apenas lembrete ao corretor</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div id="fathers_day_form" class="border rounded p-5 bg-light">
                                                            <div class="form-check form-check-custom form-check-solid mb-3">
                                                                <input class="form-check-input" type="checkbox" name="titular_is_father" id="titular_is_father">
                                                                <label class="form-check-label fw-semibold" for="titular_is_father">
                                                                    O titular é pai
                                                                </label>
                                                            </div>
                                                            <div class="form-check form-check-custom form-check-solid">
                                                                <input class="form-check-input" type="checkbox" name="has_father_member" id="has_father_member">
                                                                <label class="form-check-label fw-semibold" for="has_father_member">
                                                                    Existe outro membro cadastrado como pai
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- 5. Dia das Mães -->
                                                    <div class="mb-10">
                                                        <div class="d-flex align-items-center mb-5">
                                                            <h4 class="fw-bold text-gray-800 me-3">5. Dia das Mães</h4>
                                                            <div class="form-check form-switch form-check-custom form-check-solid">
                                                                <input class="form-check-input" type="checkbox" name="mothers_day_active" id="mothers_day_active">
                                                                <label class="form-check-label fw-semibold text-muted ms-2" for="mothers_day_active">
                                                                    Ativo
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="row mb-5">
                                                            <div class="col-md-6">
                                                                <label class="form-label fs-6 fw-semibold mb-3">Ação:</label>
                                                                <select class="form-select form-select-solid" name="mothers_day_action">
                                                                    <option value="message">Enviar mensagem automática</option>
                                                                    <option value="reminder">Apenas lembrete ao corretor</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div id="mothers_day_form" class="border rounded p-5 bg-light">
                                                            <div class="form-check form-check-custom form-check-solid mb-3">
                                                                <input class="form-check-input" type="checkbox" name="titular_is_mother" id="titular_is_mother">
                                                                <label class="form-check-label fw-semibold" for="titular_is_mother">
                                                                    O titular é mãe
                                                                </label>
                                                            </div>
                                                            <div class="form-check form-check-custom form-check-solid">
                                                                <input class="form-check-input" type="checkbox" name="has_mother_member" id="has_mother_member">
                                                                <label class="form-check-label fw-semibold" for="has_mother_member">
                                                                    Existe outro membro cadastrado como mãe
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- 6. Dia das Crianças -->
                                                    <div class="mb-10">
                                                        <div class="d-flex align-items-center mb-5">
                                                            <h4 class="fw-bold text-gray-800 me-3">6. Dia das Crianças</h4>
                                                            <div class="form-check form-switch form-check-custom form-check-solid">
                                                                <input class="form-check-input" type="checkbox" name="childrens_day_active" id="childrens_day_active">
                                                                <label class="form-check-label fw-semibold text-muted ms-2" for="childrens_day_active">
                                                                    Ativo
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="row mb-5">
                                                            <div class="col-md-6">
                                                                <label class="form-label fs-6 fw-semibold mb-3">Ação:</label>
                                                                <select class="form-select form-select-solid" name="childrens_day_action">
                                                                    <option value="message">Enviar mensagem automática</option>
                                                                    <option value="reminder">Apenas lembrete ao corretor</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div id="childrens_day_form" class="border rounded p-5 bg-light">
                                                            <div class="form-check form-check-custom form-check-solid">
                                                                <input class="form-check-input" type="checkbox" name="has_children" id="has_children">
                                                                <label class="form-check-label fw-semibold" for="has_children">
                                                                    Há criança cadastrada no plano
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- 7. Datas Religiosas/Comemorativas -->
                                                    <div class="mb-10">
                                                        <div class="d-flex align-items-center mb-5">
                                                            <h4 class="fw-bold text-gray-800 me-3">7. Datas Religiosas/Comemorativas</h4>
                                                            <div class="form-check form-switch form-check-custom form-check-solid">
                                                                <input class="form-check-input" type="checkbox" name="religious_dates_active" id="religious_dates_active">
                                                                <label class="form-check-label fw-semibold text-muted ms-2" for="religious_dates_active">
                                                                    Ativo
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="row mb-5">
                                                            <div class="col-md-6">
                                                                <label class="form-label fs-6 fw-semibold mb-3">Ação:</label>
                                                                <select class="form-select form-select-solid" name="religious_dates_action">
                                                                    <option value="message">Enviar mensagem automática</option>
                                                                    <option value="reminder">Apenas lembrete ao corretor</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div id="religious_dates_form" class="border rounded p-5 bg-light">
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <label class="form-label fs-6 fw-semibold mb-3">Datas a serem lembradas:</label>
                                                                    <div class="form-check form-check-custom form-check-solid mb-3">
                                                                        <input class="form-check-input" type="checkbox" name="religious_dates[]" value="natal" id="natal">
                                                                        <label class="form-check-label fw-semibold" for="natal">Natal</label>
                                                                    </div>
                                                                    <div class="form-check form-check-custom form-check-solid mb-3">
                                                                        <input class="form-check-input" type="checkbox" name="religious_dates[]" value="pascoa" id="pascoa">
                                                                        <label class="form-check-label fw-semibold" for="pascoa">Páscoa</label>
                                                                    </div>
                                                                    <div class="form-check form-check-custom form-check-solid">
                                                                        <input class="form-check-input" type="checkbox" name="religious_dates[]" value="ano_novo" id="ano_novo">
                                                                        <label class="form-check-label fw-semibold" for="ano_novo">Ano Novo</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- 8. Vencimento Mensal do Boleto -->
                                                    <div class="mb-10">
                                                        <div class="d-flex align-items-center mb-5">
                                                            <h4 class="fw-bold text-gray-800 me-3">8. Vencimento Mensal do Boleto</h4>
                                                            <div class="form-check form-switch form-check-custom form-check-solid">
                                                                <input class="form-check-input" type="checkbox" name="billing_due_active" id="billing_due_active">
                                                                <label class="form-check-label fw-semibold text-muted ms-2" for="billing_due_active">
                                                                    Ativo
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="row mb-5">
                                                            <div class="col-md-6">
                                                                <label class="form-label fs-6 fw-semibold mb-3">Ação:</label>
                                                                <select class="form-select form-select-solid" name="billing_due_action">
                                                                    <option value="message">Enviar mensagem automática</option>
                                                                    <option value="reminder">Apenas lembrete ao corretor</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div id="billing_due_form" class="border rounded p-5 bg-light">
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <label class="form-label fs-6 fw-semibold mb-2">Dia fixo do vencimento</label>
                                                                    <input type="number" class="form-control form-control-solid" name="billing_day" min="1" max="31" placeholder="Ex: 15">
                                                                    <div class="form-text">Dia do mês (1-31)</div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- 9. Renovação do Plano -->
                                                    <div class="mb-10">
                                                        <div class="d-flex align-items-center mb-5">
                                                            <h4 class="fw-bold text-gray-800 me-3">9. Renovação do Plano</h4>
                                                            <div class="form-check form-switch form-check-custom form-check-solid">
                                                                <input class="form-check-input" type="checkbox" name="plan_renewal_active" id="plan_renewal_active">
                                                                <label class="form-check-label fw-semibold text-muted ms-2" for="plan_renewal_active">
                                                                    Ativo
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="row mb-5">
                                                            <div class="col-md-6">
                                                                <label class="form-label fs-6 fw-semibold mb-3">Ação:</label>
                                                                <select class="form-select form-select-solid" name="plan_renewal_action">
                                                                    <option value="message">Enviar mensagem automática</option>
                                                                    <option value="reminder">Apenas lembrete ao corretor</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div id="plan_renewal_form" class="border rounded p-5 bg-light">
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <label class="form-label fs-6 fw-semibold mb-2">Data prevista de renovação</label>
                                                                    <input type="date" class="form-control form-control-solid" name="renewal_date">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- 10. Atualizações Importantes no Plano -->
                                                    <div class="mb-10">
                                                        <div class="d-flex align-items-center mb-5">
                                                            <h4 class="fw-bold text-gray-800 me-3">10. Atualizações Importantes no Plano</h4>
                                                            <div class="form-check form-switch form-check-custom form-check-solid">
                                                                <input class="form-check-input" type="checkbox" name="plan_updates_active" id="plan_updates_active">
                                                                <label class="form-check-label fw-semibold text-muted ms-2" for="plan_updates_active">
                                                                    Ativo
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="row mb-5">
                                                            <div class="col-md-6">
                                                                <label class="form-label fs-6 fw-semibold mb-3">Ação:</label>
                                                                <select class="form-select form-select-solid" name="plan_updates_action">
                                                                    <option value="message">Enviar mensagem automática</option>
                                                                    <option value="reminder">Apenas lembrete ao corretor</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div id="plan_updates_form" class="border rounded p-5 bg-light">
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <label class="form-label fs-6 fw-semibold mb-2">Atualizações previstas</label>
                                                                    <textarea class="form-control form-control-solid" name="plan_updates_text" rows="3" placeholder="Mudança de valores, benefícios, rede, regras, etc."></textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- 11. Benefícios Personalizados -->
                                                    <div class="mb-10">
                                                        <div class="d-flex align-items-center mb-5">
                                                            <h4 class="fw-bold text-gray-800 me-3">11. Benefícios Personalizados</h4>
                                                            <div class="form-check form-switch form-check-custom form-check-solid">
                                                                <input class="form-check-input" type="checkbox" name="custom_benefits_active" id="custom_benefits_active">
                                                                <label class="form-check-label fw-semibold text-muted ms-2" for="custom_benefits_active">
                                                                    Ativo
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="row mb-5">
                                                            <div class="col-md-6">
                                                                <label class="form-label fs-6 fw-semibold mb-3">Ação:</label>
                                                                <select class="form-select form-select-solid" name="custom_benefits_action">
                                                                    <option value="message">Enviar mensagem automática</option>
                                                                    <option value="reminder">Apenas lembrete ao corretor</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div id="custom_benefits_form" class="border rounded p-5 bg-light">
                                                            <div class="row mb-5">
                                                                <div class="col-md-6">
                                                                    <label class="form-label fs-6 fw-semibold mb-2">Nome do Benefício</label>
                                                                    <input type="text" class="form-control form-control-solid" name="benefit_name[]" placeholder="Ex: Check-up anual">
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label class="form-label fs-6 fw-semibold mb-2">Data/Período</label>
                                                                    <input type="text" class="form-control form-control-solid" name="benefit_date[]" placeholder="Ex: Janeiro de cada ano">
                                                                </div>
                                                            </div>
                                                            <button type="button" class="btn btn-light-primary btn-sm" onclick="addBenefitRow()">
                                                                <i class="ki-duotone ki-plus fs-4"><span class="path1"></span><span class="path2"></span></i>
                                                                Adicionar Benefício
                                                            </button>
                                                        </div>
                                                    </div>

                                                    <!-- 12. Datas Especiais Personalizadas -->
                                                    <div class="mb-10">
                                                        <div class="d-flex align-items-center mb-5">
                                                            <h4 class="fw-bold text-gray-800 me-3">12. Datas Especiais Personalizadas</h4>
                                                            <div class="form-check form-switch form-check-custom form-check-solid">
                                                                <input class="form-check-input" type="checkbox" name="custom_dates_active" id="custom_dates_active">
                                                                <label class="form-check-label fw-semibold text-muted ms-2" for="custom_dates_active">
                                                                    Ativo
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="row mb-5">
                                                            <div class="col-md-6">
                                                                <label class="form-label fs-6 fw-semibold mb-3">Ação:</label>
                                                                <select class="form-select form-select-solid" name="custom_dates_action">
                                                                    <option value="message">Enviar mensagem automática</option>
                                                                    <option value="reminder">Apenas lembrete ao corretor</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div id="custom_dates_form" class="border rounded p-5 bg-light">
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <label class="form-label fs-6 fw-semibold mb-2">Datas e descrições importantes</label>
                                                                    <textarea class="form-control form-control-solid" name="custom_dates_text" rows="4" placeholder="Ex: 'Formatura do filho - 15/12/2024', 'Abertura de filial - 20/03/2024'"></textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer flex-center">
                                    <button type="button" id="kt_modal_relationship_management_cancel" class="btn btn-light me-3">
                                        Cancelar
                                    </button>
                                    <button type="button" id="kt_modal_relationship_management_submit" class="btn btn-primary">
                                        <span class="indicator-label">
                                            Salvar Configurações
                                        </span>
                                        <span class="indicator-progress">
                                            Salvando... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                        </span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="kt_modal_add_customer" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered mw-650px">
                            <div class="modal-content">
                                <form class="form fv-plugins-bootstrap5 fv-plugins-framework" action="#" id="kt_modal_add_customer_form" data-kt-redirect="/metronic8/demo1/apps/customers/list.html">
                                    <div class="modal-header" id="kt_modal_add_customer_header">
                                        <h2 class="fw-bold">Adicionar um Cliente</h2>
                                        <div id="kt_modal_add_customer_close" class="btn btn-icon btn-sm btn-active-icon-primary">
                                            <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i> </div>
                                    </div>
                                    <div class="modal-body py-10 px-lg-17">
                                        <div class="scroll-y me-n7 pe-7" id="kt_modal_add_customer_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_add_customer_header" data-kt-scroll-wrappers="#kt_modal_add_customer_scroll" data-kt-scroll-offset="300px" style="max-height: 645px;">
                                            <div class="fv-row mb-7 fv-plugins-icon-container">
                                                <label class="required fs-6 fw-semibold mb-2">Nome</label>
                                                <input type="text" class="form-control form-control-solid" placeholder="" name="name" value="Sean Bean">
                                                <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
                                            </div>
                                            <div class="fv-row mb-7 fv-plugins-icon-container">
                                                <label class="fs-6 fw-semibold mb-2">
                                                    <span class="required">E-mail</span>
                                                    <span class="ms-1" data-bs-toggle="tooltip" aria-label="O endereço de e-mail deve estar ativo" data-bs-original-title="O endereço de e-mail deve estar ativo" data-kt-initialized="1">
                                                        <i class="ki-duotone ki-information fs-7"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i> </span>
                                                </label>
                                                <input type="email" class="form-control form-control-solid" placeholder="" name="email" value="sean@dellito.com">
                                                <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
                                            </div>
                                            <div class="fv-row mb-15">
                                                <label class="fs-6 fw-semibold mb-2">Descrição</label>
                                                <input type="text" class="form-control form-control-solid" placeholder="" name="description">
                                            </div>
                                            <div class="fw-bold fs-3 rotate collapsible mb-7" data-bs-toggle="collapse" href="#kt_modal_add_customer_billing_info" role="button" aria-expanded="false" aria-controls="kt_customer_view_details">
                                                Informações de Entrega
                                                <span class="ms-2 rotate-180">
                                                    <i class="ki-duotone ki-down fs-3"></i> </span>
                                            </div>
                                            <div id="kt_modal_add_customer_billing_info" class="collapse show">
                                                <div class="d-flex flex-column mb-7 fv-row fv-plugins-icon-container">
                                                    <label class="required fs-6 fw-semibold mb-2">Endereço Linha 1</label>
                                                    <input class="form-control form-control-solid" placeholder="" name="address1" value="101, Collins Street">
                                                    <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
                                                </div>
                                                <div class="d-flex flex-column mb-7 fv-row">
                                                    <label class="fs-6 fw-semibold mb-2">Endereço Linha 2</label>
                                                    <input class="form-control form-control-solid" placeholder="" name="address2" value="">
                                                </div>
                                                <div class="d-flex flex-column mb-7 fv-row fv-plugins-icon-container">
                                                    <label class="required fs-6 fw-semibold mb-2">Cidade</label>
                                                    <input class="form-control form-control-solid" placeholder="" name="city" value="Melbourne">
                                                    <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
                                                </div>
                                                <div class="row g-9 mb-7">
                                                    <div class="col-md-6 fv-row fv-plugins-icon-container">
                                                        <label class="required fs-6 fw-semibold mb-2">Estado / Província</label>
                                                        <input class="form-control form-control-solid" placeholder="" name="state" value="Victoria">
                                                        <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
                                                    </div>
                                                    <div class="col-md-6 fv-row fv-plugins-icon-container">
                                                        <label class="required fs-6 fw-semibold mb-2">Código Postal</label>
                                                        <input class="form-control form-control-solid" placeholder="" name="postcode" value="3000">
                                                        <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
                                                    </div>
                                                </div>
                                                <div class="d-flex flex-column mb-7 fv-row fv-plugins-icon-container">
                                                    <label class="fs-6 fw-semibold mb-2">
                                                        <span class="required">País</span>
                                                        <span class="ms-1" data-bs-toggle="tooltip" aria-label="País de origem" data-bs-original-title="País de origem" data-kt-initialized="1">
                                                            <i class="ki-duotone ki-information fs-7"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i> </span>
                                                    </label>
                                                    <select name="country" aria-label="Selecione um País" data-control="select2" data-placeholder="Selecione um País..." data-dropdown-parent="#kt_modal_add_customer" class="form-select form-select-solid fw-bold select2-hidden-accessible" data-select2-id="select2-data-12-qga2" tabindex="-1" aria-hidden="true" data-kt-initialized="1">
                                                        <option value="">Selecione um País...</option>
                                                        <option value="AF">Afeganistão</option>
                                                        <option value="AX">Ilhas Aland</option>
                                                        <option value="AL">Albânia</option>
                                                        <option value="DZ">Argélia</option>
                                                        <option value="AS">Samoa Americana</option>
                                                        <option value="AD">Andorra</option>
                                                        <option value="AO">Angola</option>
                                                        <option value="AI">Anguilla</option>
                                                        <option value="AG">Antígua e Barbuda</option>
                                                        <option value="AR">Argentina</option>
                                                        <option value="AM">Armênia</option>
                                                        <option value="AW">Aruba</option>
                                                        <option value="AU">Austrália</option>
                                                        <option value="AT">Áustria</option>
                                                        <option value="AZ">Azerbaijão</option>
                                                        <option value="BS">Bahamas</option>
                                                        <option value="BH">Bahrein</option>
                                                        <option value="BD">Bangladesh</option>
                                                        <option value="BB">Barbados</option>
                                                        <option value="BY">Bielorrússia</option>
                                                        <option value="BE">Bélgica</option>
                                                        <option value="BZ">Belize</option>
                                                        <option value="BJ">Benin</option>
                                                        <option value="BM">Bermudas</option>
                                                        <option value="BT">Butão</option>
                                                        <option value="BO">Bolívia</option>
                                                        <option value="BQ">Bonaire, Santo Eustáquio e Saba</option>
                                                        <option value="BA">Bósnia e Herzegovina</option>
                                                        <option value="BW">Botsuana</option>
                                                        <option value="BR">Brasil</option>
                                                        <option value="IO">Território Britânico do Oceano Índico</option>
                                                        <option value="BN">Brunei</option>
                                                        <option value="BG">Bulgária</option>
                                                        <option value="BF">Burkina Faso</option>
                                                        <option value="BI">Burundi</option>
                                                        <option value="KH">Camboja</option>
                                                        <option value="CM">Camarões</option>
                                                        <option value="CA">Canadá</option>
                                                        <option value="CV">Cabo Verde</option>
                                                        <option value="KY">Ilhas Cayman</option>
                                                        <option value="CF">República Centro-Africana</option>
                                                        <option value="TD">Chade</option>
                                                        <option value="CL">Chile</option>
                                                        <option value="CN">China</option>
                                                        <option value="CX">Ilha Christmas</option>
                                                        <option value="CC">Ilhas Cocos (Keeling)</option>
                                                        <option value="CO">Colômbia</option>
                                                        <option value="KM">Comores</option>
                                                        <option value="CK">Ilhas Cook</option>
                                                        <option value="CR">Costa Rica</option>
                                                        <option value="CI">Costa do Marfim</option>
                                                        <option value="HR">Croácia</option>
                                                        <option value="CU">Cuba</option>
                                                        <option value="CW">Curaçao</option>
                                                        <option value="CZ">República Tcheca</option>
                                                        <option value="DK">Dinamarca</option>
                                                        <option value="DJ">Djibuti</option>
                                                        <option value="DM">Dominica</option>
                                                        <option value="DO">República Dominicana</option>
                                                        <option value="EC">Equador</option>
                                                        <option value="EG">Egito</option>
                                                        <option value="SV">El Salvador</option>
                                                        <option value="GQ">Guiné Equatorial</option>
                                                        <option value="ER">Eritreia</option>
                                                        <option value="EE">Estônia</option>
                                                        <option value="ET">Etiópia</option>
                                                        <option value="FK">Ilhas Falkland (Malvinas)</option>
                                                        <option value="FJ">Fiji</option>
                                                        <option value="FI">Finlândia</option>
                                                        <option value="FR">França</option>
                                                        <option value="PF">Polinésia Francesa</option>
                                                        <option value="GA">Gabão</option>
                                                        <option value="GM">Gâmbia</option>
                                                        <option value="GE">Geórgia</option>
                                                        <option value="DE">Alemanha</option>
                                                        <option value="GH">Gana</option>
                                                        <option value="GI">Gibraltar</option>
                                                        <option value="GR">Grécia</option>
                                                        <option value="GL">Groenlândia</option>
                                                        <option value="GD">Granada</option>
                                                        <option value="GU">Guam</option>
                                                        <option value="GT">Guatemala</option>
                                                        <option value="GG">Guernsey</option>
                                                        <option value="GN">Guiné</option>
                                                        <option value="GW">Guiné-Bissau</option>
                                                        <option value="HT">Haiti</option>
                                                        <option value="VA">Santa Sé (Cidade do Vaticano)</option>
                                                        <option value="HN">Honduras</option>
                                                        <option value="HK">Hong Kong</option>
                                                        <option value="HU">Hungria</option>
                                                        <option value="IS">Islândia</option>
                                                        <option value="IN">Índia</option>
                                                        <option value="ID">Indonésia</option>
                                                        <option value="IR">Irã</option>
                                                        <option value="IQ">Iraque</option>
                                                        <option value="IE">Irlanda</option>
                                                        <option value="IM">Ilha de Man</option>
                                                        <option value="IL">Israel</option>
                                                        <option value="IT">Itália</option>
                                                        <option value="JM">Jamaica</option>
                                                        <option value="JP">Japão</option>
                                                        <option value="JE">Jersey</option>
                                                        <option value="JO">Jordânia</option>
                                                        <option value="KZ">Cazaquistão</option>
                                                        <option value="KE">Quênia</option>
                                                        <option value="KI">Kiribati</option>
                                                        <option value="KP">Coreia do Norte</option>
                                                        <option value="KW">Kuwait</option>
                                                        <option value="KG">Quirguistão</option>
                                                        <option value="LA">Laos</option>
                                                        <option value="LV">Letônia</option>
                                                        <option value="LB">Líbano</option>
                                                        <option value="LS">Lesoto</option>
                                                        <option value="LR">Libéria</option>
                                                        <option value="LY">Líbia</option>
                                                        <option value="LI">Liechtenstein</option>
                                                        <option value="LT">Lituânia</option>
                                                        <option value="LU">Luxemburgo</option>
                                                        <option value="MO">Macau</option>
                                                        <option value="MG">Madagascar</option>
                                                        <option value="MW">Malawi</option>
                                                        <option value="MY">Malásia</option>
                                                        <option value="MV">Maldivas</option>
                                                        <option value="ML">Mali</option>
                                                        <option value="MT">Malta</option>
                                                        <option value="MH">Ilhas Marshall</option>
                                                        <option value="MQ">Martinica</option>
                                                        <option value="MR">Mauritânia</option>
                                                        <option value="MU">Maurício</option>
                                                        <option value="MX">México</option>
                                                        <option value="FM">Micronésia</option>
                                                        <option value="MD">Moldávia</option>
                                                        <option value="MC">Mônaco</option>
                                                        <option value="MN">Mongólia</option>
                                                        <option value="ME">Montenegro</option>
                                                        <option value="MS">Montserrat</option>
                                                        <option value="MA">Marrocos</option>
                                                        <option value="MZ">Moçambique</option>
                                                        <option value="MM">Myanmar</option>
                                                        <option value="NA">Namíbia</option>
                                                        <option value="NR">Nauru</option>
                                                        <option value="NP">Nepal</option>
                                                        <option value="NL">Holanda</option>
                                                        <option value="NZ">Nova Zelândia</option>
                                                        <option value="NI">Nicarágua</option>
                                                        <option value="NE">Níger</option>
                                                        <option value="NG">Nigéria</option>
                                                        <option value="NU">Niue</option>
                                                        <option value="NF">Ilha Norfolk</option>
                                                        <option value="MP">Ilhas Marianas do Norte</option>
                                                        <option value="NO">Noruega</option>
                                                        <option value="OM">Omã</option>
                                                        <option value="PK">Paquistão</option>
                                                        <option value="PW">Palau</option>
                                                        <option value="PS">Território Palestino</option>
                                                        <option value="PA">Panamá</option>
                                                        <option value="PG">Papua Nova Guiné</option>
                                                        <option value="PY">Paraguai</option>
                                                        <option value="PE">Peru</option>
                                                        <option value="PH">Filipinas</option>
                                                        <option value="PL">Polônia</option>
                                                        <option value="PT">Portugal</option>
                                                        <option value="PR">Porto Rico</option>
                                                        <option value="QA">Catar</option>
                                                        <option value="RO">Romênia</option>
                                                        <option value="RU">Rússia</option>
                                                        <option value="RW">Ruanda</option>
                                                        <option value="BL">São Bartolomeu</option>
                                                        <option value="KN">São Cristóvão e Nevis</option>
                                                        <option value="LC">Santa Lúcia</option>
                                                        <option value="MF">São Martinho (parte francesa)</option>
                                                        <option value="VC">São Vicente e Granadinas</option>
                                                        <option value="WS">Samoa</option>
                                                        <option value="SM">San Marino</option>
                                                        <option value="ST">São Tomé e Príncipe</option>
                                                        <option value="SA">Arábia Saudita</option>
                                                        <option value="SN">Senegal</option>
                                                        <option value="RS">Sérvia</option>
                                                        <option value="SC">Seychelles</option>
                                                        <option value="SL">Serra Leoa</option>
                                                        <option value="SG">Singapura</option>
                                                        <option value="SX">Sint Maarten (parte holandesa)</option>
                                                        <option value="SK">Eslováquia</option>
                                                        <option value="SI">Eslovênia</option>
                                                        <option value="SB">Ilhas Salomão</option>
                                                        <option value="SO">Somália</option>
                                                        <option value="ZA">África do Sul</option>
                                                        <option value="KR">Coreia do Sul</option>
                                                        <option value="SS">Sudão do Sul</option>
                                                        <option value="ES">Espanha</option>
                                                        <option value="LK">Sri Lanka</option>
                                                        <option value="SD">Sudão</option>
                                                        <option value="SR">Suriname</option>
                                                        <option value="SZ">Suazilândia</option>
                                                        <option value="SE">Suécia</option>
                                                        <option value="CH">Suíça</option>
                                                        <option value="SY">Síria</option>
                                                        <option value="TW">Taiwan</option>
                                                        <option value="TJ">Tajiquistão</option>
                                                        <option value="TZ">Tanzânia</option>
                                                        <option value="TH">Tailândia</option>
                                                        <option value="TG">Togo</option>
                                                        <option value="TK">Tokelau</option>
                                                        <option value="TO">Tonga</option>
                                                        <option value="TT">Trinidad e Tobago</option>
                                                        <option value="TN">Tunísia</option>
                                                        <option value="TR">Turquia</option>
                                                        <option value="TM">Turcomenistão</option>
                                                        <option value="TC">Ilhas Turks e Caicos</option>
                                                        <option value="TV">Tuvalu</option>
                                                        <option value="UG">Uganda</option>
                                                        <option value="UA">Ucrânia</option>
                                                        <option value="AE">Emirados Árabes Unidos</option>
                                                        <option value="GB">Reino Unido</option>
                                                        <option value="US" selected="" data-select2-id="select2-data-14-y2sv">Estados Unidos</option>
                                                        <option value="UY">Uruguai</option>
                                                        <option value="UZ">Uzbequistão</option>
                                                        <option value="VU">Vanuatu</option>
                                                        <option value="VE">Venezuela</option>
                                                        <option value="VN">Vietnã</option>
                                                        <option value="VI">Ilhas Virgens</option>
                                                        <option value="YE">Iêmen</option>
                                                        <option value="ZM">Zâmbia</option>
                                                        <option value="ZW">Zimbábue</option>
                                                    </select><span class="select2 select2-container select2-container--bootstrap5" dir="ltr" data-select2-id="select2-data-13-hkyd" style="width: 100%;"><span class="selection"><span class="select2-selection select2-selection--single form-select form-select-solid fw-bold" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-disabled="false" aria-labelledby="select2-country-wa-container" aria-controls="select2-country-wa-container"><span class="select2-selection__rendered" id="select2-country-wa-container" role="textbox" aria-readonly="true" title="Estados Unidos">Estados Unidos</span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
                                                    <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
                                                </div>
                                                <div class="fv-row mb-7">
                                                    <div class="d-flex flex-stack">
                                                        <div class="me-5">
                                                            <label class="fs-6 fw-semibold">Usar como endereço de cobrança?</label>
                                                            <div class="fs-7 fw-semibold text-muted">Se precisar de mais informações, consulte o planejamento orçamentário</div>
                                                        </div>
                                                        <label class="form-check form-switch form-check-custom form-check-solid">
                                                            <input class="form-check-input" name="billing" type="checkbox" value="1" id="kt_modal_add_customer_billing" checked="checked">
                                                            <span class="form-check-label fw-semibold text-muted" for="kt_modal_add_customer_billing">
                                                                Sim
                                                            </span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer flex-center">
                                        <button type="reset" id="kt_modal_add_customer_cancel" class="btn btn-light me-3">
                                            Descartar
                                        </button>
                                        <button type="submit" id="kt_modal_add_customer_submit" class="btn btn-primary">
                                            <span class="indicator-label">
                                                Enviar
                                            </span>
                                            <span class="indicator-progress">
                                                Por favor, aguarde... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                            </span>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="kt_customers_export_modal" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered mw-650px">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h2 class="fw-bold">Exportar Clientes</h2>
                                    <div id="kt_customers_export_close" class="btn btn-icon btn-sm btn-active-icon-primary">
                                        <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i> </div>
                                </div>
                                <div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
                                    <form id="kt_customers_export_form" class="form fv-plugins-bootstrap5 fv-plugins-framework" action="#">
                                        <div class="fv-row mb-10">
                                            <label class="fs-5 fw-semibold form-label mb-5">Selecione o Formato de Exportação:</label>
                                            <select name="country" data-control="select2" data-placeholder="Selecione um formato" data-hide-search="true" class="form-select form-select-solid select2-hidden-accessible" data-select2-id="select2-data-15-n3is" tabindex="-1" aria-hidden="true" data-kt-initialized="1">
                                                <option value="excell" data-select2-id="select2-data-17-p4lu">Excel</option>
                                                <option value="pdf">PDF</option>
                                                <option value="csv">CSV</option>
                                                <option value="zip">ZIP</option>
                                            </select><span class="select2 select2-container select2-container--bootstrap5" dir="ltr" data-select2-id="select2-data-16-o02b" style="width: 100%;"><span class="selection"><span class="select2-selection select2-selection--single form-select form-select-solid" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-disabled="false" aria-labelledby="select2-country-eu-container" aria-controls="select2-country-eu-container"><span class="select2-selection__rendered" id="select2-country-eu-container" role="textbox" aria-readonly="true" title="Excel">Excel</span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>
                                        </div>
                                        <div class="fv-row mb-10 fv-plugins-icon-container">
                                            <label class="fs-5 fw-semibold form-label mb-5">Selecione o Intervalo de Datas:</label>
                                            <input class="form-control form-control-solid flatpickr-input" placeholder="Escolha uma data" name="date" type="hidden"><input class="form-control form-control-solid form-control input" placeholder="Escolha uma data" tabindex="0" type="text" readonly="readonly">
                                            <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
                                        </div>
                                        <div class="row fv-row mb-15">
                                            <label class="fs-5 fw-semibold form-label mb-5">Tipo de Pagamento:</label>
                                            <div class="d-flex flex-column">
                                                <label class="form-check form-check-custom form-check-sm form-check-solid mb-3">
                                                    <input class="form-check-input" type="checkbox" value="1" checked="checked" name="payment_type">
                                                    <span class="form-check-label text-gray-600 fw-semibold">
                                                        Todos
                                                    </span>
                                                </label>
                                                <label class="form-check form-check-custom form-check-sm form-check-solid mb-3">
                                                    <input class="form-check-input" type="checkbox" value="2" checked="checked" name="payment_type">
                                                    <span class="form-check-label text-gray-600 fw-semibold">
                                                        Visa
                                                    </span>
                                                </label>
                                                <label class="form-check form-check-custom form-check-sm form-check-solid mb-3">
                                                    <input class="form-check-input" type="checkbox" value="3" name="payment_type">
                                                    <span class="form-check-label text-gray-600 fw-semibold">
                                                        Mastercard
                                                    </span>
                                                </label>
                                                <label class="form-check form-check-custom form-check-sm form-check-solid">
                                                    <input class="form-check-input" type="checkbox" value="4" name="payment_type">
                                                    <span class="form-check-label text-gray-600 fw-semibold">
                                                        American Express
                                                    </span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="text-center">
                                            <button type="reset" id="kt_customers_export_cancel" class="btn btn-light me-3">
                                                Descartar
                                            </button>
                                            <button type="submit" id="kt_customers_export_submit" class="btn btn-primary">
                                                <span class="indicator-label">
                                                    Enviar
                                                </span>
                                                <span class="indicator-progress">
                                                    Por favor, aguarde... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                                </span>
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Visualização em Cards -->
                    <div id="cardsView" class="card" style="display: none;">
                        <div class="card-header border-0 pt-6">
                            <div class="card-title">
                                <h3 class="fw-bold text-gray-800">Visualização em Cards por Etapas</h3>
                            </div>
                        </div>
                        <div class="card-body pt-0">
                            <div class="row g-6 g-xl-9">
                                <!-- Card de Cliente -->
                                <div class="col-md-6 col-lg-4 col-xl-3">
                                    <div class="card h-100">
                                        <div class="card-body d-flex flex-center flex-column pt-12 p-9">
                                            <div class="symbol symbol-65px symbol-circle mb-5">
                                                <span class="symbol-label fs-2x fw-semibold text-success bg-light-success">JS</span>
                                            </div>
                                            <a href="#" class="fs-4 text-gray-800 text-hover-primary fw-bold mb-0" data-bs-toggle="modal" data-bs-target="#kt_modal_relationship_management" data-customer-id="1">João Silva</a>
                                            <div class="fw-semibold fs-5 text-gray-400 mb-6">Pessoa Física</div>
                                            <div class="d-flex flex-center flex-wrap">
                                                <div class="border border-gray-300 border-dashed rounded min-w-80px py-3 px-4 mx-2 mb-3">
                                                    <div class="fs-6 fw-bold text-gray-700">+55 11 99999-9999</div>
                                                    <div class="fw-semibold fs-7 text-gray-500">WhatsApp</div>
                                                </div>
                                                <div class="border border-gray-300 border-dashed rounded min-w-80px py-3 px-4 mx-2 mb-3">
                                                    <div class="fs-6 fw-bold text-gray-700">São Paulo</div>
                                                    <div class="fw-semibold fs-7 text-gray-500">Cidade</div>
                                                </div>
                                            </div>
                                            <div class="d-flex flex-center">
                                                <div class="form-check form-switch form-check-custom form-check-solid">
                                                    <input class="form-check-input" type="checkbox" value="1" id="card_relationship_1" data-customer-id="1"                                                    <label class="form-check-label fw-semibold text-muted ms-2" for="card_relationship_1">
                                                        <span class="switch-label">Ativo</span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Mais cards... -->
                            </div>
                        </div>
                    </div>

                    <!-- Visualização em Colunas (removido termo Kanban) -->
                    <div id="productColumnsView" class="card" style="display: none;">
                        <div class="card-header border-0 pt-6">
                            <div class="card-title">
                                <h3 class="fw-bold text-gray-800">Produtos</h3>
                            </div>
                        </div>
                        <div class="card-body pt-0">
                            <div class="row g-6 g-xl-9">
                                <div class="col-md-4">
                                    <div class="card">
                                        <div class="card-header">
                                            <h4 class="card-title">Plano Básico</h4>
                                        </div>
                                        <div class="card-body">
                                            <div class="d-flex flex-column">
                                                <div class="d-flex align-items-center mb-3">
                                                    <div class="symbol symbol-40px me-3">
                                                        <span class="symbol-label fs-6 fw-semibold text-success bg-light-success">JS</span>
                                                    </div>
                                                    <div class="d-flex flex-column">
                                                        <a href="#" class="text-gray-800 text-hover-primary fw-bold" data-bs-toggle="modal" data-bs-target="#kt_modal_relationship_management" data-customer-id="1">João Silva</a>
                                                        <span class="text-muted fs-7">Pessoa Física</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="card">
                                        <div class="card-header">
                                            <h4 class="card-title">Plano Premium</h4>
                                        </div>
                                        <div class="card-body">
                                            <div class="d-flex flex-column">
                                                <div class="d-flex align-items-center mb-3">
                                                    <div class="symbol symbol-40px me-3">
                                                        <span class="symbol-label fs-6 fw-semibold text-info bg-light-info">MS</span>
                                                    </div>
                                                    <div class="d-flex flex-column">
                                                        <a href="#" class="text-gray-800 text-hover-primary fw-bold" data-bs-toggle="modal" data-bs-target="#kt_modal_relationship_management" data-customer-id="2">Maria Santos</a>
                                                        <span class="text-muted fs-7">Tech Solutions Ltda</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="card">
                                        <div class="card-header">
                                            <h4 class="card-title">Plano Empresarial</h4>
                                        </div>
                                        <div class="card-body">
                                            <div class="d-flex flex-column">
                                                <div class="d-flex align-items-center mb-3">
                                                    <div class="symbol symbol-40px me-3">
                                                        <span class="symbol-label fs-6 fw-semibold text-warning bg-light-warning">CO</span>
                                                    </div>
                                                    <div class="d-flex flex-column">
                                                        <a href="#" class="text-gray-800 text-hover-primary fw-bold" data-bs-toggle="modal" data-bs-target="#kt_modal_relationship_management" data-customer-id="3">Carlos Oliveira</a>
                                                        <span class="text-muted fs-7">Pessoa Física</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Visualização Timeline -->
                    <div id="timelineView" class="card" style="display: none;">
                        <div class="card-header border-0 pt-6">
                            <div class="card-title">
                                <h3 class="fw-bold text-gray-800">Timeline de Vigências (12 Meses)</h3>
                            </div>
                        </div>
                        <div class="card-body pt-0">
                            <div class="row g-6 g-xl-9">
                                <div class="col-md-2">
                                    <div class="card">
                                        <div class="card-header text-center">
                                            <h5 class="card-title">Janeiro</h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="d-flex flex-column">
                                                <div class="d-flex align-items-center mb-2">
                                                    <div class="symbol symbol-30px me-2">
                                                        <span class="symbol-label fs-7 fw-semibold text-success bg-light-success">JS</span>
                                                    </div>
                                                    <div class="d-flex flex-column">
                                                        <span class="text-gray-800 fw-bold fs-7">João Silva</span>
                                                        <span class="text-muted fs-8">15 Jan</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="card">
                                        <div class="card-header text-center">
                                            <h5 class="card-title">Fevereiro</h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="d-flex flex-column">
                                                <div class="d-flex align-items-center mb-2">
                                                    <div class="symbol symbol-30px me-2">
                                                        <span class="symbol-label fs-7 fw-semibold text-info bg-light-info">MS</span>
                                                    </div>
                                                    <div class="d-flex flex-column">
                                                        <span class="text-gray-800 fw-bold fs-7">Maria Santos</span>
                                                        <span class="text-muted fs-8">20 Fev</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Mais meses... -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection