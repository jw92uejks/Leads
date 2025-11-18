<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Controla o botão de transferência em lote
        const selectAllCheckbox = document.querySelector('[data-kt-select="select_all"]');
        const leadCheckboxes = document.querySelectorAll('.lead-checkbox');
        const transferSelectedBtn = document.getElementById('transferSelectedBtn');

        function updateTransferButton() {
            const checkedBoxes = document.querySelectorAll('.lead-checkbox:checked');
            transferSelectedBtn.disabled = checkedBoxes.length === 0;
            
            // Atualizar contador de leads selecionados
            const selectedLeadsCount = document.getElementById('selectedLeadsCount');
            if (selectedLeadsCount) {
                selectedLeadsCount.textContent = checkedBoxes.length;
            }
        }

        // Select all checkbox
        if (selectAllCheckbox) {
            selectAllCheckbox.addEventListener('change', function() {
                leadCheckboxes.forEach(checkbox => {
                    checkbox.checked = this.checked;
                });
                updateTransferButton();
            });
        }

        // Individual checkboxes
        leadCheckboxes.forEach(checkbox => {
            checkbox.addEventListener('change', function() {
                updateTransferButton();
                
                // Update select all checkbox state
                const checkedBoxes = document.querySelectorAll('.lead-checkbox:checked');
                if (selectAllCheckbox) {
                    selectAllCheckbox.checked = checkedBoxes.length === leadCheckboxes.length;
                    selectAllCheckbox.indeterminate = checkedBoxes.length > 0 && checkedBoxes.length < leadCheckboxes.length;
                }
            });
        });

        // Atualizar tipo de transferência nos modais
        document.querySelectorAll('input[name="transfer_type"]').forEach(radio => {
            radio.addEventListener('change', function() {
                const transferType = document.getElementById('transferType');
                if (transferType) {
                    transferType.textContent = this.value === 'responsibility' ? 'Responsabilidade' : 'Titularidade';
                }
            });
        });

        document.querySelectorAll('input[name="single_transfer_type"]').forEach(radio => {
            radio.addEventListener('change', function() {
                const transferType = document.getElementById('singleTransferType');
                if (transferType) {
                    transferType.textContent = this.value === 'responsibility' ? 'Responsabilidade' : 'Titularidade';
                }
            });
        });

        // Atualizar nome do lead no modal individual
        document.querySelectorAll('[data-bs-target="#transferSingleLeadModal"]').forEach(button => {
            button.addEventListener('click', function() {
                const leadName = this.getAttribute('data-lead-name');
                const singleLeadName = document.getElementById('singleLeadName');
                if (singleLeadName && leadName) {
                    singleLeadName.textContent = leadName;
                }
            });
        });

        // Filtros
        document.getElementById('filter_lead_type')?.addEventListener('change', applyFilters);
        document.getElementById('filter_operadora')?.addEventListener('change', applyFilters);
        document.getElementById('filter_ddd')?.addEventListener('change', applyFilters);
        document.getElementById('filter_date')?.addEventListener('change', applyFilters);

        function applyFilters() {
            const leadType = document.getElementById('filter_lead_type').value;
            const operadora = document.getElementById('filter_operadora').value;
            const ddd = document.getElementById('filter_ddd').value;
            const filterDate = document.getElementById('filter_date').value;

            const rows = document.querySelectorAll('#leads_transfer_table tbody tr');
            
            rows.forEach(row => {
                let show = true;
                
                // Filtro por tipo
                if (leadType && row.querySelector('td:nth-child(3) .badge').textContent.trim() !== getLeadTypeLabel(leadType)) {
                    show = false;
                }
                
                // Filtro por operadora
                if (operadora) {
                    const operadoraCell = row.querySelector('td:nth-child(4)');
                    const operadoraValue = operadoraCell.getAttribute('data-operadora');
                    if (operadoraValue !== operadora) {
                        show = false;
                    }
                }
                
                // Filtro por DDD
                if (ddd && !row.querySelector('td:nth-child(6)').textContent.includes(ddd)) {
                    show = false;
                }
                
                // Filtro por data
                if (filterDate) {
                    const rowDateCell = row.querySelector('td:nth-child(5)');
                    if (rowDateCell) {
                        const rowDateOrder = rowDateCell.getAttribute('data-order');
                        if (rowDateOrder && rowDateOrder !== filterDate) {
                            show = false;
                        }
                    }
                }
                
                row.style.display = show ? '' : 'none';
            });
        }

        function getLeadTypeLabel(value) {
            const types = {
                '1': 'Pessoa Física',
                '2': 'Pessoa Jurídica',
                '3': 'Adesão',
                '4': 'Mista'
            };
            return types[value] || '';
        }
    });
</script>
