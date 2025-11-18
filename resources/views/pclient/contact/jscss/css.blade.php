<link href="{{ asset('assets/css/custom.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/css/datatables.css') }}" rel="stylesheet" type="text/css" />

<style>
.contact-page .contact-search-container {
    position: relative;
}

.contact-page .contact-search-input {
    border: 1px solid #e4e6ef;
    background-color: #ffffff;
    color: #3f4254;
    border-radius: 8px;
    padding: 12px 16px 12px 48px;
    font-size: 0.875rem;
    font-weight: 500;
    transition: all 0.2s ease-in-out;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.02);
}

.contact-page .contact-search-input:focus {
    border-color: #e71d73;
    box-shadow: 0 0 0 0.2rem rgba(231, 29, 115, 0.25);
    background-color: #ffffff;
}

.contact-page .contact-search-input:hover {
    border-color: #d1d3e0;
    background-color: #f8f9fa;
}

.contact-page .contact-search-icon {
    color: #6c757d;
    transition: color 0.2s ease-in-out;
}

.contact-page .contact-search-input:focus + .ki-duotone {
    color: #e71d73;
}

.contact-page .contact-filter-trigger {
    background-color: #f8f9fa;
    color: #6c757d;
    border: 1px solid #e4e6ef;
    border-radius: 8px;
    padding: 8px 16px;
    font-weight: 500;
    transition: all 0.2s ease-in-out;
    position: relative;
}

.contact-page .contact-filter-trigger:hover {
    background-color: #e9ecef;
    color: #495057;
    border-color: #d1d3e0;
    transform: translateY(-1px);
}

.contact-page .contact-filter-trigger .ki-duotone {
    color: #6c757d;
    transition: color 0.2s ease-in-out;
}

.contact-page .contact-filter-trigger:hover .ki-duotone {
    color: #e71d73;
}

.contact-page .contact-filter-trigger.has-active-filters {
    background: linear-gradient(135deg, #e71d73 0%, #d63384 100%);
    color: #ffffff;
    border-color: #e71d73;
    box-shadow: 0 2px 8px rgba(231, 29, 115, 0.3);
}

.contact-page .contact-filter-trigger.has-active-filters .ki-duotone {
    color: #ffffff;
}

.contact-page .contact-filter-trigger.has-active-filters::after {
    content: '';
    position: absolute;
    top: -2px;
    right: -2px;
    width: 8px;
    height: 8px;
    background-color: #ffffff;
    border: 2px solid #e71d73;
    border-radius: 50%;
}

.contact-page .contact-filter-trigger.has-active-filters[data-filter-count]::after {
    content: attr(data-filter-count);
    width: auto;
    height: auto;
    min-width: 18px;
    padding: 2px 6px;
    font-size: 10px;
    font-weight: 700;
    line-height: 1;
    text-align: center;
    background-color: #ffffff;
    color: #e71d73;
    border: 2px solid #e71d73;
    border-radius: 10px;
    top: -8px;
    right: -8px;
}

.contact-page .contact-form-container {
    background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
    border-radius: 12px;
    padding: 1.5rem;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
}

.contact-page .contact-form-section {
    background-color: #ffffff;
    border-radius: 10px;
    padding: 1.25rem;
    border: 1px solid #f1f3f4;
    transition: all 0.3s ease-in-out;
    margin-bottom: 1.5rem;
    position: relative;
}

.contact-page .contact-form-section:hover {
    border-color: #e4e6ef;
    box-shadow: 0 4px 16px rgba(0, 0, 0, 0.08);
    transform: translateY(-2px);
}

.contact-page .contact-form-section.has-active-filters {
    border-color: #e71d73;
    background: linear-gradient(135deg, #ffffff 0%, #fff5f8 100%);
    box-shadow: 0 4px 16px rgba(231, 29, 115, 0.15);
}

.contact-page .contact-form-section.has-active-filters::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 3px;
    background: linear-gradient(90deg, #e71d73 0%, #d63384 100%);
    border-radius: 10px 10px 0 0;
}

.contact-page .contact-form-label {
    color: #3f4254;
    font-weight: 600;
    font-size: 0.875rem;
    margin-bottom: 0.5rem;
}

.contact-page .contact-form-label-muted {
    color: #6c757d;
    font-weight: 500;
    font-size: 0.8rem;
}

.contact-page .contact-form-label-primary {
    color: #2c3e50;
    font-weight: 700;
    font-size: 1rem;
    margin-bottom: 0.75rem;
    border-left: 3px solid #e71d73;
    padding-left: 0.75rem;
}

.contact-page .contact-form-select {
    border: 1px solid #e4e6ef;
    background-color: #ffffff;
    color: #3f4254;
    border-radius: 8px;
    padding: 12px 16px;
    font-size: 0.875rem;
    font-weight: 500;
    transition: all 0.2s ease-in-out;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.02);
}

.contact-page .contact-form-select:focus {
    border-color: #e71d73;
    box-shadow: 0 0 0 0.2rem rgba(231, 29, 115, 0.25);
    background-color: #ffffff;
}

.contact-page .contact-form-select:hover {
    border-color: #d1d3e0;
    background-color: #f8f9fa;
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
}

.contact-page .contact-form-select option {
    background-color: #ffffff;
    color: #3f4254;
    padding: 8px 12px;
    transition: all 0.2s ease-in-out;
}

.contact-page .contact-form-select option:hover {
    background-color: #e71d73;
    color: #ffffff;
}

.contact-page .contact-form-select option:checked {
    background-color: #e71d73;
    color: #ffffff;
}

.contact-page .contact-form-date {
    border: 1px solid #e4e6ef;
    background-color: #ffffff;
    color: #3f4254;
    border-radius: 8px;
    padding: 12px 16px;
    font-size: 0.875rem;
    font-weight: 500;
    transition: all 0.2s ease-in-out;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.02);
    position: relative;
}

