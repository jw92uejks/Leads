<link href="{{ asset('assets/css/custom.css') }}" rel="stylesheet" type="text/css" />

<style>
#kt_app_content {
    margin-bottom: 60px;
}

.card-flush {
    border: 1px solid #e4e6ef;
    transition: all 0.3s ease;
}

.card-flush:hover {
    border-color: #e71d73;
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
}

/* Link do menu já definido abaixo - removendo duplicação */

.nav-pills-custom .nav-link.active {
    background-color: #e71d73 !important;
    border-color: #e71d73 !important;
    color: #ffffff !important;
    box-shadow: 0 4px 12px rgba(231, 29, 115, 0.3) !important;
}

.nav-pills-custom .nav-link-icon-wrapper {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 2rem;
    height: 2rem;
    border-radius: 0.375rem;
    background-color: #e71d73;
    margin-right: 0.75rem;
    transition: all 0.3s ease;
}

.nav-pills-custom .nav-link-icon-wrapper i {
    color: #ffffff;
}

.nav-pills-custom .nav-link.active .nav-link-icon-wrapper {
    background-color: rgba(255, 255, 255, 0.9);
}

.nav-pills-custom .nav-link.active .nav-link-icon-wrapper i {
    color: #e71d73;
}

.nav-pills-custom .nav-link:hover .nav-link-icon-wrapper {
    background-color: #a11753;
}

.nav-pills-custom .nav-link:hover .nav-link-icon-wrapper i {
    color: #ffffff;
}

.nav-pills-custom .nav-link-title {
    font-weight: 500;
    font-size: 0.875rem;
    color: inherit;
}

.nav-pills-custom .nav-link.active .nav-link-title {
    color: #ffffff !important;
    font-weight: 600 !important;
}

.nav-pills-custom .nav-link.active:hover {
    background-color: #a11753 !important;
    border-color: #a11753 !important;
    color: #ffffff !important;
    transform: translateX(3px);
}

.accordion-item {
    border: 1px solid #e4e6ef;
    border-radius: 0.5rem;
    margin-bottom: 0.75rem;
    overflow: hidden;
}

.accordion-button {
    background-color: #ffffff;
    border: none;
    padding: 1rem 1.25rem;
    font-weight: 500;
    color: #181c32;
    transition: all 0.3s ease;
}

.accordion-button:not(.collapsed) {
    background-color: #f8f9fa;
    color: #e71d73;
    box-shadow: none;
}

.accordion-button.collapsed {
    background-color: #ffffff;
    color: #181c32;
}

.accordion-button:focus {
    box-shadow: none;
    border-color: #e71d73;
}

.accordion-button::after {
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' fill='%23e71d73'%3e%3cpath fill-rule='evenodd' d='M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z'/%3e%3c/svg%3e");
    transition: all 0.3s ease;
}

.accordion-button:not(.collapsed)::after {
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' fill='%23e71d73'%3e%3cpath fill-rule='evenodd' d='M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z'/%3e%3c/svg%3e");
    transform: rotate(180deg);
}

.accordion-collapse {
    border: 0;
}

.accordion-collapse.show {
    display: block !important;
}

.accordion-collapse:not(.show) {
    display: none;
}

.accordion-body {
    padding: 1.25rem;
    background-color: #ffffff;
    border-top: 1px solid #e4e6ef;
    display: block !important;
    visibility: visible !important;
    opacity: 1 !important;
}

.accordion-body p {
    color: #495057;
    line-height: 1.6;
    margin-bottom: 1rem;
    font-size: 0.95rem;
}

.accordion-body ul, .accordion-body ol {
    color: #495057;
    line-height: 1.6;
    margin-bottom: 1rem;
    padding-left: 1.25rem;
}

.accordion-body li {
    margin-bottom: 0.5rem;
    font-size: 0.95rem;
}

.accordion-body strong {
    color: #181c32;
    font-weight: 600;
}

.search-highlight {
    background-color: #fff3cd;
    padding: 0.125rem 0.25rem;
    border-radius: 0.25rem;
    font-weight: 600;
}

.symbol-label {
    border-radius: 0.5rem;
    display: flex;
    align-items: center;
    justify-content: center;
}

.bg-light-primary {
    background-color: rgba(231, 29, 115, 0.1);
}

.bg-light-success {
    background-color: rgba(0, 201, 167, 0.1);
}

.bg-light-warning {
    background-color: rgba(255, 184, 34, 0.1);
}

.text-primary {
    color: #e71d73 !important;
}

.btn-primary {
    background-color: #e71d73 !important;
    border-color: #e71d73 !important;
}

.btn-primary:hover {
    background-color: #a11753 !important;
    border-color: #a11753 !important;
}

