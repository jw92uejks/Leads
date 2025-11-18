<!--begin::Modal - Manage Team-->
<div class="modal fade" id="kt_modal_manage_team" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="fw-bold">Gerenciar Equipe: <span id="team_name_display"></span></h2>
                <div class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal">
                    <i class="ki-duotone ki-cross fs-1">
                        <span class="path1"></span>
                        <span class="path2"></span>
                    </i>
                </div>
            </div>
            <div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
                <div class="d-flex justify-content-between align-items-center mb-7">
                    <div>
                        <h3 class="fw-bold mb-2">Corretores da Equipe</h3>
                        <p class="text-muted">Gerencie os corretores desta equipe</p>
                    </div>
                    <button type="button" class="btn btn-pink" data-bs-toggle="modal" data-bs-target="#kt_modal_add_corretor_to_team" data-bs-dismiss="modal">
                        <i class="ki-duotone ki-plus-square fs-3">
                            <span class="path1"></span>
                            <span class="path2"></span>
                            <span class="path3"></span>
                        </i>Adicionar Corretor
                    </button>
                </div>
                
                <div class="table-responsive">
                    <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_team_members_table">
                        <thead>
                            <tr class="text-start text-gray-500 fw-bold fs-7 text-uppercase gs-0">
                                <th class="min-w-200px">Nome</th>
                                <th class="min-w-200px">Email</th>
                                <th class="min-w-200px">Criação</th>
                                <th class="min-w-100px">Status</th>
                                <th class="text-end min-w-100px">Ações</th>
                            </tr>
                        </thead>
                        <tbody class="fw-semibold text-gray-600">
                            <tr>
                                <td>João Silva</td>
                                <td>joao.silva@email.com</td>
                                <td data-order="2025-01-15">15/01/2025</td>
                                <td><span class="badge badge-light-success">Ativo</span></td>
                                <td class="text-end">
                                    <button class="btn btn-sm btn-light btn-active-light-primary btn-flex btn-center" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                        <span class="indicator-label">Ações</span>
                                        <i class="ki-duotone ki-down fs-2 m-0"></i>
                                    </button>
                                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-200px py-4" data-kt-menu="true">
                                        <div class="menu-item px-3">
                                            <a href="#" class="menu-link px-3" data-bs-toggle="modal" data-bs-target="#kt_modal_edit_corretor">
                                                <i class="ki-duotone ki-setting-3 fs-3 me-2">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                    <span class="path3"></span>
                                                    <span class="path4"></span>
                                                    <span class="path5"></span>
                                                </i>
                                                Editar
                                            </a>
                                        </div>
                                        {{-- Removido: ação de abrir Kanban --}}
                                        <div class="menu-separator my-2 opacity-75"></div>
                                        <div class="menu-item px-3">
                                            <a href="#" class="menu-link px-3 text-danger" data-kt-action="remove-from-team">
                                                <i class="ki-duotone ki-trash fs-3 me-2">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                    <span class="path3"></span>
                                                    <span class="path4"></span>
                                                    <span class="path5"></span>
                                                </i>
                                                Remover da Equipe
                                            </a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Ana Lima</td>
                                <td>ana.lima@email.com</td>
                                <td data-order="2025-01-15">15/01/2025</td>
                                <td><span class="badge badge-light-success">Ativo</span></td>
                                <td class="text-end">
                                    <button class="btn btn-sm btn-light btn-active-light-primary btn-flex btn-center" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                        <span class="indicator-label">Ações</span>
                                        <i class="ki-duotone ki-down fs-2 m-0"></i>
                                    </button>
                                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-200px py-4" data-kt-menu="true">
                                        <div class="menu-item px-3">
                                            <a href="#" class="menu-link px-3" data-bs-toggle="modal" data-bs-target="#kt_modal_edit_corretor">
                                                <i class="ki-duotone ki-setting-3 fs-3 me-2">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                    <span class="path3"></span>
                                                    <span class="path4"></span>
                                                    <span class="path5"></span>
                                                </i>
                                                Editar
                                            </a>
                                        </div>
                                        {{-- Removido: ação de abrir Kanban --}}
                                        <div class="menu-separator my-2 opacity-75"></div>
                                        <div class="menu-item px-3">
                                            <a href="#" class="menu-link px-3 text-danger" data-kt-action="remove-from-team">
                                                <i class="ki-duotone ki-trash fs-3 me-2">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                    <span class="path3"></span>
                                                    <span class="path4"></span>
                                                    <span class="path5"></span>
                                                </i>
                                                Remover da Equipe
                                            </a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!--end::Modal - Manage Team-->
