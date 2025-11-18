@extends('layouts.app')
@section('title', 'Minhas Compras')
@section('financial', 'active')

@section('headlocal') @includeIf('pclient.financial.jscss.css') @endsection
@section('jslocal') @includeIf('pclient.financial.jscss.javascript') @endsection

@section('content')
<div class="d-flex flex-column flex-column-fluid">
    <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
        <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Minhas Compras</h1>
                <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                    <li class="breadcrumb-item text-muted">
                        <span class="text-muted text-hover-primary">Histórico de Fornecedores de Leads</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-xxl">
            <div class="d-flex flex-column flex-lg-row">
                <div class="flex-lg-row-fluid me-lg-15 order-2 order-lg-1 mb-10 mb-lg-0">
                    <div class="card card-flush pt-3 mb-5 mb-xl-10">
                        <div class="card-header">
                            <div class="card-title">
                                <h2 class="fw-bold">Fornecedores de Leads Comprados</h2>
                            </div>
                        </div>
                        <div class="card-body pt-3">
                            <div class="mb-10">
                                <div class="d-flex flex-wrap py-5">
                                    <div class="flex-equal me-5">
                                        <table class="table fs-6 fw-semibold gs-0 gy-2 gx-2 m-0">
                                            <tr>
                                                <td class="text-gray-400 min-w-175px w-175px">Email:</td>
                                                <td class="text-gray-800 min-w-200px">{{ Auth::user()->email ?? 'usuario@exemplo.com' }}</td>
                                            </tr>
                                            <tr>
                                                <td class="text-gray-400">Nome do Cliente:</td>
                                                <td class="text-gray-800">{{ Auth::user()->name ?? 'Usuário' }}</td>
                                            </tr>
                                            <tr>
                                                <td class="text-gray-400">Total Gasto:</td>
                                                <td class="text-gray-800 text-success fw-bold">R$ 7.450,00</td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div class="flex-equal">
                                        <table class="table fs-6 fw-semibold gs-0 gy-2 gx-2 m-0">
                                            <tr>
                                                <td class="text-gray-400 min-w-175px w-175px">Leads Comprados:</td>
                                                <td class="text-gray-800 min-w-200px">
                                                    <span class="badge badge-light-success fw-bold">1.250 leads</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                                <td class="text-gray-400">Fornecedores Ativos:</td>
                <td class="text-gray-800">3 fornecedores</td>
                                            </tr>
                                            <tr>
                                                <td class="text-gray-400">Última Compra:</td>
                                                <td class="text-gray-800">{{ date('d/m/Y') }}</td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-0">
                                <h5 class="mb-4">Histórico de Compras:</h5>
                                <div class="table-responsive">
                                    <table class="table align-middle table-row-dashed fs-6 gy-4 mb-0">
                                        <thead>
                                            <tr class="border-bottom border-gray-200 text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                                                <th class="min-w-200px">Fornecedor</th>
                                                <th class="min-w-100px">Qtd. Leads</th>
                                                <th class="min-w-125px">Valor Pago</th>
                                                <th class="min-w-125px">Data da Compra</th>
                                            </tr>
                                        </thead>
                                        <tbody class="fw-semibold text-gray-800">
                                            <tr>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="symbol symbol-50px me-3">
                                                            <div class="symbol-label bg-light-danger">
                                                                <i class="ki-duotone ki-fire fs-2 text-danger">
                                                                    <span class="path1"></span>
                                                                    <span class="path2"></span>
                                                                </i>
                                                            </div>
                                                        </div>
                                                        <div class="d-flex flex-column">
                                                            <span class="fw-bold">Leads Automotivos Premium</span>
                                                            <span class="text-gray-600 fs-7">por AutoLeads Corp</span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>250 leads</td>
                                                <td>R$ 2.450,00</td>
                                                <td>{{ date('d/m/Y') }}</td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="symbol symbol-50px me-3">
                                                            <div class="symbol-label bg-light-warning">
                                                                <i class="ki-duotone ki-flash fs-2 text-warning">
                                                                    <span class="path1"></span>
                                                                    <span class="path2"></span>
                                                                </i>
                                                            </div>
                                                        </div>
                                                        <div class="d-flex flex-column">
                                                            <span class="fw-bold">Leads E-commerce Validados</span>
                                                            <span class="text-gray-600 fs-7">por DigitalSales Ltda</span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>500 leads</td>
                                                <td>R$ 3.200,00</td>
                                                <td>{{ date('d/m/Y', strtotime('-3 days')) }}</td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="symbol symbol-50px me-3">
                                                            <div class="symbol-label bg-light-info">
                                                                <i class="ki-duotone ki-snowflake fs-2 text-info">
                                                                    <span class="path1"></span>
                                                                    <span class="path2"></span>
                                                                    <span class="path3"></span>
                                                                    <span class="path4"></span>
                                                                </i>
                                                            </div>
                                                        </div>
                                                        <div class="d-flex flex-column">
                                                            <span class="fw-bold">Leads Saúde Premium</span>
                                                            <span class="text-gray-600 fs-7">por HealthLeads Pro</span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>500 leads</td>
                                                <td>R$ 1.800,00</td>
                                                <td>{{ date('d/m/Y', strtotime('-1 week')) }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card card-flush pt-3 mb-5 mb-xl-10">
                        <div class="card-header">
                            <div class="card-title">
                                <h2>Atividades Recentes</h2>
                            </div>
                            <div class="card-toolbar">
                                <a href="#" class="btn btn-light-primary" data-bs-toggle="modal" data-bs-target="#kt_modal_events">Ver Todas Atividades</a>
                            </div>
                        </div>
                        <div class="card-body pt-0">
                            <div class="table-responsive">
                                <table class="table align-middle table-row-dashed fs-6 text-gray-600 fw-semibold gy-5">
                                    <tbody>
                                        <tr>
                                            <td class="min-w-400px">
                                                <a href="#" class="fw-bold text-gray-800 text-hover-primary me-1 event-detail-link" data-event-id="1">Compra realizada</a> 
                                                - Fornecedor <a href="#" class="fw-bold text-gray-800 text-hover-primary">Leads Automotivos Premium</a> (250 leads)
                                            </td>
                                            <td class="pe-0 text-gray-600 text-end min-w-200px">{{ date('d M Y, H:i') }}</td>
                                        </tr>
                                        <tr>
                                            <td class="min-w-400px">
                                                <a href="#" class="fw-bold text-gray-800 text-hover-primary me-1 event-detail-link" data-event-id="3">Pagamento aprovado</a> 
                                                para fornecedor de R$ 3.200,00 via <span class="badge badge-light-info">PIX</span>
                                            </td>
                                            <td class="pe-0 text-gray-600 text-end min-w-200px">{{ date('d M Y, H:i', strtotime('-1 day')) }}</td>
                                        </tr>
                                        <tr>
                                            <td class="min-w-400px">
                                                Avaliação enviada para fornecedor 
                                                <a href="#" class="fw-bold text-gray-800 text-hover-primary me-1">Leads Saúde Premium</a> 
                                                - <span class="badge badge-light-warning">5 estrelas</span>
                                            </td>
                                            <td class="pe-0 text-gray-600 text-end min-w-200px">{{ date('d M Y, H:i', strtotime('-3 days')) }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex-column flex-lg-row-auto w-lg-250px w-xl-300px mb-10 order-1 order-lg-2">
                    <div class="card card-flush mb-0 subscription-summary">
                        <div class="card-header">
                            <div class="card-title">
                                <h2>Resumo da Conta</h2>
                            </div>
                        </div>
                        <div class="card-body pt-0 fs-6">
                            <div class="mb-7">
                                <div class="d-flex align-items-center">
                                    <div class="symbol symbol-60px symbol-circle me-3">
                                        <img alt="Avatar" src="{{ asset('assets/images/avatars/blank.png') }}" />
                                    </div>
                                    <div class="d-flex flex-column">
                                        <span class="fs-4 fw-bold text-gray-900 me-2">{{ Auth::user()->name ?? 'Usuário' }}</span>
                                        <span class="fw-semibold text-gray-600">{{ Auth::user()->email ?? 'usuario@exemplo.com' }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="separator separator-dashed mb-7"></div>
                            <div class="mb-7">
                                <h5 class="mb-4">Estatísticas de Compra</h5>
                                <div class="d-flex align-items-center mb-3">
                                    <div class="symbol symbol-40px me-3">
                                        <div class="symbol-label bg-light-success">
                                            <i class="ki-duotone ki-chart-pie-4 fs-6 text-success">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                                <span class="path3"></span>
                                            </i>
                                        </div>
                                    </div>
                                    <div class="d-flex flex-column flex-grow-1">
                                        <span class="text-gray-800 fw-bold">Total de Leads</span>
                                        <span class="text-gray-600 fw-semibold fs-7">1.250 leads comprados</span>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center">
                                    <div class="symbol symbol-40px me-3">
                                        <div class="symbol-label bg-light-primary">
                                            <i class="ki-duotone ki-wallet fs-6 text-primary">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                                <span class="path3"></span>
                                                <span class="path4"></span>
                                            </i>
                                        </div>
                                    </div>
                                    <div class="d-flex flex-column flex-grow-1">
                                        <span class="text-gray-800 fw-bold">Investimento Total</span>
                                        <span class="text-gray-600 fw-semibold fs-7">R$ 7.450,00</span>
                                    </div>
                                </div>
                            </div>
                            <div class="separator separator-dashed mb-7"></div>
                            <div class="mb-10">
                                <h5 class="mb-4">Detalhes do Pagamento</h5>
                                <div class="mb-0">
                                    <div class="fw-semibold text-gray-600 d-flex align-items-center">
                                        Mastercard
                                        <img src="{{ asset('assets/images/svg/card-logos/mastercard.svg') }}" class="w-35px ms-2" alt="" />
                                    </div>
                                    <div class="fw-semibold text-gray-600">Expira Dez 2026</div>
                                </div>
                            </div>
                            <div class="separator separator-dashed mb-7"></div>
                            <div class="mb-0">
                                <h5 class="mb-4">Status da Conta</h5>
                                <table class="table fs-6 fw-semibold gs-0 gy-2 gx-2">
                                    <tr>
                                        <td class="text-gray-600">Membro desde:</td>
                                        <td class="text-gray-800">{{ date('d/m/Y', strtotime('-1 month')) }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-gray-600">Status:</td>
                                        <td>
                                            <span class="badge badge-light-success">Ativo</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-gray-600">Última compra:</td>
                                        <td class="text-gray-800">{{ date('d/m/Y') }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Todas Atividades -->
<div class="modal fade" id="kt_modal_events" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable mw-1000px">
        <div class="modal-content">
            <div class="modal-header flex-stack">
                <h2>Todas as Atividades</h2>
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <i class="ki-duotone ki-cross fs-1">
                        <span class="path1"></span>
                        <span class="path2"></span>
                    </i>
                </div>
            </div>
            <div class="modal-body scroll-y pt-10 pb-15 px-lg-17">
                <div class="table-responsive">
                    <table class="table align-middle table-row-dashed fs-6 text-gray-600 fw-semibold gy-5">
                        <thead>
                            <tr class="border-bottom border-gray-200 text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
                                <th>Atividade</th>
                                <th class="text-end">Data</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Compra realizada - Fornecedor Leads Automotivos Premium (250 leads)</td>
                                <td class="text-end">{{ date('d/m/Y H:i') }}</td>
                            </tr>
                            <tr>
                                <td>Pagamento aprovado para fornecedor de R$ 3.200,00 via PIX</td>
                                <td class="text-end">{{ date('d/m/Y H:i', strtotime('-1 day')) }}</td>
                            </tr>
                            <tr>
                                <td>Avaliação enviada para fornecedor Leads Saúde Premium - 5 estrelas</td>
                                <td class="text-end">{{ date('d/m/Y H:i', strtotime('-3 days')) }}</td>
                            </tr>
                            <tr>
                                <td>Cadastro realizado na plataforma com sucesso</td>
                                <td class="text-end">{{ date('d/m/Y H:i', strtotime('-1 month')) }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 