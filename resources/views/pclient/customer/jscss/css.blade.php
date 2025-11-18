<style>
/* Estilos para a página de Carteira de Clientes */

/* Estilo para os badges de tipo de cliente */
.badge-light-primary {
    background-color: #f1f3ff;
    color: #3699ff;
    border: 1px solid #e1e5ff;
}

.badge-light-info {
    background-color: #e8f4fd;
    color: #0dcaf0;
    border: 1px solid #b3e5fc;
}

.badge-light-success {
    background-color: #e8f5e8;
    color: #198754;
    border: 1px solid #c3e6cb;
}

/* Estilo para os switches de relacionamento */
.form-check-input:checked {
    background-color: #3699ff;
    border-color: #3699ff;
}

.form-check-input:focus {
    border-color: #3699ff;
    outline: 0;
    box-shadow: 0 0 0 0.25rem rgba(54, 153, 255, 0.25);
}

/* Estilo para o modal de relacionamento */
#kt_modal_relationship_management .modal-dialog {
    max-width: 1200px;
}

#kt_modal_relationship_management .modal-content {
    border-radius: 0.75rem;
    box-shadow: 0 0.5rem 1.5rem rgba(0, 0, 0, 0.15);
}

/* Estilo para as seções do formulário */
.mb-10 {
    margin-bottom: 2.5rem !important;
}

.mb-8 {
    margin-bottom: 2rem !important;
}

/* Estilo para os formulários dentro das seções */
.border.rounded.p-5.bg-light {
    background-color: #f8f9fa !important;
    border: 1px solid #e9ecef !important;
    border-radius: 0.5rem !important;
    padding: 1.5rem !important;
}

/* Estilo para os títulos das seções */
h4.fw-bold.text-gray-800 {
    color: #181c32 !important;
    font-weight: 700 !important;
    font-size: 1.1rem;
}

/* Estilo para os botões de adicionar */
.btn-light-primary {
    background-color: #f1f3ff;
    border-color: #e1e5ff;
    color: #3699ff;
}

.btn-light-primary:hover {
    background-color: #e1e5ff;
    border-color: #c7d2fe;
    color: #2b77e5;
}

/* Estilo para os ícones do WhatsApp */
.ki-duotone.ki-sms {
    color: #25d366 !important;
}

/* Estilo para as linhas da tabela */
.table tbody tr:hover {
    background-color: #f8f9fa;
}

/* Estilo para os links dos nomes dos clientes */
a.text-gray-800.text-hover-primary {
    color: #181c32 !important;
    text-decoration: none;
    transition: color 0.15s ease-in-out;
}

a.text-gray-800.text-hover-primary:hover {
    color: #3699ff !important;
}

/* Estilo para os formulários desabilitados */
.form-control:disabled,
.form-select:disabled {
    background-color: #f8f9fa;
    opacity: 0.6;
}

/* Estilo para os campos de formulário quando a seção está inativa */
.inactive-section .form-control,
.inactive-section .form-select,
.inactive-section .form-check-input {
    pointer-events: none;
    opacity: 0.6;
}

/* Estilo para os indicadores de progresso */
.indicator-progress {
    display: none;
}

.btn.loading .indicator-label {
    display: none;
}

.btn.loading .indicator-progress {
    display: inline-block;
}

/* Estilo para os tooltips */
.tooltip {
    font-size: 0.875rem;
}

/* Estilo para os cards de informações do cliente */
.card {
    border: 1px solid #e9ecef;
    border-radius: 0.75rem;
    box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
}

.card-header {
    background-color: #f8f9fa;
    border-bottom: 1px solid #e9ecef;
    border-radius: 0.75rem 0.75rem 0 0 !important;
}

/* Estilo para os labels dos formulários */
.form-label {
    font-weight: 600;
    color: #181c32;
    margin-bottom: 0.5rem;
}

/* Estilo para os textos de ajuda */
.form-text {
    font-size: 0.875rem;
    color: #6c757d;
    margin-top: 0.25rem;
}

/* Estilo para os switches customizados - mais alongados e rosa */
.form-switch .form-check-input {
    width: 3.5rem;
    height: 1.75rem;
    background-color: #e4e6ef;
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='-4 -4 8 8'%3e%3ccircle r='3' fill='%23fff'/%3e%3c/svg%3e");
    background-position: left center;
    border-radius: 2rem;
    border: 1px solid #d1d3e0;
    cursor: pointer;
    transition: all 0.3s ease-in-out;
}

.form-switch .form-check-input:focus {
    border-color: #E91E63;
    outline: 0;
    box-shadow: 0 0 0 0.25rem rgba(233, 30, 99, 0.25);
}

.form-switch .form-check-input:checked {
    background-color: #E91E63 !important;
    border-color: #E91E63 !important;
    background-position: right center;
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='-4 -4 8 8'%3e%3ccircle r='3' fill='%23fff'/%3e%3c/svg%3e");
}

.form-switch .form-check-input:hover {
    border-color: #E91E63;
}

/* Estilo para os botões de ação da tabela */
.btn-sm {
    padding: 0.375rem 0.75rem;
    font-size: 0.875rem;
    border-radius: 0.375rem;
}

/* Estilo para os badges de status */
.badge {
    font-size: 0.75rem;
    font-weight: 600;
    padding: 0.375rem 0.75rem;
    border-radius: 0.375rem;
}

/* Estilo para os campos de data */
input[type="date"] {
    position: relative;
}

input[type="date"]::-webkit-calendar-picker-indicator {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    width: auto;
    height: auto;
    color: transparent;
    background: transparent;
    cursor: pointer;
}

/* Estilo para os campos numéricos */
input[type="number"] {
    -moz-appearance: textfield;
}

input[type="number"]::-webkit-outer-spin-button,
input[type="number"]::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
}

