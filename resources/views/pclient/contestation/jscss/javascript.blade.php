<script src="{{ asset('assets/js/plugins.bundle.js') }}"></script>
<script src="{{ asset('assets/js/datatables.bundle.js') }}"></script>

<script>
"use strict";

// Aguardar o carregamento completo das dependências
function waitForDependencies(callback) {
    const maxAttempts = 50;
    let attempts = 0;

    function checkDependencies() {
        attempts++;

        // Verificar se jQuery e DataTables estão disponíveis
        if (typeof window.jQuery !== 'undefined' && typeof window.jQuery.fn.DataTable !== 'undefined') {
            console.log('✅ jQuery and DataTables loaded successfully');
            callback();
            return;
        }

        if (attempts >= maxAttempts) {
            console.error('❌ Timeout: jQuery or DataTables not loaded after 5 seconds');
            // Tentar carregar manualmente
            loadFallback(callback);
            return;
        }

        console.log('⏳ Waiting for dependencies... Attempt', attempts, '/', maxAttempts);
        setTimeout(checkDependencies, 100);
    }

    checkDependencies();
}

function loadFallback(callback) {
    console.log('📚 Tentando carregar dependências manualmente...');

    // Carregar jQuery se não estiver disponível
    if (typeof window.jQuery === 'undefined') {
        const jqueryScript = document.createElement('script');
        jqueryScript.src = 'https://code.jquery.com/jquery-3.6.0.min.js';
        jqueryScript.onload = function() {
            console.log('✅ jQuery carregado via fallback');
            loadDataTables(callback);
        };
        document.head.appendChild(jqueryScript);
    } else {
        loadDataTables(callback);
    }
}

function loadDataTables(callback) {
    // Carregar DataTables se não estiver disponível
    if (typeof window.jQuery.fn.DataTable === 'undefined') {
        const dtScript = document.createElement('script');
        dtScript.src = 'https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js';
        dtScript.onload = function() {
            console.log('✅ DataTables carregado via fallback');
            callback();
        };
        document.head.appendChild(dtScript);
    } else {
        callback();
    }
}

