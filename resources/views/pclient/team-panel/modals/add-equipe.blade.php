<!--begin::Modal - Add Equipe-->
<div class="modal fade" id="kt_modal_add_equipe" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="fw-bold">Criar Nova Equipe</h2>
                <div class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal">
                    <i class="ki-duotone ki-cross fs-1">
                        <span class="path1"></span>
                        <span class="path2"></span>
                    </i>
                </div>
            </div>
            <div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
                <form id="kt_modal_add_equipe_form" class="form">
                    <div class="fv-row mb-7">
                        <label class="fs-6 fw-semibold form-label mb-2">
                            <span class="required">Nome da Equipe</span>
                        </label>
                        <input class="form-control form-control-solid" placeholder="Digite o nome da equipe" name="equipe_name" />
                    </div>
                    <div class="fv-row mb-7">
                        <label class="fs-6 fw-semibold form-label mb-2">Selecionar Corretores</label>
                        <select class="form-select form-select-solid" name="equipe_corretores" multiple data-control="select2" data-placeholder="Selecione os corretores">
                            <option value="1">João Silva</option>
                            <option value="2">Maria Santos</option>
                            <option value="3">Pedro Costa</option>
                            <option value="4">Ana Lima</option>
                            <option value="5">Carlos Oliveira</option>
                        </select>
                    </div>
                    <div class="text-center pt-15">
                        <button type="reset" class="btn btn-light me-3" data-bs-dismiss="modal">
                            Cancelar
                        </button>
                        <button type="submit" class="btn btn-pink" id="kt_create_equipe_btn">
                            <span class="indicator-label">Criar Equipe</span>
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
<!--end::Modal - Add Equipe-->
