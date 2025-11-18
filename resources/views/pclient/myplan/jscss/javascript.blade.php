<script>
"use strict";

var KTTransactionsPage = function () {
    var filterModal;
    var filterForm;
    var filterButton;
    var cancelButton;
    var closeButton;

    var initFilterModal = function () {
        filterModal = new bootstrap.Modal(document.querySelector('#kt_modal_filter_transactions'));
        filterForm = document.querySelector('#kt_modal_filter_transactions_form');
        filterButton = document.querySelector('[data-kt-filter-transactions-modal-action="submit"]');
        cancelButton = document.querySelector('[data-kt-filter-transactions-modal-action="cancel"]');
        closeButton = document.querySelector('[data-kt-filter-transactions-modal-action="close"]');

        if (filterButton) {
            filterButton.addEventListener('click', function (e) {
                e.preventDefault();
                
                filterButton.setAttribute('data-kt-indicator', 'on');
                filterButton.disabled = true;

                setTimeout(function () {
                    filterButton.removeAttribute('data-kt-indicator');
                    filterButton.disabled = false;
                    filterModal.hide();
                    
                    Swal.fire({
                        text: "Filtros aplicados com sucesso!",
                        icon: "success",
                        buttonsStyling: false,
                        confirmButtonText: "Ok, entendi!",
                        customClass: {
                            confirmButton: "btn btn-primary"
                        }
                    });
                }, 2000);
            });
        }

        if (cancelButton) {
            cancelButton.addEventListener('click', function (e) {
                e.preventDefault();
                filterModal.hide();
            });
        }

        if (closeButton) {
            closeButton.addEventListener('click', function (e) {
                e.preventDefault();
                filterModal.hide();
            });
        }
    };

    var initCounters = function () {
        var counters = document.querySelectorAll('[data-kt-countup="true"]');
        
        counters.forEach(function(counter) {
            var finalValue = counter.getAttribute('data-kt-countup-value');
            var prefix = counter.getAttribute('data-kt-countup-prefix') || '';
            
            var countUp = new CountUp(counter, finalValue, {
                prefix: prefix,
                duration: 2,
                separator: '.',
                decimal: ','
            });
            
            if (!countUp.error) {
                countUp.start();
            }
        });
    };

    var initTabs = function () {
        var tabLinks = document.querySelectorAll('[data-bs-toggle="tab"]');
        
        tabLinks.forEach(function(tabLink) {
            tabLink.addEventListener('shown.bs.tab', function (e) {
                var target = e.target.getAttribute('href');
                console.log('Tab ativada: ' + target);
            });
        });
    };

    return {
        init: function () {
            initFilterModal();
            initCounters();
            initTabs();
        }
    };
}();

KTUtil.onDOMContentLoaded(function () {
    KTTransactionsPage.init();
});
</script> 