<script>
// JavaScript para a página de Carteira de Clientes

document.addEventListener('DOMContentLoaded', function() {
    // Inicializar componentes
    initializeCustomerTable();
    initializeRelationshipModal();
    initializeFormValidation();
    initializeToggleSwitches();
    initializeViewSwitch();
});

// Dados simulados dos clientes
const customersData = {
    1: {
        name: 'João Silva',
        type: 'Pessoa Física',
        phone: '(11) 99999-9999',
        city: 'São Paulo',
        company: '',
        position: '',
        relationshipStatus: false
    },
    2: {
        name: 'Maria Santos',
        type: 'Pessoa Jurídica',
        phone: '(11) 88888-8888',
        city: 'Rio de Janeiro',
        company: 'Tech Solutions Ltda',
        position: 'Diretora Comercial',
        relationshipStatus: true
    },
    3: {
        name: 'Carlos Oliveira',
        type: 'Adesão',
        phone: '(11) 77777-7777',
        city: 'Belo Horizonte',
        company: '',
        position: '',
        relationshipStatus: false
    }
};

// Inicializar tabela de clientes
function initializeCustomerTable() {
    // Configurar DataTable se necessário
    if (typeof $.fn.DataTable !== 'undefined') {
        $('#kt_customers_table').DataTable({
            responsive: true,
            pageLength: 10,
            language: {
                url: '//cdn.datatables.net/plug-ins/1.13.7/i18n/pt-BR.json'
            }
        });
    }
    
    // Configurar filtros
    setupTableFilters();
    
    // Configurar eventos dos switches de relacionamento
    setupRelationshipSwitches();
}

// Configurar filtros da tabela
function setupTableFilters() {
    // Filtro por tipo de cliente
    $('[data-kt-customer-table-filter="customer_type"]').on('change', function() {
        const filterValue = $(this).val();
        filterTableByColumn(1, filterValue); // Coluna do tipo
    });
    
    // Filtro por status do relacionamento
    $('[data-kt-customer-table-filter="relationship_status"]').on('change', function() {
        const filterValue = $(this).val();
        filterTableByRelationshipStatus(filterValue);
    });
    
    // Filtro de busca
    $('[data-kt-customer-table-filter="search"]').on('keyup', function() {
        const searchValue = $(this).val().toLowerCase();
        filterTableBySearch(searchValue);
    });
}

// Filtrar tabela por coluna
function filterTableByColumn(columnIndex, filterValue) {
    const table = $('#kt_customers_table tbody');
    const rows = table.find('tr');
    
    rows.each(function() {
        const cell = $(this).find('td').eq(columnIndex);
        const cellText = cell.text().toLowerCase();
        
        if (filterValue === '' || cellText.includes(filterValue.toLowerCase())) {
            $(this).show();
        } else {
            $(this).hide();
        }
    });
}

// Filtrar tabela por status do relacionamento
function filterTableByRelationshipStatus(status) {
    const table = $('#kt_customers_table tbody');
    const rows = table.find('tr');
    
    rows.each(function() {
        const switchInput = $(this).find('input[type="checkbox"][data-customer-id]');
        const isActive = switchInput.is(':checked');
        
        if (status === 'all' || 
            (status === 'active' && isActive) || 
            (status === 'inactive' && !isActive)) {
            $(this).show();
        } else {
            $(this).hide();
        }
    });
}

// Filtrar tabela por busca
function filterTableBySearch(searchValue) {
    const table = $('#kt_customers_table tbody');
    const rows = table.find('tr');
    
    rows.each(function() {
        const rowText = $(this).text().toLowerCase();
        
        if (rowText.includes(searchValue)) {
            $(this).show();
        } else {
            $(this).hide();
        }
    });
}

