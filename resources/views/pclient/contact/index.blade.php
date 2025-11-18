@extends('layouts.app')
@section('title', 'Base de Contatos')
@section('contact', 'active')

@section('headlocal') @includeIf('pclient.contact.jscss.css') @endsection
@section('jslocal') @includeIf('pclient.contact.jscss.javascript') @endsection

@section('content')
    <div class="d-flex flex-column flex-column-fluid contact-page">
        <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
            <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
                <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Base de contatos</h1>
                    <span class="text-muted">Painel Principal</span>
                </div>
            </div>
        </div>

        <div class="d-flex flex-column flex-column-fluid">
            <div id="kt_app_content" class="app-content  flex-column-fluid ">
                <div id="kt_app_content_container" class="app-container  container-xxl ">
                    <div class="card">
                        <div class="card-header border-0 pt-6">
                            <div class="card-title">
                                <div class="d-flex align-items-center position-relative my-1 contact-search-container">
                                    <i class="ki-duotone ki-magnifier fs-3 position-absolute ms-5 contact-search-icon"><span class="path1"></span><span class="path2"></span></i>
                                    <input type="text" data-kt-customer-table-filter="search" class="form-control form-control-solid w-250px ps-12 contact-search-input" placeholder="Buscar Contatos" value="{{ $filters['search'] ?? '' }}">
                                </div>
                            </div>

                            <div class="card-toolbar">
                                <div class="d-flex justify-content-end" data-kt-customer-table-toolbar="base">
                                    <button type="button" class="btn btn-light-primary me-3 contact-filter-trigger" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                        <i class="ki-duotone ki-filter fs-2"><span class="path1"></span><span class="path2"></span></i> Filtrar
                                    </button>
                                    <div class="menu menu-sub menu-sub-dropdown w-400px w-md-425px" data-kt-menu="true" id="kt-toolbar-filter">
                                        <div class="px-7 py-5">
                                            <div class="fs-4 text-gray-900 fw-bold">Opções de Filtros</div>
                                        </div>
                                        <div class="separator border-gray-200"></div>
                                        <div class="px-7 py-5">
                                            <form id="filter-form" method="GET" action="{{ route('contact.index') }}">
                                                <input type="hidden" name="search" id="search-input-hidden" value="{{ $filters['search'] ?? '' }}">
                                                <div class="mb-10 contact-form-section">
                                                    <label class="form-label fs-5 fw-semibold mb-3 contact-form-label-primary">Tipos de registros:</label>
                                                    <select class="form-select form-select-solid fw-bold contact-form-select" name="search_field" data-placeholder="Selecione uma opção" data-allow-clear="true" data-dropdown-parent="#kt-toolbar-filter">
                                                        <option value="">Selecione uma opção</option>
                                                        <option value="pj" {{ isset($filters['search_field']) && $filters['search_field'] == 'pj' ? 'selected' : '' }}>Pessoa Jurídica</option>
                                                        <option value="pf" {{ isset($filters['search_field']) && $filters['search_field'] == 'pf' ? 'selected' : '' }}>Pessoa Física</option>
                                                        <option value="adesão" {{ isset($filters['search_field']) && $filters['search_field'] == 'adesão' ? 'selected' : '' }}>Adesão</option>
                                                    </select>
                                                </div>

                                                <div class="mb-10 contact-form-section">
                                                    <label class="form-label fs-5 fw-semibold mb-3 contact-form-label-primary">Data de criação:</label>
                                                    <div class="row contact-form-row">
                                                        <div class="col-6 contact-form-col">
                                                            <label class="form-label fs-6 fw-medium mb-2 text-muted contact-form-label-muted">De:</label>
                                                            <input type="date" class="form-control form-control-solid contact-form-date" name="date_from" value="{{ $filters['date_from'] ?? '' }}">
                                                        </div>
                                                        <div class="col-6 contact-form-col">
                                                            <label class="form-label fs-6 fw-medium mb-2 text-muted contact-form-label-muted">Até:</label>
                                                            <input type="date" class="form-control form-control-solid contact-form-date" name="date_to" value="{{ $filters['date_to'] ?? '' }}" placeholder="Data final">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="mb-10 contact-form-section">
                                                    <label class="form-label fs-5 fw-semibold mb-3 contact-form-label-primary">Ordenação:</label>
                                                    <div class="row contact-form-row">
                                                        <div class="col-6 contact-form-col">
                                                            <label class="form-label fs-6 fw-medium mb-1 text-muted contact-form-label-muted">Campo:</label>
                                                            <select class="form-select form-select-solid contact-form-select" name="sort_by">
                                                                <option value="id" {{ isset($filters['sort_by']) && $filters['sort_by'] == 'id' ? 'selected' : '' }}>CTCOD</option>
                                                                <option value="name" {{ isset($filters['sort_by']) && $filters['sort_by'] == 'name' ? 'selected' : '' }}>Nome</option>
                                                                <option value="created_at" {{ isset($filters['sort_by']) && $filters['sort_by'] == 'created_at' ? 'selected' : '' }}>Data de Criação</option>
                                                                <option value="city" {{ isset($filters['sort_by']) && $filters['sort_by'] == 'city' ? 'selected' : '' }}>Cidade</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-6 contact-form-col">
                                                            <label class="form-label fs-6 fw-medium mb-2 text-muted contact-form-label-muted">Direção:</label>
                                                            <select class="form-select form-select-solid contact-form-select" name="sort_direction">
                                                                <option value="desc" {{ isset($filters['sort_direction']) && $filters['sort_direction'] == 'desc' ? 'selected' : '' }}>Decrescente</option>
                                                                <option value="asc" {{ isset($filters['sort_direction']) && $filters['sort_direction'] == 'asc' ? 'selected' : '' }}>Crescente</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="d-flex justify-content-end contact-form-actions">
                                                    <button type="button" class="btn btn-light btn-active-light-primary me-2 contact-form-btn contact-form-btn-light" id="clear-filters-btn">Limpar</button>
                                                    <!-- <button type="button" class="btn btn-primary contact-form-btn contact-form-btn-primary" id="apply-filters-btn">Aplicar</button> -->
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <!-- <button type="button" class="btn btn-light-primary me-3" data-bs-toggle="modal" data-bs-target="#kt_customers_export_modal">
                                        <i class="ki-duotone ki-exit-up fs-2"><span class="path1"></span><span class="path2"></span></i> Exportar
                                    </button> -->
                                    <a href="{{ route('contact.create') }}" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#kt_modal_add_customer">
                                        <i class="ki-duotone ki-plus fs-2"></i>
                                        Adicionar Contato
                                    </a>
                                </div>
                                <div class="d-flex justify-content-end align-items-center d-none" data-kt-customer-table-toolbar="selected">
                                    <div class="fw-bold me-5">
                                        <span class="me-2" data-kt-customer-table-select="selected_count"></span> Selecionados
                                    </div>
                                    <button type="button" class="btn btn-danger" data-kt-customer-table-select="delete_selected">
                                        Excluir Selecionados
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="card-body pt-0">
                            <div id="kt_customers_table_wrapper" class="dt-container dt-bootstrap5 dt-empty-footer">
                                <div id="" class="table-responsive">
                                    <table class="table align-middle table-row-dashed fs-6 gy-5 dataTable contact-table" id="kt_customers_table" style="width: 100%;">
                                        <colgroup>
                                            <col data-dt-column="0" style="width: 33px;">
                                            <col data-dt-column="1" style="width: 216.281px;">
                                            <col data-dt-column="2" style="width: 171.25px;">
                                            <col data-dt-column="3" style="width: 196.312px;">
                                            <col data-dt-column="4" style="width: 143.453px;">
                                            <col data-dt-column="5" style="width: 82.141px;">
                                            <col data-dt-column="6" style="width: 114.672px;">
                                        </colgroup>
                                        <thead>
                                            <tr class="text-start text-gray-500 fw-bold fs-7 text-uppercase gs-0">
                                                <th class="min-w-100px dt-orderable-asc dt-orderable-desc" data-dt-column="1" rowspan="1" colspan="1" aria-label="CTcod" tabindex="0"><span class="dt-column-title" role="button">CTcod</span><span class="dt-column-order"></span></th>
                                                <th class="min-w-150px dt-orderable-asc dt-orderable-desc" data-dt-column="2" rowspan="1" colspan="1" aria-label="Nome do Contato" tabindex="0"><span class="dt-column-title" role="button">Nome do Contato</span><span class="dt-column-order"></span></th>
                                                <th class="min-w-125px dt-orderable-asc dt-orderable-desc" data-dt-column="3" rowspan="1" colspan="1" aria-label="Cidade" tabindex="0"><span class="dt-column-title" role="button">Cidade</span><span class="dt-column-order"></span></th>
                                                <th class="min-w-125px dt-orderable-asc dt-orderable-desc" data-dt-column="4" rowspan="1" colspan="1" aria-label="Tipo de cadastro" tabindex="0"><span class="dt-column-title" role="button">Tipo de cadastro</span><span class="dt-column-order"></span></th>
                                                <th class="min-w-125px dt-orderable-asc dt-orderable-desc" data-dt-column="5" rowspan="1" colspan="1" aria-label="Qtd vidas" tabindex="0"><span class="dt-column-title" role="button">Qtd vidas</span><span class="dt-column-order"></span></th>
                                                <th class="min-w-125px dt-orderable-asc dt-orderable-desc" data-dt-column="6" rowspan="1" colspan="1" aria-label="Data de Criação" tabindex="0"><span class="dt-column-title" role="button">Criado em</span><span class="dt-column-order"></span></th>
                                                <th class="text-end min-w-70px dt-orderable-none" data-dt-column="6" rowspan="1" colspan="1" aria-label="Ações"><span class="dt-column-title">Ações</span><span class="dt-column-order"></span></th>
                                            </tr>
                                        </thead>
                                        <tbody class="fw-semibold text-gray-600" id="contacts-table-body">
                                            @include('pclient.contact.partials.table-rows')
                                        </tbody>
                                        <tbody id="loading-indicator" class="d-none">
                                            <tr>
                                                <td colspan="7" class="text-center py-10">
                                                    <div class="d-flex align-items-center justify-content-center">
                                                        <div class="spinner-border text-primary me-3" role="status">
                                                            <span class="visually-hidden">Carregando...</span>
                                                        </div>
                                                        <span class="text-muted">Carregando contatos...</span>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12 col-md-5 d-flex align-items-center justify-content-center justify-content-md-start dt-toolbar">
                                        <div class="d-flex align-items-center">
                                            <select name="per_page" aria-controls="kt_customers_table" class="form-select form-select-solid form-select-sm" data-kt-customer-table-filter="per_page">
                                                <option value="10" {{ request('per_page', 10) == 10 ? 'selected' : '' }}>10</option>
                                                <option value="25" {{ request('per_page', 10) == 25 ? 'selected' : '' }}>25</option>
                                                <option value="50" {{ request('per_page', 10) == 50 ? 'selected' : '' }}>50</option>
                                                <option value="100" {{ request('per_page', 10) == 100 ? 'selected' : '' }}>100</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-7 d-flex align-items-center justify-content-center justify-content-md-end">
                                        <div id="contacts-pagination">
                                            @include('pclient.contact.partials.pagination')
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
@endsection

@includeIf('pclient.contact.modal.create')
