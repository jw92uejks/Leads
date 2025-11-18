<style>
#kt_app_content {
    margin-bottom: 60px;
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

.form-check-input:checked {
    background-color: #009ef7;
    border-color: #009ef7;
}

.card-flush {
    border: 1px solid #e4e6ef;
    transition: all 0.3s ease;
}

.card-flush:hover {
    border-color: #009ef7;
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
}

#upload-form {
    position: relative;
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

.btn-light-success {
    background-color: rgba(80, 205, 137, 0.1);
    border-color: rgba(80, 205, 137, 0.2);
    color: #50cd89;
}

.btn-light-success:hover {
    background-color: rgba(80, 205, 137, 0.2);
    border-color: rgba(80, 205, 137, 0.3);
    color: #50cd89;
}

.separator {
    border-top: 1px dashed #e4e6ef;
}

.list-unstyled li {
    padding: 0.25rem 0;
}

input[type="file"] {
    padding: 0.75rem 1rem;
}

.text-center .ki-duotone {
    display: block;
    margin: 0 auto;
}

@media (max-width: 991px) {
    .col-xl-8, .col-xl-4 {
        margin-bottom: 2rem;
    }
}

.form-text {
    font-size: 0.875rem;
    color: #a1a5b7;
    margin-top: 0.5rem;
}

.btn .ki-duotone {
    margin-right: 0.5rem;
}
</style> 