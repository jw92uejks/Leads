<style>
.profile-card {
    transition: all 0.3s ease;
}

.profile-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 0.5rem 1.5rem 0.5rem rgba(0, 0, 0, 0.075);
}

.avatar-upload {
    position: relative;
    cursor: pointer;
}

.avatar-upload:hover .avatar-overlay {
    opacity: 1;
}

.avatar-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0, 0, 0, 0.5);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: opacity 0.3s ease;
}

.avatar-overlay i {
    color: white;
    font-size: 1.5rem;
}

.form-control:focus {
    border-color: #e11d48;
    box-shadow: 0 0 0 0.2rem rgba(225, 29, 72, 0.25);
}

.form-select:focus {
    border-color: #e11d48;
    box-shadow: 0 0 0 0.2rem rgba(225, 29, 72, 0.25);
}

.btn-primary {
    background-color: #e11d48;
    border-color: #e11d48;
}

.btn-primary:hover {
    background-color: #be123c;
    border-color: #be123c;
}

.btn-primary:focus {
    background-color: #be123c;
    border-color: #be123c;
    box-shadow: 0 0 0 0.2rem rgba(225, 29, 72, 0.25);
}

.badge-light-success {
    background-color: #d1fae5;
    color: #065f46;
}

.badge-light-warning {
    background-color: #fef3c7;
    color: #92400e;
}

.symbol-100px {
    width: 100px;
    height: 100px;
}

.symbol-circle {
    border-radius: 50%;
}

.symbol img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    border-radius: 50%;
}

.separator {
    border-top: 1px solid #e1e5e9;
}

.border-end {
    border-right: 1px solid #e1e5e9;
}

.form-check-input:checked {
    background-color: #e11d48;
    border-color: #e11d48;
}

.form-check-input:focus {
    border-color: #e11d48;
    box-shadow: 0 0 0 0.2rem rgba(225, 29, 72, 0.25);
}

.modal-content {
    border: none;
    border-radius: 0.75rem;
}

.modal-header {
    border-bottom: 1px solid #e1e5e9;
    padding: 1.5rem;
}

.modal-body {
    padding: 1.5rem;
}

.modal-footer {
    border-top: 1px solid #e1e5e9;
    padding: 1.5rem;
}

#avatar-preview {
    max-width: 100px;
    max-height: 100px;
    object-fit: cover;
    border-radius: 50%;
}

.loading-spinner {
    display: inline-block;
    width: 1rem;
    height: 1rem;
    border: 2px solid #f3f3f3;
    border-top: 2px solid #e11d48;
    border-radius: 50%;
    animation: spin 1s linear infinite;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

.form-text {
    font-size: 0.875rem;
    color: #6c757d;
}

.required::after {
    content: " *";
    color: #e11d48;
}

/* Estilos para o campo do token da API */
.api-token-text {
    transition: all 0.3s ease;
    user-select: none;
    display: inline-block;
    min-height: 1.5rem;
    line-height: 1.5rem;
}

/* Estilo para o container do campo quando o token estiver oculto */
.form-control.position-relative.token-hidden {
    cursor: pointer;
    transition: all 0.3s ease;
}

.form-control.position-relative.token-hidden:hover {
    background-color: rgba(0, 0, 0, 0.05) !important;
    border-color: #e11d48;
}

.api-token-text.hidden {
    color: #6c757d !important;
    text-shadow: none;
}

.form-control.position-relative {
    overflow: hidden;
}

#toggle-token {
    z-index: 10;
    transition: all 0.2s ease;
    cursor: pointer;
}

#toggle-token:hover {
    transform: translateY(-50%) scale(1.1);
    box-shadow: 0 0.25rem 0.5rem rgba(0, 0, 0, 0.15);
}

#toggle-token:active {
    transform: translateY(-50%) scale(0.95);
}

#toggle-token:focus {
    outline: none;
    box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.25);
}

/* Estilos para o botão de regeneração do token */
#regenerate-token {
    z-index: 10;
    transition: all 0.2s ease;
    cursor: pointer;
    width: 28px;
    height: 28px;
    padding: 0;
    display: flex;
    align-items: center;
    justify-content: center;
}

#regenerate-token:hover {
    transform: translateY(-50%) scale(1.1);
    box-shadow: 0 0.25rem 0.5rem rgba(0, 0, 0, 0.15);
    background-color: #e11d48 !important;
    border-color: #e11d48 !important;
    color: white !important;
}

#regenerate-token:active {
    transform: translateY(-50%) scale(0.95);
}

#regenerate-token:focus {
    outline: none;
    box-shadow: 0 0 0 0.2rem rgba(225, 29, 72, 0.25);
}

/* Estilo para o ícone fa-random */
#regenerate-token .fas.fa-random {
    font-size: 0.75rem;
    line-height: 1;
}

/* Estilo para o campo de input quando o token for regenerado */
.form-control.token-regenerated {
    background-color: #d4edda !important;
    border-color: #28a745 !important;
    transition: all 0.3s ease;
}

/* Estilo para o ícone do olho */
#token-icon {
    transition: all 0.3s ease;
}

#token-icon.hidden {
    opacity: 0.7;
}

@media (max-width: 768px) {
    .symbol-100px {
        width: 80px;
        height: 80px;
    }

    .card-body {
        padding: 1rem;
    }

    .modal-dialog {
        margin: 0.5rem;
    }
}
</style>