.contact-page .contact-form-date:focus {
    border-color: #e71d73;
    box-shadow: 0 0 0 0.2rem rgba(231, 29, 115, 0.25);
    background-color: #ffffff;
    transform: translateY(-1px);
}

.contact-page .contact-form-date:hover {
    border-color: #d1d3e0;
    background-color: #f8f9fa;
    transform: translateY(-1px);
}

.contact-page .contact-form-date::-webkit-calendar-picker-indicator {
    background-color: #e71d73;
    border-radius: 4px;
    padding: 4px;
    cursor: pointer;
    transition: all 0.2s ease-in-out;
}

.contact-page .contact-form-date::-webkit-calendar-picker-indicator:hover {
    background-color: #d63384;
    transform: scale(1.1);
}

.contact-page .contact-form-btn {
    border-radius: 8px;
    font-weight: 600;
    font-size: 0.875rem;
    padding: 12px 20px;
    transition: all 0.2s ease-in-out;
    border: none;
    position: relative;
    overflow: hidden;
}

.contact-page .contact-form-btn-light {
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    color: #495057;
    border: 1px solid #dee2e6;
    transition: all 0.2s ease-in-out;
}

.contact-page .contact-form-btn-light:hover {
    background: linear-gradient(135deg, #e9ecef 0%, #dee2e6 100%);
    color: #212529;
    border-color: #adb5bd;
    transform: translateY(-1px);
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
}

.contact-page .contact-form-btn-light:active {
    transform: translateY(0);
    box-shadow: 0 1px 4px rgba(0, 0, 0, 0.1);
}

.contact-page .contact-form-btn-light:focus {
    box-shadow: 0 0 0 0.2rem rgba(108, 117, 125, 0.25);
    border-color: #6c757d;
}

.contact-page .contact-form-btn-light:disabled {
    opacity: 0.6;
    cursor: not-allowed;
    transform: none;
}

.contact-page .contact-form-btn-light:disabled:hover {
    transform: none;
    box-shadow: none;
}

.contact-page .contact-form-btn-primary {
    background: linear-gradient(135deg, #e71d73 0%, #d63384 100%);
    color: #ffffff;
    border: 1px solid #e71d73;
}

.contact-page .contact-form-btn-primary:hover {
    background: linear-gradient(135deg, #d63384 0%, #c2255c 100%);
    border-color: #c2255c;
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(231, 29, 115, 0.3);
}

.contact-page .contact-form-btn-primary:active {
    transform: translateY(0);
    box-shadow: 0 2px 8px rgba(231, 29, 115, 0.2);
}

.contact-page .contact-form-row {
    margin: 0 -0.5rem;
}

.contact-page .contact-form-col {
    padding: 0 0.5rem;
}

.contact-page .contact-form-actions {
    gap: 0.75rem;
    padding-top: 1rem;
    border-top: 1px solid #f1f3f4;
}

.contact-page .contact-form-btn {
    min-width: 100px;
    font-weight: 600;
    letter-spacing: 0.025em;
}

.contact-page .contact-table th,
.contact-page .contact-table td {
    padding: 1rem 1.5rem;
}

.contact-page .contact-table th {
    padding-bottom: 1.5rem;
}

/* Responsividade específica da página de contatos */
@media (max-width: 768px) {
    .contact-page .contact-form-row {
        flex-direction: column;
    }

    .contact-page .contact-form-col {
        width: 100%;
        margin-bottom: 1rem;
    }

    .contact-page .contact-form-btn {
        width: 100%;
        margin-bottom: 0.5rem;
    }

    .contact-page .contact-form-actions {
        flex-direction: column;
    }
}

@media (max-width: 480px) {
    .contact-page .contact-form-section {
        padding: 1rem;
    }
}
</style>
