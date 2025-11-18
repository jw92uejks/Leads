<style>
#kt_app_content {
    margin-bottom: 60px;
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
    border-radius: inherit;
}

.card-flush {
    border: 1px solid #e4e6ef;
    transition: all 0.3s ease;
}

.card-flush:hover {
    border-color: #009ef7;
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
}

.form-control-solid, .form-select-solid {
    background-color: #f8f9fa;
    border: 1px solid #e4e6ef;
    transition: all 0.15s ease-in-out;
}

.form-control-solid:focus, .form-select-solid:focus {
    background-color: #ffffff;
    border-color: #009ef7;
    box-shadow: 0 0 0 0.2rem rgba(0, 158, 247, 0.25);
}

.required::after {
    content: " *";
    color: #f1416c;
}

.text-warning {
    color: #ffc700 !important;
}

.text-gray-300 {
    color: #b5b5c3 !important;
}

.badge-light-success {
    background-color: rgba(80, 205, 137, 0.1);
    color: #50cd89;
}

.badge-light-warning {
    background-color: rgba(255, 199, 0, 0.1);
    color: #ffc700;
}

.border-end {
    border-right: 1px solid #e4e6ef !important;
}

.separator {
    border-top: 1px dashed #e4e6ef;
}

.bg-light-primary {
    background-color: rgba(0, 158, 247, 0.1);
}

.bg-light-success {
    background-color: rgba(80, 205, 137, 0.1);
}

.bg-light-warning {
    background-color: rgba(255, 199, 0, 0.1);
}

.bg-light-info {
    background-color: rgba(55, 125, 255, 0.1);
}

.bg-light-secondary {
    background-color: rgba(108, 117, 125, 0.1);
}

.form-check-input:checked {
    background-color: #009ef7;
    border-color: #009ef7;
}

.form-switch .form-check-input {
    width: 3.5rem;
    height: 1.75rem!important;
    border-radius: 1.25rem;
}

.form-switch .form-check-input:checked {
    background-position: right center;
    background-color: #009ef7;
}

.form-switch.form-check-solid .form-check-input:not(:checked) {
    background-color: color(srgb 0.32 0.27 0.29 / 0.27);
}

.indicator-progress {
    display: none;
}

.indicator-progress.active {
    display: inline-block;
}

.indicator-label.hidden {
    display: none;
}

@media (max-width: 991px) {
    .col-xl-4, .col-xl-8 {
        margin-bottom: 2rem;
    }
    
    .row.g-9 .col-md-6 {
        margin-bottom: 1rem;
    }
}

.ki-duotone.fs-2 {
    width: 1.75rem;
    height: 1.75rem;
}

.ki-duotone.fs-4 {
    width: 1.25rem;
    height: 1.25rem;
}

.ki-duotone.fs-5 {
    width: 1rem;
    height: 1rem;
}

.rounded {
    border-radius: 0.75rem !important;
}

.mt-8 {
    margin-top: 3rem !important;
}
</style> 