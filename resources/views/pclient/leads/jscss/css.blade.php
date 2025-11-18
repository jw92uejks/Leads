<style>
.d-flex.align-items-center.gap-2.gap-lg-3 {
    width: 270px;
}

.text-pink {
    color: #e91e63 !important;
}

.btn-light-pink {
    color: #e91e63;
    background-color: rgba(233, 30, 99, 0.1);
    border-color: rgba(233, 30, 99, 0.1);
}

.btn-light-pink:hover {
    color: #fff;
    background-color: #e91e63;
    border-color: #e91e63;
}

.btn-pink {
    color: #fff;
    background-color: #e91e63;
    border-color: #e91e63;
}

.btn-pink:hover {
    color: #fff;
    background-color: #d81b60;
    border-color: #d81b60;
}

.badge-light-danger {
    color: #e91e63;
    background-color: rgba(233, 30, 99, 0.1);
}

.badge-light-warning {
    color: #ff9800;
    background-color: rgba(255, 152, 0, 0.1);
}

.badge-light-info {
    color: #2196f3;
    background-color: rgba(33, 150, 243, 0.1);
}

.badge-light-success {
    color: #4caf50;
    background-color: rgba(76, 175, 80, 0.1);
}

#kt_leads_table tbody tr:hover {
    background-color: rgba(233, 30, 99, 0.05) !important;
}

.card-flush {
    box-shadow: 0px 0px 20px 0px rgba(76, 78, 100, 0.16);
}

.table th {
    background-color: #f8f9fa;
    border-top: 1px solid #e4e6ea;
    padding: 12px 16px;
}

.table td {
    padding: 12px 16px;
    vertical-align: middle;
}

#kt_leads_table th.ps-4 {
    padding-left: 20px !important;
}

#kt_leads_table th.pe-4 {
    padding-right: 20px !important;
}

#kt_leads_table td.ps-4 {
    padding-left: 20px !important;
}

#kt_leads_table td.pe-4 {
    padding-right: 20px !important;
}

.dataTables_wrapper .dataTables_paginate .paginate_button.current {
    background: #e91e63 !important;
    border-color: #e91e63 !important;
    color: white !important;
}

.dataTables_wrapper .dataTables_paginate .paginate_button:hover {
    background: rgba(233, 30, 99, 0.1) !important;
    border-color: #e91e63 !important;
    color: #e91e63 !important;
}

.dataTables_wrapper .dataTables_info {
    color: #7e8299;
    font-size: 13px;
    font-weight: 500;
}

.dataTables_wrapper .dataTables_length select {
    border: 1px solid #e4e6ea;
    border-radius: 0.475rem;
    background-color: #fff;
    color: #5e6278;
}

.w-150px {
    width: 150px !important;
    min-width: 150px !important;
}

#kt_leads_daterangepicker {
    cursor: pointer;
    background-color: #fff;
    border: 1px solid #e4e6ea;
    border-radius: 0.475rem;
    color: #5e6278;
    font-size: 13px;
    font-weight: 500;
}

#kt_leads_daterangepicker:focus {
    border-color: #e91e63;
    box-shadow: 0 0 0 0.2rem rgba(233, 30, 99, 0.25);
}

.daterangepicker {
    background-color: #ffffff;
    border: 1px solid #e4e6ea;
    border-radius: 0.475rem;
    box-shadow: 0 4px 20px 0 rgba(76, 78, 100, 0.1);
}

.daterangepicker .ranges {
    background-color: #ffffff;
    border-right: 1px solid #e4e6ea;
}

.daterangepicker .ranges ul {
    list-style: none;
    margin: 0;
    padding: 0;
}

.daterangepicker .ranges li {
    color: #5e6278;
    padding: 8px 20px;
    cursor: pointer;
    font-size: 13px;
    font-weight: 500;
    border-radius: 0.475rem;
    margin: 4px 8px;
}

.daterangepicker .ranges li:hover {
    background-color: #f5f8fa;
    color: #009ef7;
}

.daterangepicker .ranges li.active {
    background-color: #009ef7;
    color: #ffffff;
}

.daterangepicker .calendar-table {
    background-color: #ffffff;
}

.daterangepicker .calendar-table .next,
.daterangepicker .calendar-table .prev {
    color: #a1a5b7;
}

.daterangepicker .calendar-table .next:hover,
.daterangepicker .calendar-table .prev:hover {
    color: #009ef7;
}

