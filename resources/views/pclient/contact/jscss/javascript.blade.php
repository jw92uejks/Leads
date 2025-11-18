<script src="{{ asset('/assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>

@include('components.alert')

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Cache de elementos DOM
    const elements = {
        clearFiltersBtn: document.getElementById('clear-filters-btn'),
        searchInput: document.querySelector('[data-kt-customer-table-filter="search"]'),
        searchInputHidden: document.getElementById('search-input-hidden'),
        applyFiltersBtn: document.getElementById('apply-filters-btn'),
        perPageSelect: document.querySelector('[data-kt-customer-table-filter="per_page"]'),
        filterForm: document.getElementById('filter-form'),
        filterButton: document.querySelector('[data-kt-menu-trigger="click"]'),
        loadingIndicator: document.getElementById('loading-indicator'),
        tableBody: document.getElementById('contacts-table-body'),
        paginationContainer: document.getElementById('contacts-pagination')
    };

    // Variáveis de estado
    let searchTimeout;
    let lastSearchTerm = '';

    // Funções utilitárias
    function showErrorMessage(message) {
        if (typeof Swal !== 'undefined') {
            Swal.fire({
                title: 'Atenção',
                text: message,
                icon: 'warning',
                confirmButtonText: 'OK',
                customClass: {
                    confirmButton: 'btn btn-primary'
                },
                buttonsStyling: false,
                width: 400,
                heightAuto: false,
                padding: '2rem'
            });
        } else {
            alert(message);
        }
    }

    function showRateLimitMessage() {
        showErrorMessage('Muitas buscas realizadas. Aguarde alguns segundos antes de tentar novamente.');
    }

    function getFormData() {
        return {
            search: elements.searchInput?.value.trim() || '',
            search_field: document.querySelector('select[name="search_field"]')?.value || '',
            status: document.querySelector('select[name="status"]')?.value || '',
            source: document.querySelector('select[name="source"]')?.value || '',
            sort_by: document.querySelector('select[name="sort_by"]')?.value || 'id',
            sort_direction: document.querySelector('select[name="sort_direction"]')?.value || 'desc',
            date_from: document.querySelector('input[name="date_from"]')?.value || '',
            date_to: document.querySelector('input[name="date_to"]')?.value || '',
            per_page: elements.perPageSelect?.value || '10'
        };
    }

    function syncSearchInputs() {
        if (elements.searchInput && elements.searchInputHidden) {
            elements.searchInputHidden.value = elements.searchInput.value;
        }
    }

    function performDynamicSearch(searchTerm) {
        if (elements.loadingIndicator && elements.tableBody) {
            elements.loadingIndicator.classList.remove('d-none');
            elements.tableBody.classList.add('d-none');
        }

        const formData = getFormData();
        formData.search = searchTerm;

        fetch('{{ route("contact.ajax.index") }}?' + new URLSearchParams(formData))
            .then(response => {
                if (response.status === 429) {
                    showRateLimitMessage();
                    return;
                }
                return response.json();
            })
            .then(data => {
                if (data?.success) {
                    if (elements.tableBody) {
                        elements.tableBody.innerHTML = data.html;
                        elements.tableBody.classList.remove('d-none');
                    }
                    if (elements.paginationContainer && data.pagination) {
                        elements.paginationContainer.innerHTML = data.pagination;
                    }
                } else if (data && !data.success) {
                    showErrorMessage(data.message || 'Erro na busca');
                }
            })
            .catch(error => {
                console.error('Erro na busca:', error);
                showErrorMessage('Erro de conexão. Tente novamente.');
            })
            .finally(() => {
                if (elements.loadingIndicator) {
                    elements.loadingIndicator.classList.add('d-none');
                }
            });
    }

    function updateFilterVisuals() {
        syncSearchInputs();

        const filterSelectors = {
            search_field: 'select[name="search_field"]',
            date_from: 'input[name="date_from"]',
            date_to: 'input[name="date_to"]',
            sort_by: 'select[name="sort_by"]',
            sort_direction: 'select[name="sort_direction"]',
            per_page: '[data-kt-customer-table-filter="per_page"]'
        };

        const filters = Object.entries(filterSelectors).reduce((acc, [key, selector]) => {
            const element = document.querySelector(selector);
            acc[key] = element?.value || (key === 'sort_by' ? 'id' : key === 'sort_direction' ? 'desc' : key === 'per_page' ? '10' : '');
            return acc;
        }, {});

        const activeFiltersCount = Object.values(filters).filter(value =>
            value && value !== '' && value !== 'id' && value !== 'desc' && value !== '10'
        ).length;

        document.querySelectorAll('.contact-form-section').forEach(section => {
            section.classList.toggle('has-active-filters', activeFiltersCount > 0);
        });

        const filterButton = document.querySelector('.contact-filter-trigger');
        if (filterButton) {
            filterButton.classList.toggle('has-active-filters', activeFiltersCount > 0);
            if (activeFiltersCount > 0) {
                filterButton.setAttribute('data-filter-count', activeFiltersCount);
            } else {
                filterButton.removeAttribute('data-filter-count');
            }
        }
    }

    function fixFilterMenuPosition() {
        const filterMenu = document.getElementById('kt-toolbar-filter');
        if (filterMenu) {
            Object.assign(filterMenu.style, {
                position: 'absolute',
                top: '100%',
                left: 'auto',
                right: '0',
                transform: 'none',
                marginTop: '0.5rem',
                zIndex: '1050'
            });
        }
    }

    function createDeleteForm(contactId) {
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = `/contact/${contactId}`;
        form.style.display = 'none';

        const csrfToken = document.createElement('input');
        csrfToken.type = 'hidden';
        csrfToken.name = '_token';
        csrfToken.value = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        const methodField = document.createElement('input');
        methodField.type = 'hidden';
        methodField.name = '_method';
        methodField.value = 'DELETE';

        form.appendChild(csrfToken);
        form.appendChild(methodField);
        document.body.appendChild(form);
        form.submit();
    }

    // Event Listeners
    if (elements.clearFiltersBtn) {
        elements.clearFiltersBtn.addEventListener('click', () => {
            window.location.href = '{{ route('contact.index') }}';
        });
    }

    if (elements.applyFiltersBtn) {
        elements.applyFiltersBtn.addEventListener('click', () => {
            performDynamicSearch(elements.searchInput?.value.trim() || '');
        });
    }

    if (elements.searchInput) {
        elements.searchInput.addEventListener('input', function() {
            const searchTerm = this.value.trim();
            syncSearchInputs();

            if (searchTerm === lastSearchTerm) return;

            clearTimeout(searchTimeout);
            searchTimeout = setTimeout(() => {
                lastSearchTerm = searchTerm;
                performDynamicSearch(searchTerm);
            }, 800);
        });

        elements.searchInput.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                clearTimeout(searchTimeout);
                performDynamicSearch(this.value.trim());
            }
        });
    }

    if (elements.perPageSelect) {
        elements.perPageSelect.addEventListener('change', () => {
            performDynamicSearch(elements.searchInput?.value.trim() || '');
        });
    }

    if (elements.filterForm) {
        elements.filterForm.addEventListener('submit', (e) => e.preventDefault());
    }

    if (elements.filterButton) {
        elements.filterButton.addEventListener('click', () => {
            [10, 50, 100].forEach(delay => setTimeout(fixFilterMenuPosition, delay));
        });

        const observer = new MutationObserver(() => fixFilterMenuPosition());
        observer.observe(elements.filterButton.parentNode, { childList: true, subtree: true });
    }

    const filterInputs = document.querySelectorAll('#filter-form input, #filter-form select');
    filterInputs.forEach(input => {
        input.addEventListener('change', function() {
            updateFilterVisuals();
            if (input.name !== 'search') {
                performDynamicSearch(elements.searchInput?.value.trim() || '');
            }
        });
        input.addEventListener('input', updateFilterVisuals);
    });

    document.querySelectorAll('form[id^="editcontact-form-"]').forEach(form => {
        form.addEventListener('submit', function() {
            const submitBtn = form.querySelector('button[type="submit"]');
            if (submitBtn) {
                submitBtn.disabled = true;
                submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Atualizando...';
            }
        });
    });

    updateFilterVisuals();
});