// Configurar switches de relacionamento
function setupRelationshipSwitches() {
    // Abrir modal ao clicar no switch
    $('input[type="checkbox"][data-customer-id]').on('change', function(e) {
        const customerId = $(this).data('customer-id');
        const $checkbox = $(this);
        const isChecked = $checkbox.is(':checked');
        
        // Atualizar label
        const $label = $checkbox.siblings('label').find('.switch-label');
        if ($label.length > 0) {
            $label.text(isChecked ? 'Ativo' : 'Inativo');
        }
        
        // Abrir modal de relacionamento
        const modalElement = document.getElementById('kt_modal_relationship_management');
        if (modalElement) {
            const modal = new bootstrap.Modal(modalElement);
            
            // Carregar dados do cliente
            if (customerId && customersData[customerId]) {
                loadCustomerData(customerId);
            }
            
            modal.show();
        }
    });
    
    // Abrir modal ao clicar no nome do cliente
    $('a[data-customer-id]').on('click', function(e) {
        e.preventDefault();
        const customerId = $(this).data('customer-id');
        
        // Abrir modal de relacionamento
        const modalElement = document.getElementById('kt_modal_relationship_management');
        if (modalElement) {
            const modal = new bootstrap.Modal(modalElement);
            
            // Carregar dados do cliente
            if (customerId && customersData[customerId]) {
                loadCustomerData(customerId);
            }
            
            modal.show();
        }
    });
}

// Inicializar modal de relacionamento
function initializeRelationshipModal() {
    const modal = $('#kt_modal_relationship_management');
    
    // Evento de abertura do modal
    modal.on('show.bs.modal', function(event) {
        const button = $(event.relatedTarget);
        const customerId = button.data('customer-id');
        
        if (customerId && customersData[customerId]) {
            loadCustomerData(customerId);
        }
    });
    
    // Evento de fechamento do modal
    modal.on('hidden.bs.modal', function() {
        resetModalForm();
    });
    
    // Configurar botões do modal
    setupModalButtons();
    
    // Configurar toggles das seções
    setupSectionToggles();
}

// Carregar dados do cliente no modal
function loadCustomerData(customerId) {
    const customer = customersData[customerId];
    
    if (customer) {
        // Preencher informações do cliente
        $('#customer_id').val(customerId);
        $('#customer_name').text(customer.name);
        $('#customer_type').text(customer.type);
        $('#customer_phone').text(customer.phone);
        $('#customer_city').text(customer.city);
        
        // Carregar configurações salvas (simulado)
        loadSavedSettings(customerId);
    }
}

// Carregar configurações salvas (simulado)
function loadSavedSettings(customerId) {
    // Simular carregamento de configurações salvas
    const savedSettings = getSavedSettings(customerId);
    
    // Aplicar configurações aos formulários
    Object.keys(savedSettings).forEach(key => {
        const element = $(`[name="${key}"]`);
        if (element.length) {
            if (element.is(':checkbox')) {
                element.prop('checked', savedSettings[key]);
            } else {
                element.val(savedSettings[key]);
            }
        }
    });
    
    // Atualizar visibilidade das seções
    updateSectionVisibility();
}

// Obter configurações salvas (simulado)
function getSavedSettings(customerId) {
    // Simular dados salvos
    return {
        'anniversary_members_active': true,
        'anniversary_members_action': 'message',
        'company_anniversary_active': false,
        'company_anniversary_action': 'reminder',
        'marriage_anniversary_active': true,
        'marriage_anniversary_action': 'message',
        'fathers_day_active': false,
        'fathers_day_action': 'reminder',
        'mothers_day_active': true,
        'mothers_day_action': 'message',
        'childrens_day_active': false,
        'childrens_day_action': 'reminder',
        'religious_dates_active': true,
        'religious_dates_action': 'message',
        'billing_due_active': true,
        'billing_due_action': 'message',
        'plan_renewal_active': false,
        'plan_renewal_action': 'reminder',
        'plan_updates_active': true,
        'plan_updates_action': 'message',
        'custom_benefits_active': false,
        'custom_benefits_action': 'reminder',
        'custom_dates_active': true,
        'custom_dates_action': 'message'
    };
}

// Configurar botões do modal
function setupModalButtons() {
    // Botão de cancelar
    $('#kt_modal_relationship_management_cancel').on('click', function() {
        $('#kt_modal_relationship_management').modal('hide');
    });
    
    // Botão de fechar
    $('#kt_modal_relationship_management_close').on('click', function() {
        $('#kt_modal_relationship_management').modal('hide');
    });
    
    // Botão de salvar
    $('#kt_modal_relationship_management_submit').on('click', function() {
        saveRelationshipSettings();
    });
}

