@extends('layouts.app')
@section('title', 'Home')
@section('dash', 'active')

@section('headlocal') @includeIf('pclient.home.jscss.css') @endsection
@section('jslocal') @includeIf('pclient.home.jscss.javascript') @endsection

@section('content')
<div class="d-flex flex-column flex-column-fluid">
    <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
        <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Dashboard</h1>
                <span class="text-muted">Painel Principal</span>
            </div>
        </div>
    </div>
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div class="row gx-5 gx-xl-10 mb-xl-10 p-10">
            <div class="col-md-6 col-lg-6 col-xl-6 col-xxl-3">
                <div class="card card-flush h-xl-100">
                    <div class="card-header rounded bgi-no-repeat bgi-size-cover bgi-position-y-top bgi-position-x-center align-items-start h-250px" style="background-image:url('{{asset('assets/images/svg/shapes/top-purple.png')}}" data-bs-theme="light">
                        <h3 class="card-title align-items-start flex-column text-white pt-15">
                            <span class="fw-bold fs-2x mb-3">Oportunidades</span>
                            <div class="fs-4 text-white">
                                <span class="opacity-75">Performance do Pipeline</span>
                            </div>
                        </h3>
                        <div class="card-toolbar pt-5">
                            <button class="btn btn-sm btn-icon btn-active-color-primary btn-color-white bg-white bg-opacity-25 bg-hover-opacity-100 bg-hover-white bg-active-opacity-25 w-20px h-20px" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end" data-kt-menu-overflow="true">
                                <i class="ki-duotone ki-dots-square fs-4">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                    <span class="path3"></span>
                                    <span class="path4"></span>
                                </i>
                            </button>
                            <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-semibold w-200px" data-kt-menu="true">
                                <div class="menu-item px-3">
                                    <div class="menu-content fs-6 text-dark fw-bold px-3 py-4">Filtros</div>
                                </div>
                                <div class="separator mb-3 opacity-75"></div>
                                <div class="menu-item px-3">
                                    <a href="#" class="menu-link px-3">New Ticket</a>
                                </div>
                                <div class="menu-item px-3">
                                    <a href="#" class="menu-link px-3">New Customer</a>
                                </div>
                                <div class="menu-item px-3" data-kt-menu-trigger="hover" data-kt-menu-placement="right-start">
                                    <a href="#" class="menu-link px-3">
                                        <span class="menu-title">New Group</span>
                                        <span class="menu-arrow"></span>
                                    </a>
                                    <div class="menu-sub menu-sub-dropdown w-175px py-4">
                                        <div class="menu-item px-3">
                                            <a href="#" class="menu-link px-3">Admin Group</a>
                                        </div>
                                        <div class="menu-item px-3">
                                            <a href="#" class="menu-link px-3">Staff Group</a>
                                        </div>
                                        <div class="menu-item px-3">
                                            <a href="#" class="menu-link px-3">Member Group</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="menu-item px-3">
                                    <a href="#" class="menu-link px-3">New Contact</a>
                                </div>
                                <div class="separator mt-3 opacity-75"></div>
                                <div class="menu-item px-3">
                                    <div class="menu-content px-3 py-3">
                                        <a class="btn btn-primary btn-sm px-4" href="#">Generate Reports</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body mt-n20">
                        <div class="mt-n20 position-relative">
                            <div class="row g-3 g-lg-6">
                                <div class="col-6">
                                    <div class="bg-gray-100 rounded-2 px-6 py-5">
                                        <div class="symbol symbol-30px me-5 mb-8">
                                            <span class="symbol-label">
                                                <i class="ki-duotone ki-flask fs-1 text-primary">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                </i>
                                            </span>
                                        </div>
                                        <div class="m-0">
                                            <span class="text-gray-700 fw-bolder d-block fs-2 lh-1 ls-n1 mb-1">37</span>
                                            <span class="text-gray-500 fw-semibold">Conversão</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="bg-gray-100 rounded-2 px-6 py-5">
                                        <div class="symbol symbol-30px me-5 mb-8">
                                            <span class="symbol-label">
                                                <i class="ki-duotone ki-bank fs-1 text-primary">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                </i>
                                            </span>
                                        </div>
                                        <div class="m-0">
                                            <span class="text-gray-700 fw-bolder d-block fs-2 lh-1 ls-n1 mb-1">R$ 61.500</span>
                                            <span class="text-gray-500 fw-semibold">Negociação</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="bg-gray-100 rounded-2 px-6 py-5">
                                        <div class="symbol symbol-30px me-5 mb-8">
                                            <span class="symbol-label">
                                                <i class="ki-duotone ki-award fs-1 text-primary">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                    <span class="path3"></span>
                                                </i>
                                            </span>
                                        </div>
                                        <div class="m-0">
                                            <span class="text-gray-700 fw-bolder d-block fs-2 lh-1 ls-n1 mb-1">4,7</span>
                                            <span class="text-gray-500 fw-semibold">Previsão</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="bg-gray-100 bg-opacity-70 rounded-2 px-6 py-5">
                                        <div class="symbol symbol-30px me-5 mb-8">
                                            <span class="symbol-label">
                                                <i class="ki-duotone ki-timer fs-1 text-primary">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                    <span class="path3"></span>
                                                </i>
                                            </span>
                                        </div>
                                        <div class="m-0">
                                            <span class="text-gray-700 fw-bolder d-block fs-2 lh-1 ls-n1 mb-1">R$ 822</span>
                                            <span class="text-gray-500 fw-semibold">Documentação</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-6 col-xl-6 col-xxl-3">
                <div class="row mb-2">
                    <div id="kt_sliders_widget_1_slider" class="card card-flush carousel carousel-custom carousel-stretch slide h-xl-100" data-bs-ride="carousel" data-bs-interval="5000">
                        <div class="card-header pt-5">
                            <h4 class="card-title d-flex align-items-start flex-column">
                                <span class="card-label fw-bold text-gray-800">Resultados</span>
                                <span class="text-gray-400 mt-1 fw-bold fs-7">Tratativas de leads</span>
                            </h4>
                            <div class="card-toolbar">
                                <ol class="p-0 m-0 carousel-indicators carousel-indicators-bullet carousel-indicators-active-primary">
                                    <li data-bs-target="#kt_sliders_widget_1_slider" data-bs-slide-to="0" class="active ms-1"></li>
                                    <li data-bs-target="#kt_sliders_widget_1_slider" data-bs-slide-to="1" class="ms-1"></li>
                                    <li data-bs-target="#kt_sliders_widget_1_slider" data-bs-slide-to="2" class="ms-1"></li>
                                </ol>
                            </div>
                        </div>
                        <div class="card-body py-6">
                            <div class="carousel-inner mt-n5">
                                <div class="carousel-item active show">
                                    <div class="d-flex align-items-center mb-5">
                                        <div class="w-80px flex-shrink-0 me-2">
                                            <div class="min-h-auto ms-n3" id="kt_slider_widget_1_chart_1" style="height: 100px"></div>
                                        </div>
                                        <div class="m-0">
                                            <h4 class="fw-bold text-gray-800 mb-3">Maio/25</h4>
                                            <div class="d-flex d-grid gap-5">
                                                <div class="d-flex flex-column flex-shrink-0 me-4">
                                                    <span class="d-flex align-items-center fs-7 fw-bold text-gray-400 mb-2">
                                                        <i class="ki-duotone ki-right-square fs-6 text-gray-600 me-2">
                                                            <span class="path1"></span>
                                                            <span class="path2"></span>
                                                        </i>
                                                        1.400 Leads
                                                    </span>
                                                    <span class="d-flex align-items-center text-gray-400 fw-bold fs-7">
                                                        <i class="ki-duotone ki-right-square fs-6 text-gray-600 me-2">
                                                            <span class="path1"></span>
                                                            <span class="path2"></span>
                                                        </i>
                                                        457 Leads
                                                    </span>
                                                </div>
                                                <div class="d-flex flex-column flex-shrink-0">
                                                    <span class="d-flex align-items-center fs-7 fw-bold text-gray-400 mb-2">
                                                        <i class="ki-duotone ki-right-square fs-6 text-gray-600 me-2">
                                                            <span class="path1"></span>
                                                            <span class="path2"></span>
                                                        </i>
                                                        226 Leads
                                                    </span>
                                                    <span class="d-flex align-items-center text-gray-400 fw-bold fs-7">
                                                        <i class="ki-duotone ki-right-square fs-6 text-gray-600 me-2">
                                                            <span class="path1"></span>
                                                            <span class="path2"></span>
                                                        </i>
                                                        4.567 Leads
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="m-0 d-grid gap-2">
                                        <a href="#" class="btn btn-sm btn-light me-2 mb-2"><b>Relatório do Total de Leads:</b>  6.650</a>
                                    </div>
                                </div>
                                <div class="carousel-item">
                                    <div class="d-flex align-items-center mb-5">
                                        <div class="w-80px flex-shrink-0 me-2">
                                            <div class="min-h-auto ms-n3" id="kt_slider_widget_1_chart_2" style="height: 100px"></div>
                                        </div>
                                        <div class="m-0">
                                           <h4 class="fw-bold text-gray-800 mb-3">Junho/25</h4>
                                            <div class="d-flex d-grid gap-5">
                                                <div class="d-flex flex-column flex-shrink-0 me-4">
                                                    <span class="d-flex align-items-center fs-7 fw-bold text-gray-400 mb-2">
                                                        <i class="ki-duotone ki-right-square fs-6 text-gray-600 me-2">
                                                            <span class="path1"></span>
                                                            <span class="path2"></span>
                                                        </i>
                                                        2.123 Leads
                                                    </span>
                                                    <span class="d-flex align-items-center text-gray-400 fw-bold fs-7">
                                                        <i class="ki-duotone ki-right-square fs-6 text-gray-600 me-2">
                                                            <span class="path1"></span>
                                                            <span class="path2"></span>
                                                        </i>
                                                        657 Leads
                                                    </span>
                                                </div>
                                                <div class="d-flex flex-column flex-shrink-0">
                                                    <span class="d-flex align-items-center fs-7 fw-bold text-gray-400 mb-2">
                                                        <i class="ki-duotone ki-right-square fs-6 text-gray-600 me-2">
                                                            <span class="path1"></span>
                                                            <span class="path2"></span>
                                                        </i>
                                                        226 Leads
                                                    </span>
                                                    <span class="d-flex align-items-center text-gray-400 fw-bold fs-7">
                                                        <i class="ki-duotone ki-right-square fs-6 text-gray-600 me-2">
                                                            <span class="path1"></span>
                                                            <span class="path2"></span>
                                                        </i>
                                                        567 Leads
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="m-0 d-grid gap-2">
                                        <a href="#" class="btn btn-sm btn-light me-2 mb-2"><b>Relatório do Total de Leads:</b>  3.573</a>
                                    </div>
                                </div>
                                <div class="carousel-item">
                                    <div class="d-flex align-items-center mb-5">
                                        <div class="w-80px flex-shrink-0 me-2">
                                            <div class="min-h-auto ms-n3" id="kt_slider_widget_1_chart_3" style="height: 100px"></div>
                                        </div>
                                        <div class="m-0">
                                            <h4 class="fw-bold text-gray-800 mb-3">Agosto/25</h4>
                                            <div class="d-flex d-grid gap-5">
                                                <div class="d-flex flex-column flex-shrink-0 me-4">
                                                    <span class="d-flex align-items-center fs-7 fw-bold text-gray-400 mb-2">
                                                        <i class="ki-duotone ki-right-square fs-6 text-gray-600 me-2">
                                                            <span class="path1"></span>
                                                            <span class="path2"></span>
                                                        </i>
                                                        410 Leads
                                                    </span>
                                                    <span class="d-flex align-items-center text-gray-400 fw-bold fs-7">
                                                        <i class="ki-duotone ki-right-square fs-6 text-gray-600 me-2">
                                                            <span class="path1"></span>
                                                            <span class="path2"></span>
                                                        </i>
                                                        457 Leads
                                                    </span>
                                                </div>
                                                <div class="d-flex flex-column flex-shrink-0">
                                                    <span class="d-flex align-items-center fs-7 fw-bold text-gray-400 mb-2">
                                                        <i class="ki-duotone ki-right-square fs-6 text-gray-600 me-2">
                                                            <span class="path1"></span>
                                                            <span class="path2"></span>
                                                        </i>
                                                        226 Leads
                                                    </span>
                                                    <span class="d-flex align-items-center text-gray-400 fw-bold fs-7">
                                                        <i class="ki-duotone ki-right-square fs-6 text-gray-600 me-2">
                                                            <span class="path1"></span>
                                                            <span class="path2"></span>
                                                        </i>
                                                        167 Leads
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="m-0 d-grid gap-2">
                                        <a href="#" class="btn btn-sm btn-light me-2 mb-2"><b>Relatório do Total de Leads:</b>  1.260</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div id="kt_sliders_widget_2_slider" class="card card-flush carousel carousel-custom carousel-stretch slide h-xl-100" data-bs-ride="carousel" data-bs-interval="5500">
                        <div class="card-header pt-5">
                            <h4 class="card-title d-flex align-items-start flex-column">
                                <span class="card-label fw-bold text-gray-800">Valor vendido</span>
                                <span class="text-gray-400 mt-1 fw-bold fs-7">Total de vandas nos últimos meses</span>
                            </h4>

                            <div class="card-toolbar">
                                <ol class="p-0 m-0 carousel-indicators carousel-indicators-bullet carousel-indicators-active-success">
                                    <li data-bs-target="#kt_sliders_widget_2_slider" data-bs-slide-to="0" class="active ms-1"></li>
                                    <li data-bs-target="#kt_sliders_widget_2_slider" data-bs-slide-to="1" class="ms-1"></li>
                                    <li data-bs-target="#kt_sliders_widget_2_slider" data-bs-slide-to="2" class="ms-1"></li>
                                </ol>
                            </div>

                        </div>
                        <div class="card-body py-6">

                            <div class="carousel-inner">

                                <div class="carousel-item active show">

                                    <div class="d-flex align-items-center mb-9">

                                        <div class="m-0">

                                            <h4 class="fw-bold text-gray-800 mb-3">Maio</h4>

                                            <div class="d-flex d-grid gap-5">

                                                <div class="d-flex flex-column flex-shrink-0 me-4">

                                                    <span class="d-flex align-items-center fs-7 fw-bold text-gray-400 mb-2">
                                                        <i class="ki-duotone ki-right-square fs-6 text-gray-600 me-2">
                                                            <span class="path1"></span>
                                                            <span class="path2"></span>
                                                        </i>5 vendas</span>

                                                    <span class="d-flex align-items-center text-gray-400 fw-bold fs-7">
                                                        <i class="ki-duotone ki-right-square fs-6 text-gray-600 me-2">
                                                            <span class="path1"></span>
                                                            <span class="path2"></span>
                                                        </i>R$800,00 ticket</span>

                                                </div>

                                                <div class="d-flex flex-column flex-shrink-0">

                                                    <span class="d-flex align-items-center fs-7 fw-bold text-gray-400 mb-2">
                                                        <i class="ki-duotone ki-right-square fs-6 text-gray-600 me-2">
                                                            <span class="path1"></span>
                                                            <span class="path2"></span>
                                                        </i>R$ 13.000,00 total</span>

                                                    <span class="d-flex align-items-center text-gray-400 fw-bold fs-7">
                                                        <i class="ki-duotone ki-right-square fs-6 text-gray-600 me-2">
                                                            <span class="path1"></span>
                                                            <span class="path2"></span>
                                                        </i>13% taxa de conversão</span>

                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                    <div class="m-0">
                                        <a href="#" class="btn btn-sm btn-light me-2 mb-2">Detalhes</a>
                                    </div>

                                </div>

                                <div class="carousel-item">

                                    <div class="d-flex align-items-center mb-9">

                                        <div class="m-0">

                                            <h4 class="fw-bold text-gray-800 mb-3">Junho</h4>

                                            <div class="d-flex d-grid gap-5">

                                                <div class="d-flex flex-column flex-shrink-0 me-4">

                                                    <span class="d-flex align-items-center fs-7 fw-bold text-gray-400 mb-2">
                                                        <i class="ki-duotone ki-right-square fs-6 text-gray-600 me-2">
                                                            <span class="path1"></span>
                                                            <span class="path2"></span>
                                                        </i>12 vendas</span>

                                                    <span class="d-flex align-items-center text-gray-400 fw-bold fs-7">
                                                        <i class="ki-duotone ki-right-square fs-6 text-gray-600 me-2">
                                                            <span class="path1"></span>
                                                            <span class="path2"></span>
                                                        </i>R$800,00 ticket</span>

                                                </div>

                                                <div class="d-flex flex-column flex-shrink-0">

                                                    <span class="d-flex align-items-center fs-7 fw-bold text-gray-400 mb-2">
                                                        <i class="ki-duotone ki-right-square fs-6 text-gray-600 me-2">
                                                            <span class="path1"></span>
                                                            <span class="path2"></span>
                                                        </i>R$ 50.000,00 total</span>

                                                    <span class="d-flex align-items-center text-gray-400 fw-bold fs-7">
                                                        <i class="ki-duotone ki-right-square fs-6 text-gray-600 me-2">
                                                            <span class="path1"></span>
                                                            <span class="path2"></span>
                                                        </i>7% taxa de conversão</span>

                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                    <div class="m-0">
                                        <a href="#" class="btn btn-sm btn-light me-2 mb-2">Detalhes</a>
                                    </div>

                                </div>

                                <div class="carousel-item">

                                    <div class="d-flex align-items-center mb-9">

                                        <div class="m-0">

                                            <h4 class="fw-bold text-gray-800 mb-3">Julho</h4>

                                            <div class="d-flex d-grid gap-5">

                                                <div class="d-flex flex-column flex-shrink-0 me-4">

                                                    <span class="d-flex align-items-center fs-7 fw-bold text-gray-400 mb-2">
                                                        <i class="ki-duotone ki-right-square fs-6 text-gray-600 me-2">
                                                            <span class="path1"></span>
                                                            <span class="path2"></span>
                                                        </i>3 vendas</span>

                                                    <span class="d-flex align-items-center text-gray-400 fw-bold fs-7">
                                                        <i class="ki-duotone ki-right-square fs-6 text-gray-600 me-2">
                                                            <span class="path1"></span>
                                                            <span class="path2"></span>
                                                        </i>R$600,00</span>

                                                </div>

                                                <div class="d-flex flex-column flex-shrink-0">

                                                    <span class="d-flex align-items-center fs-7 fw-bold text-gray-400 mb-2">
                                                        <i class="ki-duotone ki-right-square fs-6 text-gray-600 me-2">
                                                            <span class="path1"></span>
                                                            <span class="path2"></span>
                                                        </i>R$ 8.000,00 total</span>

                                                    <span class="d-flex align-items-center text-gray-400 fw-bold fs-7">
                                                        <i class="ki-duotone ki-right-square fs-6 text-gray-600 me-2">
                                                            <span class="path1"></span>
                                                            <span class="path2"></span>
                                                        </i>7% taxa de conversão</span>

                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                    <div class="m-0">
                                        <a href="#" class="btn btn-sm btn-light me-2 mb-2">Detalhes</a>
                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12 col-xl-12 col-xxl-6 mb-10 mb-xl-0">
                <div class="card h-md-100">
                    <div class="card-header border-0 pt-5">
                        <h3 class="card-title align-items-start flex-column">
                            <span class="card-label fw-bold text-gray-900">Agendamentos</span>
                            <span class="text-muted mt-1 fw-semibold fs-7">Próximos eventos agendados</span>
                        </h3>
                        <div class="card-toolbar">
                            <a href={{route('calendar.index')}} class="btn btn-sm btn-light">Agenda completa</a>
                        </div>
                    </div>
                    <div class="card-body pt-7 px-0">
                        <ul class="nav nav-stretch nav-pills nav-pills-custom nav-pills-active-custom d-flex justify-content-between mb-8 px-5" role="tablist">
                            <li class="nav-item p-0 ms-0" role="presentation">
                                <a class="nav-link btn d-flex flex-column flex-center rounded-pill min-w-45px py-4 px-3 btn-active-danger " data-bs-toggle="tab" href="#kt_timeline_widget_3_tab_content_1" aria-selected="false" tabindex="-1" role="tab">
                                    <span class="fs-7 fw-semibold">Sex</span>
                                    <span class="fs-6 fw-bold">20</span>
                                </a>
                            </li>
                            <li class="nav-item p-0 ms-0" role="presentation">
                                <a class="nav-link btn d-flex flex-column flex-center rounded-pill min-w-45px py-4 px-3 btn-active-danger " data-bs-toggle="tab" href="#kt_timeline_widget_3_tab_content_2" aria-selected="false" tabindex="-1" role="tab">
                                    <span class="fs-7 fw-semibold">Sáb</span>
                                    <span class="fs-6 fw-bold">21</span>
                                </a>
                            </li>
                            <li class="nav-item p-0 ms-0" role="presentation">
                                <a class="nav-link btn d-flex flex-column flex-center rounded-pill min-w-45px py-4 px-3 btn-active-danger " data-bs-toggle="tab" href="#kt_timeline_widget_3_tab_content_3" aria-selected="false" tabindex="-1" role="tab">
                                    <span class="fs-7 fw-semibold">Dom</span>
                                    <span class="fs-6 fw-bold">22</span>
                                </a>
                            </li>
                            <li class="nav-item p-0 ms-0" role="presentation">
                                <a class="nav-link btn d-flex flex-column flex-center rounded-pill min-w-45px py-4 px-3 btn-active-danger active" data-bs-toggle="tab" href="#kt_timeline_widget_3_tab_content_4" aria-selected="true" role="tab">
                                    <span class="fs-7 fw-semibold">Seg</span>
                                    <span class="fs-6 fw-bold">23</span>
                                </a>
                            </li>
                            <li class="nav-item p-0 ms-0" role="presentation">
                                <a class="nav-link btn d-flex flex-column flex-center rounded-pill min-w-45px py-4 px-3 btn-active-danger " data-bs-toggle="tab" href="#kt_timeline_widget_3_tab_content_5" aria-selected="false" tabindex="-1" role="tab">
                                    <span class="fs-7 fw-semibold">Ter</span>
                                    <span class="fs-6 fw-bold">24</span>
                                </a>
                            </li>
                            <li class="nav-item p-0 ms-0" role="presentation">
                                <a class="nav-link btn d-flex flex-column flex-center rounded-pill min-w-45px py-4 px-3 btn-active-danger " data-bs-toggle="tab" href="#kt_timeline_widget_3_tab_content_6" aria-selected="false" tabindex="-1" role="tab">
                                    <span class="fs-7 fw-semibold">Qua</span>
                                    <span class="fs-6 fw-bold">25</span>
                                </a>
                            </li>
                            <li class="nav-item p-0 ms-0" role="presentation">
                                <a class="nav-link btn d-flex flex-column flex-center rounded-pill min-w-45px py-4 px-3 btn-active-danger " data-bs-toggle="tab" href="#kt_timeline_widget_3_tab_content_7" aria-selected="false" tabindex="-1" role="tab">
                                    <span class="fs-7 fw-semibold">Qui</span>
                                    <span class="fs-6 fw-bold">26</span>
                                </a>
                            </li>
                            <li class="nav-item p-0 ms-0" role="presentation">
                                <a class="nav-link btn d-flex flex-column flex-center rounded-pill min-w-45px py-4 px-3 btn-active-danger " data-bs-toggle="tab" href="#kt_timeline_widget_3_tab_content_8" aria-selected="false" tabindex="-1" role="tab">
                                    <span class="fs-7 fw-semibold">Sex</span>
                                    <span class="fs-6 fw-bold">27</span>
                                </a>
                            </li>
                            <li class="nav-item p-0 ms-0" role="presentation">
                                <a class="nav-link btn d-flex flex-column flex-center rounded-pill min-w-45px py-4 px-3 btn-active-danger " data-bs-toggle="tab" href="#kt_timeline_widget_3_tab_content_9" aria-selected="false" tabindex="-1" role="tab">
                                    <span class="fs-7 fw-semibold">Sáb</span>
                                    <span class="fs-6 fw-bold">28</span>
                                </a>
                            </li>
                            <li class="nav-item p-0 ms-0" role="presentation">
                                <a class="nav-link btn d-flex flex-column flex-center rounded-pill min-w-45px py-4 px-3 btn-active-danger " data-bs-toggle="tab" href="#kt_timeline_widget_3_tab_content_10" aria-selected="false" tabindex="-1" role="tab">
                                    <span class="fs-7 fw-semibold">Dom</span>
                                    <span class="fs-6 fw-bold">29</span>
                                </a>
                            </li>
                            <li class="nav-item p-0 ms-0" role="presentation">
                                <a class="nav-link btn d-flex flex-column flex-center rounded-pill min-w-45px py-4 px-3 btn-active-danger " data-bs-toggle="tab" href="#kt_timeline_widget_3_tab_content_11" aria-selected="false" tabindex="-1" role="tab">
                                    <span class="fs-7 fw-semibold">Seg</span>
                                    <span class="fs-6 fw-bold">30</span>
                                </a>
                            </li>
                        </ul>
                        <div class="tab-content mb-2 px-9">
                            <div class="tab-pane fade " id="kt_timeline_widget_3_tab_content_1" role="tabpanel">
                                <div class="d-flex align-items-center mb-6">
                                    <span data-kt-element="bullet" class="bullet bullet-vertical d-flex align-items-center min-h-70px mh-100 me-4 bg-success"></span>
                                    <div class="flex-grow-1 me-5">
                                        <div class="text-gray-800 fw-semibold fs-2">
                                            10:20 - 11:00
                                            <span class="text-gray-500 fw-semibold fs-7">AM </span>
                                        </div>
                                        <div class="text-gray-700 fw-semibold fs-6">9 Degree Project Estimation Meeting</div>

                                        <div class="text-gray-500 fw-semibold fs-7">
                                            Lead by
                                            <a href="#" class="text-primary opacity-75-hover fw-semibold">Peter
                                                Marcus</a>
                                        </div>
                                    </div>



                                    <a href="#" class="btn btn-sm btn-light" data-bs-toggle="modal" data-bs-target="#kt_modal_create_project">View</a>

                                </div>



                                <div class="d-flex align-items-center mb-6">

                                    <span data-kt-element="bullet" class="bullet bullet-vertical d-flex align-items-center min-h-70px mh-100 me-4 bg-warning"></span>



                                    <div class="flex-grow-1 me-5">
                                        <div class="text-gray-800 fw-semibold fs-2">
                                            12:00 - 13:40
                                            <span class="text-gray-500 fw-semibold fs-7">
                                                AM </span>
                                        </div>

                                        <div class="text-gray-700 fw-semibold fs-6">
                                            Dashboard UI/UX Design Review </div>

                                        <div class="text-gray-500 fw-semibold fs-7">
                                            Lead by
                                            <a href="#" class="text-primary opacity-75-hover fw-semibold">Lead by
                                                Bob</a>
                                        </div>
                                    </div>



                                    <a href="#" class="btn btn-sm btn-light" data-bs-toggle="modal" data-bs-target="#kt_modal_create_project">View</a>

                                </div>



                                <div class="d-flex align-items-center mb-6">

                                    <span data-kt-element="bullet" class="bullet bullet-vertical d-flex align-items-center min-h-70px mh-100 me-4 bg-info"></span>



                                    <div class="flex-grow-1 me-5">

                                        <div class="text-gray-800 fw-semibold fs-2">
                                            16:30 - 17:00
                                            <span class="text-gray-500 fw-semibold fs-7">
                                                PM </span>
                                        </div>



                                        <div class="text-gray-700 fw-semibold fs-6">
                                            Marketing Campaign Discussion </div>



                                        <div class="text-gray-500 fw-semibold fs-7">
                                            Lead by

                                            <a href="#" class="text-primary opacity-75-hover fw-semibold">Lead by Mark
                                                Morris</a>

                                        </div>

                                    </div>



                                    <a href="#" class="btn btn-sm btn-light" data-bs-toggle="modal" data-bs-target="#kt_modal_create_project">View</a>

                                </div>

                            </div>


                            <div class="tab-pane fade " id="kt_timeline_widget_3_tab_content_2" role="tabpanel">


                                <div class="d-flex align-items-center mb-6">

                                    <span data-kt-element="bullet" class="bullet bullet-vertical d-flex align-items-center min-h-70px mh-100 me-4 bg-warning"></span>



                                    <div class="flex-grow-1 me-5">

                                        <div class="text-gray-800 fw-semibold fs-2">
                                            16:30 - 17:00
                                            <span class="text-gray-500 fw-semibold fs-7">
                                                PM </span>
                                        </div>



                                        <div class="text-gray-700 fw-semibold fs-6">
                                            Marketing Campaign Discussion </div>



                                        <div class="text-gray-500 fw-semibold fs-7">
                                            Lead by

                                            <a href="#" class="text-primary opacity-75-hover fw-semibold">Lead by Mark
                                                Morris</a>

                                        </div>

                                    </div>



                                    <a href="#" class="btn btn-sm btn-light" data-bs-toggle="modal" data-bs-target="#kt_modal_create_project">View</a>

                                </div>



                                <div class="d-flex align-items-center mb-6">

                                    <span data-kt-element="bullet" class="bullet bullet-vertical d-flex align-items-center min-h-70px mh-100 me-4 bg-info"></span>



                                    <div class="flex-grow-1 me-5">

                                        <div class="text-gray-800 fw-semibold fs-2">
                                            12:00 - 13:40
                                            <span class="text-gray-500 fw-semibold fs-7">
                                                AM </span>
                                        </div>



                                        <div class="text-gray-700 fw-semibold fs-6">
                                            9 Degree Project Estimation Meeting </div>



                                        <div class="text-gray-500 fw-semibold fs-7">
                                            Lead by

                                            <a href="#" class="text-primary opacity-75-hover fw-semibold">Peter
                                                Marcus</a>

                                        </div>

                                    </div>



                                    <a href="#" class="btn btn-sm btn-light" data-bs-toggle="modal" data-bs-target="#kt_modal_create_project">View</a>

                                </div>



                                <div class="d-flex align-items-center mb-6">

                                    <span data-kt-element="bullet" class="bullet bullet-vertical d-flex align-items-center min-h-70px mh-100 me-4 bg-success"></span>



                                    <div class="flex-grow-1 me-5">

                                        <div class="text-gray-800 fw-semibold fs-2">
                                            10:20 - 11:00
                                            <span class="text-gray-500 fw-semibold fs-7">
                                                AM </span>
                                        </div>



                                        <div class="text-gray-700 fw-semibold fs-6">
                                            9 Degree Project Estimation Meeting </div>



                                        <div class="text-gray-500 fw-semibold fs-7">
                                            Lead by

                                            <a href="#" class="text-primary opacity-75-hover fw-semibold">Peter
                                                Marcus</a>

                                        </div>

                                    </div>



                                    <a href="#" class="btn btn-sm btn-light" data-bs-toggle="modal" data-bs-target="#kt_modal_create_project">View</a>

                                </div>

                            </div>


                            <div class="tab-pane fade " id="kt_timeline_widget_3_tab_content_3" role="tabpanel">


                                <div class="d-flex align-items-center mb-6">

                                    <span data-kt-element="bullet" class="bullet bullet-vertical d-flex align-items-center min-h-70px mh-100 me-4 bg-primary"></span>



                                    <div class="flex-grow-1 me-5">

                                        <div class="text-gray-800 fw-semibold fs-2">
                                            10:20 - 11:00
                                            <span class="text-gray-500 fw-semibold fs-7">
                                                AM </span>
                                        </div>



                                        <div class="text-gray-700 fw-semibold fs-6">
                                            9 Degree Project Estimation Meeting </div>



                                        <div class="text-gray-500 fw-semibold fs-7">
                                            Lead by

                                            <a href="#" class="text-primary opacity-75-hover fw-semibold">Peter
                                                Marcus</a>

                                        </div>

                                    </div>



                                    <a href="#" class="btn btn-sm btn-light" data-bs-toggle="modal" data-bs-target="#kt_modal_create_project">View</a>

                                </div>



                                <div class="d-flex align-items-center mb-6">

                                    <span data-kt-element="bullet" class="bullet bullet-vertical d-flex align-items-center min-h-70px mh-100 me-4 bg-warning"></span>



                                    <div class="flex-grow-1 me-5">

                                        <div class="text-gray-800 fw-semibold fs-2">
                                            12:00 - 13:40
                                            <span class="text-gray-500 fw-semibold fs-7">
                                                AM </span>
                                        </div>



                                        <div class="text-gray-700 fw-semibold fs-6">
                                            Marketing Campaign Discussion </div>



                                        <div class="text-gray-500 fw-semibold fs-7">
                                            Lead by

                                            <a href="#" class="text-primary opacity-75-hover fw-semibold">Lead by
                                                Bob</a>

                                        </div>

                                    </div>



                                    <a href="#" class="btn btn-sm btn-light" data-bs-toggle="modal" data-bs-target="#kt_modal_create_project">View</a>

                                </div>



                                <div class="d-flex align-items-center mb-6">

                                    <span data-kt-element="bullet" class="bullet bullet-vertical d-flex align-items-center min-h-70px mh-100 me-4 bg-info"></span>



                                    <div class="flex-grow-1 me-5">

                                        <div class="text-gray-800 fw-semibold fs-2">
                                            16:30 - 17:00
                                            <span class="text-gray-500 fw-semibold fs-7">
                                                PM </span>
                                        </div>



                                        <div class="text-gray-700 fw-semibold fs-6">
                                            Marketing Campaign Discussion </div>



                                        <div class="text-gray-500 fw-semibold fs-7">
                                            Lead by

                                            <a href="#" class="text-primary opacity-75-hover fw-semibold">Lead by Mark
                                                Morris</a>

                                        </div>

                                    </div>



                                    <a href="#" class="btn btn-sm btn-light" data-bs-toggle="modal" data-bs-target="#kt_modal_create_project">View</a>

                                </div>

                            </div>


                            <div class="tab-pane fade show active" id="kt_timeline_widget_3_tab_content_4" role="tabpanel">


                                <div class="d-flex align-items-center mb-6">

                                    <span data-kt-element="bullet" class="bullet bullet-vertical d-flex align-items-center min-h-70px mh-100 me-4 bg-info"></span>



                                    <div class="flex-grow-1 me-5">

                                        <div class="text-gray-800 fw-semibold fs-2">
                                            10:20 - 11:00
                                            <span class="text-gray-500 fw-semibold fs-7">
                                                AM </span>
                                        </div>



                                        <div class="text-gray-700 fw-semibold fs-6">
                                            9 Degree Project Estimation Meeting </div>



                                        <div class="text-gray-500 fw-semibold fs-7">
                                            Lead by

                                            <a href="#" class="text-primary opacity-75-hover fw-semibold">Peter
                                                Marcus</a>

                                        </div>

                                    </div>



                                    <a href="#" class="btn btn-sm btn-light" data-bs-toggle="modal" data-bs-target="#kt_modal_create_project">View</a>

                                </div>



                                <div class="d-flex align-items-center mb-6">

                                    <span data-kt-element="bullet" class="bullet bullet-vertical d-flex align-items-center min-h-70px mh-100 me-4 bg-warning"></span>



                                    <div class="flex-grow-1 me-5">

                                        <div class="text-gray-800 fw-semibold fs-2">
                                            16:30 - 17:00
                                            <span class="text-gray-500 fw-semibold fs-7">
                                                PM </span>
                                        </div>



                                        <div class="text-gray-700 fw-semibold fs-6">
                                            Dashboard UI/UX Design Review </div>



                                        <div class="text-gray-500 fw-semibold fs-7">
                                            Lead by

                                            <a href="#" class="text-primary opacity-75-hover fw-semibold">Lead by
                                                Bob</a>

                                        </div>

                                    </div>



                                    <a href="#" class="btn btn-sm btn-light" data-bs-toggle="modal" data-bs-target="#kt_modal_create_project">View</a>

                                </div>



                                <div class="d-flex align-items-center mb-6">

                                    <span data-kt-element="bullet" class="bullet bullet-vertical d-flex align-items-center min-h-70px mh-100 me-4 bg-success"></span>



                                    <div class="flex-grow-1 me-5">

                                        <div class="text-gray-800 fw-semibold fs-2">
                                            12:00 - 13:40
                                            <span class="text-gray-500 fw-semibold fs-7">
                                                AM </span>
                                        </div>



                                        <div class="text-gray-700 fw-semibold fs-6">
                                            Marketing Campaign Discussion </div>



                                        <div class="text-gray-500 fw-semibold fs-7">
                                            Lead by

                                            <a href="#" class="text-primary opacity-75-hover fw-semibold">Lead by Mark
                                                Morris</a>

                                        </div>

                                    </div>



                                    <a href="#" class="btn btn-sm btn-light" data-bs-toggle="modal" data-bs-target="#kt_modal_create_project">View</a>

                                </div>

                            </div>


                            <div class="tab-pane fade " id="kt_timeline_widget_3_tab_content_5" role="tabpanel">


                                <div class="d-flex align-items-center mb-6">

                                    <span data-kt-element="bullet" class="bullet bullet-vertical d-flex align-items-center min-h-70px mh-100 me-4 bg-danger"></span>



                                    <div class="flex-grow-1 me-5">

                                        <div class="text-gray-800 fw-semibold fs-2">
                                            12:00 - 13:40
                                            <span class="text-gray-500 fw-semibold fs-7">
                                                AM </span>
                                        </div>



                                        <div class="text-gray-700 fw-semibold fs-6">
                                            9 Dashboard UI/UX Design Review </div>



                                        <div class="text-gray-500 fw-semibold fs-7">
                                            Lead by

                                            <a href="#" class="text-primary opacity-75-hover fw-semibold">Lead by
                                                Bob</a>

                                        </div>

                                    </div>



                                    <a href="#" class="btn btn-sm btn-light" data-bs-toggle="modal" data-bs-target="#kt_modal_create_project">View</a>

                                </div>



                                <div class="d-flex align-items-center mb-6">

                                    <span data-kt-element="bullet" class="bullet bullet-vertical d-flex align-items-center min-h-70px mh-100 me-4 bg-warning"></span>



                                    <div class="flex-grow-1 me-5">

                                        <div class="text-gray-800 fw-semibold fs-2">
                                            10:20 - 11:00
                                            <span class="text-gray-500 fw-semibold fs-7">
                                                AM </span>
                                        </div>



                                        <div class="text-gray-700 fw-semibold fs-6">
                                            9 Degree Project Estimation Meeting </div>



                                        <div class="text-gray-500 fw-semibold fs-7">
                                            Lead by

                                            <a href="#" class="text-primary opacity-75-hover fw-semibold">Lead by Mark
                                                Morris</a>

                                        </div>

                                    </div>



                                    <a href="#" class="btn btn-sm btn-light" data-bs-toggle="modal" data-bs-target="#kt_modal_create_project">View</a>

                                </div>



                                <div class="d-flex align-items-center mb-6">

                                    <span data-kt-element="bullet" class="bullet bullet-vertical d-flex align-items-center min-h-70px mh-100 me-4 bg-info"></span>



                                    <div class="flex-grow-1 me-5">

                                        <div class="text-gray-800 fw-semibold fs-2">
                                            16:30 - 17:00
                                            <span class="text-gray-500 fw-semibold fs-7">
                                                PM </span>
                                        </div>



                                        <div class="text-gray-700 fw-semibold fs-6">
                                            Marketing Campaign Discussion </div>



                                        <div class="text-gray-500 fw-semibold fs-7">
                                            Lead by

                                            <a href="#" class="text-primary opacity-75-hover fw-semibold">Peter
                                                Marcus</a>

                                        </div>

                                    </div>



                                    <a href="#" class="btn btn-sm btn-light" data-bs-toggle="modal" data-bs-target="#kt_modal_create_project">View</a>

                                </div>

                            </div>


                            <div class="tab-pane fade " id="kt_timeline_widget_3_tab_content_6" role="tabpanel">


                                <div class="d-flex align-items-center mb-6">

                                    <span data-kt-element="bullet" class="bullet bullet-vertical d-flex align-items-center min-h-70px mh-100 me-4 bg-info"></span>



                                    <div class="flex-grow-1 me-5">

                                        <div class="text-gray-800 fw-semibold fs-2">
                                            10:20 - 11:00
                                            <span class="text-gray-500 fw-semibold fs-7">
                                                AM </span>
                                        </div>



                                        <div class="text-gray-700 fw-semibold fs-6">
                                            Marketing Campaign Discussion </div>



                                        <div class="text-gray-500 fw-semibold fs-7">
                                            Lead by

                                            <a href="#" class="text-primary opacity-75-hover fw-semibold">Lead by Mark
                                                Morris</a>

                                        </div>

                                    </div>



                                    <a href="#" class="btn btn-sm btn-light" data-bs-toggle="modal" data-bs-target="#kt_modal_create_project">View</a>

                                </div>



                                <div class="d-flex align-items-center mb-6">

                                    <span data-kt-element="bullet" class="bullet bullet-vertical d-flex align-items-center min-h-70px mh-100 me-4 bg-primary"></span>



                                    <div class="flex-grow-1 me-5">

                                        <div class="text-gray-800 fw-semibold fs-2">
                                            16:30 - 17:00
                                            <span class="text-gray-500 fw-semibold fs-7">
                                                PM </span>
                                        </div>



                                        <div class="text-gray-700 fw-semibold fs-6">
                                            9 Degree Project Estimation Meeting </div>



                                        <div class="text-gray-500 fw-semibold fs-7">
                                            Lead by

                                            <a href="#" class="text-primary opacity-75-hover fw-semibold">Peter
                                                Marcus</a>

                                        </div>

                                    </div>



                                    <a href="#" class="btn btn-sm btn-light" data-bs-toggle="modal" data-bs-target="#kt_modal_create_project">View</a>

                                </div>



                                <div class="d-flex align-items-center mb-6">

                                    <span data-kt-element="bullet" class="bullet bullet-vertical d-flex align-items-center min-h-70px mh-100 me-4 bg-warning"></span>



                                    <div class="flex-grow-1 me-5">

                                        <div class="text-gray-800 fw-semibold fs-2">
                                            12:00 - 13:40
                                            <span class="text-gray-500 fw-semibold fs-7">
                                                AM </span>
                                        </div>



                                        <div class="text-gray-700 fw-semibold fs-6">
                                            9 Dashboard UI/UX Design Review </div>



                                        <div class="text-gray-500 fw-semibold fs-7">
                                            Lead by

                                            <a href="#" class="text-primary opacity-75-hover fw-semibold">Lead by
                                                Bob</a>

                                        </div>

                                    </div>



                                    <a href="#" class="btn btn-sm btn-light" data-bs-toggle="modal" data-bs-target="#kt_modal_create_project">View</a>

                                </div>

                            </div>


                            <div class="tab-pane fade " id="kt_timeline_widget_3_tab_content_7" role="tabpanel">


                                <div class="d-flex align-items-center mb-6">

                                    <span data-kt-element="bullet" class="bullet bullet-vertical d-flex align-items-center min-h-70px mh-100 me-4 bg-warning"></span>



                                    <div class="flex-grow-1 me-5">

                                        <div class="text-gray-800 fw-semibold fs-2">
                                            12:00 - 13:40
                                            <span class="text-gray-500 fw-semibold fs-7">
                                                AM </span>
                                        </div>



                                        <div class="text-gray-700 fw-semibold fs-6">
                                            9 Degree Project Estimation Meeting </div>



                                        <div class="text-gray-500 fw-semibold fs-7">
                                            Lead by

                                            <a href="#" class="text-primary opacity-75-hover fw-semibold">Lead by
                                                Bob</a>

                                        </div>

                                    </div>



                                    <a href="#" class="btn btn-sm btn-light" data-bs-toggle="modal" data-bs-target="#kt_modal_create_project">View</a>

                                </div>



                                <div class="d-flex align-items-center mb-6">

                                    <span data-kt-element="bullet" class="bullet bullet-vertical d-flex align-items-center min-h-70px mh-100 me-4 bg-danger"></span>



                                    <div class="flex-grow-1 me-5">

                                        <div class="text-gray-800 fw-semibold fs-2">
                                            10:20 - 11:00
                                            <span class="text-gray-500 fw-semibold fs-7">
                                                AM </span>
                                        </div>



                                        <div class="text-gray-700 fw-semibold fs-6">
                                            9 Dashboard UI/UX Design Review </div>



                                        <div class="text-gray-500 fw-semibold fs-7">
                                            Lead by

                                            <a href="#" class="text-primary opacity-75-hover fw-semibold">Peter
                                                Marcus</a>

                                        </div>

                                    </div>



                                    <a href="#" class="btn btn-sm btn-light" data-bs-toggle="modal" data-bs-target="#kt_modal_create_project">View</a>

                                </div>



                                <div class="d-flex align-items-center mb-6">

                                    <span data-kt-element="bullet" class="bullet bullet-vertical d-flex align-items-center min-h-70px mh-100 me-4 bg-success"></span>



                                    <div class="flex-grow-1 me-5">

                                        <div class="text-gray-800 fw-semibold fs-2">
                                            16:30 - 17:00
                                            <span class="text-gray-500 fw-semibold fs-7">
                                                PM </span>
                                        </div>



                                        <div class="text-gray-700 fw-semibold fs-6">
                                            Marketing Campaign Discussion </div>



                                        <div class="text-gray-500 fw-semibold fs-7">
                                            Lead by

                                            <a href="#" class="text-primary opacity-75-hover fw-semibold">Lead by Mark
                                                Morris</a>

                                        </div>

                                    </div>



                                    <a href="#" class="btn btn-sm btn-light" data-bs-toggle="modal" data-bs-target="#kt_modal_create_project">View</a>

                                </div>

                            </div>


                            <div class="tab-pane fade " id="kt_timeline_widget_3_tab_content_8" role="tabpanel">


                                <div class="d-flex align-items-center mb-6">

                                    <span data-kt-element="bullet" class="bullet bullet-vertical d-flex align-items-center min-h-70px mh-100 me-4 bg-success"></span>



                                    <div class="flex-grow-1 me-5">

                                        <div class="text-gray-800 fw-semibold fs-2">
                                            16:30 - 17:00
                                            <span class="text-gray-500 fw-semibold fs-7">
                                                PM </span>
                                        </div>



                                        <div class="text-gray-700 fw-semibold fs-6">
                                            Marketing Campaign Discussion </div>



                                        <div class="text-gray-500 fw-semibold fs-7">
                                            Lead by

                                            <a href="#" class="text-primary opacity-75-hover fw-semibold">Peter
                                                Marcus</a>

                                        </div>

                                    </div>



                                    <a href="#" class="btn btn-sm btn-light" data-bs-toggle="modal" data-bs-target="#kt_modal_create_project">View</a>

                                </div>



                                <div class="d-flex align-items-center mb-6">

                                    <span data-kt-element="bullet" class="bullet bullet-vertical d-flex align-items-center min-h-70px mh-100 me-4 bg-info"></span>



                                    <div class="flex-grow-1 me-5">

                                        <div class="text-gray-800 fw-semibold fs-2">
                                            10:20 - 11:00
                                            <span class="text-gray-500 fw-semibold fs-7">
                                                AM </span>
                                        </div>



                                        <div class="text-gray-700 fw-semibold fs-6">
                                            9 Degree Project Estimation Meeting </div>



                                        <div class="text-gray-500 fw-semibold fs-7">
                                            Lead by

                                            <a href="#" class="text-primary opacity-75-hover fw-semibold">Lead by Mark
                                                Morris</a>

                                        </div>

                                    </div>



                                    <a href="#" class="btn btn-sm btn-light" data-bs-toggle="modal" data-bs-target="#kt_modal_create_project">View</a>

                                </div>



                                <div class="d-flex align-items-center mb-6">

                                    <span data-kt-element="bullet" class="bullet bullet-vertical d-flex align-items-center min-h-70px mh-100 me-4 bg-danger"></span>



                                    <div class="flex-grow-1 me-5">

                                        <div class="text-gray-800 fw-semibold fs-2">
                                            12:00 - 13:40
                                            <span class="text-gray-500 fw-semibold fs-7">
                                                AM </span>
                                        </div>



                                        <div class="text-gray-700 fw-semibold fs-6">
                                            9 Dashboard UI/UX Design Review </div>



                                        <div class="text-gray-500 fw-semibold fs-7">
                                            Lead by

                                            <a href="#" class="text-primary opacity-75-hover fw-semibold">Lead by
                                                Bob</a>

                                        </div>

                                    </div>



                                    <a href="#" class="btn btn-sm btn-light" data-bs-toggle="modal" data-bs-target="#kt_modal_create_project">View</a>

                                </div>

                            </div>


                            <div class="tab-pane fade " id="kt_timeline_widget_3_tab_content_9" role="tabpanel">


                                <div class="d-flex align-items-center mb-6">

                                    <span data-kt-element="bullet" class="bullet bullet-vertical d-flex align-items-center min-h-70px mh-100 me-4 bg-info"></span>



                                    <div class="flex-grow-1 me-5">

                                        <div class="text-gray-800 fw-semibold fs-2">
                                            12:00 - 13:40
                                            <span class="text-gray-500 fw-semibold fs-7">
                                                AM </span>
                                        </div>



                                        <div class="text-gray-700 fw-semibold fs-6">
                                            9 Degree Project Estimation Meeting </div>



                                        <div class="text-gray-500 fw-semibold fs-7">
                                            Lead by

                                            <a href="#" class="text-primary opacity-75-hover fw-semibold">Lead by
                                                Bob</a>

                                        </div>

                                    </div>



                                    <a href="#" class="btn btn-sm btn-light" data-bs-toggle="modal" data-bs-target="#kt_modal_create_project">View</a>

                                </div>



                                <div class="d-flex align-items-center mb-6">

                                    <span data-kt-element="bullet" class="bullet bullet-vertical d-flex align-items-center min-h-70px mh-100 me-4 bg-primary"></span>



                                    <div class="flex-grow-1 me-5">

                                        <div class="text-gray-800 fw-semibold fs-2">
                                            16:30 - 17:00
                                            <span class="text-gray-500 fw-semibold fs-7">
                                                PM </span>
                                        </div>



                                        <div class="text-gray-700 fw-semibold fs-6">
                                            Marketing Campaign Discussion </div>



                                        <div class="text-gray-500 fw-semibold fs-7">
                                            Lead by

                                            <a href="#" class="text-primary opacity-75-hover fw-semibold">Lead by Mark
                                                Morris</a>

                                        </div>

                                    </div>



                                    <a href="#" class="btn btn-sm btn-light" data-bs-toggle="modal" data-bs-target="#kt_modal_create_project">View</a>

                                </div>



                                <div class="d-flex align-items-center mb-6">

                                    <span data-kt-element="bullet" class="bullet bullet-vertical d-flex align-items-center min-h-70px mh-100 me-4 bg-success"></span>



                                    <div class="flex-grow-1 me-5">

                                        <div class="text-gray-800 fw-semibold fs-2">
                                            10:20 - 11:00
                                            <span class="text-gray-500 fw-semibold fs-7">
                                                AM </span>
                                        </div>



                                        <div class="text-gray-700 fw-semibold fs-6">
                                            9 Dashboard UI/UX Design Review </div>



                                        <div class="text-gray-500 fw-semibold fs-7">
                                            Lead by

                                            <a href="#" class="text-primary opacity-75-hover fw-semibold">Peter
                                                Marcus</a>

                                        </div>

                                    </div>



                                    <a href="#" class="btn btn-sm btn-light" data-bs-toggle="modal" data-bs-target="#kt_modal_create_project">View</a>

                                </div>

                            </div>


                            <div class="tab-pane fade " id="kt_timeline_widget_3_tab_content_10" role="tabpanel">


                                <div class="d-flex align-items-center mb-6">

                                    <span data-kt-element="bullet" class="bullet bullet-vertical d-flex align-items-center min-h-70px mh-100 me-4 bg-danger"></span>



                                    <div class="flex-grow-1 me-5">

                                        <div class="text-gray-800 fw-semibold fs-2">
                                            12:00 - 13:40
                                            <span class="text-gray-500 fw-semibold fs-7">
                                                AM </span>
                                        </div>



                                        <div class="text-gray-700 fw-semibold fs-6">
                                            Marketing Campaign Discussion </div>



                                        <div class="text-gray-500 fw-semibold fs-7">
                                            Lead by

                                            <a href="#" class="text-primary opacity-75-hover fw-semibold">Peter
                                                Marcus</a>

                                        </div>

                                    </div>



                                    <a href="#" class="btn btn-sm btn-light" data-bs-toggle="modal" data-bs-target="#kt_modal_create_project">View</a>

                                </div>



                                <div class="d-flex align-items-center mb-6">

                                    <span data-kt-element="bullet" class="bullet bullet-vertical d-flex align-items-center min-h-70px mh-100 me-4 bg-warning"></span>



                                    <div class="flex-grow-1 me-5">

                                        <div class="text-gray-800 fw-semibold fs-2">
                                            10:20 - 11:00
                                            <span class="text-gray-500 fw-semibold fs-7">
                                                AM </span>
                                        </div>



                                        <div class="text-gray-700 fw-semibold fs-6">
                                            9 Dashboard UI/UX Design Review </div>



                                        <div class="text-gray-500 fw-semibold fs-7">
                                            Lead by

                                            <a href="#" class="text-primary opacity-75-hover fw-semibold">Lead by
                                                Bob</a>

                                        </div>

                                    </div>



                                    <a href="#" class="btn btn-sm btn-light" data-bs-toggle="modal" data-bs-target="#kt_modal_create_project">View</a>

                                </div>



                                <div class="d-flex align-items-center mb-6">

                                    <span data-kt-element="bullet" class="bullet bullet-vertical d-flex align-items-center min-h-70px mh-100 me-4 bg-info"></span>



                                    <div class="flex-grow-1 me-5">

                                        <div class="text-gray-800 fw-semibold fs-2">
                                            16:30 - 17:00
                                            <span class="text-gray-500 fw-semibold fs-7">
                                                PM </span>
                                        </div>



                                        <div class="text-gray-700 fw-semibold fs-6">
                                            9 Degree Project Estimation Meeting </div>



                                        <div class="text-gray-500 fw-semibold fs-7">
                                            Lead by

                                            <a href="#" class="text-primary opacity-75-hover fw-semibold">Lead by Mark
                                                Morris</a>

                                        </div>

                                    </div>



                                    <a href="#" class="btn btn-sm btn-light" data-bs-toggle="modal" data-bs-target="#kt_modal_create_project">View</a>

                                </div>

                            </div>


                            <div class="tab-pane fade " id="kt_timeline_widget_3_tab_content_11" role="tabpanel">


                                <div class="d-flex align-items-center mb-6">

                                    <span data-kt-element="bullet" class="bullet bullet-vertical d-flex align-items-center min-h-70px mh-100 me-4 bg-info"></span>



                                    <div class="flex-grow-1 me-5">

                                        <div class="text-gray-800 fw-semibold fs-2">
                                            16:30 - 17:00
                                            <span class="text-gray-500 fw-semibold fs-7">
                                                PM </span>
                                        </div>



                                        <div class="text-gray-700 fw-semibold fs-6">
                                            9 Dashboard UI/UX Design Review </div>



                                        <div class="text-gray-500 fw-semibold fs-7">
                                            Lead by

                                            <a href="#" class="text-primary opacity-75-hover fw-semibold">Lead by Mark
                                                Morris</a>

                                        </div>

                                    </div>



                                    <a href="#" class="btn btn-sm btn-light" data-bs-toggle="modal" data-bs-target="#kt_modal_create_project">View</a>

                                </div>



                                <div class="d-flex align-items-center mb-6">

                                    <span data-kt-element="bullet" class="bullet bullet-vertical d-flex align-items-center min-h-70px mh-100 me-4 bg-danger"></span>



                                    <div class="flex-grow-1 me-5">

                                        <div class="text-gray-800 fw-semibold fs-2">
                                            10:20 - 11:00
                                            <span class="text-gray-500 fw-semibold fs-7">
                                                AM </span>
                                        </div>



                                        <div class="text-gray-700 fw-semibold fs-6">
                                            Marketing Campaign Discussion </div>



                                        <div class="text-gray-500 fw-semibold fs-7">
                                            Lead by

                                            <a href="#" class="text-primary opacity-75-hover fw-semibold">Peter
                                                Marcus</a>

                                        </div>

                                    </div>



                                    <a href="#" class="btn btn-sm btn-light" data-bs-toggle="modal" data-bs-target="#kt_modal_create_project">View</a>

                                </div>



                                <div class="d-flex align-items-center mb-6">

                                    <span data-kt-element="bullet" class="bullet bullet-vertical d-flex align-items-center min-h-70px mh-100 me-4 bg-primary"></span>



                                    <div class="flex-grow-1 me-5">

                                        <div class="text-gray-800 fw-semibold fs-2">
                                            12:00 - 13:40
                                            <span class="text-gray-500 fw-semibold fs-7">
                                                AM </span>
                                        </div>



                                        <div class="text-gray-700 fw-semibold fs-6">
                                            9 Degree Project Estimation Meeting </div>



                                        <div class="text-gray-500 fw-semibold fs-7">
                                            Lead by

                                            <a href="#" class="text-primary opacity-75-hover fw-semibold">Lead by
                                                Bob</a>

                                        </div>

                                    </div>



                                    <a href="#" class="btn btn-sm btn-light" data-bs-toggle="modal" data-bs-target="#kt_modal_create_project">View</a>

                                </div>

                            </div>


                        </div>



                        <div class="float-end d-none">
                            <a href="#" class="btn btn-sm btn-light me-2" data-bs-toggle="modal" data-bs-target="#kt_modal_create_project">Add Lesson</a>

                            <a href="#" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#kt_modal_create_app">Call Sick for Today</a>
                        </div>

                    </div>

                </div>



                <div class="card card-flush d-none h-md-100">

                    <div class="card-header mt-6">

                        <div class="card-title flex-column">
                            <h3 class="fw-bold mb-1">What's on the road?</h3>

                            <div class="fs-6 text-gray-500">Total 482 participants</div>
                        </div>



                        <div class="card-toolbar">

                            <select name="status" data-control="select2" data-hide-search="true" class="form-select form-select-solid form-select-sm fw-bold w-100px select2-hidden-accessible" data-select2-id="select2-data-7-aj2h" tabindex="-1" aria-hidden="true" data-kt-initialized="1">
                                <option value="1" selected="" data-select2-id="select2-data-9-6cfh">Options</option>
                                <option value="2">Option 1</option>
                                <option value="3">Option 2</option>
                                <option value="4">Option 3</option>
                            </select><span class="select2 select2-container select2-container--bootstrap5" dir="ltr" data-select2-id="select2-data-8-t1i0" style="width: 100%;"><span class="selection"><span class="select2-selection select2-selection--single form-select form-select-solid form-select-sm fw-bold w-100px" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="0" aria-disabled="false" aria-labelledby="select2-status-68-container" aria-controls="select2-status-68-container"><span class="select2-selection__rendered" id="select2-status-68-container" role="textbox" aria-readonly="true" title="Options">Options</span><span class="select2-selection__arrow" role="presentation"><b role="presentation"></b></span></span></span><span class="dropdown-wrapper" aria-hidden="true"></span></span>

                        </div>

                    </div>



                    <div class="card-body p-0">

                        <ul class="nav nav-pills d-flex flex-nowrap hover-scroll-x py-2 ms-4" role="tablist">


                            <li class="nav-item me-1" role="presentation">
                                <a class="nav-link btn d-flex flex-column flex-center rounded-pill min-w-45px me-2 py-4 px-3 btn-color-active-white btn-active-danger " data-bs-toggle="tab" href="#kt_schedule_day_0" aria-selected="false" tabindex="-1" role="tab">

                                    <span class="text-gray-500 fs-7 fw-semibold">Sex</span>
                                    <span class="fs-6 text-gray-800 fw-bold">20</span>
                                </a>
                            </li>



                            <li class="nav-item me-1" role="presentation">
                                <a class="nav-link btn d-flex flex-column flex-center rounded-pill min-w-45px me-2 py-4 px-3 btn-color-active-white btn-active-danger " data-bs-toggle="tab" href="#kt_schedule_day_1" aria-selected="false" tabindex="-1" role="tab">

                                    <span class="text-gray-500 fs-7 fw-semibold">Sáb</span>
                                    <span class="fs-6 text-gray-800 fw-bold">21</span>
                                </a>
                            </li>



                            <li class="nav-item me-1" role="presentation">
                                <a class="nav-link btn d-flex flex-column flex-center rounded-pill min-w-45px me-2 py-4 px-3 btn-color-active-white btn-active-danger " data-bs-toggle="tab" href="#kt_schedule_day_2" aria-selected="false" tabindex="-1" role="tab">

                                    <span class="text-gray-500 fs-7 fw-semibold">Dom</span>
                                    <span class="fs-6 text-gray-800 fw-bold">22</span>
                                </a>
                            </li>



                            <li class="nav-item me-1" role="presentation">
                                <a class="nav-link btn d-flex flex-column flex-center rounded-pill min-w-45px me-2 py-4 px-3 btn-color-active-white btn-active-danger active" data-bs-toggle="tab" href="#kt_schedule_day_3" aria-selected="true" role="tab">

                                    <span class="text-gray-500 fs-7 fw-semibold">Seg</span>
                                    <span class="fs-6 text-gray-800 fw-bold">23</span>
                                </a>
                            </li>



                            <li class="nav-item me-1" role="presentation">
                                <a class="nav-link btn d-flex flex-column flex-center rounded-pill min-w-45px me-2 py-4 px-3 btn-color-active-white btn-active-danger " data-bs-toggle="tab" href="#kt_schedule_day_4" aria-selected="false" tabindex="-1" role="tab">

                                    <span class="text-gray-500 fs-7 fw-semibold">Ter</span>
                                    <span class="fs-6 text-gray-800 fw-bold">24</span>
                                </a>
                            </li>



                            <li class="nav-item me-1" role="presentation">
                                <a class="nav-link btn d-flex flex-column flex-center rounded-pill min-w-45px me-2 py-4 px-3 btn-color-active-white btn-active-danger " data-bs-toggle="tab" href="#kt_schedule_day_5" aria-selected="false" tabindex="-1" role="tab">

                                    <span class="text-gray-500 fs-7 fw-semibold">Qua</span>
                                    <span class="fs-6 text-gray-800 fw-bold">25</span>
                                </a>
                            </li>



                            <li class="nav-item me-1" role="presentation">
                                <a class="nav-link btn d-flex flex-column flex-center rounded-pill min-w-45px me-2 py-4 px-3 btn-color-active-white btn-active-danger " data-bs-toggle="tab" href="#kt_schedule_day_6" aria-selected="false" tabindex="-1" role="tab">

                                    <span class="text-gray-500 fs-7 fw-semibold">Th</span>
                                    <span class="fs-6 text-gray-800 fw-bold">26</span>
                                </a>
                            </li>



                            <li class="nav-item me-1" role="presentation">
                                <a class="nav-link btn d-flex flex-column flex-center rounded-pill min-w-45px me-2 py-4 px-3 btn-color-active-white btn-active-danger " data-bs-toggle="tab" href="#kt_schedule_day_7" aria-selected="false" tabindex="-1" role="tab">

                                    <span class="text-gray-500 fs-7 fw-semibold">Sex</span>
                                    <span class="fs-6 text-gray-800 fw-bold">27</span>
                                </a>
                            </li>



                            <li class="nav-item me-1" role="presentation">
                                <a class="nav-link btn d-flex flex-column flex-center rounded-pill min-w-45px me-2 py-4 px-3 btn-color-active-white btn-active-danger " data-bs-toggle="tab" href="#kt_schedule_day_8" aria-selected="false" tabindex="-1" role="tab">

                                    <span class="text-gray-500 fs-7 fw-semibold">Sáb</span>
                                    <span class="fs-6 text-gray-800 fw-bold">28</span>
                                </a>
                            </li>



                            <li class="nav-item me-1" role="presentation">
                                <a class="nav-link btn d-flex flex-column flex-center rounded-pill min-w-45px me-2 py-4 px-3 btn-color-active-white btn-active-danger " data-bs-toggle="tab" href="#kt_schedule_day_9" aria-selected="false" tabindex="-1" role="tab">

                                    <span class="text-gray-500 fs-7 fw-semibold">Dom</span>
                                    <span class="fs-6 text-gray-800 fw-bold">29</span>
                                </a>
                            </li>



                            <li class="nav-item me-1" role="presentation">
                                <a class="nav-link btn d-flex flex-column flex-center rounded-pill min-w-45px me-2 py-4 px-3 btn-color-active-white btn-active-danger " data-bs-toggle="tab" href="#kt_schedule_day_10" aria-selected="false" tabindex="-1" role="tab">

                                    <span class="text-gray-500 fs-7 fw-semibold">Seg</span>
                                    <span class="fs-6 text-gray-800 fw-bold">30</span>
                                </a>
                            </li>



                            <li class="nav-item me-1" role="presentation">
                                <a class="nav-link btn d-flex flex-column flex-center rounded-pill min-w-45px me-2 py-4 px-3 btn-color-active-white btn-active-danger " data-bs-toggle="tab" href="#kt_schedule_day_11" aria-selected="false" tabindex="-1" role="tab">

                                    <span class="text-gray-500 fs-7 fw-semibold">Ter</span>
                                    <span class="fs-6 text-gray-800 fw-bold">31</span>
                                </a>
                            </li>

                        </ul>



                        <div class="tab-content px-9">

                            <div id="kt_schedule_day_0" class="tab-pane fade show " role="tabpanel">

                                <div class="d-flex flex-stack position-relative mt-8">

                                    <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>



                                    <div class="fw-semibold ms-5 text-gray-600">

                                        <div class="fs-5">
                                            13:00 - 14:00

                                            <span class="fs-7 text-gray-500 text-uppercase">
                                                pm </span>
                                        </div>



                                        <a href="#" class="fs-5 fw-bold text-gray-800 text-hover-primary mb-2">
                                            Team Backlog Grooming Session </a>



                                        <div class="text-gray-500">
                                            Lead by <a href="#">Yannis Gloverson</a>
                                        </div>

                                    </div>



                                    <a href="#" class="btn btn-bg-light btn-active-color-primary btn-sm">View</a>

                                </div>


                                <div class="d-flex flex-stack position-relative mt-8">

                                    <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>



                                    <div class="fw-semibold ms-5 text-gray-600">

                                        <div class="fs-5">
                                            9:00 - 10:00

                                            <span class="fs-7 text-gray-500 text-uppercase">
                                                am </span>
                                        </div>



                                        <a href="#" class="fs-5 fw-bold text-gray-800 text-hover-primary mb-2">
                                            Marketing Campaign Discussion </a>



                                        <div class="text-gray-500">
                                            Lead by <a href="#">Mark Randall</a>
                                        </div>

                                    </div>



                                    <a href="#" class="btn btn-bg-light btn-active-color-primary btn-sm">View</a>

                                </div>


                                <div class="d-flex flex-stack position-relative mt-8">

                                    <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>



                                    <div class="fw-semibold ms-5 text-gray-600">

                                        <div class="fs-5">
                                            16:30 - 17:30

                                            <span class="fs-7 text-gray-500 text-uppercase">
                                                pm </span>
                                        </div>



                                        <a href="#" class="fs-5 fw-bold text-gray-800 text-hover-primary mb-2">
                                            Sales Pitch Proposal </a>



                                        <div class="text-gray-500">
                                            Lead by <a href="#">Terry Robins</a>
                                        </div>

                                    </div>



                                    <a href="#" class="btn btn-bg-light btn-active-color-primary btn-sm">View</a>

                                </div>

                            </div>


                            <div id="kt_schedule_day_1" class="tab-pane fade show active" role="tabpanel">

                                <div class="d-flex flex-stack position-relative mt-8">

                                    <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>



                                    <div class="fw-semibold ms-5 text-gray-600">

                                        <div class="fs-5">
                                            10:00 - 11:00

                                            <span class="fs-7 text-gray-500 text-uppercase">
                                                am </span>
                                        </div>



                                        <a href="#" class="fs-5 fw-bold text-gray-800 text-hover-primary mb-2">
                                            Marketing Campaign Discussion </a>



                                        <div class="text-gray-500">
                                            Lead by <a href="#">David Stevenson</a>
                                        </div>

                                    </div>



                                    <a href="#" class="btn btn-bg-light btn-active-color-primary btn-sm">View</a>

                                </div>


                                <div class="d-flex flex-stack position-relative mt-8">

                                    <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>



                                    <div class="fw-semibold ms-5 text-gray-600">

                                        <div class="fs-5">
                                            13:00 - 14:00

                                            <span class="fs-7 text-gray-500 text-uppercase">
                                                pm </span>
                                        </div>



                                        <a href="#" class="fs-5 fw-bold text-gray-800 text-hover-primary mb-2">
                                            Creative Content Initiative </a>



                                        <div class="text-gray-500">
                                            Lead by <a href="#">Terry Robins</a>
                                        </div>

                                    </div>



                                    <a href="#" class="btn btn-bg-light btn-active-color-primary btn-sm">View</a>

                                </div>


                                <div class="d-flex flex-stack position-relative mt-8">

                                    <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>



                                    <div class="fw-semibold ms-5 text-gray-600">

                                        <div class="fs-5">
                                            10:00 - 11:00

                                            <span class="fs-7 text-gray-500 text-uppercase">
                                                am </span>
                                        </div>



                                        <a href="#" class="fs-5 fw-bold text-gray-800 text-hover-primary mb-2">
                                            Project Review &amp; Testing </a>



                                        <div class="text-gray-500">
                                            Lead by <a href="#">David Stevenson</a>
                                        </div>

                                    </div>



                                    <a href="#" class="btn btn-bg-light btn-active-color-primary btn-sm">View</a>

                                </div>

                            </div>


                            <div id="kt_schedule_day_2" class="tab-pane fade show " role="tabpanel">

                                <div class="d-flex flex-stack position-relative mt-8">

                                    <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>



                                    <div class="fw-semibold ms-5 text-gray-600">

                                        <div class="fs-5">
                                            12:00 - 13:00

                                            <span class="fs-7 text-gray-500 text-uppercase">
                                                pm </span>
                                        </div>



                                        <a href="#" class="fs-5 fw-bold text-gray-800 text-hover-primary mb-2">
                                            Lunch &amp; Learn Catch Up </a>



                                        <div class="text-gray-500">
                                            Lead by <a href="#">Mark Randall</a>
                                        </div>

                                    </div>



                                    <a href="#" class="btn btn-bg-light btn-active-color-primary btn-sm">View</a>

                                </div>


                                <div class="d-flex flex-stack position-relative mt-8">

                                    <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>



                                    <div class="fw-semibold ms-5 text-gray-600">

                                        <div class="fs-5">
                                            14:30 - 15:30

                                            <span class="fs-7 text-gray-500 text-uppercase">
                                                pm </span>
                                        </div>



                                        <a href="#" class="fs-5 fw-bold text-gray-800 text-hover-primary mb-2">
                                            Committee Review Approvals </a>



                                        <div class="text-gray-500">
                                            Lead by <a href="#">Mark Randall</a>
                                        </div>

                                    </div>



                                    <a href="#" class="btn btn-bg-light btn-active-color-primary btn-sm">View</a>

                                </div>


                                <div class="d-flex flex-stack position-relative mt-8">

                                    <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>



                                    <div class="fw-semibold ms-5 text-gray-600">

                                        <div class="fs-5">
                                            13:00 - 14:00

                                            <span class="fs-7 text-gray-500 text-uppercase">
                                                pm </span>
                                        </div>



                                        <a href="#" class="fs-5 fw-bold text-gray-800 text-hover-primary mb-2">
                                            Dashboard UI/UX Design Review </a>



                                        <div class="text-gray-500">
                                            Lead by <a href="#">Michael Walters</a>
                                        </div>

                                    </div>



                                    <a href="#" class="btn btn-bg-light btn-active-color-primary btn-sm">View</a>

                                </div>

                            </div>


                            <div id="kt_schedule_day_3" class="tab-pane fade show " role="tabpanel">

                                <div class="d-flex flex-stack position-relative mt-8">

                                    <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>



                                    <div class="fw-semibold ms-5 text-gray-600">

                                        <div class="fs-5">
                                            11:00 - 11:45

                                            <span class="fs-7 text-gray-500 text-uppercase">
                                                am </span>
                                        </div>



                                        <a href="#" class="fs-5 fw-bold text-gray-800 text-hover-primary mb-2">
                                            Sales Pitch Proposal </a>



                                        <div class="text-gray-500">
                                            Lead by <a href="#">Bob Harris</a>
                                        </div>

                                    </div>



                                    <a href="#" class="btn btn-bg-light btn-active-color-primary btn-sm">View</a>

                                </div>


                                <div class="d-flex flex-stack position-relative mt-8">

                                    <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>



                                    <div class="fw-semibold ms-5 text-gray-600">

                                        <div class="fs-5">
                                            12:00 - 13:00

                                            <span class="fs-7 text-gray-500 text-uppercase">
                                                pm </span>
                                        </div>



                                        <a href="#" class="fs-5 fw-bold text-gray-800 text-hover-primary mb-2">
                                            Development Team Capacity Review </a>



                                        <div class="text-gray-500">
                                            Lead by <a href="#">Karina Clarke</a>
                                        </div>

                                    </div>



                                    <a href="#" class="btn btn-bg-light btn-active-color-primary btn-sm">View</a>

                                </div>


                                <div class="d-flex flex-stack position-relative mt-8">

                                    <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>



                                    <div class="fw-semibold ms-5 text-gray-600">

                                        <div class="fs-5">
                                            11:00 - 11:45

                                            <span class="fs-7 text-gray-500 text-uppercase">
                                                am </span>
                                        </div>



                                        <a href="#" class="fs-5 fw-bold text-gray-800 text-hover-primary mb-2">
                                            Marketing Campaign Discussion </a>



                                        <div class="text-gray-500">
                                            Lead by <a href="#">Caleb Donaldson</a>
                                        </div>

                                    </div>



                                    <a href="#" class="btn btn-bg-light btn-active-color-primary btn-sm">View</a>

                                </div>

                            </div>


                            <div id="kt_schedule_day_4" class="tab-pane fade show " role="tabpanel">

                                <div class="d-flex flex-stack position-relative mt-8">

                                    <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>



                                    <div class="fw-semibold ms-5 text-gray-600">

                                        <div class="fs-5">
                                            12:00 - 13:00

                                            <span class="fs-7 text-gray-500 text-uppercase">
                                                pm </span>
                                        </div>



                                        <a href="#" class="fs-5 fw-bold text-gray-800 text-hover-primary mb-2">
                                            Creative Content Initiative </a>



                                        <div class="text-gray-500">
                                            Lead by <a href="#">Naomi Hayabusa</a>
                                        </div>

                                    </div>



                                    <a href="#" class="btn btn-bg-light btn-active-color-primary btn-sm">View</a>

                                </div>


                                <div class="d-flex flex-stack position-relative mt-8">

                                    <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>



                                    <div class="fw-semibold ms-5 text-gray-600">

                                        <div class="fs-5">
                                            16:30 - 17:30

                                            <span class="fs-7 text-gray-500 text-uppercase">
                                                pm </span>
                                        </div>



                                        <a href="#" class="fs-5 fw-bold text-gray-800 text-hover-primary mb-2">
                                            Team Backlog Grooming Session </a>



                                        <div class="text-gray-500">
                                            Lead by <a href="#">Yannis Gloverson</a>
                                        </div>

                                    </div>



                                    <a href="#" class="btn btn-bg-light btn-active-color-primary btn-sm">View</a>

                                </div>


                                <div class="d-flex flex-stack position-relative mt-8">

                                    <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>



                                    <div class="fw-semibold ms-5 text-gray-600">

                                        <div class="fs-5">
                                            14:30 - 15:30

                                            <span class="fs-7 text-gray-500 text-uppercase">
                                                pm </span>
                                        </div>



                                        <a href="#" class="fs-5 fw-bold text-gray-800 text-hover-primary mb-2">
                                            Project Review &amp; Testing </a>



                                        <div class="text-gray-500">
                                            Lead by <a href="#">Caleb Donaldson</a>
                                        </div>

                                    </div>



                                    <a href="#" class="btn btn-bg-light btn-active-color-primary btn-sm">View</a>

                                </div>

                            </div>


                            <div id="kt_schedule_day_5" class="tab-pane fade show " role="tabpanel">

                                <div class="d-flex flex-stack position-relative mt-8">

                                    <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>



                                    <div class="fw-semibold ms-5 text-gray-600">

                                        <div class="fs-5">
                                            16:30 - 17:30

                                            <span class="fs-7 text-gray-500 text-uppercase">
                                                pm </span>
                                        </div>



                                        <a href="#" class="fs-5 fw-bold text-gray-800 text-hover-primary mb-2">
                                            Marketing Campaign Discussion </a>



                                        <div class="text-gray-500">
                                            Lead by <a href="#">Peter Marcus</a>
                                        </div>

                                    </div>



                                    <a href="#" class="btn btn-bg-light btn-active-color-primary btn-sm">View</a>

                                </div>


                                <div class="d-flex flex-stack position-relative mt-8">

                                    <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>



                                    <div class="fw-semibold ms-5 text-gray-600">

                                        <div class="fs-5">
                                            9:00 - 10:00

                                            <span class="fs-7 text-gray-500 text-uppercase">
                                                am </span>
                                        </div>



                                        <a href="#" class="fs-5 fw-bold text-gray-800 text-hover-primary mb-2">
                                            Creative Content Initiative </a>



                                        <div class="text-gray-500">
                                            Lead by <a href="#">Walter White</a>
                                        </div>

                                    </div>



                                    <a href="#" class="btn btn-bg-light btn-active-color-primary btn-sm">View</a>

                                </div>


                                <div class="d-flex flex-stack position-relative mt-8">

                                    <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>



                                    <div class="fw-semibold ms-5 text-gray-600">

                                        <div class="fs-5">
                                            12:00 - 13:00

                                            <span class="fs-7 text-gray-500 text-uppercase">
                                                pm </span>
                                        </div>



                                        <a href="#" class="fs-5 fw-bold text-gray-800 text-hover-primary mb-2">
                                            Marketing Campaign Discussion </a>



                                        <div class="text-gray-500">
                                            Lead by <a href="#">Sean Bean</a>
                                        </div>

                                    </div>



                                    <a href="#" class="btn btn-bg-light btn-active-color-primary btn-sm">View</a>

                                </div>

                            </div>


                            <div id="kt_schedule_day_6" class="tab-pane fade show " role="tabpanel">

                                <div class="d-flex flex-stack position-relative mt-8">

                                    <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>



                                    <div class="fw-semibold ms-5 text-gray-600">

                                        <div class="fs-5">
                                            14:30 - 15:30

                                            <span class="fs-7 text-gray-500 text-uppercase">
                                                pm </span>
                                        </div>



                                        <a href="#" class="fs-5 fw-bold text-gray-800 text-hover-primary mb-2">
                                            Dashboard UI/UX Design Review </a>



                                        <div class="text-gray-500">
                                            Lead by <a href="#">Kendell Trevor</a>
                                        </div>

                                    </div>



                                    <a href="#" class="btn btn-bg-light btn-active-color-primary btn-sm">View</a>

                                </div>


                                <div class="d-flex flex-stack position-relative mt-8">

                                    <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>



                                    <div class="fw-semibold ms-5 text-gray-600">

                                        <div class="fs-5">
                                            12:00 - 13:00

                                            <span class="fs-7 text-gray-500 text-uppercase">
                                                pm </span>
                                        </div>



                                        <a href="#" class="fs-5 fw-bold text-gray-800 text-hover-primary mb-2">
                                            Creative Content Initiative </a>



                                        <div class="text-gray-500">
                                            Lead by <a href="#">Bob Harris</a>
                                        </div>

                                    </div>



                                    <a href="#" class="btn btn-bg-light btn-active-color-primary btn-sm">View</a>

                                </div>


                                <div class="d-flex flex-stack position-relative mt-8">

                                    <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>



                                    <div class="fw-semibold ms-5 text-gray-600">

                                        <div class="fs-5">
                                            13:00 - 14:00

                                            <span class="fs-7 text-gray-500 text-uppercase">
                                                pm </span>
                                        </div>



                                        <a href="#" class="fs-5 fw-bold text-gray-800 text-hover-primary mb-2">
                                            Development Team Capacity Review </a>



                                        <div class="text-gray-500">
                                            Lead by <a href="#">David Stevenson</a>
                                        </div>

                                    </div>



                                    <a href="#" class="btn btn-bg-light btn-active-color-primary btn-sm">View</a>

                                </div>

                            </div>


                            <div id="kt_schedule_day_7" class="tab-pane fade show " role="tabpanel">

                                <div class="d-flex flex-stack position-relative mt-8">

                                    <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>



                                    <div class="fw-semibold ms-5 text-gray-600">

                                        <div class="fs-5">
                                            16:30 - 17:30

                                            <span class="fs-7 text-gray-500 text-uppercase">
                                                pm </span>
                                        </div>



                                        <a href="#" class="fs-5 fw-bold text-gray-800 text-hover-primary mb-2">
                                            Marketing Campaign Discussion </a>



                                        <div class="text-gray-500">
                                            Lead by <a href="#">Michael Walters</a>
                                        </div>

                                    </div>



                                    <a href="#" class="btn btn-bg-light btn-active-color-primary btn-sm">View</a>

                                </div>


                                <div class="d-flex flex-stack position-relative mt-8">

                                    <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>



                                    <div class="fw-semibold ms-5 text-gray-600">

                                        <div class="fs-5">
                                            12:00 - 13:00

                                            <span class="fs-7 text-gray-500 text-uppercase">
                                                pm </span>
                                        </div>



                                        <a href="#" class="fs-5 fw-bold text-gray-800 text-hover-primary mb-2">
                                            Project Review &amp; Testing </a>



                                        <div class="text-gray-500">
                                            Lead by <a href="#">Yannis Gloverson</a>
                                        </div>

                                    </div>



                                    <a href="#" class="btn btn-bg-light btn-active-color-primary btn-sm">View</a>

                                </div>


                                <div class="d-flex flex-stack position-relative mt-8">

                                    <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>



                                    <div class="fw-semibold ms-5 text-gray-600">

                                        <div class="fs-5">
                                            11:00 - 11:45

                                            <span class="fs-7 text-gray-500 text-uppercase">
                                                am </span>
                                        </div>



                                        <a href="#" class="fs-5 fw-bold text-gray-800 text-hover-primary mb-2">
                                            Team Backlog Grooming Session </a>



                                        <div class="text-gray-500">
                                            Lead by <a href="#">Bob Harris</a>
                                        </div>

                                    </div>



                                    <a href="#" class="btn btn-bg-light btn-active-color-primary btn-sm">View</a>

                                </div>

                            </div>


                            <div id="kt_schedule_day_8" class="tab-pane fade show " role="tabpanel">

                                <div class="d-flex flex-stack position-relative mt-8">

                                    <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>



                                    <div class="fw-semibold ms-5 text-gray-600">

                                        <div class="fs-5">
                                            10:00 - 11:00

                                            <span class="fs-7 text-gray-500 text-uppercase">
                                                am </span>
                                        </div>



                                        <a href="#" class="fs-5 fw-bold text-gray-800 text-hover-primary mb-2">
                                            Creative Content Initiative </a>



                                        <div class="text-gray-500">
                                            Lead by <a href="#">Yannis Gloverson</a>
                                        </div>

                                    </div>



                                    <a href="#" class="btn btn-bg-light btn-active-color-primary btn-sm">View</a>

                                </div>


                                <div class="d-flex flex-stack position-relative mt-8">

                                    <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>



                                    <div class="fw-semibold ms-5 text-gray-600">

                                        <div class="fs-5">
                                            11:00 - 11:45

                                            <span class="fs-7 text-gray-500 text-uppercase">
                                                am </span>
                                        </div>



                                        <a href="#" class="fs-5 fw-bold text-gray-800 text-hover-primary mb-2">
                                            9 Degree Project Estimation Meeting </a>



                                        <div class="text-gray-500">
                                            Lead by <a href="#">Caleb Donaldson</a>
                                        </div>

                                    </div>



                                    <a href="#" class="btn btn-bg-light btn-active-color-primary btn-sm">View</a>

                                </div>


                                <div class="d-flex flex-stack position-relative mt-8">

                                    <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>



                                    <div class="fw-semibold ms-5 text-gray-600">

                                        <div class="fs-5">
                                            14:30 - 15:30

                                            <span class="fs-7 text-gray-500 text-uppercase">
                                                pm </span>
                                        </div>



                                        <a href="#" class="fs-5 fw-bold text-gray-800 text-hover-primary mb-2">
                                            Sales Pitch Proposal </a>



                                        <div class="text-gray-500">
                                            Lead by <a href="#">Caleb Donaldson</a>
                                        </div>

                                    </div>



                                    <a href="#" class="btn btn-bg-light btn-active-color-primary btn-sm">View</a>

                                </div>

                            </div>


                            <div id="kt_schedule_day_9" class="tab-pane fade show " role="tabpanel">

                                <div class="d-flex flex-stack position-relative mt-8">

                                    <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>



                                    <div class="fw-semibold ms-5 text-gray-600">

                                        <div class="fs-5">
                                            12:00 - 13:00

                                            <span class="fs-7 text-gray-500 text-uppercase">
                                                pm </span>
                                        </div>



                                        <a href="#" class="fs-5 fw-bold text-gray-800 text-hover-primary mb-2">
                                            Development Team Capacity Review </a>



                                        <div class="text-gray-500">
                                            Lead by <a href="#">Bob Harris</a>
                                        </div>

                                    </div>



                                    <a href="#" class="btn btn-bg-light btn-active-color-primary btn-sm">View</a>

                                </div>


                                <div class="d-flex flex-stack position-relative mt-8">

                                    <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>



                                    <div class="fw-semibold ms-5 text-gray-600">

                                        <div class="fs-5">
                                            9:00 - 10:00

                                            <span class="fs-7 text-gray-500 text-uppercase">
                                                am </span>
                                        </div>



                                        <a href="#" class="fs-5 fw-bold text-gray-800 text-hover-primary mb-2">
                                            Marketing Campaign Discussion </a>



                                        <div class="text-gray-500">
                                            Lead by <a href="#">Caleb Donaldson</a>
                                        </div>

                                    </div>



                                    <a href="#" class="btn btn-bg-light btn-active-color-primary btn-sm">View</a>

                                </div>


                                <div class="d-flex flex-stack position-relative mt-8">

                                    <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>



                                    <div class="fw-semibold ms-5 text-gray-600">

                                        <div class="fs-5">
                                            13:00 - 14:00

                                            <span class="fs-7 text-gray-500 text-uppercase">
                                                pm </span>
                                        </div>



                                        <a href="#" class="fs-5 fw-bold text-gray-800 text-hover-primary mb-2">
                                            Marketing Campaign Discussion </a>



                                        <div class="text-gray-500">
                                            Lead by <a href="#">Bob Harris</a>
                                        </div>

                                    </div>



                                    <a href="#" class="btn btn-bg-light btn-active-color-primary btn-sm">View</a>

                                </div>

                            </div>


                            <div id="kt_schedule_day_10" class="tab-pane fade show " role="tabpanel">

                                <div class="d-flex flex-stack position-relative mt-8">

                                    <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>



                                    <div class="fw-semibold ms-5 text-gray-600">

                                        <div class="fs-5">
                                            10:00 - 11:00

                                            <span class="fs-7 text-gray-500 text-uppercase">
                                                am </span>
                                        </div>



                                        <a href="#" class="fs-5 fw-bold text-gray-800 text-hover-primary mb-2">
                                            Sales Pitch Proposal </a>



                                        <div class="text-gray-500">
                                            Lead by <a href="#">Caleb Donaldson</a>
                                        </div>

                                    </div>



                                    <a href="#" class="btn btn-bg-light btn-active-color-primary btn-sm">View</a>

                                </div>


                                <div class="d-flex flex-stack position-relative mt-8">

                                    <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>



                                    <div class="fw-semibold ms-5 text-gray-600">

                                        <div class="fs-5">
                                            14:30 - 15:30

                                            <span class="fs-7 text-gray-500 text-uppercase">
                                                pm </span>
                                        </div>



                                        <a href="#" class="fs-5 fw-bold text-gray-800 text-hover-primary mb-2">
                                            Project Review &amp; Testing </a>



                                        <div class="text-gray-500">
                                            Lead by <a href="#">Terry Robins</a>
                                        </div>

                                    </div>



                                    <a href="#" class="btn btn-bg-light btn-active-color-primary btn-sm">View</a>

                                </div>


                                <div class="d-flex flex-stack position-relative mt-8">

                                    <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>



                                    <div class="fw-semibold ms-5 text-gray-600">

                                        <div class="fs-5">
                                            10:00 - 11:00

                                            <span class="fs-7 text-gray-500 text-uppercase">
                                                am </span>
                                        </div>



                                        <a href="#" class="fs-5 fw-bold text-gray-800 text-hover-primary mb-2">
                                            Dashboard UI/UX Design Review </a>



                                        <div class="text-gray-500">
                                            Lead by <a href="#">Peter Marcus</a>
                                        </div>

                                    </div>



                                    <a href="#" class="btn btn-bg-light btn-active-color-primary btn-sm">View</a>

                                </div>

                            </div>


                            <div id="kt_schedule_day_11" class="tab-pane fade show " role="tabpanel">

                                <div class="d-flex flex-stack position-relative mt-8">

                                    <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>



                                    <div class="fw-semibold ms-5 text-gray-600">

                                        <div class="fs-5">
                                            14:30 - 15:30

                                            <span class="fs-7 text-gray-500 text-uppercase">
                                                pm </span>
                                        </div>



                                        <a href="#" class="fs-5 fw-bold text-gray-800 text-hover-primary mb-2">
                                            Development Team Capacity Review </a>



                                        <div class="text-gray-500">
                                            Lead by <a href="#">Yannis Gloverson</a>
                                        </div>

                                    </div>



                                    <a href="#" class="btn btn-bg-light btn-active-color-primary btn-sm">View</a>

                                </div>


                                <div class="d-flex flex-stack position-relative mt-8">

                                    <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>



                                    <div class="fw-semibold ms-5 text-gray-600">

                                        <div class="fs-5">
                                            10:00 - 11:00

                                            <span class="fs-7 text-gray-500 text-uppercase">
                                                am </span>
                                        </div>



                                        <a href="#" class="fs-5 fw-bold text-gray-800 text-hover-primary mb-2">
                                            Sales Pitch Proposal </a>



                                        <div class="text-gray-500">
                                            Lead by <a href="#">Naomi Hayabusa</a>
                                        </div>

                                    </div>



                                    <a href="#" class="btn btn-bg-light btn-active-color-primary btn-sm">View</a>

                                </div>


                                <div class="d-flex flex-stack position-relative mt-8">

                                    <div class="position-absolute h-100 w-4px bg-secondary rounded top-0 start-0"></div>



                                    <div class="fw-semibold ms-5 text-gray-600">

                                        <div class="fs-5">
                                            14:30 - 15:30

                                            <span class="fs-7 text-gray-500 text-uppercase">
                                                pm </span>
                                        </div>



                                        <a href="#" class="fs-5 fw-bold text-gray-800 text-hover-primary mb-2">
                                            Creative Content Initiative </a>



                                        <div class="text-gray-500">
                                            Lead by <a href="#">Caleb Donaldson</a>
                                        </div>

                                    </div>



                                    <a href="#" class="btn btn-bg-light btn-active-color-primary btn-sm">View</a>

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
