<div class="table-responsive">
    <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_teams_table">
        <thead>
            <tr class="text-start text-gray-500 fw-bold fs-7 text-uppercase gs-0">
                <th class="min-w-200px">Nome da Equipe</th>
                <th class="min-w-200px">Membros</th>
                <th class="min-w-200px">Criação</th>
                <th class="min-w-100px">Status</th>
                <th class="text-end min-w-100px">Ações</th>
            </tr>
        </thead>
        <tbody class="fw-semibold text-gray-600">
            <tr>
                <td>
                    <div class="d-flex align-items-center">
                        <div class="symbol symbol-35px symbol-circle me-3">
                            <i class="ki-duotone ki-profile-user fs-2 text-pink">
                                <span class="path1"></span>
                                <span class="path2"></span>
                                <span class="path3"></span>
                                <span class="path4"></span>
                            </i>
                        </div>
                        <div class="flex-grow-1">
                            <a href="{{ route('team-panel.single-team.show', 1) }}" class="fw-bold text-pink text-hover-primary text-decoration-none">Equipe Alpha</a>
                            <div class="text-muted fs-7">4 corretores ativos</div>
                        </div>
                    </div>
                </td>
                <td>
                    <div class="d-flex align-items-center">
                        <div class="symbol symbol-35px symbol-circle me-3">
                            <img src="{{ asset('assets/images/avatars/blank.png') }}" alt="João Silva" />
                        </div>
                        <div class="symbol symbol-35px symbol-circle me-3">
                            <img src="{{ asset('assets/images/avatars/blank.png') }}" alt="Ana Lima" />
                        </div>
                        <div class="symbol symbol-35px symbol-circle me-3">
                            <img src="{{ asset('assets/images/avatars/blank.png') }}" alt="Carlos Oliveira" />
                        </div>
                        <div class="symbol symbol-35px symbol-circle me-3">
                            <img src="{{ asset('assets/images/avatars/blank.png') }}" alt="Mariana Costa" />
                        </div>
                        <div class="symbol symbol-35px symbol-circle me-3 bg-light-pink">
                            <span class="symbol-label fs-7 fw-bold text-pink">+2</span>
                        </div>
                    </div>
                </td>
                <td data-order="2025-01-15">15/01/2025</td>
                <td><span class="badge badge-light-success">Ativa</span></td>
                <td class="text-end">
                    <button class="btn btn-sm btn-light btn-active-light-primary btn-flex btn-center" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                        <span class="indicator-label">Ações</span>
                        <i class="ki-duotone ki-down fs-2 m-0"></i>
                    </button>
                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-200px py-4" data-kt-menu="true">
                        <div class="menu-item px-3">
                            <a href="{{ route('team-panel.single-team.show', 1) }}" class="menu-link px-3">
                                <i class="ki-duotone ki-profile-user fs-3 me-2">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                    <span class="path3"></span>
                                    <span class="path4"></span>
                                </i>
                                Ver Equipe
                            </a>
                        </div>
                        <div class="menu-item px-3">
                            <a href="{{ route('team-panel.single-team.edit', 1) }}" class="menu-link px-3">
                                <i class="ki-duotone ki-setting-3 fs-3 me-2">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                    <span class="path3"></span>
                                    <span class="path4"></span>
                                    <span class="path5"></span>
                                </i>
                                Editar Equipe
                            </a>
                        </div>
                        <div class="menu-separator my-2 opacity-75"></div>
                        <div class="menu-item px-3">
                            <a href="#" class="menu-link px-3 text-danger" data-kt-teams-table-filter="delete_row">
                                <i class="ki-duotone ki-trash fs-3 me-2">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                    <span class="path3"></span>
                                    <span class="path4"></span>
                                    <span class="path5"></span>
                                </i>
                                Excluir Equipe
                            </a>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="d-flex align-items-center">
                        <div class="symbol symbol-35px symbol-circle me-3">
                            <i class="ki-duotone ki-profile-user fs-2 text-pink">
                                <span class="path1"></span>
                                <span class="path2"></span>
                                <span class="path3"></span>
                                <span class="path4"></span>
                            </i>
                        </div>
                        <div class="flex-grow-1">
                            <a href="{{ route('team-panel.single-team.show', 2) }}" class="fw-bold text-pink text-hover-primary text-decoration-none">Equipe Beta</a>
                            <div class="text-muted fs-7">2 corretores ativos</div>
                        </div>
                    </div>
                </td>
                <td>
                    <div class="d-flex align-items-center">
                        <div class="symbol symbol-35px symbol-circle me-3">
                            <img src="{{ asset('assets/images/avatars/blank.png') }}" alt="Pedro Costa" />
                        </div>
                        <div class="symbol symbol-35px symbol-circle me-3">
                            <img src="{{ asset('assets/images/avatars/blank.png') }}" alt="Carlos Oliveira" />
                        </div>
                    </div>
                </td>
                <td data-order="2025-02-20">20/02/2025</td>
                <td><span class="badge badge-light-warning">Inativa</span></td>
                <td class="text-end">
                    <button class="btn btn-sm btn-light btn-active-light-primary btn-flex btn-center" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                        <span class="indicator-label">Ações</span>
                        <i class="ki-duotone ki-down fs-2 m-0"></i>
                    </button>
                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-200px py-4" data-kt-menu="true">
                        <div class="menu-item px-3">
                            <a href="{{ route('team-panel.single-team.show', 2) }}" class="menu-link px-3">
                                <i class="ki-duotone ki-profile-user fs-3 me-2">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                    <span class="path3"></span>
                                    <span class="path4"></span>
                                </i>
                                Ver Equipe
                            </a>
                        </div>
                        <div class="menu-item px-3">
                            <a href="{{ route('team-panel.single-team.edit', 2) }}" class="menu-link px-3">
                                <i class="ki-duotone ki-setting-3 fs-3 me-2">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                    <span class="path3"></span>
                                    <span class="path4"></span>
                                    <span class="path5"></span>
                                </i>
                                Editar Equipe
                            </a>
                        </div>
                        <div class="menu-separator my-2 opacity-75"></div>
                        <div class="menu-item px-3">
                            <a href="#" class="menu-link px-3 text-danger" data-kt-teams-table-filter="delete_row">
                                <i class="ki-duotone ki-trash fs-3 me-2">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                    <span class="path3"></span>
                                    <span class="path4"></span>
                                    <span class="path5"></span>
                                </i>
                                Excluir Equipe
                            </a>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="d-flex align-items-center">
                        <div class="symbol symbol-35px symbol-circle me-3">
                            <i class="ki-duotone ki-profile-user fs-2 text-pink">
                                <span class="path1"></span>
                                <span class="path2"></span>
                                <span class="path3"></span>
                                <span class="path4"></span>
                            </i>
                        </div>
                        <div class="flex-grow-1">
                            <a href="{{ route('team-panel.single-team.show', 3) }}" class="fw-bold text-pink text-hover-primary text-decoration-none">Equipe Gamma</a>
                            <div class="text-muted fs-7">3 corretores ativos</div>
                        </div>
                    </div>
                </td>
                <td>
                    <div class="d-flex align-items-center">
                        <div class="symbol symbol-35px symbol-circle me-3">
                            <img src="{{ asset('assets/images/avatars/blank.png') }}" alt="Membro" />
                        </div>
                        <div class="symbol symbol-35px symbol-circle me-3">
                            <img src="{{ asset('assets/images/avatars/blank.png') }}" alt="Membro" />
                        </div>
                        <div class="symbol symbol-35px symbol-circle me-3">
                            <img src="{{ asset('assets/images/avatars/blank.png') }}" alt="Membro" />
                        </div>
                    </div>
                </td>
                <td data-order="2025-03-15">15/03/2025</td>
                <td><span class="badge badge-light-success">Ativa</span></td>
                <td class="text-end">
                    <button class="btn btn-sm btn-light btn-active-light-primary btn-flex btn-center" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                        <span class="indicator-label">Ações</span>
                        <i class="ki-duotone ki-down fs-2 m-0"></i>
                    </button>
                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-200px py-4" data-kt-menu="true">
                        <div class="menu-item px-3">
                            <a href="{{ route('team-panel.single-team.show', 3) }}" class="menu-link px-3">
                                <i class="ki-duotone ki-profile-user fs-3 me-2">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                    <span class="path3"></span>
                                    <span class="path4"></span>
                                </i>
                                Ver Equipe
                            </a>
                        </div>
                        <div class="menu-item px-3">
                            <a href="{{ route('team-panel.single-team.edit', 3) }}" class="menu-link px-3">
                                <i class="ki-duotone ki-setting-3 fs-3 me-2">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                    <span class="path3"></span>
                                    <span class="path4"></span>
                                    <span class="path5"></span>
                                </i>
                                Editar Equipe
                            </a>
                        </div>
                        <div class="menu-separator my-2 opacity-75"></div>
                        <div class="menu-item px-3">
                            <a href="#" class="menu-link px-3 text-danger" data-kt-teams-table-filter="delete_row">
                                <i class="ki-duotone ki-trash fs-3 me-2">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                    <span class="path3"></span>
                                    <span class="path4"></span>
                                    <span class="path5"></span>
                                </i>
                                Excluir Equipe
                            </a>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="d-flex align-items-center">
                        <div class="symbol symbol-35px symbol-circle me-3">
                            <i class="ki-duotone ki-profile-user fs-2 text-pink">
                                <span class="path1"></span>
                                <span class="path2"></span>
                                <span class="path3"></span>
                                <span class="path4"></span>
                            </i>
                        </div>
                        <div class="flex-grow-1">
                            <a href="{{ route('team-panel.single-team.show', 4) }}" class="fw-bold text-pink text-hover-primary text-decoration-none">Equipe Delta</a>
                            <div class="text-muted fs-7">2 corretores ativos</div>
                        </div>
                    </div>
                </td>
                <td>
                    <div class="d-flex align-items-center">
                        <div class="symbol symbol-35px symbol-circle me-3">
                            <img src="{{ asset('assets/images/avatars/blank.png') }}" alt="Membro" />
                        </div>
                        <div class="symbol symbol-35px symbol-circle me-3">
                            <img src="{{ asset('assets/images/avatars/blank.png') }}" alt="Membro" />
                        </div>
                    </div>
                </td>
                <td data-order="2025-04-10">10/04/2025</td>
                <td><span class="badge badge-light-success">Ativa</span></td>
                <td class="text-end">
                    <button class="btn btn-sm btn-light btn-active-light-primary btn-flex btn-center" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                        <span class="indicator-label">Ações</span>
                        <i class="ki-duotone ki-down fs-2 m-0"></i>
                    </button>
                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-200px py-4" data-kt-menu="true">
                        <div class="menu-item px-3">
                            <a href="{{ route('team-panel.single-team.show', 4) }}" class="menu-link px-3">
                                <i class="ki-duotone ki-profile-user fs-3 me-2">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                    <span class="path3"></span>
                                    <span class="path4"></span>
                                </i>
                                Ver Equipe
                            </a>
                        </div>
                        <div class="menu-item px-3">
                            <a href="{{ route('team-panel.single-team.edit', 4) }}" class="menu-link px-3">
                                <i class="ki-duotone ki-setting-3 fs-3 me-2">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                    <span class="path3"></span>
                                    <span class="path4"></span>
                                    <span class="path5"></span>
                                </i>
                                Editar Equipe
                            </a>
                        </div>
                        <div class="menu-separator my-2 opacity-75"></div>
                        <div class="menu-item px-3">
                            <a href="#" class="menu-link px-3 text-danger" data-kt-teams-table-filter="delete_row">
                                <i class="ki-duotone ki-trash fs-3 me-2">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                    <span class="path3"></span>
                                    <span class="path4"></span>
                                    <span class="path5"></span>
                                </i>
                                Excluir Equipe
                            </a>
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="d-flex align-items-center">
                        <div class="symbol symbol-35px symbol-circle me-3">
                            <i class="ki-duotone ki-profile-user fs-2 text-pink">
                                <span class="path1"></span>
                                <span class="path2"></span>
                                <span class="path3"></span>
                                <span class="path4"></span>
                            </i>
                        </div>
                        <div class="flex-grow-1">
                            <a href="{{ route('team-panel.single-team.show', 5) }}" class="fw-bold text-pink text-hover-primary text-decoration-none">Equipe Epsilon</a>
                            <div class="text-muted fs-7">4 corretores ativos</div>
                        </div>
                    </div>
                </td>
                <td>
                    <div class="d-flex align-items-center">
                        <div class="symbol symbol-35px symbol-circle me-3">
                            <img src="{{ asset('assets/images/avatars/blank.png') }}" alt="Membro" />
                        </div>
                        <div class="symbol symbol-35px symbol-circle me-3">
                            <img src="{{ asset('assets/images/avatars/blank.png') }}" alt="Membro" />
                        </div>
                        <div class="symbol symbol-35px symbol-circle me-3">
                            <img src="{{ asset('assets/images/avatars/blank.png') }}" alt="Membro" />
                        </div>
                        <div class="symbol symbol-35px symbol-circle me-3">
                            <img src="{{ asset('assets/images/avatars/blank.png') }}" alt="Membro" />
                        </div>
                    </div>
                </td>
                <td data-order="2025-05-20">20/05/2025</td>
                <td><span class="badge badge-light-warning">Inativa</span></td>
                <td class="text-end">
                    <button class="btn btn-sm btn-light btn-active-light-primary btn-flex btn-center" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                        <span class="indicator-label">Ações</span>
                        <i class="ki-duotone ki-down fs-2 m-0"></i>
                    </button>
                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-200px py-4" data-kt-menu="true">
                        <div class="menu-item px-3">
                            <a href="{{ route('team-panel.single-team.show', 5) }}" class="menu-link px-3">
                                <i class="ki-duotone ki-profile-user fs-3 me-2">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                    <span class="path3"></span>
                                    <span class="path4"></span>
                                </i>
                                Ver Equipe
                            </a>
                        </div>
                        <div class="menu-item px-3">
                            <a href="{{ route('team-panel.single-team.edit', 5) }}" class="menu-link px-3">
                                <i class="ki-duotone ki-setting-3 fs-3 me-2">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                    <span class="path3"></span>
                                    <span class="path4"></span>
                                    <span class="path5"></span>
                                </i>
                                Editar Equipe
                            </a>
                        </div>
                        <div class="menu-separator my-2 opacity-75"></div>
                        <div class="menu-item px-3">
                            <a href="#" class="menu-link px-3 text-danger" data-kt-teams-table-filter="delete_row">
                                <i class="ki-duotone ki-trash fs-3 me-2">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                    <span class="path3"></span>
                                    <span class="path4"></span>
                                    <span class="path5"></span>
                                </i>
                                Excluir Equipe
                            </a>
                        </div>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
</div>

{{-- Modais removidos - implementar funcionalidades no backend --}} 