/* Estilo para os textareas */
textarea.form-control {
    resize: vertical;
    min-height: 80px;
}

/* Estilo para os modais responsivos */
@media (max-width: 768px) {
    #kt_modal_relationship_management .modal-dialog {
        margin: 0.5rem;
        max-width: calc(100% - 1rem);
    }
    
    .modal-xl {
        max-width: calc(100% - 1rem);
    }
}

/* Estilo para os formulários em dispositivos móveis */
@media (max-width: 576px) {
    .row .col-md-6,
    .row .col-md-4,
    .row .col-md-12 {
        margin-bottom: 1rem;
    }
    
    .btn {
        width: 100%;
        margin-bottom: 0.5rem;
    }
}

/* Estilo para os estados de loading */
.loading-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: rgba(255, 255, 255, 0.8);
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 1000;
}

/* Estilo para as mensagens de validação */
.invalid-feedback {
    display: block;
    width: 100%;
    margin-top: 0.25rem;
    font-size: 0.875rem;
    color: #dc3545;
}

.valid-feedback {
    display: block;
    width: 100%;
    margin-top: 0.25rem;
    font-size: 0.875rem;
    color: #198754;
}

/* Estilo para os campos obrigatórios */
.required::after {
    content: " *";
    color: #dc3545;
}

/* Estilo para os grupos de formulário */
.form-group {
    margin-bottom: 1rem;
}

/* Estilo para os separadores */
.separator {
    height: 1px;
    background-color: #e9ecef;
    margin: 1rem 0;
}

/* Estilo para os títulos das seções com ícones */
.section-title {
    display: flex;
    align-items: center;
    margin-bottom: 1rem;
}

.section-title i {
    margin-right: 0.5rem;
    font-size: 1.25rem;
    color: #3699ff;
}

/* Estilo para os cards de configuração */
.config-card {
    border: 1px solid #e9ecef;
    border-radius: 0.5rem;
    padding: 1.5rem;
    margin-bottom: 1.5rem;
    background-color: #fff;
    transition: box-shadow 0.15s ease-in-out;
}

.config-card:hover {
    box-shadow: 0 0.25rem 0.5rem rgba(0, 0, 0, 0.1);
}

.config-card.active {
    border-color: #3699ff;
    box-shadow: 0 0 0 0.2rem rgba(54, 153, 255, 0.25);
}

/* Estilo para os indicadores de status */
.status-indicator {
    display: inline-block;
    width: 8px;
    height: 8px;
    border-radius: 50%;
    margin-right: 0.5rem;
}

.status-indicator.active {
    background-color: #198754;
}

.status-indicator.inactive {
    background-color: #6c757d;
}

/* Estilo para os botões de toggle */
.toggle-btn {
    position: relative;
    display: inline-block;
    width: 60px;
    height: 30px;
}

.toggle-btn input {
    opacity: 0;
    width: 0;
    height: 0;
}

.toggle-slider {
    position: absolute;
    cursor: pointer;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: #ccc;
    transition: 0.4s;
    border-radius: 30px;
}

.toggle-slider:before {
    position: absolute;
    content: "";
    height: 22px;
    width: 22px;
    left: 4px;
    bottom: 4px;
    background-color: white;
    transition: 0.4s;
    border-radius: 50%;
}

input:checked + .toggle-slider {
    background-color: #3699ff;
}

input:checked + .toggle-slider:before {
    transform: translateX(30px);
}

/* Estilo para os tooltips customizados */
.custom-tooltip {
    position: relative;
    display: inline-block;
}

.custom-tooltip .tooltip-text {
    visibility: hidden;
    width: 200px;
    background-color: #333;
    color: #fff;
    text-align: center;
    border-radius: 6px;
    padding: 8px;
    position: absolute;
    z-index: 1;
    bottom: 125%;
    left: 50%;
    margin-left: -100px;
    opacity: 0;
    transition: opacity 0.3s;
    font-size: 0.875rem;
}

.custom-tooltip:hover .tooltip-text {
    visibility: visible;
    opacity: 1;
}

/* Estilo para os alertas */
.alert {
    border-radius: 0.5rem;
    border: 1px solid transparent;
    padding: 0.75rem 1rem;
    margin-bottom: 1rem;
}

.alert-info {
    color: #0c5460;
    background-color: #d1ecf1;
    border-color: #bee5eb;
}

.alert-success {
    color: #155724;
    background-color: #d4edda;
    border-color: #c3e6cb;
}

.alert-warning {
    color: #856404;
    background-color: #fff3cd;
    border-color: #ffeaa7;
}

.alert-danger {
    color: #721c24;
    background-color: #f8d7da;
    border-color: #f5c6cb;
}

/* Estilo para containers ocuparem 100% da largura */
#kt_app_content_container.w-100 {
    max-width: 100% !important;
}

/* Estilo para a visualização por colunas com scroll horizontal */
#view-columns-container .table-responsive {
    overflow-x: auto;
    -webkit-overflow-scrolling: touch;
}

/* Forçar meses lado a lado na visualização por vigência */
#view-columns-container .table-responsive {
    overflow-x: auto !important;
    overflow-y: hidden !important;
}

#view-columns-container .table-responsive > div {
    display: flex !important;
    flex-direction: row !important;
    flex-wrap: nowrap !important;
    width: max-content !important;
    gap: 0 !important;
}

#view-columns-container .flex-shrink-0 {
    flex: 0 0 auto !important;
    display: inline-block !important;
    vertical-align: top !important;
}

/* Estilo para os cards na visualização por colunas */
#view-columns-container .card.hover-elevate-up {
    transition: all 0.3s ease;
}

#view-columns-container .card.hover-elevate-up:hover {
    transform: translateY(-4px);
    box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15) !important;
}
</style>