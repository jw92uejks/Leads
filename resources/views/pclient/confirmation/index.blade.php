@extends('layouts.app')
@section('title', 'Confirmação da Compra')
@section('confirmation', 'active')

@section('headlocal') @includeIf('pclient.confirmation.jscss.css') @endsection
@section('jslocal') @includeIf('pclient.confirmation.jscss.javascript') @endsection

@section('content')
<div class="d-flex flex-column flex-column-fluid">
    <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
        <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Confirmação da Compra</h1>
                <span class="text-muted">Sua compra foi processada com sucesso</span>
            </div>
        </div>
    </div>
    
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-xxl">
            <div class="card">
                <div class="card-body p-lg-20">
                    <div class="d-flex flex-column flex-xl-row">
                        <div class="flex-lg-row-fluid me-xl-18 mb-10 mb-xl-0">
                            <div class="mt-n1">
                                <div class="d-flex flex-stack pb-10">
                                    <a href="#">
                                        <img alt="Logo" src="{{ asset('assets/logo-icon.png') }}" style="height: 50px;" />
                                    </a>
                                </div>
                                <div class="m-0">
                                    <div class="fw-bold fs-3 text-gray-800 mb-8">Pedido #{{ sprintf('PED-%s-%03d', date('Y'), 1234) }}</div>
                                    <div class="row g-5 mb-11">
                                        <div class="col-sm-6">
                                            <div class="fw-semibold fs-7 text-gray-600 mb-1">Data do Pedido:</div>
                                            <div class="fw-bold fs-6 text-gray-800">{{ date('d/m/Y') }}</div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="fw-semibold fs-7 text-gray-600 mb-1">Data de Entrega:</div>
                                            <div class="fw-bold fs-6 text-gray-800 d-flex align-items-center">
                                                <span class="pe-2">{{ date('d/m/Y', strtotime('+1 day')) }}</span>
                                                <span class="fs-7 text-success d-flex align-items-center">
                                                <span class="bullet bullet-dot bg-success me-2"></span>Entrega em 24h</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row g-5 mb-12">
                                        <div class="col-sm-6">
                                            <div class="fw-semibold fs-7 text-gray-600 mb-1">Comprado por:</div>
                                            <div class="fw-bold fs-6 text-gray-800">{{ auth()->user()->name ?? 'Cliente Marketplace' }}</div>
                                            <div class="fw-semibold fs-7 text-gray-600">{{ auth()->user()->email ?? 'cliente@marketplace.com' }}</div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="fw-semibold fs-7 text-gray-600 mb-1">Vendido por:</div>
                                            <div class="fw-bold fs-6 text-gray-800">OnDeal Marketplace</div>
                                            <div class="fw-semibold fs-7 text-gray-600">Plataforma de Leads Premium
                                            <br />Brasil</div>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1">
                                        <div class="table-responsive border-bottom mb-9" style="height: 900px; overflow-y: auto;">
                                            <table class="table mb-3">
                                                <thead>
                                                    <tr class="border-bottom fs-6 fw-bold text-muted">
                                                        <th class="min-w-175px pb-2 ps-4">Lead</th>
                                                        <th class="min-w-100px pb-2">Fornecedor</th>
                                                        <th class="min-w-80px text-center pb-2">Temperatura</th>
                                                        <th class="min-w-100px text-end pb-2 pe-4">Preço</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr class="text-gray-700 fs-6">
                                                        <td class="d-flex align-items-center pt-6 ps-4">
                                                            <div class="symbol symbol-35px symbol-circle flex-shrink-0 me-3">
                                                                <div class="symbol-label bg-light-danger">
                                                                    <i class="ki-duotone ki-arrow-up fs-2 text-danger">
                                                                        <span class="path1"></span>
                                                                        <span class="path2"></span>
                                                                    </i>
                                                                </div>
                                                            </div>
                                                            <div>
                                                                <div class="fw-bold text-gray-800">Carlos Automotivo Premium</div>
                                                            </div>
                                                        </td>
                                                        <td class="pt-6">
                                                            <span class="text-gray-600">AutoLeads Corp</span>
                                                        </td>
                                                        <td class="pt-6 text-center">
                                                            <span class="badge badge-light-danger">
                                                                <span class="bullet bullet-dot bg-danger me-2"></span>Quente
                                                            </span>
                                                        </td>
                                                        <td class="pt-6 text-end pe-4">R$ 1.250,00</td>
                                                    </tr>
                                                    <tr class="text-gray-700 fs-6">
                                                        <td class="d-flex align-items-center ps-4">
                                                            <div class="symbol symbol-35px symbol-circle flex-shrink-0 me-3">
                                                                <div class="symbol-label bg-light-warning">
                                                                    <i class="ki-duotone ki-arrow-right fs-2 text-warning">
                                                                        <span class="path1"></span>
                                                                        <span class="path2"></span>
                                                                    </i>
                                                                </div>
                                                            </div>
                                                            <div>
                                                                <div class="fw-bold text-gray-800">Ana E-commerce Growth</div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <span class="text-gray-600">DigitalGrowth Pro</span>
                                                        </td>
                                                        <td class="text-center">
                                                            <span class="badge badge-light-warning">
                                                                <span class="bullet bullet-dot bg-warning me-2"></span>Morno
                                                            </span>
                                                        </td>
                                                        <td class="text-end pe-4">R$ 950,00</td>
                                                    </tr>
                                                    <tr class="text-gray-700 fs-6">
                                                        <td class="d-flex align-items-center ps-4">
                                                            <div class="symbol symbol-35px symbol-circle flex-shrink-0 me-3">
                                                                <div class="symbol-label bg-light-info">
                                                                    <i class="ki-duotone ki-arrow-down fs-2 text-info">
                                                                        <span class="path1"></span>
                                                                        <span class="path2"></span>
                                                                    </i>
                                                                </div>
                                                            </div>
                                                            <div>
                                                                <div class="fw-bold text-gray-800">Pedro Saúde & Bem-estar</div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <span class="text-gray-600">HealthLeads</span>
                                                        </td>
                                                        <td class="text-center">
                                                            <span class="badge badge-light-info">
                                                                <span class="bullet bullet-dot bg-info me-2"></span>Frio
                                                            </span>
                                                        </td>
                                                        <td class="text-end pe-4">R$ 720,00</td>
                                                    </tr>
                                                    <tr class="text-gray-700 fs-6">
                                                        <td class="d-flex align-items-center ps-4">
                                                            <div class="symbol symbol-35px symbol-circle flex-shrink-0 me-3">
                                                                <div class="symbol-label bg-light-danger">
                                                                    <i class="ki-duotone ki-arrow-up fs-2 text-danger">
                                                                        <span class="path1"></span>
                                                                        <span class="path2"></span>
                                                                    </i>
                                                                </div>
                                                            </div>
                                                            <div>
                                                                <div class="fw-bold text-gray-800">Mariana Tech Premium</div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <span class="text-gray-600">TechLeads Plus</span>
                                                        </td>
                                                        <td class="text-center">
                                                            <span class="badge badge-light-danger">
                                                                <span class="bullet bullet-dot bg-danger me-2"></span>Quente
                                                            </span>
                                                        </td>
                                                        <td class="text-end pe-4">R$ 1.180,00</td>
                                                    </tr>
                                                    <tr class="text-gray-700 fs-6">
                                                        <td class="d-flex align-items-center ps-4">
                                                            <div class="symbol symbol-35px symbol-circle flex-shrink-0 me-3">
                                                                <div class="symbol-label bg-light-warning">
                                                                    <i class="ki-duotone ki-arrow-right fs-2 text-warning">
                                                                        <span class="path1"></span>
                                                                        <span class="path2"></span>
                                                                    </i>
                                                                </div>
                                                            </div>
                                                            <div>
                                                                <div class="fw-bold text-gray-800">Roberto Imóveis VIP</div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <span class="text-gray-600">PropertyLeads</span>
                                                        </td>
                                                        <td class="text-center">
                                                            <span class="badge badge-light-warning">
                                                                <span class="bullet bullet-dot bg-warning me-2"></span>Morno
                                                            </span>
                                                        </td>
                                                        <td class="text-end pe-4">R$ 1.460,00</td>
                                                    </tr>
                                                    <tr class="text-gray-700 fs-6">
                                                        <td class="d-flex align-items-center ps-4">
                                                            <div class="symbol symbol-35px symbol-circle flex-shrink-0 me-3">
                                                                <div class="symbol-label bg-light-danger">
                                                                    <i class="ki-duotone ki-arrow-up fs-2 text-danger">
                                                                        <span class="path1"></span>
                                                                        <span class="path2"></span>
                                                                    </i>
                                                                </div>
                                                            </div>
                                                            <div>
                                                                <div class="fw-bold text-gray-800">Fernanda Educação Gold</div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <span class="text-gray-600">EduLeads</span>
                                                        </td>
                                                        <td class="text-center">
                                                            <span class="badge badge-light-danger">
                                                                <span class="bullet bullet-dot bg-danger me-2"></span>Quente
                                                            </span>
                                                        </td>
                                                        <td class="text-end pe-4">R$ 325,00</td>
                                                    </tr>
                                                    <tr class="text-gray-700 fs-6">
                                                        <td class="d-flex align-items-center ps-4">
                                                            <div class="symbol symbol-35px symbol-circle flex-shrink-0 me-3">
                                                                <div class="symbol-label bg-light-info">
                                                                    <i class="ki-duotone ki-arrow-down fs-2 text-info">
                                                                        <span class="path1"></span>
                                                                        <span class="path2"></span>
                                                                    </i>
                                                                </div>
                                                            </div>
                                                            <div>
                                                                <div class="fw-bold text-gray-800">Gabriel Finanças Executive</div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <span class="text-gray-600">FinanceLeads Pro</span>
                                                        </td>
                                                        <td class="text-center">
                                                            <span class="badge badge-light-info">
                                                                <span class="bullet bullet-dot bg-info me-2"></span>Frio
                                                            </span>
                                                        </td>
                                                        <td class="text-end pe-4">R$ 580,00</td>
                                                    </tr>
                                                                                                </tbody>
                                            </table>
                                        </div>
                                        


                                        
                                        <div class="d-flex justify-content-end">
                                    <div class="mw-300px">
                                        <div class="d-flex flex-stack mb-3">
                                            <div class="fw-semibold pe-10 text-gray-600 fs-7">Subtotal:</div>
                                            <div class="text-end fw-bold fs-6 text-gray-800">R$ 240.941,18</div>
                                        </div>
                                        <div class="d-flex flex-stack mb-3">
                                            <div class="fw-semibold pe-10 text-gray-600 fs-7">Taxa de Processamento (2%)</div>
                                            <div class="text-end fw-bold fs-6 text-gray-800">R$ 4.818,82</div>
                                        </div>
                                        <div class="d-flex flex-stack mb-3">
                                            <div class="fw-semibold pe-10 text-gray-600 fs-7">Subtotal + Taxa</div>
                                            <div class="text-end fw-bold fs-6 text-gray-800">R$ 245.760,00</div>
                                        </div>
                                        <div class="d-flex flex-stack">
                                            <div class="fw-semibold pe-10 text-gray-600 fs-7">Total Pago</div>
                                            <div class="text-end fw-bold fs-4" style="color: #e71d73;">R$ 245.760,00</div>
                                        </div>
                                    </div>
                                </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="m-0">
                            <div class="d-print-none border border-dashed border-gray-300 card-rounded h-lg-100 min-w-md-350px p-9 bg-lighten">
                                <div class="mb-8">
                                    <span class="badge badge-light-success me-2">
                                        <i class="ki-duotone ki-double-check">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                        </i>
                                        Compra concluída
                                    </span>
                                </div>
                                <h6 class="mb-8 fw-bolder text-gray-600 text-hover-primary">DETALHES DO PAGAMENTO</h6>
                                <div class="mb-6">
                                    <div class="fw-semibold text-gray-600 fs-7">Método de Pagamento:</div>
                                    <div class="fw-bold text-gray-800 fs-6">Cartão de Crédito</div>
                                </div>
                                <div class="mb-6">
                                    <div class="fw-semibold text-gray-600 fs-7">Número do Cartão:</div>
                                    <div class="fw-bold text-gray-800 fs-6">**** **** **** 4242</div>
                                </div>
                                <div class="mb-15">
                                    <div class="fw-semibold text-gray-600 fs-7">Data de Processamento:</div>
                                    <div class="fw-bold fs-6 text-gray-800 d-flex align-items-center">{{ date('d/m/Y H:i') }}
                                    <span class="fs-7 text-success d-flex align-items-center">
                                    <span class="bullet bullet-dot bg-success mx-2"></span>Aprovado</span></div>
                                </div>
                                <h6 class="mb-8 fw-bolder text-gray-600 text-hover-primary">RESUMO DA COMPRA</h6>
                                <div class="mb-6">
                                    <div class="fw-semibold text-gray-600 fs-7">Total de Fornecedores</div>
                                    <div class="fw-bold fs-6 text-gray-800">87 fornecedores únicos
                                    <a href="#" class="link-primary ps-1">Ver Detalhes</a></div>
                                </div>
                                <div class="mb-6">
                                    <div class="fw-semibold text-gray-600 fs-7">Total de Leads:</div>
                                    <div class="fw-bold text-gray-800 fs-6">1024 leads individuais</div>
                                </div>
                                <div class="m-0">
                                    <div class="fw-semibold text-gray-600 fs-7">Disponibilização:</div>
                                    <div class="fw-bold fs-6 text-gray-800 d-flex align-items-center">24 horas
                                    <span class="fs-7 text-success d-flex align-items-center">
                                    <span class="bullet bullet-dot bg-success mx-2"></span>Download automático</span></div>
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
