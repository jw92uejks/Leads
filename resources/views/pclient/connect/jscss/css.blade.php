<link href="{{ asset('assets/css/custom.css') }}" rel="stylesheet" type="text/css" />

<style>
/* Custom styles for connect page */
.card-custom {
    transition: all 0.3s ease;
    border: 1px solid #e1e3ea;
}

.card-custom:hover {
    transform: translateY(-2px);
    box-shadow: 0 0.5rem 1.5rem 0.5rem rgba(0, 0, 0, 0.075);
}

.symbol-label.bg-light-success {
    background-color: #e8fff3 !important;
}

.badge.badge-light-success {
    background-color: #e8fff3 !important;
    color: #50cd89 !important;
}

.card.connection-kpi-section .card-body{
  padding: 2.5rem!important;
}

.connections-list .connection-card .symbol .symbol-label{
  width: 100px;
  height:100px;
}

.bg-light-success{border: 1px solid #ccded5}
.bg-light-success i{color:#469069}

.bg-light-warning{border: 1px solid #e2d7ac}
.bg-light-warning i{color:#cea200}

.bg-light-danger{border: 1px solid #dcbec7}
.bg-light-danger i {color:#e71d73}

.card-toolbar .badge {
    font-size: 14px;
}

.connections-list .connection-card i{
  font-size:50px;
}

/* KPI Icons styles */
.kpi-icon {
    font-size: 40px !important;
    margin-bottom: 0 !important;
}



/* Modal fullscreen adjustments */
.modal-fullscreen .modal-body {
    padding: 2rem;
}

/* Form validation styles */
.fv-row .form-control.is-invalid {
    border-color: #f1416c;
    box-shadow: 0 0 0 0.2rem rgba(241, 65, 108, 0.25);
}

.fv-row .form-control.is-valid {
    border-color: #50cd89;
    box-shadow: 0 0 0 0.2rem rgba(80, 205, 137, 0.25);
}

/* Tooltip styles */
.tooltip {
    font-size: 0.875rem;
}

/* Switch toggle styles */
.form-check-input:checked {
    background-color: #f1416c;
    border-color: #f1416c;
}

.form-check-input:focus {
    border-color: #f1416c;
    box-shadow: 0 0 0 0.2rem rgba(241, 65, 108, 0.25);
}

/* Button loading states */
.btn[data-kt-indicator="on"] .indicator-label {
    display: none;
}

.btn[data-kt-indicator="on"] .indicator-progress {
    display: inline-block;
}

.btn .indicator-progress {
    display: none;
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .modal-fullscreen .modal-body {
        padding: 1rem;
    }
    
    .card-custom .card-body {
        padding: 1.5rem !important;
    }
}
</style>
