<script>
    document.addEventListener('DOMContentLoaded', function() {
    // Aguardar que o Bootstrap esteja carregado antes de inicializar
    waitForBootstrap(function() {
        initializeMarketplace();
    });
});

// Verificar se o Bootstrap está carregado
function waitForBootstrap(callback, maxAttempts = 10) {
    let attempts = 0;
    
    function checkBootstrap() {
        attempts++;
        console.log(`🔍 Tentativa ${attempts} de verificar Bootstrap...`);
        
        if (typeof bootstrap !== 'undefined' && bootstrap.Collapse) {
            console.log('✅ Bootstrap carregado com sucesso!');
            callback();
        } else if (attempts < maxAttempts) {
            console.log('⏳ Bootstrap ainda não carregado, tentando novamente...');
            setTimeout(checkBootstrap, 200);
        } else {
            console.log('⚠️ Bootstrap não carregado após várias tentativas, usando fallback');
            callback();
        }
    }
    
    checkBootstrap();
}

// Função para inicializar collapse manualmente se Bootstrap não estiver disponível
function initializeCollapseManual(button, form) {
    if (!button || !form) return;
    
    button.addEventListener('click', function(e) {
        e.preventDefault();
        
        const isCollapsed = form.classList.contains('show');
        
        if (isCollapsed) {
            form.classList.remove('show');
            button.setAttribute('aria-expanded', 'false');
            console.log('✅ Filtros avançados fechados (manual)');
        } else {
            form.classList.add('show');
            button.setAttribute('aria-expanded', 'true');
            console.log('✅ Filtros avançados abertos (manual)');
        }
    });
}