// Salvar configurações de relacionamento
function saveRelationshipSettings() {
    const customerId = $('#customer_id').val();
    const form = $('#kt_relationship_management_form');
    
    // Validar formulário
    if (!validateForm()) {
        return;
    }
    
    // Mostrar loading
    const submitBtn = $('#kt_modal_relationship_management_submit');
    submitBtn.addClass('loading');
    
    // Simular salvamento
    setTimeout(() => {
        // Coletar dados do formulário
        const formData = collectFormData();
        
        // Salvar configurações (simulado)
        saveSettings(customerId, formData);
        
        // Esconder loading
        submitBtn.removeClass('loading');
        
        // Mostrar sucesso
        showNotification('Configurações salvas com sucesso!', 'success');
        
        // Fechar modal
        $('#kt_modal_relationship_management').modal('hide');
        
    }, 1500);
}

// Coletar dados do formulário
function collectFormData() {
    const formData = {};
    
    // Coletar todos os campos do formulário
    $('#kt_relationship_management_form').find('input, select, textarea').each(function() {
        const $this = $(this);
        const name = $this.attr('name');
        
        if (name) {
            if ($this.is(':checkbox')) {
                formData[name] = $this.is(':checked');
            } else if ($this.is('select[multiple]')) {
                formData[name] = $this.val() || [];
            } else {
                formData[name] = $this.val();
            }
        }
    });
    
    return formData;
}

// Salvar configurações (simulado)
function saveSettings(customerId, settings) {
    // Simular salvamento no localStorage
    localStorage.setItem(`customer_settings_${customerId}`, JSON.stringify(settings));
    
    // Atualizar status do relacionamento na tabela
    const isActive = Object.values(settings).some(value => value === true);
    const switchInput = $(`input[data-customer-id="${customerId}"]`);
    switchInput.prop('checked', isActive);
    
    // Atualizar label
    const label = switchInput.siblings('label').find('.switch-label');
    label.text(isActive ? 'Ativo' : 'Inativo');
}

// Validar formulário
function validateForm() {
    let isValid = true;
    
    // Validar campos obrigatórios quando as seções estão ativas
    $('.form-check-input[type="checkbox"]').each(function() {
        const $this = $(this);
        const isActive = $this.is(':checked');
        const sectionId = $this.attr('id').replace('_active', '');
        const sectionForm = $(`#${sectionId}_form`);
        
        if (isActive) {
            // Validar campos obrigatórios da seção
            sectionForm.find('input[required], select[required], textarea[required]').each(function() {
                const $field = $(this);
                if (!$field.val()) {
                    $field.addClass('is-invalid');
                    isValid = false;
                } else {
                    $field.removeClass('is-invalid');
                }
            });
        }
    });
    
    return isValid;
}

// Configurar toggles das seções
function setupSectionToggles() {
    $('.form-check-input[type="checkbox"]').on('change', function() {
        updateSectionVisibility();
    });
}

// Atualizar visibilidade das seções
function updateSectionVisibility() {
    $('.form-check-input[type="checkbox"]').each(function() {
        const $this = $(this);
        const isActive = $this.is(':checked');
        const sectionId = $this.attr('id').replace('_active', '');
        const sectionForm = $(`#${sectionId}_form`);
        
        if (isActive) {
            sectionForm.removeClass('inactive-section');
            sectionForm.find('input, select, textarea').prop('disabled', false);
        } else {
            sectionForm.addClass('inactive-section');
            sectionForm.find('input, select, textarea').prop('disabled', true);
        }
    });
}

// Inicializar validação de formulário
function initializeFormValidation() {
    // Validação em tempo real
    $('input, select, textarea').on('blur', function() {
        validateField($(this));
    });
    
    // Limpar validação ao digitar
    $('input, select, textarea').on('input', function() {
        $(this).removeClass('is-invalid');
    });
}

// Validar campo individual
function validateField($field) {
    const value = $field.val();
    const isRequired = $field.prop('required');
    
    if (isRequired && !value) {
        $field.addClass('is-invalid');
        return false;
    } else {
        $field.removeClass('is-invalid');
        return true;
    }
}

