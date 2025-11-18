@extends('layouts.app')
@section('title', 'Dashboard Fornecedor')
@section('supplier-dashboard', 'active')

@section('headlocal') @includeIf('pclient.supplier-dashboard.jscss.css') @endsection
@section('jslocal') @includeIf('pclient.supplier-dashboard.jscss.javascript') @endsection

@section('content')
<div class="supplier-dashboard d-flex flex-column flex-column-fluid">
    <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
        <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Dashboard Fornecedor</h1>
                <span class="text-muted">Painel de Controle de Vendas de Leads</span>
            </div>
            <div class="d-flex align-items-center gap-2 gap-lg-3">
                <div class="d-flex align-items-center gap-3">
                    <div class="d-flex align-items-center gap-2">
                        <label class="form-label fs-7 fw-bold text-muted mb-0">Período:</label>
                        <select class="form-select form-select-sm w-auto" id="periodFilter" onchange="updateCharts()">
                            <option value="7">Últimos 7 dias</option>
                            <option value="30" selected>Últimos 30 dias</option>
                            <option value="90">Últimos 90 dias</option>
                            <option value="365">Último ano</option>
                        </select>
                    </div>
                    <span class="current-time text-muted fs-7">{{ date('H:i:s') }}</span>
                </div>
                <button type="button" class="btn btn-sm btn-primary" onclick="refreshDashboard()">
                    <i class="ki-duotone ki-arrows-circle fs-5">
                        <span class="path1"></span>
                        <span class="path2"></span>
                    </i>
                    Atualizar
                </button>
            </div>
        </div>
    </div>

    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div class="row gx-5 gx-xl-10 mb-xl-10 p-10">
            
            <div class="col-xl-4">
                <div class="card card-flush supplier-metric-card mb-5">
                    <div class="card-header rounded bgi-no-repeat bgi-size-cover bgi-position-y-top bgi-position-x-center align-items-start h-200px card-purple" data-bs-theme="light">
                        <h3 class="card-title align-items-start flex-column text-white pt-15">
                            <span class="fw-bold fs-2x mb-3">Performance</span>
                            <div class="fs-4 text-white">
                                <span class="opacity-75">Métricas de Vendas</span>
                            </div>
                        </h3>
                        <div class="card-toolbar pt-5">
                            <button class="btn btn-sm btn-icon btn-active-color-primary btn-color-white bg-white bg-opacity-25 bg-hover-opacity-100 bg-hover-white bg-active-opacity-25 w-20px h-20px" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                <i class="ki-duotone ki-dots-square fs-4">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                    <span class="path3"></span>
                                    <span class="path4"></span>
                                </i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body mt-n15 pb-5">
                        <div class="mt-n15 position-relative">
                            <div class="row g-3 g-lg-6">
                                <div class="col-6">
                                    <div class="bg-gray-100 bg-opacity-70 rounded-2 px-6 py-5">
                                        <div class="symbol symbol-30px me-5 mb-8">
                                            <span class="symbol-label">
                                                <i class="ki-duotone ki-chart-line-up fs-1 text-primary">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                </i>
                                            </span>
                                        </div>
                                        <div class="m-0">
                                            <span class="text-gray-700 fw-bolder d-block fs-2 lh-1 ls-n1 mb-1">247</span>
                                            <span class="text-gray-500 fw-semibold">Leads Vendidos</span>
                                            <div class="metric-trend positive">
                                                <i class="ki-duotone ki-arrow-up fs-7"></i>
                                                +15% este mês
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="bg-gray-100 bg-opacity-70 rounded-2 px-6 py-5">
                                        <div class="symbol symbol-30px me-5 mb-8">
                                            <span class="symbol-label">
                                                <i class="ki-duotone ki-wallet fs-1 text-primary">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                    <span class="path3"></span>
                                                    <span class="path4"></span>
                                                </i>
                                            </span>
                                        </div>
                                        <div class="m-0">
                                            <span class="text-gray-700 fw-bolder d-block fs-2 lh-1 ls-n1 mb-1">R$ 24.500</span>
                                            <span class="text-gray-500 fw-semibold">Receita Total</span>
                                            <div class="metric-trend positive">
                                                <i class="ki-duotone ki-arrow-up fs-7"></i>
                                                +22% este mês
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="bg-gray-100 bg-opacity-70 rounded-2 px-6 py-5">
                                        <div class="symbol symbol-30px me-5 mb-8">
                                            <span class="symbol-label">
                                                <i class="ki-duotone ki-star fs-1 text-primary">
                                                    <span class="path1"></span>
                                                </i>
                                            </span>
                                        </div>
                                        <div class="m-0">
                                            <span class="text-gray-700 fw-bolder d-block fs-2 lh-1 ls-n1 mb-1">4.8</span>
                                            <span class="text-gray-500 fw-semibold">Rating Médio</span>
                                            <div class="rating-stars">
                                                <i class="ki-duotone ki-star fs-6"></i>
                                                <i class="ki-duotone ki-star fs-6"></i>
                                                <i class="ki-duotone ki-star fs-6"></i>
                                                <i class="ki-duotone ki-star fs-6"></i>
                                                <i class="ki-duotone ki-star fs-6"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="bg-gray-100 bg-opacity-70 rounded-2 px-6 py-5">
                                        <div class="symbol symbol-30px me-5 mb-8">
                                            <span class="symbol-label">
                                                <i class="ki-duotone ki-percentage fs-1 text-primary">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                </i>
                                            </span>
                                        </div>
                                        <div class="m-0">
                                            <span class="text-gray-700 fw-bolder d-block fs-2 lh-1 ls-n1 mb-1">73%</span>
                                            <span class="text-gray-500 fw-semibold">Taxa Conversão</span>
                                            <div class="metric-trend positive">
                                                <i class="ki-duotone ki-arrow-up fs-7"></i>
                                                +5% esta semana
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="card card-flush h-xl-100 supplier-metric-card earnings-widget">
                    <div class="card-header pt-5 mb-6">
                        <h3 class="card-title align-items-start flex-column">
                            <div class="d-flex align-items-center mb-2">
                                <span class="fs-3 fw-semibold text-gray-400 align-self-start me-1">R$</span>
                                <span class="fs-2hx fw-bold text-gray-800 me-2 lh-1 ls-n2" id="avgEarningsValue">1.000,58</span>
                                <span class="badge badge-light-success fs-base">
                                    <i class="ki-duotone ki-arrow-up fs-5 text-success ms-n1">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                    <span id="avgEarningsPercent">3.2%</span>
                                </span>
                            </div>
                            <span class="fs-6 fw-semibold text-gray-400">Relatório de Ganhos</span>
                        </h3>
                        <div class="card-toolbar">
                            <button class="btn btn-icon btn-color-gray-400 btn-active-color-primary justify-content-end" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end" data-kt-menu-overflow="true">
                                <i class="ki-duotone ki-dots-square fs-1 text-gray-300 me-n1">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                    <span class="path3"></span>
                                    <span class="path4"></span>
                                </i>
                            </button>
                            <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-semibold w-200px" data-kt-menu="true">
                                <div class="menu-item px-3">
                                    <div class="menu-content fs-6 text-dark fw-bold px-3 py-4">Ações Rápidas</div>
                                </div>
                                <div class="separator mb-3 opacity-75"></div>
                                <div class="menu-item px-3">
                                    <a href="#" class="menu-link px-3">Exportar Relatório</a>
                                </div>
                                <div class="menu-item px-3">
                                    <a href="#" class="menu-link px-3">Ver Detalhes</a>
                                </div>
                                <div class="menu-item px-3">
                                    <a href="#" class="menu-link px-3">Comparar Período</a>
                                </div>
                                <div class="separator mt-3 opacity-75"></div>
                                <div class="menu-item px-3">
                                    <div class="menu-content px-3 py-3">
                                        <a class="btn btn-primary btn-sm px-4" href="#">Gerar Relatório</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body py-0 px-0">
                        <div class="chart-container px-6 py-4">
                            <canvas id="earningsChart1" style="height: 180px;"></canvas>
                        </div>
                        <div class="table-responsive mx-6 mt-4 mb-6">
                            <table class="table align-middle gs-0 gy-2">
                                <tbody>
                                    <tr>
                                        <td class="text-gray-600 fw-bold fs-7">Manhã</td>
                                        <td class="text-end">
                                            <span class="text-gray-800 fw-bold fs-7">R$ 850,43</span>
                                        </td>
                                        <td class="text-end">
                                            <span class="fw-bold fs-7 text-danger">-45,20</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-gray-600 fw-bold fs-7">Tarde</td>
                                        <td class="text-end">
                                            <span class="text-gray-800 fw-bold fs-7">R$ 1.200,18</span>
                                        </td>
                                        <td class="text-end">
                                            <span class="fw-bold fs-7 text-success">+349,75</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-gray-600 fw-bold fs-7">Noite</td>
                                        <td class="text-end">
                                            <span class="text-gray-800 fw-bold fs-7">R$ 950,63</span>
                                        </td>
                                        <td class="text-end">
                                            <span class="fw-bold fs-7 text-danger">-249,55</span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-8">
                <div class="row g-5 g-xl-10 mb-5">
                    <div class="col-xl-6">
                        <div class="card card-flush h-xl-100 supplier-metric-card">
                            <div class="card-header pt-7">
                                <h3 class="card-title align-items-start flex-column">
                                    <span class="card-label fw-bold text-dark">Distribuição de Leads</span>
                                    <span class="text-gray-400 mt-1 fw-semibold fs-6">Últimos 30 dias</span>
                                </h3>
                            </div>
                            <div class="card-body pt-6">
                                <div class="chart-container">
                                    <canvas id="leadsSalesChart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-6">
                        <div class="card card-flush h-xl-100 supplier-metric-card">
                            <div class="card-header pt-7">
                                <h3 class="card-title align-items-start flex-column">
                                    <span class="card-label fw-bold text-dark">Avaliações Recebidas</span>
                                    <span class="text-gray-400 mt-1 fw-semibold fs-6">Últimas 100 avaliações</span>
                                </h3>
                            </div>
                            <div class="card-body pt-6">
                                <div class="chart-container">
                                    <canvas id="ratingChart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row g-5 g-xl-10">
                    <div class="col-xl-12">
                        <div class="card card-flush h-xl-100 supplier-metric-card">
                            <div class="card-header pt-7">
                                <h3 class="card-title align-items-start flex-column">
                                    <span class="card-label fw-bold text-dark">Vendas Realizadas</span>
                                    <span class="text-gray-400 mt-1 fw-semibold fs-6">Quantidade de leads por período</span>
                                </h3>
                            </div>
                            <div class="card-body pt-6">
                                <div class="chart-container">
                                    <canvas id="monthlyPerformanceChart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row gx-5 gx-xl-10 mb-xl-10 p-10">
            <div class="col-xl-12">
                <div class="card card-flush supplier-metric-card">
                    <div class="card-header pt-8">
                        <h3 class="card-title align-items-start flex-column">
                            <span class="card-label fw-bold text-dark">Últimas Vendas de Leads</span>
                            <span class="text-gray-400 mt-1 fw-semibold fs-6">Transações mais recentes</span>
                        </h3>
                        <div class="card-toolbar">
                            <button type="button" class="btn btn-sm btn-icon btn-color-primary btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                <i class="ki-duotone ki-dots-square fs-5">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                    <span class="path3"></span>
                                    <span class="path4"></span>
                                </i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body py-3">
                        <div class="table-responsive">
                            <table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4 table-hover">
                                <thead>
                                    <tr class="fw-bold text-muted">
                                        <th class="min-w-150px">Lead</th>
                                        <th class="min-w-100px">Cliente</th>
                                        <th class="min-w-100px text-center">Valor</th>
                                        <th class="min-w-100px">Status</th>
                                        <th class="min-w-100px">Data</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="symbol symbol-45px me-5">
                                                    <span class="symbol-label bg-light-primary text-primary fw-bold">LC</span>
                                                </div>
                                                <div class="d-flex justify-content-start flex-column">
                                                    <span class="text-dark fw-bold text-hover-primary fs-6">#LD-001235</span>
                                                    <span class="text-muted fw-semibold text-muted d-block fs-7">Lead Comercial</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="text-dark fw-bold d-block fs-6">João Silva</span>
                                            <span class="text-muted fw-semibold d-block fs-7">Empresa ABC</span>
                                        </td>
                                        <td class="text-center">
                                            <span class="text-dark fw-bold d-block fs-6">R$ 150,00</span>
                                        </td>
                                        <td>
                                            <span class="badge badge-light-success">Vendido</span>
                                        </td>
                                        <td>
                                            <span class="text-dark fw-bold d-block fs-6">Hoje</span>
                                            <span class="text-muted fw-semibold d-block fs-7">14:30</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="symbol symbol-45px me-5">
                                                    <span class="symbol-label bg-light-warning text-warning fw-bold">LI</span>
                                                </div>
                                                <div class="d-flex justify-content-start flex-column">
                                                    <span class="text-dark fw-bold text-hover-primary fs-6">#LD-001234</span>
                                                    <span class="text-muted fw-semibold text-muted d-block fs-7">Lead Imobiliário</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="text-dark fw-bold d-block fs-6">Maria Santos</span>
                                            <span class="text-muted fw-semibold d-block fs-7">Imobiliária XYZ</span>
                                        </td>
                                        <td class="text-center">
                                            <span class="text-dark fw-bold d-block fs-6">R$ 200,00</span>
                                        </td>
                                        <td>
                                            <span class="badge badge-light-warning">Pendente</span>
                                        </td>
                                        <td>
                                            <span class="text-dark fw-bold d-block fs-6">Ontem</span>
                                            <span class="text-muted fw-semibold d-block fs-7">16:45</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="symbol symbol-45px me-5">
                                                    <span class="symbol-label bg-light-info text-info fw-bold">LS</span>
                                                </div>
                                                <div class="d-flex justify-content-start flex-column">
                                                    <span class="text-dark fw-bold text-hover-primary fs-6">#LD-001233</span>
                                                    <span class="text-muted fw-semibold text-muted d-block fs-7">Lead Seguros</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="text-dark fw-bold d-block fs-6">Carlos Oliveira</span>
                                            <span class="text-muted fw-semibold d-block fs-7">Seguradora 123</span>
                                        </td>
                                        <td class="text-center">
                                            <span class="text-dark fw-bold d-block fs-6">R$ 180,00</span>
                                        </td>
                                        <td>
                                            <span class="badge badge-light-success">Vendido</span>
                                        </td>
                                        <td>
                                            <span class="text-dark fw-bold d-block fs-6">2 dias atrás</span>
                                            <span class="text-muted fw-semibold d-block fs-7">09:15</span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
@endsection 