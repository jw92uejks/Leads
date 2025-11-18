@extends('layouts.app')
@section('title', 'Leads Adquiridos')
@section('leads', 'active')

@section('headlocal') @includeIf('pclient.leads.jscss.css') @endsection
@section('jslocal') @includeIf('pclient.leads.jscss.javascript') @endsection

@section('content')
    <div class="d-flex flex-column flex-column-fluid">
        <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
            <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
                <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Leads Adquiridos</h1>
                    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                        <li class="breadcrumb-item text-muted">
                            <a href="{{ route('dashboard') }}" class="text-muted text-hover-primary">Início</a>
                        </li>
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-500 w-5px h-2px"></span>
                        </li>
                        <li class="breadcrumb-item text-muted">Leads Adquiridos</li>
                    </ul>
                </div>
                <div class="d-flex align-items-center gap-2 gap-lg-3">
                    <div class="w-100 mw-150px">
                        <select class="form-select form-select-solid" data-control="select2" data-hide-search="true"
                            data-placeholder="Temperatura" data-kt-leads-table-filter="main-temperature">
                            <option value="">Todos</option>
                            <option value="Quente">Quente</option>
                            <option value="Morno">Morno</option>
                            <option value="Frio">Frio</option>
                        </select>
                    </div>
                    <button type="button" class="btn btn-light-primary" data-kt-menu-trigger="click"
                        data-kt-menu-placement="bottom-end">
                        <i class="ki-duotone ki-filter fs-2">
                            <span class="path1"></span>
                            <span class="path2"></span>
                        </i>Filtros
                    </button>
                    <div class="menu menu-sub menu-sub-dropdown w-300px w-md-325px" data-kt-menu="true">
                        <div class="px-7 py-5">
                            <div class="fs-5 text-dark fw-bold">Opções de Filtro</div>
                        </div>
                        <div class="separator border-gray-200"></div>
                        <div class="px-7 py-5" data-kt-ecommerce-order-filter="form">
                            <div class="mb-10">
                                <label class="form-label fw-semibold">Temperatura:</label>
                                <div>
                                    <select class="form-select form-select-solid" data-kt-select2="true"
                                        data-placeholder="Selecione..." data-allow-clear="true" multiple="multiple">
                                        <option></option>
                                        <option value="Quente">Quente</option>
                                        <option value="Morno">Morno</option>
                                        <option value="Frio">Frio</option>
                                    </select>
                                </div>
                            </div>
                            <div class="d-flex justify-content-end">
                                <button type="reset" class="btn btn-light btn-active-light-primary fw-semibold me-2 px-6"
                                    data-kt-menu-dismiss="true" data-kt-ecommerce-order-filter="reset">Redefinir</button>
                                <button type="submit" class="btn btn-primary fw-semibold px-6" data-kt-menu-dismiss="true"
                                    data-kt-ecommerce-order-filter="filter">Aplicar</button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div id="kt_app_content" class="app-content flex-column-fluid">
            <div id="kt_app_content_container" class="app-container container-xxl">
                <div class="card card-flush">
                    <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                        <div class="card-title">
                            <div class="d-flex align-items-center position-relative my-1">
                                <i class="ki-duotone ki-magnifier fs-3 position-absolute ms-4">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i>
                                <input type="text" data-kt-leads-table-filter="search"
                                    class="form-control form-control-solid w-250px ps-12"
                                    placeholder="Buscar leads adquiridos" />
                            </div>
                        </div>
                        <div class="card-toolbar flex-row-fluid justify-content-end gap-5">
                            <input class="form-control form-control-solid w-100 mw-250px" placeholder="Selecionar período"
                                id="kt_leads_daterangepicker" />
                            <button type="button" class="btn btn-light-primary" data-kt-menu-trigger="click"
                                data-kt-menu-placement="bottom-end">
                                <i class="ki-duotone ki-exit-down fs-2">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i>Exportar Relatório
                            </button>
                            <div id="kt_leads_export_menu"
                                class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-200px py-4"
                                data-kt-menu="true">
                                <div class="menu-item px-3">
                                    <a href="#" class="menu-link px-3" data-kt-leads-export="copy">Copiar para área de
                                        transferência</a>
                                </div>
                                <div class="menu-item px-3">
                                    <a href="#" class="menu-link px-3" data-kt-leads-export="excel">Exportar como
                                        Excel</a>
                                </div>
                                <div class="menu-item px-3">
                                    <a href="#" class="menu-link px-3" data-kt-leads-export="csv">Exportar como
                                        CSV</a>
                                </div>
                                <div class="menu-item px-3">
                                    <a href="#" class="menu-link px-3" data-kt-leads-export="pdf">Exportar como
                                        PDF</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body pt-0">
                        <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_leads_table">
                            <thead>
                                <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                                    <th class="min-w-125px ps-4">Nome do Lead</th>
                                    <th class="min-w-125px ps-4">Email</th>
                                    <th class="min-w-100px ps-4">Temperatura</th>
                                    <th class="min-w-100px ps-4">Tracking</th>
                                    <th class="min-w-100px ps-4">Data de Aquisição</th>
                                    <th class="text-end min-w-100px pe-4">Fornecedor</th>
                                    <th class="text-end min-w-70px pe-4">Ações</th>
                                </tr>
                            </thead>
                            <tbody class="fw-semibold text-gray-600">
                                @foreach ($leadsAcquired as $lead)
                                <tr>
                                    <td class="ps-4">
                                        <a href="#" class="text-dark text-hover-primary">
                                            {{ $lead->name }}
                                        </a>
                                    </td>
                                    <td class="ps-4">
                                        <a href="#" class="text-dark text-hover-primary">
                                            {{ $lead->email }}
                                        </a>
                                    </td>
                                    <td class="ps-4">
                                        <span @class([ 'badge' , 'badge-light-danger'=> $lead->temperature->value === 'hot', 'badge-light-warning' => $lead->temperature->value === 'warm', 'badge-light-info' => $lead->temperature->value === 'cold', ])>
                                            {{ $lead->temperature->label() }}
                                        </span>
                                    </td>
                                    <td class="ps-4">
                                        <span class="text-muted">{{ $lead->traking ?? 'N/A' }}</span>
                                    </td>
                                    <td class="ps-4">
                                        {{ $lead->acquired_at->translatedFormat('d M Y, H:i') }}
                                    </td>
                                    <td class="text-end pe-4">
                                        {{ $lead->supplier->name }}
                                    </td>
                                    <td class="text-end pe-4">
                                        <a href="#" class="btn btn-sm btn-light btn-active-light-primary btn-flex btn-center" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                            Ações
                                            <i class="ki-duotone ki-down fs-5 ms-1"></i>
                                        </a>
                                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-150px py-4" data-kt-menu="true">
                                            <div class="menu-item px-3">
                                                <a href="#" class="menu-link px-3">Enviar lead para...</a>
                                            </div>
                                            <div class="menu-item px-3">
                                                <a href="#" class="menu-link px-3" data-kt-leads-table-filter="delete_row">Remover Lead</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