/* Melhorias na interface da wiki */
.wiki-section {
    background: linear-gradient(135deg, #f8f9fc 0%, #ffffff 100%);
    border-radius: 1rem;
    padding: 2rem;
    margin-bottom: 2rem;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
    border: 1px solid rgba(231, 29, 115, 0.1);
}

/* Layout melhorado para títulos e descrições */
.card-title {
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
    margin-bottom: 0;
}

.card-title h3 {
    margin-bottom: 0;
    line-height: 1.3;
    font-size: 1.5rem;
    font-weight: 700;
}

.card-title .text-gray-400 {
    display: block;
    margin-top: 0.25rem;
    font-size: 0.875rem;
    line-height: 1.4;
    color: #6c757d !important;
}

/* Design melhorado para cards */
.card-header {
    padding: 1.5rem 1.5rem 0.75rem 1.5rem;
    border-bottom: none;
    background: transparent;
}

.card-body {
    padding: 0.75rem 1.5rem 1.5rem 1.5rem;
}

/* Melhorias gerais de design e UX */
.page-heading {
    color: #181c32;
    font-weight: 700;
    margin-bottom: 0.5rem;
}

.text-muted {
    color: #6c757d !important;
    font-size: 0.9rem;
}

/* Hover effects melhorados */
.card-flush:hover {
    border-color: rgba(231, 29, 115, 0.3);
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.12);
    transform: translateY(-1px);
}

/* Espaçamento melhorado */
.row.g-5.g-xl-10 {
    margin-bottom: 2rem;
}

/* Accordion melhorado */
.accordion {
    border: none;
}

.accordion-item {
    border: 1px solid #e9ecef;
    border-radius: 0.75rem;
    margin-bottom: 1rem;
    overflow: hidden;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.04);
    transition: all 0.3s ease;
}

.accordion-item:hover {
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
    border-color: rgba(231, 29, 115, 0.2);
}

/* Menu de categorias melhorado */
.nav-pills-custom {
    gap: 0.5rem;
}

.nav-pills-custom .nav-link {
    border-radius: 0.75rem;
    padding: 1rem 1.25rem;
    margin-bottom: 0.5rem;
    border: 1px solid #e9ecef;
    background-color: #ffffff;
    color: #495057;
    transition: all 0.3s ease;
    text-align: left;
    display: flex;
    align-items: center;
    justify-content: flex-start;
    font-weight: 500;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.04);
}

.nav-pills-custom .nav-link:hover:not(.active) {
    background-color: #f8f9fa;
    border-color: rgba(231, 29, 115, 0.2);
    transform: translateX(3px);
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
}

/* Input de pesquisa melhorado */
.search-input-wrapper input {
    position: relative;
    z-index: 1;
    background: rgba(255, 255, 255, 0.95);
    border: 2px solid #e9ecef;
    border-radius: 0.75rem;
    transition: all 0.3s ease;
    font-size: 1rem;
    padding: 0.875rem 3rem 0.875rem 3rem;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.04);
}

.search-input-wrapper input:focus {
    border-color: #e71d73;
    box-shadow: 0 0 0 0.2rem rgba(231, 29, 115, 0.15), 0 4px 12px rgba(0, 0, 0, 0.08);
    background: #ffffff;
    transform: scale(1.005);
}

/* Typography melhorada */
h1, h2, h3, h4, h5, h6 {
    color: #181c32;
    font-weight: 600;
}

p {
    color: #495057;
    line-height: 1.6;
}

/* Responsividade melhorada */

.wiki-header {
    text-align: center;
    margin-bottom: 2rem;
}

.wiki-header h1 {
    color: #181c32;
    font-weight: 700;
    margin-bottom: 0.5rem;
    position: relative;
}

.wiki-header h1::after {
    content: '';
    position: absolute;
    bottom: -10px;
    left: 50%;
    transform: translateX(-50%);
    width: 60px;
    height: 3px;
    background: linear-gradient(90deg, #e71d73, #a11753);
    border-radius: 2px;
}

.category-card {
    background: #ffffff;
    border: 1px solid rgba(231, 29, 115, 0.1);
    border-radius: 1rem;
    padding: 1.5rem;
    margin-bottom: 1rem;
    transition: all 0.3s ease;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
}

.category-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
    border-color: rgba(231, 29, 115, 0.3);
}

.content-card {
    background: #ffffff;
    border: 1px solid rgba(231, 29, 115, 0.1);
    border-radius: 1rem;
    overflow: hidden;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
    transition: all 0.3s ease;
}

.content-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 30px rgba(0, 0, 0, 0.12);
}

.support-contact-card {
    background: #ffffff;
    border: 1px solid rgba(231, 29, 115, 0.2);
    color: #181c32;
    border-radius: 1rem;
    overflow: hidden;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
}

.support-contact-card .card-title h3 {
    color: #181c32;
    font-weight: 700;
}