// Inicializar switches customizados
function initializeToggleSwitches() {
    // Configurar switches do Bootstrap
    $('.form-switch .form-check-input').on('change', function() {
        const $this = $(this);
        const isChecked = $this.is(':checked');
        const label = $this.siblings('label');
        
        // Atualizar classe do label
        if (isChecked) {
            label.removeClass('text-muted').addClass('text-primary');
        } else {
            label.removeClass('text-primary').addClass('text-muted');
        }
    });
}

// Funções para adicionar linhas dinâmicas
function addMemberRow() {
    const container = $('#anniversary_members_form');
    const newRow = `
        <div class="row mb-5 member-row">
            <div class="col-md-4">
                <label class="form-label fs-6 fw-semibold mb-2">Nome</label>
                <input type="text" class="form-control form-control-solid" name="member_name[]" placeholder="Nome do membro">
            </div>
            <div class="col-md-4">
                <label class="form-label fs-6 fw-semibold mb-2">Data de Nascimento</label>
                <input type="date" class="form-control form-control-solid" name="member_birthdate[]">
            </div>
            <div class="col-md-4">
                <label class="form-label fs-6 fw-semibold mb-2">Sexo</label>
                <select class="form-select form-select-solid" name="member_gender[]">
                    <option value="">Selecione</option>
                    <option value="M">Masculino</option>
                    <option value="F">Feminino</option>
                </select>
            </div>
        </div>
        <div class="row mb-5 member-row">
            <div class="col-md-12">
                <label class="form-label fs-6 fw-semibold mb-2">Grau de Relacionamento</label>
                <select class="form-select form-select-solid" name="member_relationship[]">
                    <option value="">Selecione</option>
                    <option value="titular">Titular</option>
                    <option value="marido">Marido</option>
                    <option value="esposa">Esposa</option>
                    <option value="parceiro">Parceiro(a)</option>
                    <option value="filho">Filho(a)</option>
                    <option value="mae">Mãe</option>
                    <option value="pai">Pai</option>
                    <option value="avo">Avô</option>
                    <option value="ava">Avó</option>
                    <option value="tio">Tio(a)</option>
                    <option value="sogro">Sogro(a)</option>
                    <option value="socio">Sócio(a)</option>
                    <option value="funcionario">Funcionário/colaborador</option>
                    <option value="outro">Outro</option>
                </select>
            </div>
        </div>
    `;
    
    container.append(newRow);
}

function addBenefitRow() {
    const container = $('#custom_benefits_form');
    const newRow = `
        <div class="row mb-5 benefit-row">
            <div class="col-md-6">
                <label class="form-label fs-6 fw-semibold mb-2">Nome do Benefício</label>
                <input type="text" class="form-control form-control-solid" name="benefit_name[]" placeholder="Ex: Check-up anual">
            </div>
            <div class="col-md-6">
                <label class="form-label fs-6 fw-semibold mb-2">Data/Período</label>
                <input type="text" class="form-control form-control-solid" name="benefit_date[]" placeholder="Ex: Janeiro de cada ano">
            </div>
        </div>
    `;
    
    container.append(newRow);
}

// Resetar formulário do modal
function resetModalForm() {
    $('#kt_relationship_management_form')[0].reset();
    $('.form-check-input').prop('checked', false);
    $('.form-control, .form-select').removeClass('is-invalid');
    updateSectionVisibility();
}

// Mostrar notificação
function showNotification(message, type = 'info') {
    // Usar toast do Bootstrap se disponível
    if (typeof bootstrap !== 'undefined' && bootstrap.Toast) {
        const toastHtml = `
            <div class="toast align-items-center text-white bg-${type === 'success' ? 'success' : type === 'warning' ? 'warning' : type === 'error' ? 'danger' : 'info'} border-0" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="d-flex">
                    <div class="toast-body">
                        ${message}
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
            </div>
        `;
        
        const toastContainer = $('#toast-container');
        if (toastContainer.length === 0) {
            $('body').append('<div id="toast-container" class="toast-container position-fixed top-0 end-0 p-3"></div>');
        }
        
        const toastElement = $(toastHtml);
        $('#toast-container').append(toastElement);
        
        const toast = new bootstrap.Toast(toastElement[0]);
        toast.show();
        
        // Remover elemento após ser escondido
        toastElement.on('hidden.bs.toast', function() {
            $(this).remove();
        });
    } else {
        // Fallback para alert simples
        alert(message);
    }
}