function initializeMarketplace() {
/*     const dialers = document.querySelectorAll('[data-kt-dialer]');
    dialers.forEach(function(dialer) {
        KTDialer.createInstance(dialer);
    });
 */
    const select2Elements = document.querySelectorAll('[data-control="select2"]');
    select2Elements.forEach(function(element) {
        $(element).select2({
            placeholder: element.getAttribute('data-placeholder') || 'Selecione uma opção',
            allowClear: true,
            width: '100%'
        });
    });

    const searchInput = document.querySelector('input[name="search"]');
    if (searchInput) {
        let searchTimeout;
        searchInput.addEventListener('input', function() {
            clearTimeout(searchTimeout);
            searchTimeout = setTimeout(function() {
                performSearch();
            }, 500); // Aguarda 500ms após parar de digitar
        });
    }

    const tabButtons = document.querySelectorAll('[data-bs-toggle="tab"]');
    tabButtons.forEach(function(button) {
        button.addEventListener('click', function() {
            // Remove active de todos os botões
            tabButtons.forEach(btn => btn.classList.remove('active'));
            // Adiciona active ao botão clicado
            this.classList.add('active');
        });
    });

    // Filtros avançados - inicialização do collapse
    const advancedSearchButton = document.getElementById('kt_horizontal_search_advanced_link');
    const advancedSearchForm = document.getElementById('kt_advanced_search_form');
    
    if (advancedSearchButton && advancedSearchForm) {
        console.log('🔧 Inicializando filtros avançados...');
        console.log('Bootstrap disponível:', typeof bootstrap !== 'undefined');
        console.log('Bootstrap Collapse disponível:', typeof bootstrap !== 'undefined' && bootstrap.Collapse);
        
        // Garantir que o elemento collapse tenha as classes corretas
        advancedSearchForm.classList.add('collapse');
        
        // Inicializar Bootstrap Collapse
        try {
            const collapseElement = new bootstrap.Collapse(advancedSearchForm, {
                toggle: false
            });
            console.log('✅ Bootstrap Collapse inicializado com sucesso');
        } catch (error) {
            console.log('⚠️ Erro ao inicializar Bootstrap Collapse:', error);
        }
        
        advancedSearchButton.addEventListener('click', function(e) {
            e.preventDefault();
            console.log('🔘 Botão de filtros avançados clicado');
            
            // Usar Bootstrap Collapse para toggle
            if (typeof bootstrap !== 'undefined' && bootstrap.Collapse) {
                try {
                    const bsCollapse = bootstrap.Collapse.getInstance(advancedSearchForm);
                    if (bsCollapse) {
                        bsCollapse.toggle();
                        console.log('✅ Toggle via Bootstrap Collapse');
                    } else {
                        new bootstrap.Collapse(advancedSearchForm).toggle();
                        console.log('✅ Toggle via nova instância Bootstrap Collapse');
                    }
                } catch (error) {
                    console.log('⚠️ Erro no toggle Bootstrap:', error);
                    // Fallback manual
                    toggleCollapseManual();
                }
            } else {
                console.log('⚠️ Bootstrap não disponível, usando fallback manual');
                toggleCollapseManual();
            }
        });
        
        // Função de fallback manual
        function toggleCollapseManual() {
            const isCollapsed = advancedSearchForm.classList.contains('show');
            
            if (isCollapsed) {
                advancedSearchForm.classList.remove('show');
                advancedSearchButton.setAttribute('aria-expanded', 'false');
                console.log('✅ Filtros avançados fechados (manual)');
            } else {
                advancedSearchForm.classList.add('show');
                advancedSearchButton.setAttribute('aria-expanded', 'true');
                console.log('✅ Filtros avançados abertos (manual)');
            }
        }
            }
        
        // Teste inicial - verificar se o collapse está funcionando
        console.log('🧪 Testando collapse...');
        console.log('Estado inicial:', advancedSearchForm.classList.contains('show'));
        console.log('Classes do formulário:', advancedSearchForm.className);
        console.log('Classes do botão:', advancedSearchButton.className);
        
    } else {
        console.log('❌ Elementos de filtros avançados não encontrados');
        console.log('Botão:', advancedSearchButton);
        console.log('Formulário:', advancedSearchForm);
    }

    const buyButtons = document.querySelectorAll('.btn-primary[class*="adquirir"], .btn-primary');
    buyButtons.forEach(function(button) {
        if (button.textContent.includes('Adquirir')) {
            button.addEventListener('click', function(e) {
                e.preventDefault();

                // Efeito visual
                const originalText = this.innerHTML;
                this.innerHTML = '<span class="indicator-progress">Processando... <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>';
                this.disabled = true;

                // Simula processamento
                setTimeout(() => {
                    // Exibe mensagem de sucesso
                    Swal.fire({
                        title: 'Sucesso!',
                        text: 'Redirecionando para o checkout...',
                        icon: 'success',
                        timer: 2000,
                        timerProgressBar: true,
                        showConfirmButton: false
                    }).then(() => {
                        // Aqui você redirecionaria para o checkout real
                        // window.location.href = '/checkout';
                    });

                    // Restaura o botão
                    this.innerHTML = originalText;
                    this.disabled = false;
                }, 1500);
            });
        }
    });

    const sortSelect = document.querySelector('select[name="sort"]');
    if (sortSelect) {
        sortSelect.addEventListener('change', function() {
            const sortValue = this.value;
            console.log('Ordenando por:', sortValue);
            performSort(sortValue);
        });
    }

    const exportSelect = document.querySelector('select[name="export"]');
    if (exportSelect) {
        exportSelect.addEventListener('change', function() {
            const exportType = this.value;
            if (exportType) {
                console.log('Exportando como:', exportType);
                performExport(exportType);
                this.value = ''; // Reset selection
            }
        });
    }

    function performSearch() {
        const searchTerm = searchInput.value.trim();
        const formData = new FormData(document.getElementById('kt_marketplace_search_form'));

        console.log('Realizando busca para:', searchTerm);
        showLoadingState();

        setTimeout(() => {
            hideLoadingState();
            updateResultsCount(Math.floor(Math.random() * 200) + 50);
        }, 1000);
    }

    // Função para ordenação
    function performSort(sortValue) {
        showLoadingState();

        setTimeout(() => {
            hideLoadingState();
            // Aqui você reorganizaria os resultados
            console.log('Resultados reordenados por:', sortValue);
        }, 800);
    }

    function performExport(exportType) {
        const toastr = window.toastr;
        if (toastr) {
            toastr.info(`Preparando arquivo ${exportType.toUpperCase()}...`);

            setTimeout(() => {
                toastr.success(`Download do arquivo ${exportType.toUpperCase()} iniciado!`);
                // Aqui você iniciaria o download real
            }, 2000);
        }
    }

    function showLoadingState() {
        const resultsContainer = document.querySelector('.tab-content');
        if (resultsContainer) {
            resultsContainer.style.opacity = '0.5';
            resultsContainer.style.pointerEvents = 'none';
        }
    }

    function hideLoadingState() {
        const resultsContainer = document.querySelector('.tab-content');
        if (resultsContainer) {
            resultsContainer.style.opacity = '1';
            resultsContainer.style.pointerEvents = 'auto';
        }
    }

    function updateResultsCount(count) {
        const resultsCount = document.querySelector('h3.fw-bold');
        if (resultsCount) {
            resultsCount.innerHTML = `${count} Fornecedores Encontrados <span class="text-gray-400 fs-6">ordenados por ↓ Relevância</span>`;
        }
    }

    const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    tooltipTriggerList.map(function(tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });

    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });

    // Modal code commented out as it's no longer needed
    // const leadsModal = document.getElementById('kt_modal_view_leads');
    // const modalTitle = document.getElementById('modal_leads_title');

    // Removido: document.addEventListener para marketplace-package-card
    // Os cards agora direcionam para a página interna

    // Cards do marketplace agora redirecionam para páginas internas
    // Não há necessidade de JavaScript adicional para os cards

    // Modal code commented out - no longer needed for marketplace cards

