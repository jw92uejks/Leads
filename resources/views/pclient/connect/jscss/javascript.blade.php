<script>
"use strict";

// Class definition
var KTModalCreateConnection = function () {
    var submitButton;
    var cancelButton;
    var closeButton;
    var form;
    var modal;

    // Private functions
    var initForm = function () {
        // Init form validation rules. For more info check the FormValidation plugin's official documentation: https://formvalidation.io/
        form = document.querySelector('#kt_modal_create_connection_form');

        if (!form) {
            return;
        }

        // Init form validation rules
        var validator = FormValidation.formValidation(
            form,
            {
                fields: {
                    'instance_name': {
                        validators: {
                            notEmpty: {
                                message: 'Nome da instância é obrigatório'
                            },
                            stringLength: {
                                min: 3,
                                max: 50,
                                message: 'Nome da instância deve ter entre 3 e 50 caracteres'
                            },
                            regexp: {
                                regexp: /^[a-zA-Z0-9_-]+$/,
                                message: 'Nome da instância deve conter apenas letras, números, hífens e underscores'
                            }
                        }
                    },
                    'phone_number': {
                        validators: {
                            notEmpty: {
                                message: 'Número de telefone é obrigatório'
                            },
                            regexp: {
                                regexp: /^\(\d{2}\)\s\d{4,5}-\d{4}$/,
                                message: 'Formato inválido. Use (21) 99999-9999'
                            }
                        }
                    }
                },
                plugins: {
                    trigger: new FormValidation.plugins.Trigger(),
                    bootstrap: new FormValidation.plugins.Bootstrap5({
                        rowSelector: '.fv-row',
                        eleInvalidClass: '',
                        eleValidClass: ''
                    })
                }
            }
        );

        // Handle form submit
        submitButton.addEventListener('click', function (e) {
            e.preventDefault();

            validator.validate().then(function (status) {
                if (status == 'Valid') {
                    // Show loading state
                    submitButton.setAttribute('data-kt-indicator', 'on');
                    submitButton.disabled = true;

                    // Simulate form submission
                    setTimeout(function() {
                        submitButton.removeAttribute('data-kt-indicator');
                        submitButton.disabled = false;

                        // Show success message
                        Swal.fire({
                            text: "Instância criada com sucesso!",
                            icon: "success",
                            buttonsStyling: false,
                            confirmButtonText: "Ok",
                            customClass: {
                                confirmButton: "btn btn-primary"
                            }
                        }).then(function (result) {
                            if (result.isConfirmed) {
                                modal.hide();
                                form.reset();
                                
                                // Reload page to show new connection
                                location.reload();
                            }
                        });
                    }, 2000);
                } else {
                    Swal.fire({
                        text: "Desculpe, parece que há alguns erros detectados, tente novamente.",
                        icon: "error",
                        buttonsStyling: false,
                        confirmButtonText: "Ok",
                        customClass: {
                            confirmButton: "btn btn-primary"
                        }
                    });
                }
            });
        });

        // Handle cancel button
        cancelButton.addEventListener('click', function (e) {
            e.preventDefault();
            Swal.fire({
                text: "Tem certeza que deseja cancelar?",
                icon: "warning",
                showCancelButton: true,
                buttonsStyling: false,
                confirmButtonText: "Sim, cancelar!",
                cancelButtonText: "Não, continuar",
                customClass: {
                    confirmButton: "btn btn-primary",
                    cancelButton: "btn btn-light"
                }
            }).then(function (result) {
                if (result.isConfirmed) {
                    form.reset();
                    modal.hide();
                }
            });
        });

        // Handle close button
        closeButton.addEventListener('click', function (e) {
            e.preventDefault();
            Swal.fire({
                text: "Tem certeza que deseja cancelar?",
                icon: "warning",
                showCancelButton: true,
                buttonsStyling: false,
                confirmButtonText: "Sim, cancelar!",
                cancelButtonText: "Não, continuar",
                customClass: {
                    confirmButton: "btn btn-primary",
                    cancelButton: "btn btn-light"
                }
            }).then(function (result) {
                if (result.isConfirmed) {
                    form.reset();
                    modal.hide();
                }
            });
        });
    }

    // Public methods
    return {
        init: function () {
            modal = document.querySelector('#kt_modal_create_connection');
            submitButton = modal.querySelector('#kt_modal_create_connection_form [type="submit"]');
            cancelButton = modal.querySelector('[data-bs-dismiss="modal"]');
            closeButton = modal.querySelector('.btn-close');

            initForm();
        }
    };
}();

