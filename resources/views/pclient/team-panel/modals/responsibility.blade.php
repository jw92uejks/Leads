<!--begin::Modal - Transferir Responsabilidade de Lead Individual-->
<div class="modal fade" id="transferSingleResponsibilityModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="fw-bold">Transferir Responsabilidade do Lead</h2>
                <div class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal">
                    <i class="ki-duotone ki-cross fs-1">
                        <span class="path1"></span>
                        <span class="path2"></span>
                    </i>
                </div>
            </div>
            <div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
                <form id="transfer_single_responsibility_form" class="form">
                    <!-- Informações sobre a transferência -->
                    <div class="alert alert-primary mb-7">
                        <div class="d-flex align-items-center">
                            <i class="ki-duotone ki-information-5 fs-2hx me-4" style="color: #A11753;">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                            <div class="flex-grow-1">
                                <h6 class="fw-bold text-dark mb-2">Transferência de Responsabilidade</h6>
                                <div class="text-dark">
                                    <p class="mb-1"><strong>Lead:</strong> <span id="singleLeadNameResponsibility">N/A</span></p>
                                    <p class="mb-0"><strong>Tipo:</strong> Responsabilidade (você mantém a titularidade)</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="fv-row mb-7">
                        <label class="fs-6 fw-semibold form-label mb-2">
                            <span class="required">Transferir para</span>
                        </label>
                        <select class="form-select form-select-solid" name="member_id" required>
                            <option value="">Selecione um membro da equipe</option>
                            @foreach($teamMembers as $member)
                                @if($member['id'] != auth()->user()->broker->id)
                                    <option value="{{ $member['id'] }}">{{ $member['name'] }} - {{ $member['role'] }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>

                    <div class="text-center pt-15">
                        <button type="reset" class="btn btn-light me-3" data-bs-dismiss="modal">
                            Cancelar
                        </button>
                        <button type="submit" class="btn btn-primary">
                            <span class="indicator-label">Transferir Responsabilidade</span>
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
<!--end::Modal - Transferir Responsabilidade de Lead Individual-->
