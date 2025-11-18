@push('modals')
    {{-- Modal Painel de Equipe --}}
    <div class="modal fade" id="kt_modal_equipe" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content border-0 shadow-lg">
                <div class="modal-body p-0">
                    <div class="submenu-modal">
                        <div class="submenu-item">
                            <a href="{{ route('team-panel.index') }}" class="submenu-link">
                                <span class="submenu-icon">
                                    <i class="ki-duotone ki-element-11 fs-2">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                        <span class="path3"></span>
                                        <span class="path4"></span>
                                    </i>
                                </span>
                                <span class="submenu-title">Visão Geral</span>
                            </a>
                        </div>
                        <div class="submenu-item">
                            <a href="{{ route('team-panel.single-team.create') }}" class="submenu-link">
                                <span class="submenu-icon">
                                    <i class="ki-duotone ki-setting-2 fs-2">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                </span>
                                <span class="submenu-title">Gerenciar Equipe</span>
                            </a>
                        </div>
                        <div class="submenu-item">
                            <a href="{{ route('team-panel.index') }}#members" class="submenu-link">
                                <span class="submenu-icon">
                                    <i class="ki-duotone ki-people fs-2">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                        <span class="path3"></span>
                                        <span class="path4"></span>
                                        <span class="path5"></span>
                                    </i>
                                </span>
                                <span class="submenu-title">Membros</span>
                            </a>
                        </div>
                        <div class="submenu-item">
                            <a href="{{ route('access.index') }}" class="submenu-link">
                                <span class="submenu-icon">
                                    <i class="ki-duotone ki-lock fs-2">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                        <span class="path3"></span>
                                    </i>
                                </span>
                                <span class="submenu-title">Controle de Acessos</span>
                            </a>
                        </div>
                        <div class="submenu-item">
                            <a href="{{ route('team-panel.index') }}#transfer" class="submenu-link">
                                <span class="submenu-icon">
                                    <i class="ki-duotone ki-arrow-mix fs-2">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                </span>
                                <span class="submenu-title">Transferência de Leads</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endpush