var KTContestationList = function () {
    var table = document.getElementById('kt_contestation_table');
    var dt;
    var $ = window.jQuery;

    var initDatatable = function () {
        if (!table) {
            console.error('❌ Table not found');
            return;
        }

        // Destruir DataTable existente se houver
        if ($.fn.DataTable.isDataTable(table)) {
            $(table).DataTable().destroy();
        }

        // Configuração do DataTable
        dt = $(table).DataTable({
            responsive: false,
            searchDelay: 500,
            processing: false,
            serverSide: false,
            paging: true,
            pageLength: 5,
            lengthChange: false,
            lengthMenu: [5],
            searching: true,
            ordering: true,
            info: true,
            autoWidth: false,
            order: [[1, 'desc']],
            pagingType: 'simple_numbers',
            dom: 'rt<"row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
            language: {
                search: "",
                searchPlaceholder: "Buscar tickets...",
                info: "Exibindo _START_ a _END_ de _TOTAL_ tickets",
                infoEmpty: "Nenhum ticket encontrado",
                infoFiltered: "(filtrado de _MAX_ tickets no total)",
                paginate: {
                    next: "Próximo",
                    previous: "Anterior",
                    first: "Primeiro",
                    last: "Último"
                },
                emptyTable: "Nenhum ticket encontrado",
                zeroRecords: "Nenhum ticket encontrado"
            },
            columnDefs: [
                { orderable: false, targets: [5] },
                { searchable: true, targets: [0, 2] }
            ],
            drawCallback: function(settings) {
                console.log('🔄 DataTable redesenhado');
                // Reaplica os event listeners após cada desenho
                setTimeout(function() {
                    handleTicketActions();
                }, 50);

                // Forçar exibição da paginação
                $('.dataTables_paginate').show();
                $('.dataTables_info').show();
            },
            initComplete: function() {
                console.log('✅ DataTable initialized successfully');

                // Forçar configurações de paginação
                this.api().page.len(5);

                // Garantir que a paginação seja visível
                $('.dataTables_wrapper .dataTables_paginate').css({
                    'display': 'block !important',
                    'visibility': 'visible !important'
                });

                $('.dataTables_wrapper .dataTables_info').css({
                    'display': 'block !important',
                    'visibility': 'visible !important'
                });

                handleTicketActions();

                // Log de debug
                console.log('📊 Total de registros:', this.api().data().length);
                console.log('📄 Registros por página:', this.api().page.len());
            }
        });

        // Event listener para busca personalizada
        const searchInput = document.querySelector('[data-kt-table-filter="search"]');
        if (searchInput) {
            searchInput.addEventListener('keyup', function (e) {
                if (dt) {
                    dt.search(e.target.value).draw();
                }
            });
        }

        // Forçar redesenho para garantir paginação
        setTimeout(function() {
            if (dt) {
                dt.draw(false);
                console.log('🔄 Redesenho forçado para garantir paginação');
            }
        }, 500);
    }

    var handleFilters = function () {
        const filterButton = document.querySelector('[data-kt-table-filter="filter"]');
        const resetButton = document.querySelector('[data-kt-table-filter="reset"]');

        if (filterButton) {
            filterButton.addEventListener('click', function () {
                const filterStatus = document.querySelector('[data-kt-table-filter="status"]').value;
                const filterPriority = document.querySelector('[data-kt-table-filter="priority"]').value;

                if (dt) {
                    if (filterStatus) {
                        dt.column(3).search(filterStatus);
                    }
                    if (filterPriority) {
                        dt.column(4).search(filterPriority);
                    }
                    dt.draw();
                }
            });
        }

        if (resetButton) {
            resetButton.addEventListener('click', function () {
                document.querySelector('[data-kt-table-filter="status"]').value = '';
                document.querySelector('[data-kt-table-filter="priority"]').value = '';
                if (dt) {
                    dt.search('').columns().search('').draw();
                }
            });
        }
    }

    var handleTicketActions = function () {
        console.log('🔗 Setting up event listeners for ticket actions');

        // Remover event listeners anteriores para evitar duplicatas
        $('.ticket-link, .ticket-subject-link, .ticket-view-btn, .ticket-close-btn, .ticket-delete-btn').off('click');

        // Links nos IDs dos tickets
        $('.ticket-link').on('click', function(e) {
            e.preventDefault();
            const ticketId = $(this).data('ticket-id');
            console.log('🎫 Abrindo thread do ticket:', ticketId);
            KTModalTicketThread.showTicket(ticketId);
        });

        // Links nos assuntos dos tickets
        $('.ticket-subject-link').on('click', function(e) {
            e.preventDefault();
            const ticketId = $(this).data('ticket-id');
            console.log('🎫 Abrindo thread do ticket via assunto:', ticketId);
            KTModalTicketThread.showTicket(ticketId);
        });

        // Botões de visualizar (olho)
        $('.ticket-view-btn').on('click', function(e) {
            e.preventDefault();
            const ticketId = $(this).data('ticket-id');
            console.log('👁️ Visualizando ticket:', ticketId);
            KTModalTicketThread.showTicket(ticketId);
        });

        // Botões de encerrar (check)
        $('.ticket-close-btn').on('click', function(e) {
            e.preventDefault();
            const ticketId = $(this).data('ticket-id');
            console.log('✅ Encerrando ticket:', ticketId);
            handleCloseTicket(ticketId);
        });

        // Botões de excluir (lixeira)
        $('.ticket-delete-btn').on('click', function(e) {
            e.preventDefault();
            const ticketId = $(this).data('ticket-id');
            console.log('🗑️ Excluindo ticket:', ticketId);
            handleDeleteTicket(ticketId);
        });

        console.log('✅ Event listeners set up');
    }

    var handleCloseTicket = function(ticketId) {
        if (typeof Swal === 'undefined') {
            console.error('❌ SweetAlert not available');
            alert(`Deseja encerrar o ticket ${ticketId}?`);
            return;
        }

        Swal.fire({
            title: "Close Ticket",
            text: `Are you sure you want to close ticket ${ticketId}? The ticket will be marked as resolved.`,
            icon: "warning",
            showCancelButton: true,
            buttonsStyling: false,
            confirmButtonText: "Yes, close!",
            cancelButtonText: "Cancel",
            customClass: {
                confirmButton: "btn btn-warning",
                cancelButton: "btn btn-active-light"
            }
        }).then(function (result) {
            if (result.isConfirmed) {
                Swal.fire({
                    title: "Ticket Closed!",
                    text: `Ticket ${ticketId} was closed successfully.`,
                    icon: "success",
                    buttonsStyling: false,
                    confirmButtonText: "Ok",
                    customClass: {
                        confirmButton: "btn btn-pink"
                    }
                }).then(function() {
                    // Simulate status change to "Resolved"
                    const row = $(`[data-ticket-id="${ticketId}"]`).closest('tr');
                    if (row.length) {
                        row.find('td:eq(3) .badge').removeClass('badge-light-warning badge-light-primary').addClass('badge-light-success').text('Resolved');
                    }
                });
            }
        });
    }

    var handleDeleteTicket = function(ticketId) {
        if (typeof Swal === 'undefined') {
            console.error('❌ SweetAlert not available');
            if (confirm(`Deseja excluir permanentemente o ticket ${ticketId}?`)) {
                const row = $(`[data-ticket-id="${ticketId}"]`).closest('tr');
                if (row.length && dt) {
                    dt.row(row).remove().draw();
                }
            }
            return;
        }

        Swal.fire({
            title: "Delete Ticket",
            text: `Are you sure you want to permanently delete ticket ${ticketId}? This action cannot be undone.`,
            icon: "error",
            showCancelButton: true,
            buttonsStyling: false,
            confirmButtonText: "Yes, delete!",
            cancelButtonText: "Cancel",
            customClass: {
                confirmButton: "btn btn-danger",
                cancelButton: "btn btn-active-light"
            }
        }).then(function (result) {
            if (result.isConfirmed) {
                Swal.fire({
                    title: "Deleted!",
                    text: `Ticket ${ticketId} was permanently deleted.`,
                    icon: "success",
                    buttonsStyling: false,
                    confirmButtonText: "Ok",
                    customClass: {
                        confirmButton: "btn btn-pink"
                    }
                }).then(function() {
                    // Remove row from table
                    const row = $(`[data-ticket-id="${ticketId}"]`).closest('tr');
                    if (row.length && dt) {
                        dt.row(row).remove().draw();
                    }
                });
            }
        });
    }

    return {
        init: function () {
            if (!table) {
                console.error('❌ Table not found');
                return;
            }

            console.log('🚀 Inicializando KTContestationList...');

            waitForDependencies(function() {
                // Aguardar um pouco mais para garantir que tudo está carregado
                setTimeout(function() {
                    initDatatable();
                    handleFilters();
                    handleTicketActions();

                    console.log('✅ KTContestationList inicializado com sucesso');
                }, 200);
            });
        }
    }
}();

