@extends('layouts.app')
@section('title', 'Meu Plano')
@section('myplan', 'active')

@section('headlocal') @includeIf('pclient.myplan.jscss.css') @endsection
@section('jslocal') @includeIf('pclient.myplan.jscss.javascript') @endsection

@section('content')
<div class="d-flex flex-column flex-column-fluid">
    <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
        <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Meu Plano</h1>
                <span class="text-muted">Painel de gerenciamento de planos</span>
            </div>
        </div>
    </div>

    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-xxl">
            <div class="card">
                <div class="card-body pt-9 pb-0">
                    <div class="d-flex flex-wrap flex-sm-nowrap">
                        <div class="flex-grow-1">
                            <div class="d-flex justify-content-between align-items-start flex-wrap mb-2">
                                <div class="d-flex flex-column">
                                    <div class="d-flex align-items-center mb-2">
                                        <a href="#" class="text-gray-900 text-hover-primary fs-2 fw-bold me-1">{{ auth()->user()->name ?? 'Usuário' }}</a>
                                    </div>
                                    <div class="d-flex flex-wrap fw-semibold fs-6 mb-4 pe-2">
                                        <a href="#" class="d-flex align-items-center text-muted-dark text-hover-primary me-5 mb-2">
                                            <i class="ki-duotone ki-profile-circle fs-4 me-1">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                                <span class="path3"></span>
                                            </i>{{ auth()->user()->name ?? 'username' }}
                                        </a>
                                        <a href="#" class="d-flex align-items-center text-muted-dark text-hover-primary me-5 mb-2">
                                            <i class="ki-duotone ki-sms fs-4 me-1">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                            </i>{{ auth()->user()->email ?? 'email@exemplo.com' }}
                                        </a>
                                        @if(!$planInfo['is_basic_user'] && auth()->user()->broker && auth()->user()->broker->subscription_expires_at)
                                        <a href="#" class="d-flex align-items-center text-muted-dark text-hover-primary mb-2">
                                            <i class="ki-duotone ki-calendar fs-4 me-1">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                            </i>Expira em {{ auth()->user()->broker->subscription_expires_at->format('d/m/Y') }}
                                        </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex flex-wrap flex-stack">
                                <div class="d-flex flex-column flex-grow-1 pe-8">
                                    <div class="d-flex flex-wrap">
                                        <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                            <div class="d-flex align-items-center">
                                                <i class="ki-duotone ki-wallet fs-3 text-pink me-2">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                    <span class="path3"></span>
                                                    <span class="path4"></span>
                                                </i>
                                                <div class="fs-3 fw-bold">{{ $planInfo['plan_name'] }}</div>
                                            </div>
                                            <div class="fw-semibold fs-6 text-muted-dark">
                                                @if($planInfo['is_basic_user'])
                                                    Plano Básico
                                                @elseif(auth()->user()->hasActiveSubscription())
                                                    Assinatura Ativa
                                                @else
                                                    Assinatura Expirada
                                                @endif
                                            </div>
                                        </div>
                                        <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                            <div class="d-flex align-items-center">
                                                <i class="ki-duotone ki-people fs-3 text-pink me-2">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                    <span class="path3"></span>
                                                    <span class="path4"></span>
                                                    <span class="path5"></span>
                                                </i>
                                                <div class="fs-3 fw-bold" data-kt-countup="true" data-kt-countup-value="{{ $planInfo['current_leads'] }}">0</div>
                                            </div>
                                            <div class="fw-semibold fs-6 text-muted-dark">Leads Adquiridos</div>
                                        </div>

                                        <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                            <div class="d-flex align-items-center">
                                                <i class="ki-duotone ki-package fs-3 text-pink me-2">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                    <span class="path3"></span>
                                                </i>
                                                <div class="fs-3 fw-bold" data-kt-countup="true" data-kt-countup-value="{{ $planInfo['max_leads'] }}">0</div>
                                            </div>
                                            <div class="fw-semibold fs-6 text-muted-dark">Limite de Leads</div>
                                        </div>

                                        <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                            <div class="d-flex align-items-center">
                                                <i class="ki-duotone ki-abstract-26 fs-3 text-pink me-2">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                    <span class="path3"></span>
                                                    <span class="path4"></span>
                                                </i>
                                                <div class="fs-3 fw-bold" data-kt-countup="true" data-kt-countup-value="{{ $planInfo['remaining_slots'] }}">0</div>
                                            </div>
                                            <div class="fw-semibold fs-6 text-muted-dark">Slots Restantes</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <a href="{{ route('pricing.index') }}" class="text-decoration-none">
                            <div class="card card-flush shadow-sm border-0 menu-card" style="width: 200px; height: 120px; margin-bottom: 40px;">
                                <div class="card-body d-flex flex-column justify-content-center align-items-center text-center py-2 px-4">
                                    <div class="mb-3">
                                        <i class="ki-duotone ki-arrows-circle" style="color: #E71D73; font-size: 2.5rem;">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                            <span class="path3"></span>
                                            <span class="path4"></span>
                                        </i>
                                    </div>
                                    <h3 class="fs-5 mb-0">
                                        @if($planInfo['is_basic_user'])
                                            Comprar Plano
                                        @else
                                            Alterar Plano
                                        @endif
                                    </h3>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>

            <div class="card mt-5">
                <div class="card-header card-header-stretch">
                    <div class="card-title d-flex align-items-center">
                        <i class="ki-duotone ki-calendar-8 fs-1 text-pink me-3 lh-0">
                            <span class="path1"></span>
                            <span class="path2"></span>
                            <span class="path3"></span>
                            <span class="path4"></span>
                            <span class="path5"></span>
                            <span class="path6"></span>
                        </i>
                        <h3 class="fw-bold m-0 text-gray-800">{{ date('d M, Y') }}</h3>
                    </div>
                    <div class="card-toolbar m-0">
                        <ul class="nav nav-tabs nav-line-tabs nav-stretch fs-6 border-0 fw-bold" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a id="kt_activity_today_tab" class="nav-link justify-content-center text-active-gray-800 active" data-bs-toggle="tab" role="tab" href="#kt_activity_today">Hoje</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a id="kt_activity_week_tab" class="nav-link justify-content-center text-active-gray-800" data-bs-toggle="tab" role="tab" href="#kt_activity_week">Semana</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a id="kt_activity_month_tab" class="nav-link justify-content-center text-active-gray-800" data-bs-toggle="tab" role="tab" href="#kt_activity_month">Mês</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a id="kt_activity_year_tab" class="nav-link justify-content-center text-active-gray-800 text-hover-gray-800" data-bs-toggle="tab" role="tab" href="#kt_activity_year">{{ date('Y') }}</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="card-body">
                    <div class="tab-content">
                        <div id="kt_activity_today" class="card-body p-0 tab-pane fade show active" role="tabpanel" aria-labelledby="kt_activity_today_tab">
                            <div class="timeline">
                                <div class="timeline-item">
                                    <div class="timeline-line w-40px"></div>
                                    <div class="timeline-icon symbol symbol-circle symbol-40px me-4">
                                        <div class="symbol-label bg-light-success">
                                            <i class="ki-duotone ki-handcart fs-2 text-success">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                                <span class="path3"></span>
                                                <span class="path4"></span>
                                                <span class="path5"></span>
                                            </i>
                                        </div>
                                    </div>
                                    <div class="timeline-content mb-10 mt-n1">
                                        <div class="pe-3 mb-5">
                                            <div class="fs-5 fw-semibold mb-2">Compra de leads realizada</div>
                                            <div class="d-flex align-items-center mt-1 fs-6">
                                                <div class="text-muted me-2 fs-7">Processado às 14:23 por</div>
                                                <div class="fw-bold text-gray-800">{{ auth()->user()->name ?? 'Usuário' }}</div>
                                            </div>
                                        </div>
                                        <div class="overflow-auto pb-5">
                                            <div class="d-flex align-items-center border border-dashed border-gray-300 rounded min-w-750px px-7 py-3 mb-5">
                                                <div class="symbol symbol-60px symbol-2by3 flex-shrink-0 me-4">
                                                    <div class="symbol-label bg-light-success">
                                                        <i class="ki-duotone ki-handcart fs-1 text-success">
                                                            <span class="path1"></span>
                                                            <span class="path2"></span>
                                                            <span class="path3"></span>
                                                            <span class="path4"></span>
                                                            <span class="path5"></span>
                                                        </i>
                                                    </div>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <div class="fs-5 fw-bold text-gray-800 mb-1">Leads Tecnologia Premium</div>
                                                    <div class="text-muted fw-semibold fs-7 mb-1">por TechLeads Solutions</div>
                                                    <div class="d-flex align-items-center">
                                                        <span class="badge badge-light-success me-2">Quente</span>
                                                        <span class="text-muted fs-7">1.000 leads</span>
                                                    </div>
                                                </div>
                                                <div class="text-end">
                                                    <div class="fs-5 fw-bold text-gray-900 mb-1">R$500</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="timeline-item">
                                    <div class="timeline-line w-40px"></div>
                                    <div class="timeline-icon symbol symbol-circle symbol-40px">
                                        <div class="symbol-label bg-light-danger">
                                            <i class="ki-duotone ki-handcart fs-2 text-danger">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                                <span class="path3"></span>
                                                <span class="path4"></span>
                                                <span class="path5"></span>
                                            </i>
                                        </div>
                                    </div>
                                    <div class="timeline-content mb-10 mt-n1">
                                                                <div class="pe-3 mb-5">
                            <div class="fs-5 fw-semibold mb-2">Compra de leads realizada</div>
                            <div class="d-flex align-items-center mt-1 fs-6">
                                <div class="text-muted me-2 fs-7">Processado às 12:15 por</div>
                                                <div class="fw-bold text-gray-800">{{ auth()->user()->name ?? 'Usuário' }}</div>
                                            </div>
                                        </div>
                                        <div class="overflow-auto pb-5">
                                            <div class="d-flex align-items-center border border-dashed border-gray-300 rounded min-w-750px px-7 py-3 mb-5">
                                                <div class="symbol symbol-60px symbol-2by3 flex-shrink-0 me-4">
                                                    <div class="symbol-label bg-light-danger">
                                                        <i class="ki-duotone ki-abstract-22 fs-1 text-danger">
                                                            <span class="path1"></span>
                                                            <span class="path2"></span>
                                                        </i>
                                                    </div>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <div class="fs-5 fw-bold text-gray-800 mb-1">Leads Automotivos Premium</div>
                                                    <div class="text-muted fw-semibold fs-7 mb-1">por AutoLeads Corp</div>
                                                    <div class="d-flex align-items-center">
                                                        <span class="badge badge-light-danger me-2">Quente</span>
                                                        <span class="text-muted fs-7">500 leads</span>
                                                    </div>
                                                </div>
                                                <div class="text-end">
                                                    <div class="fs-5 fw-bold text-gray-900 mb-1">R$750</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="timeline-item">
                                    <div class="timeline-line w-40px"></div>
                                    <div class="timeline-icon symbol symbol-circle symbol-40px">
                                        <div class="symbol-label bg-light-warning">
                                            <i class="ki-duotone ki-price-tag fs-2 text-warning">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                                <span class="path3"></span>
                                            </i>
                                        </div>
                                    </div>
                                    <div class="timeline-content mb-10 mt-n1">
                                                                <div class="pe-3 mb-5">
                            <div class="fs-5 fw-semibold mb-2">Compra de leads realizada</div>
                            <div class="d-flex align-items-center mt-1 fs-6">
                                <div class="text-muted me-2 fs-7">Processado às 10:45 por</div>
                                                <div class="fw-bold text-gray-800">{{ auth()->user()->name ?? 'Usuário' }}</div>
                                            </div>
                                        </div>
                                        <div class="overflow-auto pb-5">
                                            <div class="d-flex align-items-center border border-dashed border-gray-300 rounded min-w-750px px-7 py-3 mb-5">
                                                <div class="symbol symbol-60px symbol-2by3 flex-shrink-0 me-4">
                                                    <div class="symbol-label bg-light-warning">
                                                        <i class="ki-duotone ki-price-tag fs-1 text-warning">
                                                            <span class="path1"></span>
                                                            <span class="path2"></span>
                                                            <span class="path3"></span>
                                                        </i>
                                                    </div>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <div class="fs-5 fw-bold text-gray-800 mb-1">Leads E-commerce Growth</div>
                                                    <div class="text-muted fw-semibold fs-7 mb-1">por DigitalGrowth Pro</div>
                                                    <div class="d-flex align-items-center">
                                                        <span class="badge badge-light-warning me-2">Morno</span>
                                                        <span class="text-muted fs-7">300 leads</span>
                                                    </div>
                                                </div>
                                                <div class="text-end">
                                                    <div class="fs-5 fw-bold text-gray-900 mb-1">R$689</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div id="kt_activity_week" class="card-body p-0 tab-pane fade" role="tabpanel" aria-labelledby="kt_activity_week_tab">
                            <div class="timeline">
                                <div class="timeline-item">
                                    <div class="timeline-line w-40px"></div>
                                    <div class="timeline-icon symbol symbol-circle symbol-40px">
                                        <div class="symbol-label bg-light-info">
                                            <i class="ki-duotone ki-ocean fs-2 text-info">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                                <span class="path3"></span>
                                                <span class="path4"></span>
                                                <span class="path5"></span>
                                                <span class="path6"></span>
                                                <span class="path7"></span>
                                                <span class="path8"></span>
                                                <span class="path9"></span>
                                                <span class="path10"></span>
                                                <span class="path11"></span>
                                                <span class="path12"></span>
                                                <span class="path13"></span>
                                                <span class="path14"></span>
                                                <span class="path15"></span>
                                                <span class="path16"></span>
                                                <span class="path17"></span>
                                                <span class="path18"></span>
                                                <span class="path19"></span>
                                            </i>
                                        </div>
                                    </div>
                                    <div class="timeline-content mb-10 mt-n1">
                                                                <div class="pe-3 mb-5">
                            <div class="fs-5 fw-semibold mb-2">Compra de leads realizada</div>
                            <div class="d-flex align-items-center mt-1 fs-6">
                                <div class="text-muted me-2 fs-7">Processado há 3 dias por</div>
                                                <div class="fw-bold text-gray-800">{{ auth()->user()->name ?? 'Usuário' }}</div>
                                            </div>
                                        </div>
                                        <div class="overflow-auto pb-5">
                                            <div class="d-flex align-items-center border border-dashed border-gray-300 rounded min-w-750px px-7 py-3 mb-5">
                                                <div class="symbol symbol-60px symbol-2by3 flex-shrink-0 me-4">
                                                    <div class="symbol-label bg-light-info">
                                                        <i class="ki-duotone ki-ocean fs-1 text-info">
                                                            <span class="path1"></span>
                                                            <span class="path2"></span>
                                                            <span class="path3"></span>
                                                            <span class="path4"></span>
                                                            <span class="path5"></span>
                                                            <span class="path6"></span>
                                                            <span class="path7"></span>
                                                            <span class="path8"></span>
                                                            <span class="path9"></span>
                                                            <span class="path10"></span>
                                                            <span class="path11"></span>
                                                            <span class="path12"></span>
                                                            <span class="path13"></span>
                                                            <span class="path14"></span>
                                                            <span class="path15"></span>
                                                            <span class="path16"></span>
                                                            <span class="path17"></span>
                                                            <span class="path18"></span>
                                                            <span class="path19"></span>
                                                        </i>
                                                    </div>
                                                </div>
                                                <div class="flex-grow-1">
                                                    <div class="fs-5 fw-bold text-gray-800 mb-1">Leads Saúde & Bem-estar</div>
                                                    <div class="text-muted fw-semibold fs-7 mb-1">por HealthLeads</div>
                                                    <div class="d-flex align-items-center">
                                                        <span class="badge badge-light-info me-2">Frio</span>
                                                        <span class="text-muted fs-7">200 leads - 100 créditos utilizados</span>
                                                    </div>
                                                </div>
                                                <div class="text-end">
                                                    <div class="fs-5 fw-bold text-gray-900 mb-1">-100 créditos</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div id="kt_activity_month" class="card-body p-0 tab-pane fade" role="tabpanel" aria-labelledby="kt_activity_month_tab">
                            <div class="timeline text-center pt-20 pb-20">
                                <div class="text-gray-600 fw-semibold fs-6">Nenhuma transação no período selecionado</div>
                            </div>
                        </div>

                        <div id="kt_activity_year" class="card-body p-0 tab-pane fade" role="tabpanel" aria-labelledby="kt_activity_year_tab">
                            <div class="timeline text-center pt-20 pb-20">
                                <div class="text-gray-600 fw-semibold fs-6">Nenhuma transação no período selecionado</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection