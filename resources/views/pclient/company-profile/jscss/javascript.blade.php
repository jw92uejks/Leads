<script>
document.addEventListener('DOMContentLoaded', function() {
    const companyForm = document.getElementById('company-form');
    const saveBtn = document.getElementById('save-profile');
    const phoneInput = document.querySelector('input[name="phone"]');
    const cnpjInput = document.querySelector('input[name="cnpj"]');

    if (companyForm) {
        companyForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            if (!validateForm()) {
                showToast('Por favor, preencha todos os campos obrigatórios', 'error');
                return;
            }

            const indicatorLabel = saveBtn.querySelector('.indicator-label');
            const indicatorProgress = saveBtn.querySelector('.indicator-progress');
            
            indicatorLabel.style.display = 'none';
            indicatorProgress.style.display = 'inline-block';
            saveBtn.disabled = true;

            const formData = new FormData(companyForm);

            setTimeout(() => {
                indicatorLabel.style.display = 'inline-block';
                indicatorProgress.style.display = 'none';
                saveBtn.disabled = false;

                Swal.fire({
                    title: 'Perfil Atualizado!',
                    text: 'As informações da empresa foram salvas com sucesso.',
                    icon: 'success',
                    confirmButtonText: 'OK'
                });
            }, 2000);
        });
    }

    if (phoneInput) {
        phoneInput.addEventListener('input', function(e) {
            let value = e.target.value.replace(/\D/g, '');
            
            if (value.length <= 11) {
                value = value.replace(/(\d{2})(\d{5})(\d{4})/, '($1) $2-$3');
                if (value.length < 14) {
                    value = value.replace(/(\d{2})(\d{4})(\d{4})/, '($1) $2-$3');
                }
            }
            
            e.target.value = value;
        });
    }

    if (cnpjInput) {
        cnpjInput.addEventListener('input', function(e) {
            let value = e.target.value.replace(/\D/g, '');
            
            if (value.length <= 14) {
                value = value.replace(/(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/, '$1.$2.$3/$4-$5');
            }
            
            e.target.value = value;
        });
    }

    const toggleSwitches = document.querySelectorAll('.form-switch input[type="checkbox"]');
    toggleSwitches.forEach(function(toggle) {
        toggle.addEventListener('change', function() {
            const label = this.closest('.d-flex').querySelector('.fw-bold').textContent;
            const status = this.checked ? 'ativado' : 'desativado';
            
            Swal.fire({
                title: `${label} ${status}`,
                text: this.checked ? 'Configuração ativada com sucesso!' : 'Configuração desativada.',
                icon: this.checked ? 'success' : 'info',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                background: '#fff',
                customClass: {
                    popup: 'swal2-modal'
                }
            });
        });
    });

    const requiredFields = document.querySelectorAll('[required]');
    requiredFields.forEach(function(field) {
        field.addEventListener('blur', function() {
            validateField(this);
        });

        field.addEventListener('input', function() {
            if (this.classList.contains('is-invalid')) {
                validateField(this);
            }
        });
    });

    function validateField(field) {
        if (!field.value.trim()) {
            field.classList.remove('is-valid');
            field.classList.add('is-invalid');
            return false;
        } else {
            field.classList.remove('is-invalid');
            field.classList.add('is-valid');
            return true;
        }
    }

    function validateForm() {
        let isValid = true;
        const requiredInputs = companyForm.querySelectorAll('[required]');

        requiredInputs.forEach(function(field) {
            if (!validateField(field)) {
                isValid = false;
            }
        });

        if (cnpjInput && cnpjInput.value) {
            if (!isValidCNPJ(cnpjInput.value)) {
                cnpjInput.classList.add('is-invalid');
                showToast('CNPJ inválido', 'error');
                isValid = false;
            }
        }

        return isValid;
    }

    function isValidCNPJ(cnpj) {
        cnpj = cnpj.replace(/\D/g, '');
        
        if (cnpj.length !== 14) return false;
        
        if (/^(\d)\1{13}$/.test(cnpj)) return false;

        let size = cnpj.length - 2;
        let numbers = cnpj.substring(0, size);
        let digits = cnpj.substring(size);
        let sum = 0;
        let pos = size - 7;

        for (let i = size; i >= 1; i--) {
            sum += numbers.charAt(size - i) * pos--;
            if (pos < 2) pos = 9;
        }

        let result = sum % 11 < 2 ? 0 : 11 - sum % 11;
        if (result != digits.charAt(0)) return false;

        size = size + 1;
        numbers = cnpj.substring(0, size);
        sum = 0;
        pos = size - 7;

        for (let i = size; i >= 1; i--) {
            sum += numbers.charAt(size - i) * pos--;
            if (pos < 2) pos = 9;
        }

        result = sum % 11 < 2 ? 0 : 11 - sum % 11;
        if (result != digits.charAt(1)) return false;

        return true;
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
                icon: type === 'error' ? 'error' : type,
                title: message
            });
        }
    }

    const logoUpload = document.querySelector('.symbol img');
    if (logoUpload) {
        logoUpload.addEventListener('click', function() {
            Swal.fire({
                title: 'Upload de Logo',
                text: 'Esta funcionalidade estará disponível em breve.',
                icon: 'info',
                confirmButtonText: 'OK'
            });
        });
        logoUpload.style.cursor = 'pointer';
    }

    const resetBtn = companyForm.querySelector('button[type="reset"]');
    if (resetBtn) {
        resetBtn.addEventListener('click', function(e) {
            e.preventDefault();
            
            Swal.fire({
                title: 'Descartar Alterações?',
                text: 'Todas as alterações não salvas serão perdidas.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#f1416c',
                cancelButtonColor: '#7e8299',
                confirmButtonText: 'Sim, descartar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    companyForm.reset();
                    
                    const validFields = companyForm.querySelectorAll('.is-valid, .is-invalid');
                    validFields.forEach(field => {
                        field.classList.remove('is-valid', 'is-invalid');
                    });
                    
                    showToast('Formulário foi resetado', 'info');
                }
            });
        });
    }

    const tooltips = document.querySelectorAll('[data-bs-toggle="tooltip"]');
    tooltips.forEach(function(tooltip) {
        new bootstrap.Tooltip(tooltip);
    });
});
</script> 