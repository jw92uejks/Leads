<link href="{{ asset('assets/css/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/css/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />

<style>
.btn-pink {
    background: linear-gradient(135deg, #e71d73 0%, #a01c7f 100%);
    border: none;
    color: white;
    font-weight: 600;
    transition: all 0.3s ease;
}

.btn-pink:hover {
    background: linear-gradient(135deg, #a01c7f 0%, #7e1764 100%);
    color: white;
    transform: translateY(-1px);
    box-shadow: 0 4px 15px rgba(231, 29, 115, 0.3);
}

.btn-light-pink {
    background: linear-gradient(135deg, #f7e3eb 0%, #edcce1 100%);
    border: 1px solid #e71d73;
    color: #e71d73;
    font-weight: 600;
    transition: all 0.3s ease;
}

.btn-light-pink:hover {
    background: linear-gradient(135deg, #e71d73 0%, #a01c7f 100%);
    color: white;
    transform: translateY(-1px);
    box-shadow: 0 4px 15px rgba(231, 29, 115, 0.2);
}

.table thead th {
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    font-weight: 600;
    color: #181c32;
    border-bottom: 2px solid #e4e6ef;
}

.timeline .timeline-item{
  flex-direction:column;
}

.table:not(.table-bordered) th:first-child,
.table:not(.table-bordered) td:first-child{
  padding-left:20px;
}

.table:not(.table-bordered) th:last-child{
  padding-right:25px;
}

.card .card-body{
  margin-top:30px
}

.table tbody tr {
    transition: all 0.2s ease;
    border-bottom: 1px solid #f1f3f6;
}

.table tbody tr:hover {
    background: linear-gradient(135deg, rgba(231, 29, 115, 0.05) 0%, rgba(160, 28, 127, 0.02) 100%);
    transform: scale(1.01);
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
}

.badge-light-danger {
    background: linear-gradient(135deg, rgba(245, 101, 101, 0.1) 0%, rgba(245, 101, 101, 0.05) 100%);
    color: #f56565;
    border: 1px solid rgba(245, 101, 101, 0.2);
}

.badge-light-warning {
    background: linear-gradient(135deg, rgba(255, 171, 0, 0.1) 0%, rgba(255, 171, 0, 0.05) 100%);
    color: #ffab00;
    border: 1px solid rgba(255, 171, 0, 0.2);
}

.badge-light-info {
    background: linear-gradient(135deg, rgba(3, 169, 244, 0.1) 0%, rgba(3, 169, 244, 0.05) 100%);
    color: #03a9f4;
    border: 1px solid rgba(3, 169, 244, 0.2);
}

.badge-light-success {
    background: linear-gradient(135deg, rgba(80, 205, 137, 0.1) 0%, rgba(80, 205, 137, 0.05) 100%);
    color: #50cd89;
    border: 1px solid rgba(80, 205, 137, 0.2);
}

.badge-light-primary {
    background: linear-gradient(135deg, rgba(231, 29, 115, 0.1) 0%, rgba(231, 29, 115, 0.05) 100%);
    color: #e71d73;
    border: 1px solid rgba(231, 29, 115, 0.2);
}

.badge-light-secondary {
    background: linear-gradient(135deg, rgba(108, 117, 125, 0.1) 0%, rgba(108, 117, 125, 0.05) 100%);
    color: #6c757d;
    border: 1px solid rgba(108, 117, 125, 0.2);
}

/* Botões de ação com estilo secondary padrão */
.btn-light-secondary {
    background-color: rgba(108, 117, 125, 0.1) !important;
    border-color: rgba(108, 117, 125, 0.2) !important;
    color: #6c757d !important;
}

.btn-light-secondary i,
.btn-light-secondary .ki-duotone {
    color: #6c757d !important;
}

.btn-light-secondary:hover {
    background-color: rgba(108, 117, 125, 0.2) !important;
    border-color: rgba(108, 117, 125, 0.3) !important;
    color: #5a6268 !important;
}

.btn-light-secondary:hover i,
.btn-light-secondary:hover .ki-duotone {
    color: #5a6268 !important;
}

/* Força todos os botões de ticket a terem o mesmo estilo */
.ticket-view-btn,
.ticket-close-btn,
.ticket-delete-btn {
    background-color: rgba(108, 117, 125, 0.1) !important;
    border-color: rgba(108, 117, 125, 0.2) !important;
    color: #6c757d !important;
}

.ticket-view-btn i,
.ticket-view-btn .ki-duotone,
.ticket-close-btn i,
.ticket-close-btn .ki-duotone,
.ticket-delete-btn i,
.ticket-delete-btn .ki-duotone {
    color: #6c757d !important;
}

.ticket-view-btn:hover,
.ticket-close-btn:hover,
.ticket-delete-btn:hover {
    background-color: rgba(108, 117, 125, 0.2) !important;
    border-color: rgba(108, 117, 125, 0.3) !important;
    color: #5a6268 !important;
}

.ticket-view-btn:hover i,
.ticket-view-btn:hover .ki-duotone,
.ticket-close-btn:hover i,
.ticket-close-btn:hover .ki-duotone,
.ticket-delete-btn:hover i,
.ticket-delete-btn:hover .ki-duotone {
    color: #5a6268 !important;
}

.card {
    border-radius: 12px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
    border: 1px solid #e4e6ef;
}

.card-header {
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    border-bottom: 1px solid #e4e6ef;
}

.form-control:focus,
.form-select:focus {
    border-color: #e71d73;
    box-shadow: 0 0 0 0.2rem rgba(231, 29, 115, 0.25);
}

.menu .menu-item .menu-link:hover {
    background: rgba(231, 29, 115, 0.1);
    color: #e71d73;
}

.text-hover-primary:hover {
    color: #e71d73 !important;
}

.btn-active-light-primary:hover,
.btn-active-light-primary.active {
    background: #e71d73 !important;
    color: white !important;
}

.modal-header {
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    border-bottom: 1px solid #e4e6ef;
}

/* Estilos para o campo de upload */
.upload-area {
    position: relative;
    border: 2px dashed #e4e6ef;
    border-radius: 8px;
    padding: 20px;
    text-align: center;
    background: #f8f9fa;
    transition: all 0.3s ease;
    cursor: pointer;
}

.upload-area:hover {
    border-color: #e71d73;
    background: rgba(231, 29, 115, 0.02);
}

.upload-area.dragover {
    border-color: #e71d73;
    background: rgba(231, 29, 115, 0.05);
}

.upload-input {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    opacity: 0;
    cursor: pointer;
    z-index: 2;
}

.upload-placeholder {
    pointer-events: none;
    z-index: 1;
}

.upload-preview {
    text-align: left;
}

.selected-files {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
    margin-bottom: 10px;
}

.file-item {
    display: flex;
    align-items: center;
    background: white;
    border: 1px solid #e4e6ef;
    border-radius: 6px;
    padding: 8px 12px;
    font-size: 0.875rem;
    max-width: 200px;
}

.file-item .file-name {
    flex: 1;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
    margin-right: 8px;
}

.file-item .file-remove {
    color: #dc3545;
    cursor: pointer;
    font-size: 1.1rem;
    line-height: 1;
}

.file-item .file-remove:hover {
    color: #c82333;
}

.btn-light-danger {
    background-color: rgba(220, 53, 69, 0.1);
    border-color: rgba(220, 53, 69, 0.2);
    color: #dc3545;
}

.btn-light-danger:hover {
    background-color: rgba(220, 53, 69, 0.2);
    border-color: rgba(220, 53, 69, 0.3);
    color: #c82333;
}

.select2-container--bootstrap5 .select2-selection--single:focus,
.select2-container--bootstrap5 .select2-selection--multiple:focus {
    border-color: #e71d73;
    box-shadow: 0 0 0 0.2rem rgba(231, 29, 115, 0.25);
}

.select2-container--bootstrap5 .select2-dropdown .select2-results__option--highlighted {
    background-color: #e71d73;
    color: white;
}

#kt_contestation_table tbody tr:hover {
    background: linear-gradient(135deg, rgba(231, 29, 115, 0.03) 0%, rgba(160, 28, 127, 0.01) 100%);
}

.loading-state {
    opacity: 0.5;
    pointer-events: none;
    position: relative;
}

.loading-state::after {
    content: '';
    position: absolute;
    top: 50%;
    left: 50%;
    width: 30px;
    height: 30px;
    margin: -15px 0 0 -15px;
    border: 3px solid #f3f3f3;
    border-top: 3px solid #e71d73;
    border-radius: 50%;
    animation: spin 1s linear infinite;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

.table-responsive {
    border-radius: 8px;
    overflow: hidden;
}

.btn-sm {
    padding: 0.375rem 0.75rem;
    font-size: 0.875rem;
}

.badge {
    font-weight: 600;
    padding: 0.5rem 0.75rem;
    border-radius: 0.375rem;
    font-size: 0.75rem;
}

/* Estilos específicos para o modal de thread */
.timeline {
    position: relative;
}

.timeline-item {
    position: relative;
}

.bg-light-pink {
    background: linear-gradient(135deg, rgba(231, 29, 115, 0.1) 0%, rgba(231, 29, 115, 0.05) 100%) !important;
    border: 1px solid rgba(231, 29, 115, 0.15);
}

.text-pink {
    color: #e71d73 !important;
}

.symbol-label.bg-light-pink {
    background: linear-gradient(135deg, rgba(231, 29, 115, 0.15) 0%, rgba(231, 29, 115, 0.1) 100%) !important;
}

.symbol-label.bg-light-primary {
    background: linear-gradient(135deg, rgba(3, 155, 229, 0.15) 0%, rgba(3, 155, 229, 0.1) 100%) !important;
}

.text-primary {
    color: #039be5 !important;
}

#kt_modal_ticket_thread .modal-dialog {
    max-width: 900px;
}

#kt_modal_ticket_thread .modal-body {
    max-height: 600px;
    overflow-y: auto;
}

.thread-message {
    transition: all 0.2s ease;
}

.thread-message:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
}

.ticket-link {
    cursor: pointer;
    transition: all 0.2s ease;
}

.ticket-link:hover {
    text-decoration: underline !important;
}

.ticket-thread-link {
    cursor: pointer;
    transition: all 0.2s ease;
}

/* Estilos para links clicáveis */
.ticket-link, .ticket-subject-link {
    cursor: pointer;
    transition: all 0.2s ease;
    text-decoration: none !important;
}

.ticket-link:hover, .ticket-subject-link:hover {
    color: #e71d73 !important;
    text-decoration: underline !important;
}



/* Estilos para botões de ícone */
.btn-icon {
    width: 35px;
    height: 35px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    border-radius: 0.475rem;
    position: relative;
    overflow: hidden;
    margin: 0 2px;
}

.btn-icon i {
    font-size: 1rem;
}

/* Espaçamento específico para ações dos tickets */
.text-center .btn-icon {
    margin: 0 1px;
}

/* Melhor espaçamento entre botões */
td.text-center .btn-icon:not(:last-child) {
    margin-right: 4px;
}

/* Tooltip styles */
.btn-icon[title]:hover::after {
    content: attr(title);
    position: absolute;
    bottom: 100%;
    left: 50%;
    transform: translateX(-50%);
    background: rgba(0, 0, 0, 0.8);
    color: white;
    padding: 0.25rem 0.5rem;
    border-radius: 0.25rem;
    font-size: 0.75rem;
    white-space: nowrap;
    z-index: 1000;
    margin-bottom: 5px;
}

.btn-icon[title]:hover::before {
    content: '';
    position: absolute;
    bottom: 100%;
    left: 50%;
    transform: translateX(-50%);
    width: 0;
    height: 0;
    border-left: 4px solid transparent;
    border-right: 4px solid transparent;
    border-top: 4px solid rgba(0, 0, 0, 0.8);
    z-index: 1000;
}

/* Animação de pulso para ações importantes */
.ticket-delete-btn:focus {
    animation: pulse-danger 1.5s infinite;
}

@keyframes pulse-danger {
    0% {
        box-shadow: 0 0 0 0 rgba(241, 65, 108, 0.7);
    }
    70% {
        box-shadow: 0 0 0 10px rgba(241, 65, 108, 0);
    }
    100% {
        box-shadow: 0 0 0 0 rgba(241, 65, 108, 0);
    }
}

/* Melhorias no DataTable */
.dataTables_wrapper .dataTables_info {
    margin-top: 1rem;
    font-size: 0.875rem;
    color: #5e6278;
    font-weight: 500;
}

.dataTables_wrapper .dataTables_paginate {
    margin-top: 1rem;
    float: right;
}

.dataTables_wrapper .row {
    display: flex !important;
    justify-content: space-between;
    align-items: center;
    margin-top: 1rem;
}

.dataTables_wrapper {
    margin-top: 0;
}

.dataTables_wrapper .dataTables_length,
.dataTables_wrapper .dataTables_filter {
    display: none;
}

/* Forçar exibição da paginação */
.dataTables_wrapper .dataTables_paginate,
.dataTables_wrapper .dataTables_info {
    display: block !important;
    visibility: visible !important;
    opacity: 1 !important;
}

/* Forçar exibição da estrutura de paginação */
.dataTables_wrapper .row:last-child {
    display: flex !important;
    justify-content: space-between !important;
    align-items: center !important;
    margin-top: 1rem !important;
}

.dataTables_wrapper .dataTables_paginate .paginate_button {
    padding: 0.5rem 0.75rem;
    margin: 0 0.25rem;
    border-radius: 0.375rem;
    border: 1px solid #e4e6ef;
    background: white;
    color: #5e6278;
    font-weight: 500;
    transition: all 0.2s ease;
    display: inline-block !important;
}

.dataTables_wrapper .dataTables_paginate .paginate_button:hover {
    background: #e71d73;
    color: white;
    border-color: #e71d73;
    transform: translateY(-1px);
}

.dataTables_wrapper .dataTables_paginate .paginate_button.current {
    background: #e71d73;
    color: white;
    border-color: #e71d73;
    font-weight: 600;
}

.dataTables_wrapper .dataTables_paginate .paginate_button.disabled {
    opacity: 0.5;
    cursor: not-allowed;
}

.dataTables_wrapper .dataTables_paginate .paginate_button.disabled:hover {
    background: white;
    color: #5e6278;
    border-color: #e4e6ef;
    transform: none;
}

/* Garantir que sempre apareça paginação mesmo com 5 itens */
.dataTables_wrapper .dataTables_paginate {
    display: block !important;
    min-height: 40px;
}

.dataTables_wrapper .dataTables_info {
    display: block !important;
    font-weight: 500;
    color: #5e6278;
}

/* Força específica para mostrar paginação */
table.dataTable + .dataTables_wrapper .dataTables_paginate,
#kt_contestation_table_wrapper .dataTables_paginate {
    display: block !important;
}