.support-contact-card .text-gray-400 {
    color: #6c757d !important;
}

.support-contact-item {
    background: #f8f9fa;
    border: 1px solid rgba(231, 29, 115, 0.1);
    border-radius: 0.75rem;
    padding: 1.5rem;
    margin-bottom: 1rem;
    transition: all 0.3s ease;
}

.support-contact-item:hover {
    background: rgba(231, 29, 115, 0.05);
    border-color: rgba(231, 29, 115, 0.2);
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
}

.support-contact-item .symbol-label {
    background: #e71d73 !important;
}

.support-contact-item .fw-bold {
    color: #181c32 !important;
}

.support-contact-item .text-gray-400 {
    color: #6c757d !important;
}

.search-card {
    background: linear-gradient(135deg, #ffffff 0%, #f8f9fc 100%);
    border: 2px solid rgba(231, 29, 115, 0.1);
    border-radius: 1rem;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
}

.search-card .card-title {
    text-align: left !important;
    display: block !important;
    width: 100% !important;
}

.search-card .card-title h3 {
    text-align: left !important;
    display: block !important;
    width: 100% !important;
}

.search-card .card-title .text-gray-400 {
    text-align: left !important;
    display: block !important;
    width: 100% !important;
}

/* Regras mais específicas para garantir alinhamento à esquerda */
.search-card .card-header .card-title {
    text-align: left !important;
}

.search-card .card-header .card-title h3 {
    text-align: left !important;
}

.search-card .card-header .card-title span {
    text-align: left !important;
}

/* Regras para títulos das categorias (content-card) */
.content-card .card-title {
    text-align: left !important;
    display: block !important;
    width: 100% !important;
}

.content-card .card-title h3 {
    text-align: left !important;
    display: block !important;
    width: 100% !important;
}

.content-card .card-title .text-gray-400 {
    text-align: left !important;
    display: block !important;
    width: 100% !important;
}

.content-card .card-header .card-title {
    text-align: left !important;
}

.content-card .card-header .card-title h3 {
    text-align: left !important;
}

.content-card .card-header .card-title span {
    text-align: left !important;
}

.search-input-wrapper {
    position: relative;
    margin-bottom: 1rem;
}

.search-input-wrapper::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(45deg, rgba(231, 29, 115, 0.05), rgba(161, 23, 83, 0.05));
    border-radius: 0.75rem;
    z-index: 0;
}

/* Input de pesquisa já definido abaixo - removendo duplicação */

@media (max-width: 768px) {
    .nav-pills-custom .nav-link {
        padding: 0.75rem 1rem;
        margin-bottom: 0.375rem;
        font-size: 0.875rem;
    }

    .nav-pills-custom .nav-link-icon-wrapper {
        width: 1.75rem;
        height: 1.75rem;
        margin-right: 0.75rem;
    }

    .accordion-button {
        padding: 1rem;
        font-size: 0.9rem;
    }

    .accordion-body {
        padding: 1rem;
        font-size: 0.9rem;
    }

    .wiki-section {
        padding: 1.5rem;
        margin-bottom: 1.5rem;
    }

    .category-card, .content-card {
        padding: 1rem;
        margin-bottom: 0.75rem;
    }

    .support-contact-item {
        padding: 1rem;
        margin-bottom: 0.75rem;
    }

    .card-title h3 {
        font-size: 1.25rem;
    }

    .card-header {
        padding: 1rem 1rem 0.5rem 1rem;
    }

    .card-body {
        padding: 0.5rem 1rem 1rem 1rem;
    }

    .search-input-wrapper input {
        padding: 0.75rem 2.5rem 0.75rem 2.5rem;
        font-size: 0.9rem;
    }

    .page-heading {
        font-size: 1.5rem;
    }

    .row.g-5.g-xl-10 {
        margin-bottom: 1.5rem;
    }
}

/* Animações suaves */
@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.card-flush {
    animation: fadeInUp 0.5s ease-out;
}

.accordion-item {
    animation: fadeInUp 0.5s ease-out;
}

.nav-pills-custom .nav-link {
    animation: fadeInUp 0.3s ease-out;
}

/* Estados de loading melhorados */
.accordion-collapse.collapsing {
    height: 0;
    overflow: hidden;
    transition: height 0.3s ease;
}

/* Melhorias de acessibilidade */
.nav-pills-custom .nav-link:focus,
.accordion-button:focus,
.search-input-wrapper input:focus {
    outline: 2px solid rgba(231, 29, 115, 0.5);
    outline-offset: 2px;
}

/* Print styles */
@media print {
    .nav-pills-custom,
    .search-card {
        display: none;
    }

    .accordion-collapse {
        display: block !important;
    }

    .accordion-button::after {
        display: none;
    }
}
</style>
