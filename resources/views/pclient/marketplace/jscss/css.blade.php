<style>
        div#kt_app_main {
            padding-bottom: 60px;
        }

    .symbol.symbol-100px.symbol-circle.mb-5 {
        max-width: 120px;
    }

    .symbol.symbol-100px.overflow-hidden.me-3 {
        max-width: 85px;
    }

    #kt_marketplace_search_form .collapse {
        background-color: #f8f9fa;
        border-radius: 8px;
        padding: 20px;
        margin-top: 10px;
    }

    .marketplace-card {
        transition: all 0.3s ease;
        border: 1px solid #e4e6ef;
    }

    .marketplace-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        border-color: #009ef7;
    }

    .rating .rating-label.checked i {
        color: #ffc700;
    }

    .rating .rating-label i {
        color: #e4e6ef;
    }

    .badge.badge-light-danger {
        background-color: rgba(245, 101, 101, 0.1);
        color: #f56565;
    }

    .badge.badge-light-warning {
        background-color: rgba(255, 199, 0, 0.1);
        color: #ffc700;
    }

    .badge.badge-light-info {
        background-color: rgba(55, 125, 255, 0.1);
        color: #377dff;
    }

    .badge.badge-violet {
        background-color: rgba(116, 103, 239, 0.1);
        color: #7467ef;
    }

    .modal-content .badge{
    font-size:1rem;
    }

    .symbol.symbol-25px>img{
    width: 32px!important;
    height: 32px!important;
    }

    .tab-pane .card,
    .tab-pane .row > div {
        opacity: 0;
        animation: fadeInUp 0.6s ease forwards;
    }

    .tab-pane .card:nth-child(1) { animation-delay: 0.1s; }
    .tab-pane .card:nth-child(2) { animation-delay: 0.2s; }
    .tab-pane .card:nth-child(3) { animation-delay: 0.3s; }

    #kt_marketplace_table_view .symbol.symbol-50px>img{
    max-width:100px;
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Responsividade para busca horizontal */
    @media (max-width: 768px) {
        #kt_marketplace_search_form .d-flex.align-items-center {
            flex-direction: column;
            gap: 15px;
        }

        #kt_marketplace_search_form .position-relative {
            width: 100% !important;
        }
    }

    .nav-group-fluid label {
        margin: 0 2px;
    }

    .nav-group-fluid .btn {
        border-radius: 6px;
    }

    [data-kt-dialer] .btn-icon {
        width: 35px;
        height: 35px;
    }

    .btn-adquirir:hover {
        transform: scale(1.05);
        transition: all 0.2s ease;
    }

    .separator-dashed {
        border-top: 1px dashed #e4e6ef;
    }

    .marketplace-package-card {
        transition: all 0.3s ease-in-out;
        position: relative;
        overflow: hidden;
        border: 1px solid rgba(228, 230, 239, 0.5);
        background: #ffffff;
    }

    .marketplace-package-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.08);
        border-color: #f1416c;
        text-decoration: none !important;
    }

    .marketplace-package-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 3px;
        background: linear-gradient(90deg, #f1416c, #ff6692);
        transform: scaleX(0);
        transition: transform 0.3s ease;
    }

    .marketplace-package-card:hover::before {
        transform: scaleX(1);
    }

    .hover-elevate-up {
        transition: all 0.3s ease-in-out;
    }

    .hover-elevate-up:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.08);
    }

    #cards-container {
        min-height: 400px;
    }

    #cards-container .package-card {
        /* margin-bottom: 10px; */
        display: flex;
        flex-direction: column;
    }

    #cards-container .package-card .card {
        flex: 1;
        display: flex;
        flex-direction: column;
    }

    #cards-container .package-card .card-body {
        flex: 1;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .package-card .symbol {
        transition: transform 0.3s ease;
    }

    .marketplace-package-card:hover .symbol {
        transform: scale(1.1);
    }

    #kt_modal_view_leads .modal-dialog {
        max-width: 1200px;
        width: 95%;
    }

    #kt_modal_view_leads .lead-item-card {
        transition: all 0.3s ease;
        border: 1px solid #e4e6ef;
        border-radius: 0.5rem;
        overflow: hidden;
        cursor: pointer;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    }

    #kt_modal_view_leads .lead-item-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        border-color: #1b84ff;
    }

    #kt_modal_view_leads .lead-thumb-section {
        background-color: #f8f9fa;
        border-right: 1px solid #e4e6ef;
        position: relative;
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    #kt_modal_view_leads .lead-thumb-image {
        width: 100%;
        height: 100%;
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 8px;
        background-color: #f1f1f4;
    }

    #kt_modal_view_leads .lead-thumb-image img {
        max-width: 100%;
        max-height: 100%;
        object-fit: contain;
        object-position: center;
    }

    #kt_modal_view_leads .lead-info-section {
        background-color: white;
    }

    #kt_modal_view_leads .lead-info-item {
        display: flex;
        align-items: center;
        font-size: 0.875rem;
    }

    #kt_modal_view_leads .lead-info-item i {
        font-size: 1rem;
        width: 16px;
        text-align: center;
    }

    #kt_modal_view_leads .lead-price {
        margin-top: auto;
    }

    #kt_modal_view_leads .lead-price span {
        font-size: 1.25rem;
        font-weight: 700;
    }

    #kt_modal_view_leads .badge {
        font-size: 0.75rem;
        padding: 0.375rem 0.75rem;
        border-radius: 0.375rem;
    }

    #kt_modal_view_leads .badge-light-warning {
        background-color: rgba(255, 193, 7, 0.15);
        color: #e6a700;
        font-weight: 600;
    }

    #kt_modal_view_leads .badge-light-mixed {
        background-color: rgba(255, 199, 0, 0.1);
        color: #ffc700;
    }

        #kt_modal_view_leads .pagination {
            margin-bottom: 0;
        }

    .pagination .page-item.active .page-link {
        background-color: #f1416c !important;
        border-color: #f1416c !important;
        color: white !important;
    }

    .pagination .page-link:hover {
        background-color: rgba(241, 65, 108, 0.1) !important;
        border-color: #f1416c !important;
        color: #f1416c !important;
    }

    #kt_modal_view_leads .pagination .page-link {
        border-radius: 0.375rem;
        border: 1px solid #e4e6ef;
        color: #6c757d;
        padding: 0.5rem 0.75rem;
        margin: 0 0.125rem;
        transition: all 0.15s ease-in-out;
        text-decoration: none;
    }

        #kt_modal_view_leads .pagination .page-item.active .page-link {
            background-color: #f1416c;
            border-color: #f1416c;
            color: white;
        }

        #kt_modal_view_leads .pagination .page-link:hover {
            background-color: rgba(241, 65, 108, 0.1);
            border-color: #f1416c;
            color: #f1416c;
        }

    #kt_modal_view_leads .pagination .page-item.disabled .page-link {
        color: #6c757d;
        pointer-events: none;
        background-color: #fff;
        border-color: #dee2e6;
    }

    .btn-primary {
        background-color: #f1416c;
        border-color: #f1416c;
    }

    .btn-primary:hover,
    .btn-primary:focus,
    .btn-primary:active {
        background-color: #e02d5b;
        border-color: #e02d5b;
    }

    .btn-light-primary {
        color: #f1416c;
        background-color: rgba(241, 65, 108, 0.1);
        border-color: rgba(241, 65, 108, 0.1);
    }

    .btn-light-primary:hover,
    .btn-light-primary:focus,
    .btn-light-primary:active {
        color: white;
        background-color: #f1416c;
        border-color: #f1416c;
    }

    #kt_advanced_search_form {
        background-color: rgba(248, 249, 250, 0.8);
        border-radius: 12px;
        padding: 25px;
        border: 1px solid rgba(228, 230, 239, 0.5);
        transition: all 0.3s ease;
    }

    #kt_advanced_search_form.show {
        display: block !important;
        opacity: 1;
        visibility: visible;
        height: auto !important;
        overflow: visible !important;
    }

    #kt_advanced_search_form:not(.show) {
        display: none !important;
        height: 0 !important;
        overflow: hidden !important;
    }

    /* Garantir que o collapse funcione corretamente */
    .collapse:not(.show) {
        display: none !important;
    }

    .collapse.show {
        display: block !important;
    }

    #kt_advanced_search_form .row.mb-6 {
        margin-bottom: 1.5rem !important;
    }

    #kt_advanced_search_form .form-label {
        margin-bottom: 0.75rem;
        font-size: 0.9rem;
    }

        .table-responsive {
            transition: opacity 0.3s ease;
        }

    /* Add custom */
    .cursor-pointer {
        cursor: pointer;
    }

    .lead-item-card {
        transition: all 0.3s ease;
    }

    .lead-item-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(0,0,0,0.1);
    }

    .border-primary {
        border-color: #f1416c !important;
        border-width: 2px !important;
    }

    .badge-circle {
        width: 24px;
        height: 24px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
    }

    .badge-primary {
        background-color: #f1416c !important;
    }

    .pagination .page-item.active .page-link {
        background-color: #f1416c !important;
        border-color: #f1416c !important;
        color: white !important;
    }

    .pagination .page-link:hover {
        background-color: rgba(241, 65, 108, 0.1) !important;
        border-color: #f1416c !important;
        color: #f1416c !important;
    }

    .lead-thumb-section {
        min-height: 120px;
    }

    .lead-item-card .badge-circle {
        z-index: 10;
        box-shadow: 0 2px 6px rgba(0,0,0,0.15);
    }

    .cursor-pointer {
        cursor: pointer;
    }

    .lead-item-card {
        transition: all 0.3s ease;
    }

    .lead-item-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(0,0,0,0.1);
    }

    .border-primary {
        border-color: #f1416c !important;
        border-width: 2px !important;
    }

    .badge-circle {
        width: 24px;
        height: 24px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
    }

    .badge-primary {
        background-color: #f1416c !important;
    }

    .lead-thumb-section {
        min-height: 120px;
    }

    .lead-item-card .badge-circle {
        z-index: 10;
        box-shadow: 0 2px 6px rgba(0,0,0,0.15);
    }

    /* Select2 com fundo rosa claro */
    #sort-select + .select2-container .select2-selection--single {
        background-color: #fce4ec !important;
        border: none !important;
        border-radius: 8px !important;
    }

    #sort-select + .select2-container .select2-selection--single .select2-selection__rendered {
        color: #495057 !important;
    }

    #sort-select + .select2-container .select2-selection--single .select2-selection__arrow {
        background-color: #fce4ec !important;
    }
</style>