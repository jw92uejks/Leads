@extends('layouts.app')
@section('title', 'Configurações')
@section('access', 'active')

@section('headlocal') @includeIf('pclient.config.jscss.css') @endsection
@section('jslocal') @includeIf('pclient.config.jscss.javascript') @endsection

@section('content')
    <div class="d-flex flex-column flex-column-fluid">
        <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
            <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
                <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Configurações</h1>
                    <span class="text-muted">Painel Principal</span>
                </div>
            </div>
        </div>
        <div id="kt_app_content_container" class="app-container">
            <!--begin::Card-->
            <div class="card card-flush ">
                <!--begin::Card body-->
                <div class="card-body pt-0">
                    <!--begin::Table-->
                    <div id="kt_permissions_table_wrapper" class="dt-container dt-bootstrap5 dt-empty-footer">
                        <div id="" class="table-responsive">
                            <table class="table align-middle table-row-dashed fs-6 gy-5 mb-0 dataTable" id="kt_permissions_table" style="width: 100%;">
                                <colgroup>
                                    <col data-dt-column="0" style="width: 369.016px;">
                                    <col data-dt-column="1" style="width: 150.625px;">
                                    <col data-dt-column="2" style="width: 369.625px;">
                                    <col data-dt-column="3" style="width: 160.828px;">
                                    <col data-dt-column="4" style="width: 100.031px;">
                                </colgroup>
                                <thead>
                                    <tr class="text-start text-gray-500 fw-bold fs-7 text-uppercase gs-0">
                                        <th class="min-w-125px dt-orderable-asc dt-orderable-desc" data-dt-column="0" rowspan="1" colspan="1" aria-label="Name: Activate to sort" tabindex="0"><span class="dt-column-title" role="button">Nome</span><span class="dt-column-order"></span></th>
                                        <th class="min-w-250px dt-orderable-none" data-dt-column="1" rowspan="1" colspan="1" aria-label="Assigned to"><span class="dt-column-title">Superior</span><span class="dt-column-order"></span></th>
                                        <th class="min-w-250px dt-orderable-none" data-dt-column="2" rowspan="1" colspan="1" aria-label="Assigned to"><span class="dt-column-title">Ocupação</span><span class="dt-column-order"></span></th>
                                        <th class="min-w-125px dt-orderable-asc dt-orderable-desc" data-dt-column="4" rowspan="1" colspan="1" aria-label="Created Date: Activate to sort" tabindex="0"><span class="dt-column-title" role="button">Criado em</span><span class="dt-column-order"></span></th>
                                        <th class="text-end min-w-100px dt-orderable-none" data-dt-column="4" rowspan="1" colspan="1" aria-label="Actions"><span class="dt-column-title">Ações</span><span class="dt-column-order"></span></th>
                                    </tr>
                                </thead>
                                <tbody class="fw-semibold text-gray-600">
                                    <tr>
                                        <td>Gabriel Campos</td>
                                        <td>

                                        </td>
                                        <td>
                                            Inteligência Artificial
                                        </td>
                                        <td data-order="2025-03-10T17:20:00-03:00">
                                            10 Mar 2025, 5:20 pm </td>
                                        <td class="text-end">
                                            <button class="btn btn-icon btn-active-light-primary w-30px h-30px me-3" data-bs-toggle="modal" data-bs-target="#kt_modal_update_permission">
                                                <i class="ki-duotone ki-setting-3 fs-3"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span></i> </button>
                                            <button class="btn btn-icon btn-active-light-primary w-30px h-30px" data-kt-permissions-table-filter="delete_row">
                                                <i class="ki-duotone ki-trash fs-3"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span></i> </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Gustavo Neri</td>
                                        <td>
                                            <a href="/metronic8/demo1/apps/user-management/roles/view.html" class="badge badge-light-success fs-7 m-1">Administrador</a>
                                        </td>
                                        <td>
                                            Automação
                                        </td>
                                        <td data-order="2025-07-25T17:30:00-03:00">
                                            25 Jul 2025, 5:30 pm </td>
                                        <td class="text-end">
                                            <button class="btn btn-icon btn-active-light-primary w-30px h-30px me-3" data-bs-toggle="modal" data-bs-target="#kt_modal_update_permission">
                                                <i class="ki-duotone ki-setting-3 fs-3"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span></i> </button>
                                            <button class="btn btn-icon btn-active-light-primary w-30px h-30px" data-kt-permissions-table-filter="delete_row">
                                                <i class="ki-duotone ki-trash fs-3"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span></i> </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Rafael</td>
                                        <td>
                                            <a href="/metronic8/demo1/apps/user-management/roles/view.html" class="badge badge-light-success fs-7 m-1">Administrador</a>
                                        </td>
                                        <td>
                                            Desenvolvedor
                                        </td>
                                        <td data-order="2025-09-22T20:43:00-03:00">
                                            22 Set 2025, 8:43 pm </td>
                                        <td class="text-end">
                                            <button class="btn btn-icon btn-active-light-primary w-30px h-30px me-3" data-bs-toggle="modal" data-bs-target="#kt_modal_update_permission">
                                                <i class="ki-duotone ki-setting-3 fs-3"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span></i> </button>
                                            <button class="btn btn-icon btn-active-light-primary w-30px h-30px" data-kt-permissions-table-filter="delete_row">
                                                <i class="ki-duotone ki-trash fs-3"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span></i> </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Bruno</td>
                                        <td>

                                        </td>
                                        <td>
                                            Gestor de leads
                                        </td>
                                        <td data-order="2025-05-05T17:30:00-03:00">
                                            05 Mai 2025, 5:30 pm </td>
                                        <td class="text-end">
                                            <button class="btn btn-icon btn-active-light-primary w-30px h-30px me-3" data-bs-toggle="modal" data-bs-target="#kt_modal_update_permission">
                                                <i class="ki-duotone ki-setting-3 fs-3"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span></i> </button>
                                            <button class="btn btn-icon btn-active-light-primary w-30px h-30px" data-kt-permissions-table-filter="delete_row">
                                                <i class="ki-duotone ki-trash fs-3"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span></i> </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Letícia Carvalho</td>
                                        <td>

                                        </td>
                                        <td>
                                            Assistente comercial
                                        </td>
                                        <td data-order="2025-02-21T21:23:00-03:00">
                                            21 Fev 2025, 9:23 pm </td>
                                        <td class="text-end">
                                            <button class="btn btn-icon btn-active-light-primary w-30px h-30px me-3" data-bs-toggle="modal" data-bs-target="#kt_modal_update_permission">
                                                <i class="ki-duotone ki-setting-3 fs-3"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span></i> </button>
                                            <button class="btn btn-icon btn-active-light-primary w-30px h-30px" data-kt-permissions-table-filter="delete_row">
                                                <i class="ki-duotone ki-trash fs-3"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span></i> </button>
                                        </td>
                                    </tr>
                                </tbody>
                                <tfoot></tfoot>
                            </table>
                        </div>
                    </div>
                    <!--end::Table-->
                </div>
                <!--end::Card body-->
            </div>
            <!--end::Card-->

            <!--begin::Modals-->
            <!--begin::Modal - Add permissions-->
            <div class="modal fade" id="kt_modal_add_permission" tabindex="-1" aria-hidden="true">
                <!--begin::Modal dialog-->
                <div class="modal-dialog modal-dialog-centered mw-650px">
                    <!--begin::Modal content-->
                    <div class="modal-content">
                        <!--begin::Modal header-->
                        <div class="modal-header">
                            <!--begin::Modal title-->
                            <h2 class="fw-bold">Add a Permission</h2>
                            <!--end::Modal title-->

                            <!--begin::Close-->
                            <div class="btn btn-icon btn-sm btn-active-icon-primary" data-kt-permissions-modal-action="close">
                                <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                            </div>
                            <!--end::Close-->
                        </div>
                        <!--end::Modal header-->

                        <!--begin::Modal body-->
                        <div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
                            <!--begin::Form-->
                            <form id="kt_modal_add_permission_form" class="form fv-plugins-bootstrap5 fv-plugins-framework" action="#">
                                <!--begin::Input group-->
                                <div class="fv-row mb-7 fv-plugins-icon-container">
                                    <!--begin::Label-->
                                    <label class="fs-6 fw-semibold form-label mb-2">
                                        <span class="required">Permission Name</span>

                                        <span class="ms-2" data-bs-toggle="popover" data-bs-trigger="hover" data-bs-html="true" data-bs-content="Permission names is required to be unique." data-kt-initialized="1">
                                            <i class="ki-duotone ki-information fs-7"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i> </span>
                                    </label>
                                    <!--end::Label-->

                                    <!--begin::Input-->
                                    <input class="form-control form-control-solid" placeholder="Enter a permission name" name="permission_name">
                                    <!--end::Input-->
                                    <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
                                </div>
                                <!--end::Input group-->

                                <!--begin::Input group-->
                                <div class="fv-row mb-7">
                                    <!--begin::Checkbox-->
                                    <label class="form-check form-check-custom form-check-solid me-9">
                                        <input class="form-check-input" type="checkbox" value="" name="permissions_core" id="kt_permissions_core">
                                        <span class="form-check-label" for="kt_permissions_core">
                                            Set as core permission
                                        </span>
                                    </label>
                                    <!--end::Checkbox-->
                                </div>
                                <!--end::Input group-->

                                <!--begin::Disclaimer-->
                                <div class="text-gray-600">Permission set as a <strong class="me-1">Core Permission</strong> will be locked and <strong class="me-1">not editable</strong> in future</div>
                                <!--end::Disclaimer-->

                                <!--begin::Actions-->
                                <div class="text-center pt-15">
                                    <button type="reset" class="btn btn-light me-3" data-kt-permissions-modal-action="cancel">
                                        Discard
                                    </button>

                                    <button type="submit" class="btn btn-primary" data-kt-permissions-modal-action="submit">
                                        <span class="indicator-label">
                                            Submit
                                        </span>
                                        <span class="indicator-progress">
                                            Please wait... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                        </span>
                                    </button>
                                </div>
                                <!--end::Actions-->
                            </form>
                            <!--end::Form-->
                        </div>
                        <!--end::Modal body-->
                    </div>
                    <!--end::Modal content-->
                </div>
                <!--end::Modal dialog-->
            </div>
            <!--end::Modal - Add permissions--><!--begin::Modal - Update permissions-->
            <div class="modal fade" id="kt_modal_update_permission" tabindex="-1" aria-hidden="true">
                <!--begin::Modal dialog-->
                <div class="modal-dialog modal-dialog-centered mw-650px">
                    <!--begin::Modal content-->
                    <div class="modal-content">
                        <!--begin::Modal header-->
                        <div class="modal-header">
                            <!--begin::Modal title-->
                            <h2 class="fw-bold">Update Permission</h2>
                            <!--end::Modal title-->

                            <!--begin::Close-->
                            <div class="btn btn-icon btn-sm btn-active-icon-primary" data-kt-permissions-modal-action="close">
                                <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                            </div>
                            <!--end::Close-->
                        </div>
                        <!--end::Modal header-->

                        <!--begin::Modal body-->
                        <div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
                            <!--begin::Notice-->

                            <!--begin::Notice-->
                            <div class="notice d-flex bg-light-warning rounded border-warning border border-dashed mb-9 p-6">
                                <!--begin::Icon-->
                                <i class="ki-duotone ki-information fs-2tx text-warning me-4"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i> <!--end::Icon-->

                                <!--begin::Wrapper-->
                                <div class="d-flex flex-stack flex-grow-1 ">
                                    <!--begin::Content-->
                                    <div class=" fw-semibold">

                                        <div class="fs-6 text-gray-700 "><strong class="me-1">Warning!</strong> By editing the permission name, you might break the system permissions functionality. Please ensure you're absolutely certain before proceeding.</div>
                                    </div>
                                    <!--end::Content-->

                                </div>
                                <!--end::Wrapper-->
                            </div>
                            <!--end::Notice-->
                            <!--end::Notice-->

                            <!--begin::Form-->
                            <form id="kt_modal_update_permission_form" class="form fv-plugins-bootstrap5 fv-plugins-framework" action="#">
                                <!--begin::Input group-->
                                <div class="fv-row mb-7 fv-plugins-icon-container">
                                    <!--begin::Label-->
                                    <label class="fs-6 fw-semibold form-label mb-2">
                                        <span class="required">Permission Name</span>

                                        <span class="ms-2" data-bs-toggle="popover" data-bs-trigger="hover" data-bs-html="true" data-bs-content="Permission names is required to be unique." data-kt-initialized="1">
                                            <i class="ki-duotone ki-information fs-7"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i> </span>
                                    </label>
                                    <!--end::Label-->

                                    <!--begin::Input-->
                                    <input class="form-control form-control-solid" placeholder="Enter a permission name" name="permission_name">
                                    <!--end::Input-->
                                    <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"></div>
                                </div>
                                <!--end::Input group-->

                                <!--begin::Actions-->
                                <div class="text-center pt-15">
                                    <button type="reset" class="btn btn-light me-3" data-kt-permissions-modal-action="cancel">
                                        Discard
                                    </button>

                                    <button type="submit" class="btn btn-primary" data-kt-permissions-modal-action="submit">
                                        <span class="indicator-label">
                                            Submit
                                        </span>
                                        <span class="indicator-progress">
                                            Please wait... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                        </span>
                                    </button>
                                </div>
                                <!--end::Actions-->
                            </form>
                            <!--end::Form-->
                        </div>
                        <!--end::Modal body-->
                    </div>
                    <!--end::Modal content-->
                </div>
                <!--end::Modal dialog-->
            </div>
            <!--end::Modal - Update permissions--><!--end::Modals-->
        </div>
    </div>
@endsection