/*     const purchaseLeadsBtn = document.getElementById('btn_purchase_leads');
    const proceedPurchaseBtn = document.getElementById('btn_proceed_purchase');

    if(purchaseLeadsBtn){
        purchaseLeadsBtn.addEventListener('click', function() {
            const tableLeads = document.getElementById("kt_leads_table");

            const checkedRows = Array.from(
                tableLeads.querySelectorAll('input.form-check-input[type="checkbox"]:checked')
            ).map(checkbox => checkbox.closest('tr'));

            for (const row of checkedRows) {
                const leadName = row.getAttribute('data-lead-name');
                const temperature = row.getAttribute('data-lead-temperature');
                const price = row.getAttribute('data-lead-price');
                const leadId = row.getAttribute('data-lead-id');
                const supplier = row.getAttribute('data-lead-supplier');

                addToCart({
                    id: leadId,
                    name: name,
                    supplier: supplier,
                    price: price,
                    temperature: temperature
                });

                $.ajax({
                    url: '/cart-items',
                    method: 'POST',
                    contentType: 'application/json',
                    data: JSON.stringify({
                        cartItems: [ { lead_id: leadId } ]
                    }),
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (response) {
                        console.log('Added to cart:', response);
                    },
                    error: function (xhr) {
                        console.error('Failed to add to cart:', xhr.responseText);
                    }
                });
            }
        });
    } */
   /*
   if (purchaseLeadsBtn) {
        purchaseLeadsBtn.addEventListener('click', function() {
            alert('ad');
            const checkedLeads = document.querySelectorAll('#kt_leads_table input[type="checkbox"]:checked');
            if (checkedLeads.length === 0) {
                Swal.fire({
                    title: 'Atenção!',
                    text: 'Selecione ao menos um lead para prosseguir.',
                    icon: 'warning',
                    confirmButtonText: 'OK'
                });
                return;
            }

            const total = Array.from(checkedLeads).reduce((sum, checkbox) => {
                if (checkbox.value !== '1') {
                    const row = checkbox.closest('tr');
                    const priceText = row.querySelector('.text-primary.fs-6').textContent;
                    const price = parseFloat(priceText.replace('R$', '').replace('.', '').replace(',', '.'));
                    return sum + price;
                }
                return sum;
            }, 0);

            Swal.fire({
                title: 'Confirmar Compra',
                html: `
                    <p>Você selecionou <strong>${checkedLeads.length - 1}</strong> leads.</p>
                    <p>Total: <strong>R$ ${total.toLocaleString('pt-BR', {minimumFractionDigits: 2})}</strong></p>
                    <p>Deseja prosseguir com a compra?</p>
                `,
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Sim, comprar',
                cancelButtonText: 'Cancelar',
                                 confirmButtonColor: '#f1416c'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Usa a instância global ou obtém uma nova instância
                    const modalElement = document.getElementById('kt_modal_view_leads');
                    const modal = leadsModalInstance || bootstrap.Modal.getInstance(modalElement);
                    if (modal) {
                        modal.hide();
                    }

                    Swal.fire({
                        title: 'Sucesso!',
                        text: 'Leads adquiridos com sucesso! Redirecionando para o checkout...',
                        icon: 'success',
                        timer: 2000,
                        timerProgressBar: true,
                        showConfirmButton: false
                    });
                }
            });
        });
    }

    if (proceedPurchaseBtn) {
        proceedPurchaseBtn.addEventListener('click', function() {
            purchaseLeadsBtn.click();
        });
    } */

        // All modal-related code commented out
        // Marketplace cards now navigate to dedicated pages

    }); // Fechamento da função initializeMarketplace
