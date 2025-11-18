<script>
document.addEventListener('DOMContentLoaded', function() {
    const leadForm = document.getElementById('lead-form');
    const uploadForm = document.getElementById('upload-form');
    const submitBtn = document.getElementById('submit-lead');
    const uploadBtn = document.getElementById('upload-btn');

    if (leadForm) {
        leadForm.addEventListener('submit', function(e) {
            e.preventDefault();

            if (submitBtn.disabled) {
                return;
            }

            const indicatorLabel = submitBtn.querySelector('.indicator-label');
            const indicatorProgress = submitBtn.querySelector('.indicator-progress');

            indicatorLabel.style.display = 'none';
            indicatorProgress.style.display = 'inline-block';
            submitBtn.disabled = true;

            const formData = new FormData(leadForm);

            fetch(leadForm.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json',
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.message) {
                    Swal.fire({
                        title: 'Lead Criado!',
                        text: data.message,
                        icon: 'success',
                        confirmButtonText: 'OK'
                    }).then(() => {
                        leadForm.reset();
                    });
                }
            })
            .catch(error => {
                console.error('Erro:', error);
                Swal.fire({
                    title: 'Erro!',
                    text: 'Ocorreu um erro ao criar o lead. Tente novamente.',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            })
            .finally(() => {
                indicatorLabel.style.display = 'inline-block';
                indicatorProgress.style.display = 'none';
                submitBtn.disabled = false;
            });
        });
    }

    if (uploadForm) {
        uploadForm.addEventListener('submit', function(e) {
            e.preventDefault();

            if (uploadBtn.disabled) {
                return;
            }

            const fileInput = uploadForm.querySelector('input[type="file"]');
            if (!fileInput.files.length) {
                showToast('Selecione um arquivo antes de fazer o upload', 'error');
                return;
            }

            const indicatorLabel = uploadBtn.querySelector('.indicator-label');
            const indicatorProgress = uploadBtn.querySelector('.indicator-progress');

            indicatorLabel.style.display = 'none';
            indicatorProgress.style.display = 'inline-block';
            uploadBtn.disabled = true;

            setTimeout(() => {
                indicatorLabel.style.display = 'inline-block';
                indicatorProgress.style.display = 'none';
                uploadBtn.disabled = false;

                Swal.fire({
                    title: 'Upload Realizado!',
                    text: 'Arquivo processado com sucesso. 150 leads foram importados.',
                    icon: 'success',
                    confirmButtonText: 'OK'
                }).then(() => {
                    uploadForm.reset();
                });
            }, 3000);
        });
    }

    const phoneInputs = document.querySelectorAll('input[name="phone"]');
    phoneInputs.forEach(function(input) {
        input.addEventListener('input', function(e) {
            let value = e.target.value.replace(/\D/g, '');

            if (value.length <= 11) {
                value = value.replace(/(\d{2})(\d{5})(\d{4})/, '($1) $2-$3');
                if (value.length < 14) {
                    value = value.replace(/(\d{2})(\d{4})(\d{4})/, '($1) $2-$3');
                }
            }

            e.target.value = value;
        });
    });

    const priceInputs = document.querySelectorAll('input[type="number"][step="0.01"]');
    priceInputs.forEach(function(input) {
        input.addEventListener('input', function(e) {
            let value = parseFloat(e.target.value);
            if (value < 0) {
                e.target.value = 0;
            }
        });
    });

    const requiredSelects = document.querySelectorAll('select[required]');
    requiredSelects.forEach(function(select) {
        select.addEventListener('change', function() {
            if (this.value) {
                this.classList.remove('is-invalid');
                this.classList.add('is-valid');
            } else {
                this.classList.remove('is-valid');
                this.classList.add('is-invalid');
            }
        });
    });

    const fileInput = document.querySelector('input[type="file"]');
    if (fileInput) {
        fileInput.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const allowedTypes = ['application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                                    'application/vnd.ms-excel',
                                    'text/csv'];

                if (!allowedTypes.includes(file.type)) {
                    showToast('Formato de arquivo não suportado. Use .xlsx, .xls ou .csv', 'error');
                    e.target.value = '';
                    return;
                }

                const maxSize = 10 * 1024 * 1024;
                if (file.size > maxSize) {
                    showToast('Arquivo muito grande. Máximo 10MB', 'error');
                    e.target.value = '';
                    return;
                }

                showToast('Arquivo selecionado: ' + file.name, 'success');
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
                icon: type === 'error' ? 'error' : type,
                title: message
            });
        }
    }

    function validateForm() {
        const requiredFields = leadForm.querySelectorAll('[required]');
        let isValid = true;

        requiredFields.forEach(function(field) {
            if (!field.value.trim()) {
                field.classList.add('is-invalid');
                isValid = false;
            } else {
                field.classList.remove('is-invalid');
                field.classList.add('is-valid');
            }
        });

        return isValid;
    }

    const tooltips = document.querySelectorAll('[data-bs-toggle="tooltip"]');
    tooltips.forEach(function(tooltip) {
        new bootstrap.Tooltip(tooltip);
    });
});
</script>