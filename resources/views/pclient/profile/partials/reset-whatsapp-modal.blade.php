<div class="modal fade" id="resetModal" tabindex="-1" aria-labelledby="resetModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form method="POST" action="{{ route('profile.whatsapp-security.reset') }}">
                @csrf
                <div class="modal-header bg-warning">
                    <h5 class="modal-title text-white" id="resetModalLabel">
                        <i class="fas fa-exclamation-triangle me-2"></i>Resetar Validação WhatsApp
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-warning">
                        <h6 class="alert-heading">
                            <i class="fas fa-info-circle me-2"></i>Importante
                        </h6>
                        <p class="mb-0">
                            Ao resetar a validação WhatsApp:
                        </p>
                        <ul class="mb-0 mt-2">
                            <li>Sua verificação atual será removida</li>
                            <li>Você precisará validar novamente seu telefone</li>
                            <li>O acesso via WhatsApp será bloqueado até nova verificação</li>
                        </ul>
                    </div>

                    <div class="mb-3">
                        <label for="current_password" class="form-label fw-bold">
                            <i class="fas fa-lock me-2"></i>Confirme sua senha
                        </label>
                        <input
                            type="password"
                            class="form-control @error('current_password') is-invalid @enderror"
                            id="current_password"
                            name="current_password"
                            required
                            placeholder="Digite sua senha atual"
                        >
                        @error('current_password')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-check">
                        <input
                            class="form-check-input"
                            type="checkbox"
                            id="confirm"
                            name="confirm"
                            value="1"
                            required
                        >
                        <label class="form-check-label" for="confirm">
                            Confirmo que desejo resetar a validação WhatsApp
                        </label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="fas fa-times me-2"></i>Cancelar
                    </button>
                    <button type="submit" class="btn btn-warning">
                        <i class="fas fa-sync-alt me-2"></i>Confirmar Reset
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