var KTModalNewTicket = function () {
    var submitButton;
    var cancelButton;
    var validator;
    var form;
    var modal;
    var $ = window.jQuery;

    var initModal = function () {
        const modalElement = document.querySelector('#kt_modal_new_ticket');
        if (modalElement && typeof bootstrap !== 'undefined') {
            modal = new bootstrap.Modal(modalElement);
            
            // Adicionar event listener para o botão X da modal
            const closeButton = modalElement.querySelector('[data-bs-dismiss="modal"]');
            if (closeButton) {
                closeButton.removeEventListener('click', handleModalClose);
                closeButton.addEventListener('click', handleModalClose);
            }
            
            // Adicionar event listener para quando a modal é fechada
            modalElement.addEventListener('hidden.bs.modal', function() {
                console.log('🔴 Modal fechada via Bootstrap');
                
                // Limpar arquivos selecionados
                if (typeof clearUploadFiles === 'function') {
                    clearUploadFiles();
                }
                
                // Resetar formulário
                if (form) {
                    form.reset();
                }
                
                // Garantir que o backdrop seja removido
                setTimeout(function() {
                    const backdrop = document.querySelector('.modal-backdrop');
                    if (backdrop) {
                        backdrop.remove();
                    }
                    
                    // Remover classes do body
                    document.body.classList.remove('modal-open');
                    document.body.style.overflow = '';
                    document.body.style.paddingRight = '';
                }, 100);
            });
            
            // Adicionar event listener para clicar fora da modal
            modalElement.addEventListener('click', function(e) {
                if (e.target === modalElement) {
                    console.log('🔴 Clicou fora da modal');
                    
                    // Limpar arquivos selecionados
                    if (typeof clearUploadFiles === 'function') {
                        clearUploadFiles();
                    }
                    
                    // Resetar formulário
                    if (form) {
                        form.reset();
                    }
                    
                    // Fechar modal
                    closeModalProperly();
                }
            });
            
            // Adicionar event listener para tecla ESC
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') {
                    const modalElement = document.getElementById('kt_modal_new_ticket');
                    if (modalElement && modalElement.classList.contains('show')) {
                        console.log('🔴 Tecla ESC pressionada');
                        closeModalProperly();
                    }
                }
            });
        }
    }

    var handleModalClose = function(e) {
        e.preventDefault();
        e.stopPropagation();
        
        console.log('🔴 Botão X clicado');
        
        // Limpar arquivos selecionados
        if (typeof clearUploadFiles === 'function') {
            clearUploadFiles();
        }
        
        // Resetar formulário
        if (form) {
            form.reset();
        }
        
        // Fechar modal
        closeModalProperly();
    };

    var closeModalProperly = function() {
        const modalElement = document.getElementById('kt_modal_new_ticket');
        if (!modalElement) return;
        
        // Remover aria-hidden primeiro
        modalElement.removeAttribute('aria-hidden');
        
        // Tentar fechar via Bootstrap primeiro
        if (modal) {
            console.log('🔴 Fechando modal via modal.hide()');
            modal.hide();
        } else {
            const bsModal = bootstrap.Modal.getInstance(modalElement);
            if (bsModal) {
                console.log('🔴 Fechando modal via bootstrap.Modal.getInstance()');
                bsModal.hide();
            } else {
                console.log('🔴 Forçando fechamento da modal');
                // Forçar fechamento completo
                modalElement.classList.remove('show');
                modalElement.style.display = 'none';
                modalElement.removeAttribute('aria-hidden');
                modalElement.setAttribute('aria-hidden', 'false');
                
                // Remover classes do body
                document.body.classList.remove('modal-open');
                document.body.style.overflow = '';
                document.body.style.paddingRight = '';
                
                // Remover backdrop
                const backdrop = document.querySelector('.modal-backdrop');
                if (backdrop) {
                    backdrop.remove();
                }
                
                // Remover todos os backdrops que possam existir
                const allBackdrops = document.querySelectorAll('.modal-backdrop');
                allBackdrops.forEach(backdrop => backdrop.remove());
            }
        }
    };

    var initForm = function () {
        form = document.querySelector('#kt_modal_new_ticket_form');
        if (!form) return;

        submitButton = form.querySelector('[data-kt-tickets-modal-action="submit"]');
        cancelButton = form.querySelector('[data-kt-tickets-modal-action="cancel"]');

        if (typeof FormValidation !== 'undefined') {
            validator = FormValidation.formValidation(
                form,
                {
                    fields: {
                        'problem_type': {
                            validators: {
                                notEmpty: {
                                    message: 'Tipo de problema é obrigatório'
                                }
                            }
                        },
                        'description': {
                            validators: {
                                notEmpty: {
                                    message: 'Descrição é obrigatória'
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
        }

        if (submitButton) {
            submitButton.addEventListener('click', function (e) {
                e.preventDefault();

                if (validator) {
                    validator.validate().then(function (status) {
                        if (status == 'Valid') {
                            submitButton.setAttribute('data-kt-indicator', 'on');
                            submitButton.disabled = true;

                            setTimeout(function () {
                                submitButton.removeAttribute('data-kt-indicator');
                                submitButton.disabled = false;

                                if (typeof Swal !== 'undefined') {
                                    Swal.fire({
                                        text: "Contestation sent successfully!",
                                        icon: "success",
                                        buttonsStyling: false,
                                        confirmButtonText: "Ok",
                                        customClass: {
                                            confirmButton: "btn btn-pink"
                                        }
                                    }).then(function (result) {
                                        if (result.isConfirmed && modal) {
                                            modal.hide();
                                            form.reset();
                                            location.reload();
                                        }
                                    });
                                } else {
                                    alert('Contestation sent successfully!');
                                    if (modal) {
                                        modal.hide();
                                        form.reset();
                                        location.reload();
                                    }
                                }
                            }, 2000);
                        }
                    });
                } else {
                    // Fallback sem validação
                    setTimeout(function () {
                        if (typeof Swal !== 'undefined') {
                            Swal.fire({
                                text: "Contestation sent successfully!",
                                icon: "success",
                                buttonsStyling: false,
                                confirmButtonText: "Ok",
                                customClass: {
                                    confirmButton: "btn btn-pink"
                                }
                            }).then(function (result) {
                                if (result.isConfirmed && modal) {
                                    modal.hide();
                                    form.reset();
                                    location.reload();
                                }
                            });
                        } else {
                            alert('Contestation sent successfully!');
                            if (modal) {
                                modal.hide();
                                form.reset();
                                location.reload();
                            }
                        }
                    }, 1000);
                }
            });
        }

        if (cancelButton) {
            // Remover event listeners anteriores para evitar duplicatas
            cancelButton.removeEventListener('click', handleCancelClick);
            cancelButton.addEventListener('click', handleCancelClick);
        }
        
        function handleCancelClick(e) {
            e.preventDefault();
            e.stopPropagation();
            
            console.log('🔴 Botão Cancelar clicado - ÚNICA VEZ');
            
            // Limpar arquivos selecionados
            if (typeof clearUploadFiles === 'function') {
                clearUploadFiles();
            }
            
            // Resetar formulário
            if (form) {
                form.reset();
            }
            
            // Fechar modal corretamente
            closeModalProperly();
        }

        // Adicionar funcionalidade para o campo de upload
        initUploadField();
        
        // Event listener para o botão X da modal (remover duplicatas)
        const closeButton = document.querySelector('#kt_modal_new_ticket [data-bs-dismiss="modal"]');
        if (closeButton) {
            closeButton.removeEventListener('click', handleModalClose);
            closeButton.addEventListener('click', handleModalClose);
        }
    }

    var initUploadField = function() {
        const uploadInput = document.getElementById('screenshots_upload');
        const uploadArea = document.querySelector('.upload-area');
        const uploadPlaceholder = document.getElementById('upload_placeholder');
        const uploadPreview = document.getElementById('upload_preview');
        const selectedFiles = document.getElementById('selected_files');
        const clearFilesBtn = document.getElementById('clear_files');

        if (!uploadInput || !uploadArea) return;

        // Drag and drop functionality
        uploadArea.addEventListener('dragover', function(e) {
            e.preventDefault();
            uploadArea.classList.add('dragover');
        });

        uploadArea.addEventListener('dragleave', function(e) {
            e.preventDefault();
            uploadArea.classList.remove('dragover');
        });

        uploadArea.addEventListener('drop', function(e) {
            e.preventDefault();
            uploadArea.classList.remove('dragover');
            const files = e.dataTransfer.files;
            handleFileSelection(files);
        });

        // Click to select files
        uploadArea.addEventListener('click', function() {
            uploadInput.click();
        });

        // File input change
        uploadInput.addEventListener('change', function(e) {
            handleFileSelection(e.target.files);
        });

        // Clear files button
        if (clearFilesBtn) {
            clearFilesBtn.addEventListener('click', function() {
                clearUploadFiles();
            });
        }

        function handleFileSelection(files) {
            if (!files || files.length === 0) return;

            const maxFiles = 5;
            const allowedTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif'];

            // Limpar arquivos anteriores se exceder o limite
            if (uploadInput.files.length + files.length > maxFiles) {
                if (typeof Swal !== 'undefined') {
                    Swal.fire({
                        text: `Máximo de ${maxFiles} arquivos permitido`,
                        icon: "warning",
                        buttonsStyling: false,
                        confirmButtonText: "Ok",
                        customClass: {
                            confirmButton: "btn btn-pink"
                        }
                    });
                } else {
                    alert(`Máximo de ${maxFiles} arquivos permitido`);
                }
                return;
            }

            // Verificar tipos de arquivo
            for (let file of files) {
                if (!allowedTypes.includes(file.type)) {
                    if (typeof Swal !== 'undefined') {
                        Swal.fire({
                            text: `Arquivo ${file.name} não é uma imagem válida`,
                            icon: "warning",
                            buttonsStyling: false,
                            confirmButtonText: "Ok",
                            customClass: {
                                confirmButton: "btn btn-pink"
                            }
                        });
                    } else {
                        alert(`Arquivo ${file.name} não é uma imagem válida`);
                    }
                    return;
                }
            }

            // Adicionar arquivos ao input
            const dt = new DataTransfer();
            const currentFiles = Array.from(uploadInput.files);
            const newFiles = Array.from(files);
            
            [...currentFiles, ...newFiles].forEach(file => {
                dt.items.add(file);
            });
            
            uploadInput.files = dt.files;

            // Atualizar preview
            updateFilePreview();
        }

        function updateFilePreview() {
            const files = Array.from(uploadInput.files);
            
            if (files.length === 0) {
                uploadPlaceholder.style.display = 'block';
                uploadPreview.style.display = 'none';
                return;
            }

            uploadPlaceholder.style.display = 'none';
            uploadPreview.style.display = 'block';

            selectedFiles.innerHTML = '';
            files.forEach((file, index) => {
                const fileItem = document.createElement('div');
                fileItem.className = 'file-item';
                fileItem.innerHTML = `
                    <span class="file-name" title="${file.name}">${file.name}</span>
                    <span class="file-remove" onclick="removeFile(${index})">&times;</span>
                `;
                selectedFiles.appendChild(fileItem);
            });
        }

        function clearUploadFiles() {
            uploadInput.value = '';
            uploadPlaceholder.style.display = 'block';
            uploadPreview.style.display = 'none';
            selectedFiles.innerHTML = '';
        }

        // Função global para remover arquivo
        window.removeFile = function(index) {
            const dt = new DataTransfer();
            const files = Array.from(uploadInput.files);
            files.splice(index, 1);
            
            files.forEach(file => {
                dt.items.add(file);
            });
            
            uploadInput.files = dt.files;
            updateFilePreview();
        };

        // Função global para limpar arquivos
        window.clearUploadFiles = function() {
            if (uploadInput) {
                uploadInput.value = '';
            }
            if (uploadPlaceholder) {
                uploadPlaceholder.style.display = 'block';
            }
            if (uploadPreview) {
                uploadPreview.style.display = 'none';
            }
            if (selectedFiles) {
                selectedFiles.innerHTML = '';
            }
        };
    }

    return {
        init: function () {
            initModal();
            initForm();
        }
    }
}();

var KTModalTicketThread = function () {
    var modal;
    var form;
    var $ = window.jQuery;

    var initModal = function () {
        const modalElement = document.querySelector('#kt_modal_ticket_thread');
        if (modalElement && typeof bootstrap !== 'undefined') {
            modal = new bootstrap.Modal(modalElement);
        }
    }

    var initForm = function () {
        form = document.querySelector('#kt_ticket_response_form');

        if (form) {
            form.addEventListener('submit', function(e) {
                e.preventDefault();

                const responseText = form.querySelector('[name="response_text"]').value;

                if (!responseText.trim()) {
                    if (typeof Swal !== 'undefined') {
                        Swal.fire({
                            text: "Please enter a response.",
                            icon: "warning",
                            buttonsStyling: false,
                            confirmButtonText: "Ok",
                            customClass: {
                                confirmButton: "btn btn-pink"
                            }
                        });
                    } else {
                        alert("Please enter a response.");
                    }
                    return;
                }

                if (typeof Swal !== 'undefined') {
                    Swal.fire({
                        text: "Response sent successfully!",
                        icon: "success",
                        buttonsStyling: false,
                        confirmButtonText: "Ok",
                        customClass: {
                            confirmButton: "btn btn-pink"
                        }
                    }).then(function (result) {
                        if (result.isConfirmed) {
                            form.reset();
                            if (modal) modal.hide();
                        }
                    });
                } else {
                    alert("Response sent successfully!");
                    form.reset();
                    if (modal) modal.hide();
                }
            });
        }
    }

    var getTicketThreadData = function(ticketId) {
        const ticketData = {
            'CTT-001': {
                title: 'Lead com dados incorretos',
                status: 'Em Análise',
                priority: 'Alta',
                created: '15/01/2024 14:30',
                thread: [
                    {
                        author: 'Você',
                        date: '15/01/2024 14:30',
                        message: 'Recebi um lead com telefone inválido (11999999999) e e-mail inexistente (teste@inexistente.com). Não consegui fazer contato.',
                        type: 'user'
                    },
                    {
                        author: 'Equipe Suporte',
                        date: '15/01/2024 16:15',
                        message: 'Olá! Recebemos sua contestação e já iniciamos a análise. Vamos verificar a qualidade do lead com nosso fornecedor.',
                        type: 'support'
                    },
                    {
                        author: 'Equipe Suporte',
                        date: '15/01/2024 18:45',
                        message: 'Identificamos o problema. O lead passou por uma verificação adicional e será creditado em sua conta. Obrigado pelo feedback!',
                        type: 'support'
                    }
                ]
            },
            'CTT-002': {
                title: 'Lead duplicado',
                status: 'Resolvido',
                priority: 'Média',
                created: '14/01/2024 09:15',
                thread: [
                    {
                        author: 'Você',
                        date: '14/01/2024 09:15',
                        message: 'Recebi o mesmo contato (João Silva - 11987654321) três vezes no mesmo dia. Gostaria de solicitar reembolso dos leads duplicados.',
                        type: 'user'
                    },
                    {
                        author: 'João Silva',
                        date: '14/01/2024 11:30',
                        message: 'Verificamos e confirmamos a duplicação. Já creditamos 2 leads em sua conta. Implementamos melhorias para evitar futuras duplicações.',
                        type: 'support'
                    }
                ]
            },
            'CTT-003': {
                title: 'Lead fora do segmento',
                status: 'Aberto',
                priority: 'Baixa',
                created: '13/01/2024 16:45',
                thread: [
                    {
                        author: 'Você',
                        date: '13/01/2024 16:45',
                        message: 'O lead recebido é de uma empresa do ramo alimentício, mas solicitei apenas leads do setor automotivo. A empresa não tem relação com meu negócio.',
                        type: 'user'
                    }
                ]
            },
            'CTT-004': {
                title: 'Contato inativo',
                status: 'Em Análise',
                priority: 'Média',
                created: '12/01/2024 11:20',
                thread: [
                    {
                        author: 'Você',
                        date: '12/01/2024 11:20',
                        message: 'Tentei contato várias vezes mas o número está fora de área. Aparentemente o telefone está desatualizado há muito tempo.',
                        type: 'user'
                    },
                    {
                        author: 'Maria Santos',
                        date: '12/01/2024 14:50',
                        message: 'Estamos verificando a origem deste lead em nossa base. Em breve retornaremos com uma posição.',
                        type: 'support'
                    }
                ]
            },
            'CTT-005': {
                title: 'Empresa fechada',
                status: 'Resolvido',
                priority: 'Alta',
                created: '11/01/2024 08:35',
                thread: [
                    {
                        author: 'Você',
                        date: '11/01/2024 08:35',
                        message: 'Fui até o endereço informado e a empresa não existe mais. O local está vazio há mais de 6 meses segundo vizinhos.',
                        type: 'user'
                    },
                    {
                        author: 'Pedro Costa',
                        date: '11/01/2024 15:20',
                        message: 'Confirmamos a informação. A empresa realmente encerrou atividades. Lead creditado e fornecedor notificado para atualização da base.',
                        type: 'support'
                    }
                ]
            },
            'CTT-006': {
                title: 'Lead com informações falsas',
                status: 'Aberto',
                priority: 'Alta',
                created: '10/01/2024 15:10',
                thread: [
                    {
                        author: 'Você',
                        date: '10/01/2024 15:10',
                        message: 'O lead informou dados pessoais que não conferem. O CPF não existe na Receita Federal e o endereço é de um terreno baldio.',
                        type: 'user'
                    }
                ]
            },
            'CTT-007': {
                title: 'Lead sem interesse',
                status: 'Em Análise',
                priority: 'Baixa',
                created: '09/01/2024 13:25',
                thread: [
                    {
                        author: 'Você',
                        date: '09/01/2024 13:25',
                        message: 'O contato informou que nunca demonstrou interesse em meu produto e não sabe como seus dados foram parar em nossa base.',
                        type: 'user'
                    },
                    {
                        author: 'Ana Silva',
                        date: '09/01/2024 17:40',
                        message: 'Vamos investigar a origem deste lead. Este tipo de situação é tratada com prioridade para manter a qualidade de nossa base.',
                        type: 'support'
                    }
                ]
            },
            'CTT-008': {
                title: 'Lead já cliente',
                status: 'Resolvido',
                priority: 'Média',
                created: '08/01/2024 10:50',
                thread: [
                    {
                        author: 'Você',
                        date: '08/01/2024 10:50',
                        message: 'Recebi um lead de uma pessoa que já é minha cliente há 2 anos. Não faz sentido pagar por um contato que já tenho.',
                        type: 'user'
                    },
                    {
                        author: 'Carlos Mendes',
                        date: '08/01/2024 16:30',
                        message: 'Situação compreensível. Lead creditado e implementaremos filtros para evitar leads de clientes existentes. Obrigado pelo feedback!',
                        type: 'support'
                    }
                ]
            }
        };

        return ticketData[ticketId] || null;
    }

    var renderThreadContent = function(ticketData) {
        let html = '';

        if (!ticketData || !ticketData.thread) {
            html = '<div class="text-center py-10"><span class="text-muted">Nenhuma mensagem encontrada</span></div>';
        } else {
            html += `
                <div class="mb-8">
                    <div class="d-flex justify-content-between align-items-center mb-5">
                        <div>
                            <h5 class="fw-bold text-dark">${ticketData.title}</h5>
                            <span class="text-muted fs-7">Criado em: ${ticketData.created}</span>
                        </div>
                        <div class="d-flex gap-2">
                            <span class="badge badge-light-${ticketData.status === 'Resolvido' ? 'success' : ticketData.status === 'Em Análise' ? 'warning' : 'primary'}">${ticketData.status}</span>
                            <span class="badge badge-light-${ticketData.priority === 'Alta' ? 'danger' : ticketData.priority === 'Média' ? 'info' : 'warning'}">${ticketData.priority}</span>
                        </div>
                    </div>
                </div>
            `;

            ticketData.thread.forEach(function(message, index) {
                const isUser = message.type === 'user';
                html += `
                    <div class="d-flex ${isUser ? 'justify-content-end' : 'justify-content-start'} mb-6">
                        <div class="w-75">
                            <div class="d-flex ${isUser ? 'justify-content-end' : 'justify-content-start'} align-items-center mb-2">
                                ${!isUser ? `<div class="symbol symbol-35px symbol-circle me-3">
                                    <div class="symbol-label bg-light-primary text-primary fw-bold fs-7">${message.author.charAt(0)}</div>
                                </div>` : ''}
                                <div class="text-${isUser ? 'end' : 'start'}">
                                    <span class="text-dark fw-bold fs-7">${message.author}</span>
                                    <span class="text-muted fs-8 ms-2">${message.date}</span>
                                </div>
                                ${isUser ? `<div class="symbol symbol-35px symbol-circle ms-3">
                                    <div class="symbol-label bg-light-pink text-pink fw-bold fs-7">V</div>
                                </div>` : ''}
                            </div>
                            <div class="p-4 rounded ${isUser ? 'bg-light-pink text-dark' : 'bg-light-primary text-dark'}" style="max-width: 100%;">
                                <div class="text-dark fw-normal">${message.message}</div>
                            </div>
                        </div>
                    </div>
                `;
            });
        }

        return html;
    }

    var showTicket = function(ticketId) {
        console.log('🎫 Exibindo thread do ticket:', ticketId);

        const ticketData = getTicketThreadData(ticketId);
        const threadContent = document.getElementById('ticket_thread_content');
        const ticketIdSpan = document.getElementById('thread_ticket_id');

        if (ticketIdSpan) {
            ticketIdSpan.textContent = '#' + ticketId;
        }

        if (threadContent) {
            threadContent.innerHTML = renderThreadContent(ticketData);
        }

        if (modal) {
            modal.show();
        }
    }

    return {
        init: function () {
            initModal();
            initForm();
        },
        showTicket: showTicket
    }
}();

// Inicialização principal
function initializeApplication() {
    console.log('🚀 Iniciando aplicação de contestation...');

    // Aguardar dependências e inicializar componentes
    waitForDependencies(function() {
        try {
            KTContestationList.init();
            KTModalNewTicket.init();
            KTModalTicketThread.init();

            console.log('✅ Aplicação inicializada com sucesso!');
        } catch (error) {
            console.error('❌ Erro ao inicializar aplicação:', error);
        }
    });
}

// Diferentes métodos de inicialização para máxima compatibilidade
if (typeof KTUtil !== 'undefined') {
    KTUtil.onDOMContentLoaded(initializeApplication);
} else if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initializeApplication);
} else {
    // DOM já carregado
    setTimeout(initializeApplication, 100);
}

// Backup - garantir que a aplicação seja inicializada
window.addEventListener('load', function() {
    setTimeout(function() {
        if (!window.appInitialized) {
            console.log('🔄 Executando inicialização de backup...');
            initializeApplication();
            window.appInitialized = true;
        }
    }, 1000);
});
</script>