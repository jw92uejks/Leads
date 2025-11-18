<!--begin::Modal - Add Corretor to Team-->
<div class="modal fade" id="kt_modal_add_corretor_to_team" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="fw-bold">Adicionar Corretor à Equipe</h2>
                <div class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal">
                    <i class="ki-duotone ki-cross fs-1">
                        <span class="path1"></span>
                        <span class="path2"></span>
                    </i>
                </div>
            </div>
            <div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
                <form id="kt_modal_add_corretor_to_team_form" class="form">
                    <div class="fv-row mb-7">
                        <label class="fs-6 fw-semibold form-label mb-2">
                            <span class="required">Buscar Usuário</span>
                        </label>
                        <input class="form-control form-control-solid" placeholder="Digite nome ou email do corretor" name="search_user" id="kt_search_user_team" />
                        <div class="mt-3" id="kt_search_results_team" style="display: none;">
                            <div class="border rounded p-3">
                                <div class="d-flex align-items-center mb-2">
                                    <div class="symbol symbol-35px symbol-circle me-3">
                                        <img src="{{ asset('assets/images/avatars/blank.png') }}" alt="Usuário" />
                                    </div>
                                    <div class="flex-grow-1">
                                        <div class="fw-bold">Maria Santos</div>
                                        <div class="text-muted">maria.santos@email.com</div>
                                    </div>
                                    <button type="button" class="btn btn-sm btn-pink" onclick="addCorretorToTeam(1, 'Maria Santos', 'maria.santos@email.com')">
                                        Adicionar
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="text-center pt-15">
                        <button type="reset" class="btn btn-light me-3" data-bs-dismiss="modal">
                            Cancelar
                        </button>
                        <button type="submit" class="btn btn-pink">
                            <span class="indicator-label">Adicionar</span>
                            <span class="indicator-progress">
                                Aguarde... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                            </span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!--end::Modal - Add Corretor to Team-->