#kt_contestation_table_wrapper .dataTables_info {
    display: block !important;
}

/* Responsividade */
@media (max-width: 768px) {
    .table-responsive {
        font-size: 0.875rem;
    }

    .btn-pink {
        width: 100%;
        margin-top: 1rem;
    }

    .card-toolbar {
        flex-direction: column;
        gap: 10px;
    }

    #kt_modal_ticket_thread .modal-dialog {
        max-width: 95%;
        margin: 1rem auto;
    }

    .thread-message .w-75 {
        width: 90% !important;
    }

    .symbol {
        display: none;
    }

    .dataTables_wrapper .row {
        flex-direction: column;
        gap: 1rem;
    }

    .dataTables_wrapper .dataTables_paginate {
        float: none;
        text-align: center;
    }

    .dataTables_wrapper .dataTables_info {
        text-align: center;
    }

    /* Botões de ação em mobile */
    .btn-icon {
        width: 30px;
        height: 30px;
        margin: 0 1px;
    }

    .btn-icon i {
        font-size: 0.85rem;
    }
}

@media (max-width: 576px) {
    .table thead th {
        font-size: 0.75rem;
        padding: 0.5rem 0.25rem;
    }

    .table tbody td {
        font-size: 0.75rem;
        padding: 0.5rem 0.25rem;
    }

    .badge {
        font-size: 0.65rem;
        padding: 0.25rem 0.5rem;
    }

    /* Botões de ação em telas muito pequenas */
    .btn-icon {
        width: 28px;
        height: 28px;
        margin: 0 1px;
    }

    .btn-icon i {
        font-size: 0.8rem;
    }

    /* Ocultar tooltips em mobile */
    .btn-icon[title]:hover::after,
    .btn-icon[title]:hover::before {
        display: none;
    }
}
</style>