</script>
<script>
document.addEventListener('alpine:init', () => {
    Alpine.data('purchaseLeads', () => ({
        selectedLeads: [],
        selectedPrices: {},

        init() {
            this.loadSelectedLeadsFromStorage();
            this.initializeSelects();
            this.initializeFilters();
            this.initializeSearch();

            window.addEventListener('beforeunload', () => {
                this.saveSelectedLeadsToStorage();
            });
        },

        loadSelectedLeadsFromStorage() {
            const stored = localStorage.getItem('selectedLeads');
            if (stored) {
                const data = JSON.parse(stored);
                this.selectedLeads = data.selectedLeads || [];
                this.selectedPrices = data.selectedPrices || {};
            }
        },

        saveSelectedLeadsToStorage() {
            localStorage.setItem('selectedLeads', JSON.stringify({
                selectedLeads: this.selectedLeads,
                selectedPrices: this.selectedPrices
            }));
        },

        toggleLeadSelection(leadId, price) {
            const index = this.selectedLeads.indexOf(leadId);
            if (index > -1) {
                this.selectedLeads.splice(index, 1);
                delete this.selectedPrices[leadId];
            } else {
                this.selectedLeads.push(leadId);
                this.selectedPrices[leadId] = price;
            }
            this.saveSelectedLeadsToStorage();
        },

        getTotalPrice() {
            return Object.values(this.selectedPrices).reduce((sum, price) => sum + price, 0);
        },

        clearSelection() {
            this.selectedLeads = [];
            this.selectedPrices = {};
            localStorage.removeItem('selectedLeads');
        },

        initializeSelects() {
            const select2Elements = document.querySelectorAll('[data-control="select2"]');
            select2Elements.forEach(function(element) {
                $(element).select2({
                    placeholder: element.getAttribute('data-placeholder') || 'Selecione uma opção',
                    allowClear: true,
                    width: '100%'
                });
            });
        },

        initializeFilters() {
            const applyFiltersBtn = document.getElementById('apply-filters');
            const clearFiltersBtn = document.getElementById('clear-filters');

            if (applyFiltersBtn) {
                applyFiltersBtn.addEventListener('click', () => {
                    this.applyFilters();
                });
            }

            if (clearFiltersBtn) {
                clearFiltersBtn.addEventListener('click', () => {
                    this.clearFilters();
                });
            }
        },

        initializeSearch() {
            const searchInput = document.getElementById('search-leads');
            const searchBtn = document.getElementById('search-btn');

            if (searchInput && searchBtn) {
                let searchTimeout;

                searchInput.addEventListener('input', () => {
                    clearTimeout(searchTimeout);
                    searchTimeout = setTimeout(() => {
                        this.performSearch();
                    }, 500);
                });

                searchBtn.addEventListener('click', () => {
                    this.performSearch();
                });
            }
        },

        applyFilters() {
            const filters = this.getFilterValues();
            const currentUrl = new URL(window.location);

            Object.keys(filters).forEach(key => {
                if (filters[key]) {
                    currentUrl.searchParams.set(key, filters[key]);
                } else {
                    currentUrl.searchParams.delete(key);
                }
            });

            currentUrl.searchParams.delete('page');
            window.location.href = currentUrl.toString();
        },

        clearFilters() {
            const filterInputs = document.querySelectorAll('#kt_leads_filters select, #kt_leads_filters input');
            filterInputs.forEach(input => {
                if (input.tagName === 'SELECT') {
                    $(input).val('').trigger('change');
                } else {
                    input.value = '';
                }
            });

            const currentUrl = new URL(window.location);
            ['lead_type', 'ddd', 'operadora', 'price_range', 'date_range', 'sort', 'search', 'page'].forEach(param => {
                currentUrl.searchParams.delete(param);
            });

            window.location.href = currentUrl.toString();
        },

        getFilterValues() {
            return {
                lead_type: document.querySelector('[name="lead_type"]')?.value || '',
                ddd: document.querySelector('[name="ddd"]')?.value || '',
                operadora: document.querySelector('[name="operadora"]')?.value || '',
                price_range: document.querySelector('[name="price_range"]')?.value || '',
                date_range: document.querySelector('[name="date_range"]')?.value || '',
                sort: document.querySelector('[name="sort"]')?.value || '',
                search: document.getElementById('search-leads')?.value || ''
            };
        },

        performSearch() {
            const searchValue = document.getElementById('search-leads')?.value || '';
            const currentUrl = new URL(window.location);

            if (searchValue) {
                currentUrl.searchParams.set('search', searchValue);
            } else {
                currentUrl.searchParams.delete('search');
            }

            currentUrl.searchParams.delete('page');
            window.location.href = currentUrl.toString();
        },

        handlePurchaseLeads() {
            if (this.selectedLeads.length === 0) {
                Swal.fire({
                    title: 'Atenção!',
                    text: 'Selecione ao menos um lead para prosseguir.',
                    icon: 'warning',
                    confirmButtonText: 'OK',
                    confirmButtonColor: '#f1416c'
                });
                return;
            }

            const total = this.getTotalPrice();

            Swal.fire({
                title: 'Confirmar Compra',
                html: `
                    <div class="text-center">
                        <div class="mb-4">
                            <div class="fs-2 fw-bold mb-2">
                                ${this.selectedLeads.length} leads selecionados
                            </div>
                            <div class="fs-3 fw-boldgi">
                                R$ ${total.toLocaleString('pt-BR', {minimumFractionDigits: 2})}
                            </div>
                        </div>
                        <p class="text-gray-600">Deseja prosseguir com a compra?</p>
                    </div>
                `,
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Sim, comprar',
                cancelButtonText: 'Cancelar',
                confirmButtonColor: '#f1416c',
                cancelButtonColor: '#7e8299',
                width: '450px'
            }).then((result) => {
                if (result.isConfirmed) {
                    this.processLeadsPurchase();
                }
            });
        },

                processLeadsPurchase() {
            const purchaseButton = document.querySelector('button[x-on\\:click="handlePurchaseLeads()"]');
            if (purchaseButton) {
                const originalText = purchaseButton.innerHTML;
                purchaseButton.innerHTML = '<span class="indicator-progress">Processando... <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>';
                purchaseButton.disabled = true;

                try {
                    const selectedLeadsData = this.selectedLeads.map(leadId => {
                        const leadElement = document.querySelector(`[data-lead-id="${leadId}"]`);
                        if (leadElement) {
                            const supplierName = document.querySelector('h1.page-heading')?.textContent?.replace('Leads Disponíveis - ', '').trim() || 'Fornecedor';
                            const price = this.selectedPrices[leadId] || 0;
                            
                            const typeElement = leadElement.querySelector('.lead-info-section .badge');
                            const type = typeElement ? typeElement.textContent.trim() : 'Lead Misto';
                            
                            const leadInfoItems = leadElement.querySelectorAll('.lead-info-item');
                            
                            let region = 'N/A';
                            let created_date = 'N/A';
                            let operadora = 'N/A';
                            
                            if (leadInfoItems.length >= 1) {
                                const regionText = leadInfoItems[0].textContent;
                                region = regionText.includes('DDD (') ? regionText.match(/DDD \(([^)]+)\)/)?.[1] || 'N/A' : 'N/A';
                            }
                            
                            if (leadInfoItems.length >= 2) {
                                const createdText = leadInfoItems[1].textContent;
                                created_date = createdText.includes('Criado em') ? createdText.replace('Criado em ', '') : 'N/A';
                            }
                            
                            if (leadInfoItems.length >= 3) {
                                const operadoraText = leadInfoItems[2].textContent;
                                operadora = operadoraText.includes('Operadora') ? operadoraText.replace('Operadora ', '') : 'N/A';
                            }
                            
                            // Fallback: buscar por texto específico em todo o elemento
                            if (region === 'N/A') {
                                const fullText = leadElement.textContent;
                                const dddMatch = fullText.match(/DDD \(([^)]+)\)/);
                                region = dddMatch ? dddMatch[1] : 'N/A';
                            }
                            
                            if (created_date === 'N/A') {
                                const fullText = leadElement.textContent;
                                const createdMatch = fullText.match(/Criado em ([^à]+) às/);
                                created_date = createdMatch ? createdMatch[1] + ' às ' + fullText.match(/às ([^à]+)/)?.[1] : 'N/A';
                            }
                            
                            if (operadora === 'N/A') {
                                const fullText = leadElement.textContent;
                                const operadoraMatch = fullText.match(/Operadora ([^à]+)/);
                                operadora = operadoraMatch ? operadoraMatch[1] : 'N/A';
                            }
                            
                            return {
                                id: leadId,
                                type: type,
                                region: region,
                                created_date: created_date,
                                operadora: operadora,
                                supplier: supplierName,
                                price: price
                            };
                        }
                        return null;
                    }).filter(item => item !== null);

                    localStorage.setItem('cart_items', JSON.stringify(selectedLeadsData));
                    
                    this.selectedLeads = [];
                    this.selectedPrices = {};
                    localStorage.removeItem('selectedLeads');

                    console.log('Debug - Redirecting to cart...');
                    window.location.href = "{{ route('cart.index') }}";
                } catch (error) {
                    console.error('Error processing leads purchase:', error);
                    // Garantir que o redirecionamento aconteça mesmo com erro
                    window.location.href = "{{ route('cart.index') }}";
                }
            }
        }
    }));
});
</script>