<style>

    #myTabContent, .table-responsive{
      overflow:hidden;
    }

    .text-active-primary.active i,
    .text-pink, .btn-pink, .badge-light-pink{
      color:#E71D73!important;
    }
    
    .nav-link.active i,
    .nav-link.active .path1,
    .nav-link.active .path2,
    .nav-link.active .path3,
    .nav-link.active .path4,
    .nav-link.active .path5 {
        color: #e91e63 !important;
        fill: #e91e63 !important;
    }
    
    .nav-link:not(.active) i,
    .nav-link:not(.active) .path1,
    .nav-link:not(.active) .path2,
    .nav-link:not(.active) .path3,
    .nav-link:not(.active) .path4,
    .nav-link:not(.active) .path5 {
        color: #6c757d !important;
        fill: #6c757d !important;
    }

    .card .card-header{
      min-height:0!important;
    }

    .tab-pane {
        display: none;
    }
    
    .tab-pane.active {
        display: block;
    }
    
    .nav-tabs .nav-link {
        border: none;
        border-bottom: 2px solid transparent;
        color: #6c757d;
        font-weight: 500;
    }
    
    .nav-tabs .nav-link.active {
        border-bottom-color: #e91e63 !important;
        color: #e91e63 !important;
    }
    
    .nav-tabs .nav-link:hover {
        border-bottom-color: #e91e63 !important;
        color: #e91e63 !important;
    }
    
    .nav-tabs .nav-link {
        color: #6c757d !important;
    }
    
    /* Botão ações em massa */
    .btn-light-secondary {
        color: #6c757d !important;
    }
    
    /* Submenus de ações em massa */
    .menu-item .menu-link {
        color: #6c757d !important;
    }
    
    .menu-item .menu-link:hover {
        background-color: rgba(108, 117, 125, 0.1) !important;
        color: #6c757d !important;
    }
    
    .menu-item .menu-link.text-danger {
        color: #dc3545 !important;
    }
    
    .menu-item .menu-link.text-warning {
        color: #ffc107 !important;
    }
    
    /* Paginação */
    .dataTables_paginate .paginate_button.current {
        background-color: #e91e63 !important;
        border-color: #e91e63 !important;
        color: white !important;
    }
    
    .dataTables_paginate .paginate_button:hover {
        background-color: #e91e63 !important;
        border-color: #e91e63 !important;
        color: white !important;
    }
    
    .dataTables_paginate .paginate_button {
        color: #6c757d !important;
    }
    
    .dataTables_paginate .paginate_button.disabled {
        color: #6c757d !important;
    }
    
    .symbol-35px {
        width: 35px;
        height: 35px;
    }
    
    .symbol-circle img {
        border-radius: 50%;
    }
    
    #kt_search_results {
        max-height: 200px;
        overflow-y: auto;
    }
    
    .bulk-actions-menu {
        min-width: 200px;
    }
    
    .table-checkbox {
        cursor: pointer;
    }
    
    .action-buttons {
        white-space: nowrap;
    }
    
    .team-members-preview {
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }
    
    .team-member-avatar {
        width: 35px;
        height: 35px;
        border-radius: 50%;
        border: 2px solid #fff;
        box-shadow: 0 0 0 2px #e1e3ea;
    }
    
    .team-member-avatar:not(:first-child) {
        margin-left: -10px;
    }
    
    /* Corrigir scroll lateral e responsividade */
    .table-responsive {
        overflow-x: auto;
        width: 100%;
        max-width: 100%;
        margin: 0;
    }
    
    #kt_corretores_table,
    #kt_equipes_table {
        width: 100% !important;
        table-layout: auto !important;
    }
    
    /* Ajustar largura das colunas da tabela de corretores */
    #kt_corretores_table th:first-child,
    #kt_corretores_table td:first-child {
        width: 40px;
        min-width: 40px;
        max-width: 40px;
    }
    
    #kt_corretores_table th:nth-child(2),
    #kt_corretores_table td:nth-child(2) {
        min-width: 140px;
        width: 140px;
    }
    
    #kt_corretores_table th:nth-child(3),
    #kt_corretores_table td:nth-child(3) {
        min-width: 180px;
        width: 180px;
    }
    
    #kt_corretores_table th:nth-child(4),
    #kt_corretores_table td:nth-child(4) {
        min-width: 100px;
        width: 100px;
    }
    
    #kt_corretores_table th:nth-child(5),
    #kt_corretores_table td:nth-child(5) {
        min-width: 80px;
        width: 80px;
    }
    
    #kt_corretores_table th:nth-child(6),
    #kt_corretores_table td:nth-child(6) {
        min-width: 120px;
        width: 120px;
    }
    
    #kt_corretores_table th:last-child,
    #kt_corretores_table td:last-child {
        width: 100px;
        min-width: 100px;
        max-width: 100px;
    }
    
    /* Ajustar largura das colunas da tabela de equipes */
    #kt_equipes_table th:first-child,
    #kt_equipes_table td:first-child {
        min-width: 150px;
        width: 150px;
    }
    
    #kt_equipes_table th:nth-child(2),
    #kt_equipes_table td:nth-child(2) {
        min-width: 180px;
        width: 180px;
    }
    
    #kt_equipes_table th:nth-child(3),
    #kt_equipes_table td:nth-child(3) {
        min-width: 100px;
        width: 100px;
    }
    
    #kt_equipes_table th:nth-child(4),
    #kt_equipes_table td:nth-child(4) {
        min-width: 80px;
        width: 80px;
    }
    
    #kt_equipes_table th:last-child,
    #kt_equipes_table td:last-child {
        width: 100px;
        min-width: 100px;
        max-width: 100px;
    }
    
    /* Evitar overflow no container */
    .app-container {
        overflow-x: hidden;
    }
    
    .card-body {
        overflow-x: hidden;
        padding: 0 1.5rem 1.5rem 1.5rem;
    }
    
    /* Melhorar responsividade em dispositivos menores */
    @media (max-width: 768px) {
        .table-responsive {
            font-size: 0.875rem;
        }
        
        #kt_corretores_table th,
        #kt_corretores_table td,
        #kt_equipes_table th,
        #kt_equipes_table td {
            padding: 0.5rem 0.25rem;
        }
        
        .btn-sm {
            font-size: 0.75rem;
            padding: 0.25rem 0.5rem;
        }
    }
    
    /* Cores do projeto */
    .btn-light-primary {
        background-color: rgba(233, 30, 99, 0.1);
        color: #e91e63;
        border-color: rgba(233, 30, 99, 0.2);
    }
    
    .btn-light-primary:hover {
        background-color: rgba(233, 30, 99, 0.2);
        color: #e91e63;
        border-color: rgba(233, 30, 99, 0.3);
    }
    
    .btn-light-secondary {
        background-color: rgba(108, 117, 125, 0.1);
        color: #6c757d;
        border-color: rgba(108, 117, 125, 0.2);
    }
    
    .btn-light-secondary:hover {
        background-color: rgba(108, 117, 125, 0.2);
        color: #6c757d;
        border-color: rgba(108, 117, 125, 0.3);
    }
    
    .text-active-primary {
        color: #e91e63 !important;
    }
    
    .badge-light-primary {
        background-color: rgba(233, 30, 99, 0.1);
        color: #e91e63;
    }
    
    .badge-light-secondary {
        background-color: rgba(108, 117, 125, 0.1);
        color: #6c757d;
    }
    
    .menu-sub-dropdown {
        width: 200px !important;
        min-width: 200px !important;
        max-width: 200px !important;
        white-space: nowrap;
    }
    
    .menu-sub-dropdown .menu-link {
        white-space: nowrap !important;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    
    .btn[data-kt-menu-trigger] {
        position: relative;
    }
    
    .btn[data-kt-menu-trigger] .menu {
        z-index: 1050;
    }
</style> 