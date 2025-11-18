<!--begin::Modal - Transferir Titularidade de Lead Individual-->
<div class="modal fade" id="transferSingleOwnershipModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="fw-bold">Transferir Titularidade do Lead</h2>
                <div class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal">
                    <i class="ki-duotone ki-cross fs-1">
                        <span class="path1"></span>
                        <span class="path2"></span>
                    </i>
                </div>
            </div>
            <div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
                <form id="transfer_single_ownership_form" class="form">
                    <!-- Aviso importante sobre titularidade -->
                    <div class="alert alert-danger mb-7">
                        <div class="d-flex align-items-center">
                            <i class="ki-duotone ki-warning-2 fs-2hx me-4" style="color: #D9214E;">
                                <span class="path1"></span>
                                <span class="path2"></span>
                                <span class="path3"></span>
                            </i>
                            <div class="flex-grow-1">
                                <h6 class="fw-bold text-dark mb-2">⚠️ ATENÇÃO: Transferência de Titularidade</h6>
                                <div class="text-dark">
                                    <p class="mb-1"><strong>Lead:</strong> <span id="singleLeadNameOwnership">N/A</span></p>
                                    <p class="mb-2"><strong>Você está CEDENDO a titularidade deste lead!</strong></p>
                                    <p class="mb-0 text-danger fw-bold">Após esta transferência, você NÃO terá mais acesso a este lead.</p>
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

                    <div class="fv-row mb-7">
                        <label class="fs-6 fw-semibold form-label mb-2">
                            <span class="required">Confirmação de Segurança</span>
                        </label>
                        <input type="text" class="form-control form-control-solid" name="confirmation_text" placeholder="Digite o nome do lead para confirmar" required>
                        <div class="form-text text-muted">Digite exatamente o nome do lead para confirmar que você entende que perderá o acesso a ele.</div>
                    </div>

                    <div class="text-center pt-15">
                        <button type="reset" class="btn btn-light me-3" data-bs-dismiss="modal">
                            Cancelar
                        </button>
                        <button type="submit" class="btn btn-danger">
                            <span class="indicator-label">Transferir Titularidade</span>
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
<!--end::Modal - Transferir Titularidade de Lead Individual-->