.daterangepicker .calendar-table th {
    color: #a1a5b7;
    font-size: 11px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.1em;
    padding: 8px;
    border-bottom: 1px solid #e4e6ea;
}

.daterangepicker .calendar-table td {
    color: #5e6278;
    font-size: 13px;
    font-weight: 500;
    padding: 8px;
    text-align: center;
    border-radius: 0.475rem;
    cursor: pointer;
}

.daterangepicker .calendar-table td:hover {
    background-color: #f5f8fa;
    color: #009ef7;
}

.daterangepicker .calendar-table td.active,
.daterangepicker .calendar-table td.in-range {
    background-color: #009ef7;
    color: #ffffff;
}

.daterangepicker .calendar-table td.start-date,
.daterangepicker .calendar-table td.end-date {
    background-color: #009ef7;
    color: #ffffff;
}

.daterangepicker .calendar-table td.off {
    color: #b5b5c3;
}

.daterangepicker .calendar-table td.today {
    font-weight: 600;
    color: #009ef7;
}

.daterangepicker .drp-buttons {
    border-top: 1px solid #e4e6ea;
    padding: 15px;
    text-align: right;
}

.daterangepicker .drp-buttons .btn {
    margin-left: 8px;
    font-size: 12px;
    font-weight: 600;
    padding: 8px 20px;
    border-radius: 0.475rem;
}

.daterangepicker .drp-buttons .cancelBtn {
    color: #7e8299;
    background-color: transparent;
    border: 1px solid #e4e6ea;
}

.daterangepicker .drp-buttons .cancelBtn:hover {
    color: #5e6278;
    background-color: #f5f8fa;
}

.daterangepicker .drp-buttons .applyBtn {
    color: #ffffff;
    background-color: #009ef7;
    border: 1px solid #009ef7;
}

.daterangepicker .drp-buttons .applyBtn:hover {
    background-color: #0095e8;
    border-color: #0095e8;
}

.daterangepicker .drp-calendar.left,
.daterangepicker .drp-calendar.right {
    border: none;
    padding: 20px;
}

.daterangepicker .month {
    color: #181c32;
    font-size: 16px;
    font-weight: 600;
    text-align: center;
    padding: 10px 0;
}

.select2-container--bootstrap5 .select2-selection--single:focus {
    border-color: #e91e63;
    box-shadow: 0 0 0 0.2rem rgba(233, 30, 99, 0.25);
}

.select2-container--bootstrap5 .select2-dropdown {
    border-color: #e4e6ea;
}

.select2-container--bootstrap5 .select2-results__option--highlighted {
    background-color: #e91e63;
}

.table th {
    padding-left: 1.5rem;
    padding-right: 1.5rem;
}

.table td {
    padding-left: 1.5rem;
    padding-right: 1.5rem;
}

.dataTables_paginate .paginate_button {
    color: #5e6278 !important;
    background: #ffffff !important;
    border: 1px solid #e4e6ea !important;
    border-radius: 0.475rem !important;
    padding: 0.5rem 0.75rem !important;
    margin: 0 0.125rem !important;
    font-size: 13px !important;
    font-weight: 500 !important;
}

.dataTables_paginate .paginate_button:hover {
    color: #e91e63 !important;
    background: #f5f5f5 !important;
    border-color: #e91e63 !important;
}

.dataTables_paginate .paginate_button.current {
    color: #ffffff !important;
    background: #e91e63 !important;
    border-color: #e91e63 !important;
}

.dropdown-menu .w-150px {
    min-width: 150px !important;
}

.badge-light-success { background-color: #d4edda; color: #155724; }
.badge-light-warning { background-color: #fff3cd; color: #856404; }
.badge-light-primary { background-color: #cce5ff; color: #004085; }

.symbol-label { background-color: #f8f9fa; }

[data-kt-leads-table-toolbar="selected"] { display: none; }

.form-select:focus, .form-control:focus { 
    border-color: #e91e63; 
    box-shadow: 0 0 0 0.2rem rgba(233, 30, 99, 0.25); 
}

.btn-light-primary { 
    color: #e91e63; 
    background-color: rgba(233, 30, 99, 0.1); 
    border-color: rgba(233, 30, 99, 0.1); 
}

.btn-light-primary:hover { 
    color: #fff; 
    background-color: #e91e63; 
    border-color: #e91e63; 
}
</style> 