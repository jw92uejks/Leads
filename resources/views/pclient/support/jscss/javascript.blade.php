<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchInput');
    const accordionItems = document.querySelectorAll('.accordion-item');
    const tabPanes = document.querySelectorAll('.tab-pane');
    const tabButtons = document.querySelectorAll('.nav-pills-custom .nav-link');

    if (searchInput) {
        console.log('Search input encontrado, adicionando listener...');
        searchInput.addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase().trim();
            console.log('Termo de busca:', searchTerm);

            if (searchTerm.length === 0) {
                console.log('Termo vazio, restaurando conteúdo...');
                showAllContent();
                return;
            }

            console.log('Iniciando busca...');
            searchContent(searchTerm);
        });
    } else {
        console.error('Search input não encontrado!');
    }

    function searchContent(searchTerm) {
        console.log('Iniciando busca por:', searchTerm);
        let foundResults = false;
        let totalResults = 0;

        console.log('Total de abas encontradas:', tabPanes.length);

        tabPanes.forEach(tabPane => {
            tabPane.style.display = 'none';
            tabPane.classList.remove('show', 'active');
        });

        tabPanes.forEach((tabPane, tabIndex) => {
            const accordionItemsInTab = tabPane.querySelectorAll('.accordion-item');
            let foundInTab = false;

            console.log(`Aba ${tabIndex}: ${tabPane.id}, accordion items: ${accordionItemsInTab.length}`);

            accordionItemsInTab.forEach(item => {
                const button = item.querySelector('.accordion-button');
                const body = item.querySelector('.accordion-body');
                const buttonText = button.textContent.toLowerCase();
                const bodyText = body.textContent.toLowerCase();

                if (buttonText.includes(searchTerm) || bodyText.includes(searchTerm)) {
                    console.log(`Resultado encontrado na aba ${tabIndex}: ${buttonText}`);
                    foundResults = true;
                    foundInTab = true;
                    totalResults++;
                    item.style.display = 'block';

                    if (body.classList.contains('collapse')) {
                        try {
                            const bsCollapse = new bootstrap.Collapse(body, {
                                toggle: false
                            });
                            bsCollapse.show();
                        } catch (e) {
                            body.classList.remove('collapse');
                            body.classList.add('show');
                        }
                    }
                } else {
                    item.style.display = 'none';
                }
            });

            if (foundInTab) {
                tabPane.style.display = 'block';
                tabPane.classList.add('show', 'active');

                const tabId = tabPane.id;
                const correspondingButton = document.querySelector(`[data-bs-target="#${tabId}"]`);
                if (correspondingButton) {
                    tabButtons.forEach(btn => btn.classList.remove('active'));
                    correspondingButton.classList.add('active');
                }
            }
        });

        console.log(`Busca concluída. Resultados encontrados: ${totalResults}, Found: ${foundResults}`);
        updateSearchResults(foundResults, searchTerm, totalResults);
    }

    function showAllContent() {
        tabPanes.forEach((tabPane, index) => {
            if (index === 0) {
                tabPane.style.display = 'block';
                tabPane.classList.add('show', 'active');
            } else {
                tabPane.style.display = 'none';
                tabPane.classList.remove('show', 'active');
            }
        });

        accordionItems.forEach(item => {
            item.style.display = 'block';
        });

        tabButtons.forEach(btn => btn.classList.remove('active'));
        const firstTabButton = document.querySelector('#v-pills-getting-started-tab');
        if (firstTabButton) {
            firstTabButton.classList.add('active');
        }

        const resultsDiv = document.getElementById('searchResults');
        if (resultsDiv) {
            resultsDiv.style.display = 'none';
        }
    }

    function updateSearchResults(found, searchTerm, totalResults) {
        let resultsDiv = document.getElementById('searchResults');

        if (!resultsDiv) {
            resultsDiv = document.createElement('div');
            resultsDiv.id = 'searchResults';
            resultsDiv.className = 'alert mt-3';
            searchInput.parentNode.parentNode.appendChild(resultsDiv);
        }

        if (searchTerm.length === 0) {
            resultsDiv.style.display = 'none';
            return;
        }

        if (found) {
            resultsDiv.className = 'alert mt-3';
            resultsDiv.style.background = 'linear-gradient(135deg, rgba(0, 201, 167, 0.1) 0%, rgba(0, 160, 133, 0.1) 100%)';
            resultsDiv.style.border = '2px solid #00c9a7';
            resultsDiv.innerHTML = `<i class="ki-duotone ki-check-circle fs-2 me-2 text-success"></i><span class="text-success fw-bold">${totalResults} resultado(s) encontrado(s)</span> para "<strong>${searchTerm}</strong>" em todas as categorias`;
        } else {
            resultsDiv.className = 'alert mt-3';
            resultsDiv.style.background = 'linear-gradient(135deg, rgba(255, 184, 34, 0.1) 0%, rgba(247, 147, 30, 0.1) 100%)';
            resultsDiv.style.border = '2px solid #ffb822';
            resultsDiv.innerHTML = `<i class="ki-duotone ki-information-5 fs-2 me-2 text-warning"></i><span class="text-warning fw-bold">Nenhum resultado encontrado</span> para "<strong>${searchTerm}</strong>". Tente outros termos ou verifique a ortografia.`;
        }
        resultsDiv.style.display = 'block';
    }

    tabButtons.forEach(button => {
        button.addEventListener('click', function() {
            const targetId = this.getAttribute('data-bs-target');
            const targetTab = document.querySelector(targetId);

            if (targetTab) {
                setTimeout(() => {
                    targetTab.scrollIntoView({ behavior: 'smooth', block: 'start' });
                }, 100);
            }
        });
    });

    const accordions = document.querySelectorAll('.accordion');
    accordions.forEach(accordion => {
        const firstCollapse = accordion.querySelector('.accordion-collapse.show');
        const firstButton = accordion.querySelector('.accordion-button');

        if (firstCollapse && firstButton) {
            firstButton.classList.remove('collapsed');
            firstButton.setAttribute('aria-expanded', 'true');
        }
    });

    document.addEventListener('shown.bs.collapse', function(e) {
        if (e.target.classList.contains('accordion-collapse')) {
            setTimeout(() => {
                e.target.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
            }, 300);
        }
    });
});
</script>
