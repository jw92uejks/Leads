<!--begin::Modal - Edit Corretor-->
<div class="modal fade" id="kt_modal_edit_corretor" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="fw-bold">Ver Detalhes Corretor</h2>
                <div class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal">
                    <i class="ki-duotone ki-cross fs-1">
                        <span class="path1"></span>
                        <span class="path2"></span>
                    </i>
                </div>
            </div>
            <div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
                <form id="kt_modal_edit_corretor_form" class="form">
                    <div class="fv-row mb-7">
                        <label class="fs-6 fw-semibold form-label mb-2">
                            <span class="required">Nome</span>
                        </label>
                        <input class="form-control form-control-solid" placeholder="Nome do corretor" name="corretor_name" value="João Silva" />
                    </div>
                    <div class="fv-row mb-7">
                        <label class="fs-6 fw-semibold form-label mb-2">
                            <span class="required">Email</span>
                        </label>
                        <input class="form-control form-control-solid" placeholder="Email do corretor" name="corretor_email" value="joao.silva@email.com" />
                    </div>
                    <div class="fv-row mb-7">
                        <label class="fs-6 fw-semibold form-label mb-2">Status</label>
                        <select class="form-select form-select-solid" name="corretor_status">
                            <option value="ativo">Ativo</option>
                            <option value="inativo">Inativo</option>
                        </select>
                    </div>
                    <div class="fv-row mb-7">
                        <label class="fs-6 fw-semibold form-label mb-2">
                            <span class="required">Equipe</span>
                        </label>
                        <div class="d-flex align-items-center gap-3">
                            <select class="form-select form-select-solid" name="corretor_equipe" required>
                                <option value="">Selecione uma equipe</option>
                                <option value="1" selected>Equipe Alpha</option>
                                <option value="2">Equipe Beta</option>
                                <option value="3">Equipe Gamma</option>
                                <option value="4">Equipe Delta</option>
                                <option value="5">Equipe Epsilon</option>
                            </select>
                            <button type="button" class="btn btn-light-primary" data-bs-toggle="modal" data-bs-target="#kt_modal_add_equipe" data-bs-dismiss="modal">
                                <i class="ki-duotone ki-plus fs-2"></i>
                                Nova Equipe
                            </button>
                        </div>
                        <div class="form-text">O corretor deve pertencer obrigatoriamente a uma equipe.</div>
                    </div>
                    <div class="text-center pt-15">
                        <button type="reset" class="btn btn-light me-3" data-bs-dismiss="modal">
                            Cancelar
                        </button>
                        <button type="submit" class="btn btn-pink">
                            <span class="indicator-label">Salvar</span>
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
<!--end::Modal - Edit Corretor-->