function confirmDelete(contactId, contactName) {
    const deleteForm = () => {
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = `/contact/${contactId}`;
        form.style.display = 'none';

        const csrfToken = document.createElement('input');
        csrfToken.type = 'hidden';
        csrfToken.name = '_token';
        csrfToken.value = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        const methodField = document.createElement('input');
        methodField.type = 'hidden';
        methodField.name = '_method';
        methodField.value = 'DELETE';

        form.appendChild(csrfToken);
        form.appendChild(methodField);
        document.body.appendChild(form);
        form.submit();
    };

    if (typeof Swal !== 'undefined') {
        Swal.fire({
            title: 'Tem certeza?',
            text: `Deseja excluir o contato "${contactName}"? Esta ação não pode ser desfeita.`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Sim, excluir!',
            cancelButtonText: 'Cancelar',
            customClass: {
                confirmButton: 'btn btn-danger',
                cancelButton: 'btn btn-secondary'
            },
            buttonsStyling: false,
            width: 400,
            heightAuto: false,
            padding: '2.5rem'
        }).then((result) => {
            if (result.isConfirmed) deleteForm();
        });
    } else {
        if (confirm(`Tem certeza que deseja excluir o contato "${contactName}"? Esta ação não pode ser desfeita.`)) {
            deleteForm();
        }
    }
}
</script>