// Função para exportar dados
function exportCustomers(format) {
    showNotification(`Exportando clientes em formato ${format}...`, 'info');
    
    // Simular exportação
    setTimeout(() => {
        showNotification('Exportação concluída!', 'success');
    }, 2000);
}

// Função para adicionar novo cliente
function addNewCustomer() {
    showNotification('Abrindo formulário de novo cliente...', 'info');
}

// Configurar eventos globais
$(document).ready(function() {
    // Configurar tooltips
    if (typeof bootstrap !== 'undefined' && bootstrap.Tooltip) {
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
    }
    
    // Configurar popovers
    if (typeof bootstrap !== 'undefined' && bootstrap.Popover) {
        var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'));
        var popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
            return new bootstrap.Popover(popoverTriggerEl);
        });
    }
    
    // Configurar eventos de exportação
    $('#kt_customers_export_submit').on('click', function() {
        const format = $('#kt_customers_export_form select').val();
        exportCustomers(format);
    });
    
    // Configurar eventos de adicionar cliente
    $('#kt_modal_add_customer_submit').on('click', function() {
        addNewCustomer();
    });
});

// Funções utilitárias
function formatPhone(phone) {
    return phone.replace(/(\d{2})(\d{5})(\d{4})/, '($1) $2-$3');
}

function formatDate(date) {
    return new Date(date).toLocaleDateString('pt-BR');
}

function formatCurrency(value) {
    return new Intl.NumberFormat('pt-BR', {
        style: 'currency',
        currency: 'BRL'
    }).format(value);
}

// Função para debounce
function debounce(func, wait, immediate) {
    var timeout;
    return function() {
        var context = this, args = arguments;
        var later = function() {
            timeout = null;
            if (!immediate) func.apply(context, args);
        };
        var callNow = immediate && !timeout;
        clearTimeout(timeout);
        timeout = setTimeout(later, wait);
        if (callNow) func.apply(context, args);
    };
}

// Aplicar debounce na busca
$('[data-kt-customer-table-filter="search"]').on('keyup', debounce(function() {
    const searchValue = $(this).val().toLowerCase();
    filterTableBySearch(searchValue);
}, 300));

// Inicializar switches de visualização
function initializeViewSwitches() {
    // Mostrar visualização por vigência por padrão
    $('#kt_customers_table_wrapper').hide();
    $('#view-columns-container').removeClass('d-none').show();
    
    // Handle view mode switches
    $('[data-view]').on('click', function(e) {
        e.preventDefault();
        const view = $(this).data('view');
        
        // Update active button
        $('[data-view]').removeClass('active btn-light-primary').addClass('btn-light');
        $(this).removeClass('btn-light').addClass('active btn-light-primary');
        
        // Show/hide views
        if (view === 'list') {
            $('#kt_customers_table_wrapper').show();
            $('#view-columns-container').hide();
        } else if (view === 'columns') {
            $('#kt_customers_table_wrapper').hide();
            $('#view-columns-container').removeClass('d-none').show();
        }
        
        // Update select dropdown if exists
        if ($('#viewMode').length) {
            $('#viewMode').val(view);
        }
    });

    // Handle view mode select dropdown
    $('#viewMode').on('change', function() {
        const view = $(this).val();
        
        // Update active button
        $('[data-view]').removeClass('active btn-light-primary').addClass('btn-light');
        $(`[data-view="${view}"]`).removeClass('btn-light').addClass('active btn-light-primary');
        
        // Show/hide views
        if (view === 'list') {
            $('#kt_customers_table_wrapper').show();
            $('#view-columns-container').hide();
        } else if (view === 'columns') {
            $('#kt_customers_table_wrapper').hide();
            $('#view-columns-container').removeClass('d-none').show();
        }
    });

    // Handle filter mode
    $('#filterMode').on('change', function() {
        const filter = $(this).val();
        applyFilter(filter);
    });
}

