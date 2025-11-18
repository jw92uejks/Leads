@extends('layouts.app')
@section('title', 'Admin')
@section('adm', 'active')

@section('headlocal') @includeIf('padmin.home.jscss.css') @endsection
@section('jslocal') @includeIf('padmin.home.jscss.javascript') @endsection

@section('content')

    <div class="container">
        <div class="row mt-10">
            <div class="col-md-12">
                <h1>Bem vindo ao Admin Dashboard</h1>
                <p>Essa é a parte administrativa do sistema.</p>
            </div>
        </div>

        <div class="row g-5 gx-xl-10 mb-5 mb-xl-10 mt-5">
            <!--begin::Col-->
            <div class="col-xl-3">
                <!--begin::Card widget 3-->
                <div class="card card-flush bgi-no-repeat bgi-size-contain bgi-position-x-end h-xl-100" style="background-color: #F1416C;background-image:url('/metronic8/demo1/assets/media/svg/shapes/wave-bg-red.svg')">
                    <!--begin::Header-->
                    <div class="card-header pt-5 mb-3">
                        <!--begin::Icon-->
                        <div class="d-flex flex-center rounded-circle h-80px w-80px" style="border: 1px dashed rgba(255, 255, 255, 0.4);background-color: #F1416C">
                            <i class="ki-duotone ki-call text-white fs-2qx lh-0"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span><span class="path6"></span><span class="path7"></span><span class="path8"></span></i>
                        </div>
                        <!--end::Icon-->
                    </div>
                    <!--end::Header-->

                    <!--begin::Card body-->
                    <div class="card-body d-flex align-items-end mb-3">
                        <!--begin::Info-->
                        <div class="d-flex align-items-center">
                            <span class="fs-4hx text-white fw-bold me-6">1.2k</span>

                            <div class="fw-bold fs-6 text-white">
                                <span class="d-block">Usuários</span>
                                <span class="">ativos</span>
                            </div>
                        </div>
                        <!--end::Info-->
                    </div>
                    <!--end::Card body-->

                    <!--begin::Card footer-->
                    <div class="card-footer" style="border-top: 1px solid rgba(255, 255, 255, 0.3);background: rgba(0, 0, 0, 0.15);">
                        <!--begin::Progress-->
                        <div class="fw-bold text-white py-2">
                            <span class="fs-1 d-block">1.935</span>
                            <span class="opacity-50">Usuários cadastrados</span>
                        </div>
                        <!--end::Progress-->
                    </div>
                    <!--end::Card footer-->
                </div>
                <!--end::Card widget 3-->
            </div>
            <!--end::Col-->

            <!--begin::Col-->
            <div class="col-xl-3">
                <!--begin::Card widget 3-->
                <div class="card card-flush bgi-no-repeat bgi-size-contain bgi-position-x-end h-xl-100" style="background-color: #7239EA;background-image:url('/metronic8/demo1/assets/media/svg/shapes/wave-bg-purple.svg')">
                    <!--begin::Header-->
                    <div class="card-header pt-5 mb-3">
                        <!--begin::Icon-->
                        <div class="d-flex flex-center rounded-circle h-80px w-80px" style="border: 1px dashed rgba(255, 255, 255, 0.4);background-color: #7239EA">
                            <i class="ki-duotone ki-call text-white fs-2qx lh-0"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span><span class="path6"></span><span class="path7"></span><span class="path8"></span></i>
                        </div>
                        <!--end::Icon-->
                    </div>
                    <!--end::Header-->

                    <!--begin::Card body-->
                    <div class="card-body d-flex align-items-end mb-3">
                        <!--begin::Info-->
                        <div class="d-flex align-items-center">
                            <span class="fs-4hx text-white fw-bold me-6">427</span>

                            <div class="fw-bold fs-6 text-white">
                                <span class="d-block">Pagantes</span>
                                <span class="">ativos</span>
                            </div>
                        </div>
                        <!--end::Info-->
                    </div>
                    <!--end::Card body-->

                    <!--begin::Card footer-->
                    <div class="card-footer" style="border-top: 1px solid rgba(255, 255, 255, 0.3);background: rgba(0, 0, 0, 0.15);">
                        <!--begin::Progress-->
                        <div class="fw-bold text-white py-2">
                            <span class="fs-1 d-block">R$ 10.305,00</span>
                            <span class="opacity-50">MRR</span>
                        </div>
                        <!--end::Progress-->
                    </div>
                    <!--end::Card footer-->
                </div>
                <!--end::Card widget 3-->
            </div>
            <!--end::Col-->

            <!--begin::Col-->
            <div class="col-xl-3">
                <!--begin::Card widget 3-->
                <div class="card card-flush bgi-no-repeat bgi-size-contain bgi-position-x-end h-xl-100" style="background-color: #39eaa6;background-image:url('/metronic8/demo1/assets/media/svg/shapes/wave-bg-purple.svg')">
                    <!--begin::Header-->
                    <div class="card-header pt-5 mb-3">
                        <!--begin::Icon-->
                        <div class="d-flex flex-center rounded-circle h-80px w-80px" style="border: 1px dashed rgba(255, 255, 255, 0.4);background-color: #39eaa6">
                            <i class="ki-duotone ki-call text-white fs-2qx lh-0"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span><span class="path6"></span><span class="path7"></span><span class="path8"></span></i>
                        </div>
                        <!--end::Icon-->
                    </div>
                    <!--end::Header-->

                    <!--begin::Card body-->
                    <div class="card-body d-flex align-items-end mb-3">
                        <!--begin::Info-->
                        <div class="d-flex align-items-center">
                            <span class="fs-4hx text-white fw-bold me-6">58</span>

                            <div class="fw-bold fs-6 text-white">
                                <span class="d-block">Times</span>
                                <span class="">ativos</span>
                            </div>
                        </div>
                        <!--end::Info-->
                    </div>
                    <!--end::Card body-->

                    <!--begin::Card footer-->
                    <div class="card-footer" style="border-top: 1px solid rgba(255, 255, 255, 0.3);background: rgba(0, 0, 0, 0.15);">
                        <!--begin::Progress-->
                        <div class="fw-bold text-white py-2">
                            <span class="fs-1 d-block">+10</span>
                            <span class="opacity-50">Esse mês</span>
                        </div>
                        <!--end::Progress-->
                    </div>
                    <!--end::Card footer-->
                </div>
                <!--end::Card widget 3-->
            </div>
            <!--end::Col-->
        </div>
    </div>

@endsection

