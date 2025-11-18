<script>
document.addEventListener('DOMContentLoaded', function() {
    const copyApiKeyBtn = document.getElementById('copy-api-key');
    const copyWebhookBtn = document.getElementById('copy-webhook');
    const regenerateKeyBtn = document.getElementById('regenerate-key');
    const toggleIntegration = document.getElementById('toggle-integration');

    if (copyApiKeyBtn) {
        copyApiKeyBtn.addEventListener('click', function() {
            const apiKeyInput = document.getElementById('api-key');
            navigator.clipboard.writeText(apiKeyInput.value).then(function() {
                showToast('API Key copiada com sucesso!', 'success');
            });
        });
    }

    if (copyWebhookBtn) {
        copyWebhookBtn.addEventListener('click', function() {
            const webhookInput = copyWebhookBtn.previousElementSibling;
            navigator.clipboard.writeText(webhookInput.value).then(function() {
                showToast('URL do webhook copiada com sucesso!', 'success');
            });
        });
    }

    if (regenerateKeyBtn) {
        regenerateKeyBtn.addEventListener('click', function() {
            Swal.fire({
                title: 'Regenerar API Key?',
                text: 'Isso invalidará a chave atual. Certifique-se de atualizar seus sistemas.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#f1416c',
                cancelButtonColor: '#7e8299',
                confirmButtonText: 'Sim, regenerar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    const originalText = this.innerHTML;
                    this.innerHTML = '<span class="indicator-progress">Gerando... <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>';
                    this.disabled = true;

                    setTimeout(() => {
                        const newKey = 'sk_live_' + Math.random().toString(36).substr(2, 15);
                        document.getElementById('api-key').value = newKey;
                        
                        this.innerHTML = originalText;
                        this.disabled = false;
                        
                        Swal.fire(
                            'Chave Regenerada!',
                            'Sua nova API Key foi gerada com sucesso.',
                            'success'
                        );
                    }, 2000);
                }
            });
        });
    }

    if (toggleIntegration) {
        toggleIntegration.addEventListener('change', function() {
            const badge = document.querySelector('.badge-light-success');
            const isActive = this.checked;
            
            if (isActive) {
                badge.textContent = 'Ativa';
                badge.className = 'badge badge-light-success fs-7 fw-bold';
                showToast('Integração ativada', 'success');
            } else {
                badge.textContent = 'Inativa';
                badge.className = 'badge badge-light-danger fs-7 fw-bold';
                showToast('Integração desativada', 'warning');
            }
        });
    }

    function showToast(message, type) {
        if (window.toastr) {
            toastr[type](message);
        } else {
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true
            });

            Toast.fire({
                icon: type,
                title: message
            });
        }
    }

    const tooltips = document.querySelectorAll('[data-bs-toggle="tooltip"]');
    tooltips.forEach(function(tooltip) {
        new bootstrap.Tooltip(tooltip);
    });
});
</script> 