// Aplicar filtro
function applyFilter(filter) {
    const table = $('#kt_customers_table tbody');
    const rows = table.find('tr');
    
    rows.each(function() {
        const $row = $(this);
        const typeCell = $row.find('td').eq(2); // Coluna do tipo
        const switchInput = $row.find('input[type="checkbox"][data-customer-id]');
        const isActive = switchInput.is(':checked');
        
        let showRow = true;
        
        switch(filter) {
            case 'active':
                showRow = isActive;
                break;
            case 'inactive':
                showRow = !isActive;
                break;
            case 'pf':
                showRow = typeCell.text().includes('PF');
                break;
            case 'pj':
                showRow = typeCell.text().includes('PJ');
                break;
            case 'adesao':
                showRow = typeCell.text().includes('Adesão');
                break;
            case 'all':
            default:
                showRow = true;
                break;
        }
        
        $row.toggle(showRow);
    });
}

// Inicializar DataTable com paginação correta
function initializeDataTable() {
    if (typeof $.fn.DataTable !== 'undefined') {
        const table = $('#kt_customers_table');
        if (table.length) {
            table.DataTable({
                responsive: true,
                pageLength: 15, // 15 itens por página
                lengthMenu: [[10, 15, 25, 50, -1], [10, 15, 25, 50, "Todos"]],
                order: [[5, 'desc']], // Ordenar por data de criação
                columnDefs: [
                    { orderable: false, targets: 0 }, // Coluna checkbox
                    { orderable: false, targets: 6 }  // Coluna relacionamento
                ],
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.13.7/i18n/pt-BR.json'
                },
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ]
            });
        }
    }
}

// Atualizar estatísticas
function updateStatistics() {
    const totalCustomers = $('#kt_customers_table tbody tr').length;
    const activeCustomers = $('#kt_customers_table tbody tr').filter(function() {
        return $(this).find('input[type="checkbox"][data-customer-id]').is(':checked');
    }).length;
    const pfCustomers = $('#kt_customers_table tbody tr').filter(function() {
        return $(this).find('td').eq(2).text().includes('PF');
    }).length;
    const pjCustomers = $('#kt_customers_table tbody tr').filter(function() {
        return $(this).find('td').eq(2).text().includes('PJ');
    }).length;
    
    $('#totalCustomers').text(totalCustomers);
    $('#activeCustomers').text(activeCustomers);
    $('#pfCustomers').text(pfCustomers);
    $('#pjCustomers').text(pjCustomers);
}

// Alternar entre visualizações (Lista / Por Mês)
function initializeViewSwitch() {
    const viewListBtn = document.getElementById('view-list');
    const viewColumnsBtn = document.getElementById('view-columns');
    const tableContainer = document.querySelector('.card:has(#kt_customers_table)');
    const columnsContainer = document.getElementById('view-columns-container');
    
    if (viewListBtn && viewColumnsBtn && tableContainer && columnsContainer) {
        // Clique no botão Lista
        viewListBtn.addEventListener('click', function() {
            // Atualizar classes dos botões
            viewListBtn.classList.remove('btn-light');
            viewListBtn.classList.add('btn-light-primary', 'active');
            viewColumnsBtn.classList.remove('btn-light-primary', 'active');
            viewColumnsBtn.classList.add('btn-light');
            
            // Mostrar tabela, esconder colunas
            tableContainer.classList.remove('d-none');
            columnsContainer.classList.add('d-none');
        });
        
        // Clique no botão Por Mês
        viewColumnsBtn.addEventListener('click', function() {
            // Atualizar classes dos botões
            viewColumnsBtn.classList.remove('btn-light');
            viewColumnsBtn.classList.add('btn-light-primary', 'active');
            viewListBtn.classList.remove('btn-light-primary', 'active');
            viewListBtn.classList.add('btn-light');
            
            // Esconder tabela, mostrar colunas
            tableContainer.classList.add('d-none');
            columnsContainer.classList.remove('d-none');
        });
    }
}

// Inicializar tudo quando o documento estiver pronto
$(document).ready(function() {
    initializeViewSwitches();
    initializeDataTable();
    
    // Remover atualização de estatísticas pois não existem mais
    // updateStatistics();
    
    // Atualizar estatísticas quando switches mudarem
    // $('input[type="checkbox"][data-customer-id]').on('change', function() {
    //     updateStatistics();
    // });
});
</script>