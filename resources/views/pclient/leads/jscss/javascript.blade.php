<script>
"use strict";

var KTLeadsList = function () {
    var datatable;
    var table;
    var dateRangePicker;

    var initLeadsList = function () {
        table = document.querySelector('#kt_leads_table');

        if (!table) {
            return;
        }

        datatable = $(table).DataTable({
            "info": true,
            'order': [],
            'pageLength': 10,
            'ordering': true,
            'responsive': true,
            'dom': 'ltip',
            'language': {
                'paginate': {
                    'first': 'Primeiro',
                    'last': 'Último',
                    'next': 'Próximo',
                    'previous': 'Anterior'
                },
                'search': 'Buscar:',
                'lengthMenu': 'Mostrar _MENU_ registros por página',
                'info': 'Mostrando _START_ até _END_ de _TOTAL_ leads',
                'infoEmpty': 'Mostrando 0 até 0 de 0 leads',
                'emptyTable': 'Nenhum lead encontrado',
                'zeroRecords': 'Nenhum lead encontrado'
            },
            'columnDefs': [
                { orderable: false, targets: 5 },
                { targets: 2, orderable: false },
                { targets: 5, className: 'text-end' }
            ],
        });

        datatable.on('draw', function () {
            initToggleToolbar();
            handleDeleteRows();
            toggleToolbars();
            KTMenu.createInstances();
        });
    }

    var initDateRangePicker = function () {
        const dateRangePickerElement = document.querySelector('#kt_leads_daterangepicker');
        if (dateRangePickerElement) {
            dateRangePicker = $(dateRangePickerElement).daterangepicker({
                locale: {
                    format: 'DD/MM/YYYY',
                    separator: ' - ',
                    applyLabel: 'Apply',
                    cancelLabel: 'Cancel',
                    fromLabel: 'From',
                    toLabel: 'To',
                    customRangeLabel: 'Custom Range',
                    daysOfWeek: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa'],
                    monthNames: ['January', 'February', 'March', 'April', 'May', 'June',
                               'July', 'August', 'September', 'October', 'November', 'December'],
                    firstDay: 1
                },
                autoUpdateInput: false,
                opens: 'left',
                drops: 'down',
                ranges: {
                    'Today': [moment(), moment()],
                    'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                    'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                    'This Month': [moment().startOf('month'), moment().endOf('month')],
                    'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                },
                alwaysShowCalendars: true,
                startDate: moment().subtract(29, 'days'),
                endDate: moment()
            });

            $(dateRangePickerElement).on('apply.daterangepicker', function(ev, picker) {
                $(this).val(picker.startDate.format('DD/MM/YYYY') + ' - ' + picker.endDate.format('DD/MM/YYYY'));
                datatable.draw();
            });

            $(dateRangePickerElement).on('cancel.daterangepicker', function(ev, picker) {
                $(this).val('');
                datatable.draw();
            });

            // Definir valor inicial
            $(dateRangePickerElement).val(moment().subtract(29, 'days').format('DD/MM/YYYY') + ' - ' + moment().format('DD/MM/YYYY'));
        }
    }

    var handleSearchDatatable = function () {
        const filterSearch = document.querySelector('[data-kt-leads-table-filter="search"]');
        filterSearch.addEventListener('keyup', function (e) {
            datatable.search(e.target.value).draw();
        });
    }

    var handleResetForm = function () {
        const resetButton = document.querySelector('[data-kt-ecommerce-order-filter="reset"]');
        resetButton.addEventListener('click', function () {
            const filterForm = document.querySelector('[data-kt-ecommerce-order-filter="form"]');
            filterForm.querySelectorAll('select').forEach(select => {
                $(select).val(null).trigger('change');
            });
            datatable.search('').draw();
        });
    }

    var handleDeleteRows = function () {
        const deleteButtons = table.querySelectorAll('[data-kt-leads-table-filter="delete_row"]');

        deleteButtons.forEach(d => {
            d.addEventListener('click', function (e) {
                e.preventDefault();

                const parent = e.target.closest('tr');

                Swal.fire({
                    text: "Tem certeza de que deseja remover este lead?",
                    icon: "warning",
                    showCancelButton: true,
                    buttonsStyling: false,
                    confirmButtonText: "Sim, remover!",
                    cancelButtonText: "Cancelar",
                    customClass: {
                        confirmButton: "btn fw-bold btn-danger",
                        cancelButton: "btn fw-bold btn-active-light-primary"
                    }
                }).then(function (result) {
                    if (result.value) {
                        datatable.row($(parent)).remove().draw();

                        Swal.fire({
                            text: "Lead removido com sucesso!",
                            icon: "success",
                            buttonsStyling: false,
                            confirmButtonText: "Ok, entendi!",
                            customClass: {
                                confirmButton: "btn fw-bold btn-primary",
                            }
                        });
                    }
                });
            })
        });
    }

    var handleFilterDatatable = function () {
        const filterButton = document.querySelector('[data-kt-ecommerce-order-filter="filter"]');
        const selectOptions = document.querySelectorAll('[data-kt-ecommerce-order-filter="form"] select');

        filterButton.addEventListener('click', function () {
            var filterString = '';

            selectOptions.forEach((item, index) => {
                if (item.value && item.value !== '') {
                    if (index !== 0) {
                        filterString += ' ';
                    }
                    filterString += item.value;
                }
            });

            datatable.search(filterString).draw();
        });
    }

    var handleMainTemperatureFilter = function () {
        const filterMainTemperature = document.querySelector('[data-kt-leads-table-filter="main-temperature"]');
        $(filterMainTemperature).on('change', e => {
            let value = e.target.value;
            if (value === 'Todos') {
                value = '';
            }
            datatable.column(2).search(value).draw();
        });
    }

    var initToggleToolbar = function () {
        const container = document.querySelector('#kt_leads_table');
        const checkboxes = container.querySelectorAll('[type="checkbox"]');

        const deleteSelected = document.querySelector('[data-kt-leads-table-select="delete_selected"]');

        checkboxes.forEach(c => {
            c.addEventListener('click', function () {
                setTimeout(function () {
                    toggleToolbars();
                }, 50);
            });
        });

        if (deleteSelected) {
            deleteSelected.addEventListener('click', function () {
                Swal.fire({
                    text: "Tem certeza de que deseja remover os leads selecionados?",
                    icon: "warning",
                    showCancelButton: true,
                    buttonsStyling: false,
                    confirmButtonText: "Sim, remover!",
                    cancelButtonText: "Cancelar",
                    customClass: {
                        confirmButton: "btn fw-bold btn-danger",
                        cancelButton: "btn fw-bold btn-active-light-primary"
                    }
                }).then(function (result) {
                    if (result.value) {
                        Swal.fire({
                            text: "Leads removidos com sucesso!",
                            icon: "success",
                            buttonsStyling: false,
                            confirmButtonText: "Ok, entendi!",
                            customClass: {
                                confirmButton: "btn fw-bold btn-primary",
                            }
                        }).then(function () {
                            const headerCheckbox = container.querySelectorAll('[type="checkbox"]')[0];
                            const checkboxes = container.querySelectorAll(':not(thead) [type="checkbox"]');

                            checkboxes.forEach(c => {
                                if (c.checked) {
                                    datatable.row($(c.closest('tbody tr'))).remove().draw();
                                }
                            });

                            headerCheckbox.checked = false;
                            toggleToolbars();
                        });
                    }
                });
            });
        }
    }

    var toggleToolbars = function () {
        const container = document.querySelector('#kt_leads_table');
        const toolbarBase = document.querySelector('[data-kt-leads-table-toolbar="base"]');
        const toolbarSelected = document.querySelector('[data-kt-leads-table-toolbar="selected"]');
        const selectedCount = document.querySelector('[data-kt-leads-table-select="selected_count"]');

        const allCheckboxes = container.querySelectorAll('tbody [type="checkbox"]');

        let checkedState = false;
        let count = 0;

        allCheckboxes.forEach(c => {
            if (c.checked) {
                checkedState = true;
                count++;
            }
        });

        if (checkedState) {
            selectedCount.innerHTML = count;
            toolbarBase.classList.add('d-none');
            toolbarSelected.classList.remove('d-none');
        } else {
            toolbarBase.classList.remove('d-none');
            toolbarSelected.classList.add('d-none');
        }
    }

    var handleExportButtons = function () {
        const exportButtons = document.querySelectorAll('#kt_leads_export_menu [data-kt-leads-export]');

        exportButtons.forEach(exportButton => {
            exportButton.addEventListener('click', e => {
                e.preventDefault();
                const exportValue = e.target.getAttribute('data-kt-leads-export');
                const target = document.querySelector('.dt-buttons .buttons-' + exportValue);

                if (target) {
                    target.click();
                }
            });
        });
    }

    return {
        init: function () {
            initLeadsList();
            initDateRangePicker();
            initToggleToolbar();
            handleSearchDatatable();
            handleResetForm();
            handleDeleteRows();
            handleFilterDatatable();
            handleMainTemperatureFilter();
            handleExportButtons();
        }
    }
}();

KTUtil.onDOMContentLoaded(function () {
    KTLeadsList.init();
});
</script> 