// Configure Instance Modal
var KTModalConfigureInstance = function () {
    var modal;
    var savePreferencesButton;
    var updateInstanceButton;
    var deleteInstanceButton;
    var turnOffButton;

    // Private functions
    var initButtons = function () {
        // Save preferences
        savePreferencesButton.addEventListener('click', function (e) {
            e.preventDefault();
            
            // Show loading state
            savePreferencesButton.setAttribute('data-kt-indicator', 'on');
            savePreferencesButton.disabled = true;

            // Simulate API call
            setTimeout(function() {
                savePreferencesButton.removeAttribute('data-kt-indicator');
                savePreferencesButton.disabled = false;

                Swal.fire({
                    text: "Preferências salvas com sucesso!",
                    icon: "success",
                    buttonsStyling: false,
                    confirmButtonText: "Ok",
                    customClass: {
                        confirmButton: "btn btn-primary"
                    }
                });
            }, 1000);
        });

        // Update instance
        updateInstanceButton.addEventListener('click', function (e) {
            e.preventDefault();
            
            // Show loading state
            updateInstanceButton.setAttribute('data-kt-indicator', 'on');
            updateInstanceButton.disabled = true;

            // Simulate API call
            setTimeout(function() {
                updateInstanceButton.removeAttribute('data-kt-indicator');
                updateInstanceButton.disabled = false;

                Swal.fire({
                    text: "Instância atualizada com sucesso!",
                    icon: "success",
                    buttonsStyling: false,
                    confirmButtonText: "Ok",
                    customClass: {
                        confirmButton: "btn btn-primary"
                    }
                });
            }, 1500);
        });

        // Delete instance
        deleteInstanceButton.addEventListener('click', function (e) {
            e.preventDefault();
            
            Swal.fire({
                text: "Tem certeza que deseja excluir esta instância? Esta ação não pode ser desfeita.",
                icon: "warning",
                showCancelButton: true,
                buttonsStyling: false,
                confirmButtonText: "Sim, excluir!",
                cancelButtonText: "Cancelar",
                customClass: {
                    confirmButton: "btn btn-danger",
                    cancelButton: "btn btn-light"
                }
            }).then(function (result) {
                if (result.isConfirmed) {
                    // Show loading state
                    deleteInstanceButton.setAttribute('data-kt-indicator', 'on');
                    deleteInstanceButton.disabled = true;

                    // Simulate API call
                    setTimeout(function() {
                        deleteInstanceButton.removeAttribute('data-kt-indicator');
                        deleteInstanceButton.disabled = false;

                        Swal.fire({
                            text: "Instância excluída com sucesso!",
                            icon: "success",
                            buttonsStyling: false,
                            confirmButtonText: "Ok",
                            customClass: {
                                confirmButton: "btn btn-primary"
                            }
                        }).then(function () {
                            modal.hide();
                            location.reload();
                        });
                    }, 2000);
                }
            });
        });

        // Turn off instance
        turnOffButton.addEventListener('click', function (e) {
            e.preventDefault();
            
            Swal.fire({
                text: "Tem certeza que deseja desligar esta instância?",
                icon: "warning",
                showCancelButton: true,
                buttonsStyling: false,
                confirmButtonText: "Sim, desligar!",
                cancelButtonText: "Cancelar",
                customClass: {
                    confirmButton: "btn btn-warning",
                    cancelButton: "btn btn-light"
                }
            }).then(function (result) {
                if (result.isConfirmed) {
                    // Show loading state
                    turnOffButton.setAttribute('data-kt-indicator', 'on');
                    turnOffButton.disabled = true;

                    // Simulate API call
                    setTimeout(function() {
                        turnOffButton.removeAttribute('data-kt-indicator');
                        turnOffButton.disabled = false;

                        Swal.fire({
                            text: "Instância desligada com sucesso!",
                            icon: "success",
                            buttonsStyling: false,
                            confirmButtonText: "Ok",
                            customClass: {
                                confirmButton: "btn btn-primary"
                            }
                        });
                    }, 1500);
                }
            });
        });
    }

    // Public methods
    return {
        init: function () {
            modal = document.querySelector('#kt_modal_configure_instance');
            savePreferencesButton = modal.querySelector('.card-header .btn-primary');
            updateInstanceButton = modal.querySelector('.card-body .btn-primary');
            deleteInstanceButton = modal.querySelector('.btn-danger');
            turnOffButton = modal.querySelector('.btn-warning');

            initButtons();
        }
    };
}();

// Global function to configure instance
function configureInstance(instanceName) {
    // Show the configure modal
    var configureModal = new bootstrap.Modal(document.getElementById('kt_modal_configure_instance'));
    configureModal.show();
}

// On document ready
KTUtil.onDOMContentLoaded(function () {
    KTModalCreateConnection.init();
    KTModalConfigureInstance.init();
});
</script>
