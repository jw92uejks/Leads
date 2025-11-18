<link href="{{ asset('assets/plugins/custom/fullcalendar/fullcalendar.bundle.css') }}" rel="stylesheet" type="text/css" />

<style>
    .form-check-custom {
        margin-top: 2.15rem !important;
        padding-left: 0 !important;
        display: flex !important;
        align-items: center !important;
    }

    .form-check-custom .form-check-input {
        width: 1.5rem !important;
        height: 1.5rem !important;
        border-radius: 0.25rem !important;
        margin-top: 0 !important;
        margin-left: 0 !important;
        margin-right: 0.5rem !important;
        position: relative !important;
    }

    .form-check-custom .form-check-input:checked {
        background-color: var(--bs-primary) !important;
        border-color: var(--bs-primary) !important;
    }

    .form-check-custom .form-check-label {
        cursor: pointer;
        margin-top: 0 !important;
        color: var(--bs-gray-700) !important;
        font-weight: 500;
        padding-left: 0 !important;
        user-select: none;
    }

    /* Efeito hover para as datas do calendário */
    .fc-daygrid-day:hover {
        background-color: #fce4ec !important;
        transition: background-color 0.2s ease;
    }

    .fc-daygrid-day:hover .fc-daygrid-day-number {
        color: #c2185b !important;
        font-weight: 600;
    }

    /* Efeito hover para as células de data em outras visualizações */
    .fc-timegrid-day:hover {
        background-color: #fce4ec !important;
        transition: background-color 0.2s ease;
    }

    .fc-list-day:hover {
        background-color: #fce4ec !important;
        transition: background-color 0.2s ease;
    }

    /* Estilo do dia atual */
    .fc-day-today {
        background-color: #fce4ec !important;
    }

    .fc-day-today .fc-daygrid-day-number {
        color: #c2185b !important;
        font-weight: 600;
    }

    /* Efeito hover para o dia atual */
    .fc-day-today:hover {
        background-color: #f8bbd9 !important;
    }

    /* Efeito hover para dias de outros meses */
    .fc-day-other:hover {
        background-color: #f3e5f5 !important;
    }

    /* Responsividade do calendário */
    .fc {
        width: 100% !important;
        max-width: 100% !important;
    }

    /* Ajustes para telas pequenas */
    @media (max-width: 768px) {
        .fc-toolbar {
            flex-direction: column !important;
            gap: 10px !important;
        }

        .fc-toolbar-chunk {
            display: flex !important;
            justify-content: center !important;
            width: 100% !important;
        }

        .fc-button-group {
            display: flex !important;
            flex-wrap: wrap !important;
            justify-content: center !important;
        }

        .fc-button {
            font-size: 0.8rem !important;
            padding: 0.4rem 0.8rem !important;
        }

        .fc-daygrid-day-number {
            font-size: 0.9rem !important;
        }

        .fc-event-title {
            font-size: 0.75rem !important;
        }
    }

    /* Ajustes para telas muito pequenas */
    @media (max-width: 576px) {
        .fc-toolbar-title {
            font-size: 1.2rem !important;
            margin: 10px 0 !important;
        }

        .fc-button {
            font-size: 0.7rem !important;
            padding: 0.3rem 0.6rem !important;
        }

        .fc-daygrid-day-number {
            font-size: 0.8rem !important;
        }

        .fc-col-header-cell {
            font-size: 0.8rem !important;
        }
    }

    /* Container do calendário */
    #kt_docs_fullcalendar_basic {
        min-height: 550px;
        width: 100%;
        padding: 30px;
    }
</style>