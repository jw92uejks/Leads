<script>
document.addEventListener('DOMContentLoaded', function() {
    initializeCheckout();
    
    const cards = document.querySelectorAll('.card');
    cards.forEach(card => {
        card.classList.add('checkout-animation');
    });

    const editOrderBtn = document.getElementById('edit-order-btn');
    if (editOrderBtn) {
        editOrderBtn.addEventListener('click', function() {

            window.location.href = '/marketplace';
        });
    }

    const finalizePurchaseBtns = document.querySelectorAll('#finalizarCompra', '#finalizarCompraFinal');
    finalizePurchaseBtns.forEach(btn => {
        btn.addEventListener('click', function() {

            Swal.fire({
                title: 'Confirmar Compra',
                text: 'Deseja realmente finalizar esta compra? Esta ação não poderá ser desfeita.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#e91e63',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Sim, finalizar!',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {

                    btn.disabled = true;
                    btn.innerHTML = '<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>Processando...';
                    

                    setTimeout(() => {

                        Swal.fire({
                            title: 'Compra Finalizada!',
                            text: 'Sua compra foi processada com sucesso.',
                            icon: 'success',
                            confirmButtonColor: '#e91e63',
                            confirmButtonText: 'OK'
                        }).then(() => {

                            window.location.href = "{{ route('leads.index') }}";
                        });
                    }, 2000);
                }
            });
        });
    });

    const cards = document.querySelectorAll('.card');
    cards.forEach((card, index) => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(20px)';
        
        setTimeout(() => {
            card.style.transition = 'all 0.6s ease';
            card.style.opacity = '1';
            card.style.transform = 'translateY(0)';
        }, index * 150);
    });

    const buttons = document.querySelectorAll('.btn');
    buttons.forEach(button => {
        button.addEventListener('mouseenter', function() {
            if (!this.disabled) {
                this.style.transform = 'translateY(-2px)';
                this.style.boxShadow = '0 4px 15px rgba(0,0,0,0.1)';
            }
        });
        
        button.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0)';
            this.style.boxShadow = 'none';
        });
    });

    const ratingStars = document.querySelectorAll('.rating .rating-label');
    ratingStars.forEach(star => {
        star.addEventListener('mouseenter', function() {
            this.style.transform = 'scale(1.1)';
            this.style.transition = 'transform 0.2s ease';
        });
        
        star.addEventListener('mouseleave', function() {
            this.style.transform = 'scale(1)';
        });
    });

    const badges = document.querySelectorAll('.badge-lg');
    badges.forEach(badge => {
        const finalValue = parseInt(badge.textContent);
        let currentValue = 0;
        const increment = Math.ceil(finalValue / 30);
        
        const timer = setInterval(() => {
            currentValue += increment;
            if (currentValue >= finalValue) {
                currentValue = finalValue;
                clearInterval(timer);
            }
            badge.textContent = currentValue.toLocaleString();
        }, 50);
    });

    const tooltips = document.querySelectorAll('[data-bs-toggle="tooltip"]');
    tooltips.forEach(tooltip => {
        new bootstrap.Tooltip(tooltip);
    });

    function validateForm() {

        return true;
    }

    function smoothScrollTo(element) {
        element.scrollIntoView({ 
            behavior: 'smooth',
            block: 'center'
        });
    }

    const interactiveElements = document.querySelectorAll('button, .card, .table-hover tr');
    interactiveElements.forEach(element => {
        element.addEventListener('click', function() {

            this.style.transform = 'scale(0.98)';
            setTimeout(() => {
                this.style.transform = 'scale(1)';
            }, 100);
        });
    });

    function handleResize() {
        const isMobile = window.innerWidth <= 768;
        const buttons = document.querySelectorAll('.btn-lg');
        
        buttons.forEach(button => {
            if (isMobile) {
                button.classList.remove('btn-lg');
                button.classList.add('btn-sm');
            } else {
                button.classList.remove('btn-sm');
                button.classList.add('btn-lg');
            }
        });
    }

    window.addEventListener('resize', handleResize);
    

    function showPageLoader() {
        const loader = document.createElement('div');
        loader.innerHTML = `
            <div class="d-flex justify-content-center align-items-center position-fixed top-0 start-0 w-100 h-100" style="background: rgba(255,255,255,0.9); z-index: 9999;">
                <div class="spinner-border text-pink" role="status">
                    <span class="visually-hidden">Carregando...</span>
                </div>
            </div>
        `;
        document.body.appendChild(loader);
    }

    console.log('Checkout page loaded successfully');
    
    if (typeof gtag !== 'undefined') {
        gtag('event', 'page_view', {
            page_title: 'Checkout',
            page_location: window.location.href
        });
    }
});


const checkoutData = {
    totalLeads: 1024,
    totalValue: 245760.00,
    leadsPerPage: 20,
    currentPage: 1,
    leads: generateMockCheckoutLeads(1024)
};

function generateMockCheckoutLeads(count) {
    const names = [
        'João Silva', 'Maria Santos', 'Carlos Oliveira', 'Ana Costa', 'Pedro Lima',
        'Fernanda Souza', 'Ricardo Pereira', 'Juliana Alves', 'Roberto Ferreira', 'Camila Rodrigues',
        'Gabriel Martins', 'Luciana Barbosa', 'Eduardo Gomes', 'Patrícia Castro', 'Bruno Teixeira',
        'Vanessa Cardoso', 'Marcos Ribeiro', 'Daniela Nascimento', 'Felipe Araújo', 'Cristiane Silva'
    ];
    
    const segments = [
        'Automotivo', 'E-commerce', 'Saúde', 'Tecnologia', 'Educação', 
        'Finanças', 'Imóveis', 'Varejo', 'Consultoria', 'Marketing'
    ];
    
    const suppliers = [
        'AutoLeads Corp', 'DigitalGrowth Pro', 'HealthLeads', 'TechLeads Plus', 'EduLeads',
        'FinanceLeads Pro', 'PropertyLeads', 'RetailLeads', 'ConsultLeads', 'MarketLeads'
    ];
    
    const leads = [];
    for (let i = 1; i <= count; i++) {
        const randomName = names[Math.floor(Math.random() * names.length)];
        const randomSegment = segments[Math.floor(Math.random() * segments.length)];
        const randomSupplier = suppliers[Math.floor(Math.random() * suppliers.length)];
        const randomRating = (Math.random() * 2 + 3).toFixed(1);
        const randomPrice = (Math.random() * 400 + 100).toFixed(2);
        
        leads.push({
            id: i,
            name: `${randomName} ${randomSegment}`,
            supplier: randomSupplier,
            rating: parseFloat(randomRating),
            price: parseFloat(randomPrice),
            location: `Lead #${i.toString().padStart(4, '0')}`
        });
    }
    return leads;
}

function initializeCheckout() {
    setupCheckoutForm();
}

function openCheckoutLeadsModal() {
    checkoutData.currentPage = 1;
    loadCheckoutModalPage(1);
    const modal = new bootstrap.Modal(document.getElementById('checkoutLeadsModal'));
    modal.show();
}

function loadCheckoutModalPage(page) {
    checkoutData.currentPage = page;
    const startIndex = (page - 1) * checkoutData.leadsPerPage;
    const endIndex = startIndex + checkoutData.leadsPerPage;
    const pageLeads = checkoutData.leads.slice(startIndex, endIndex);
    
    const tbody = document.getElementById('checkout-modal-leads-tbody');
    tbody.innerHTML = '';
    
    pageLeads.forEach(lead => {
        const row = createCheckoutLeadRow(lead);
        tbody.appendChild(row);
    });
    
    updateCheckoutPaginationInfo(page);
    generateCheckoutPagination();
}

function createCheckoutLeadRow(lead) {
    const tr = document.createElement('tr');
    tr.innerHTML = `
        <td>
            <div class="d-flex align-items-center">
                <div class="symbol symbol-35px me-3">
                    <div class="symbol-label" style="background-color: rgba(231, 29, 115, 0.1);">
                        <i class="ki-duotone ki-user fs-3" style="color: #e71d73;">
                            <span class="path1"></span>
                            <span class="path2"></span>
                        </i>
                    </div>
                </div>
                <div>
                    <div class="fw-bold text-gray-800 fs-6">${lead.name}</div>
                    <div class="text-muted fs-7">${lead.location}</div>
                </div>
            </div>
        </td>
        <td class="text-center">
            <span class="text-gray-600">${lead.supplier}</span>
        </td>
        <td class="text-center">
            <div class="d-flex justify-content-center">
                ${generateCheckoutStarRating(lead.rating)}
            </div>
        </td>
        <td class="text-end fw-bold">R$ ${lead.price.toFixed(2).replace('.', ',')}</td>
    `;
    return tr;
}

function generateCheckoutStarRating(rating) {
    const fullStars = Math.floor(rating);
    let starsHtml = '';
    
    for (let i = 0; i < 5; i++) {
        const isChecked = i < fullStars ? 'checked' : '';
        starsHtml += `
            <div class="rating-label ${isChecked}">
                <i class="ki-duotone ki-star fs-7"></i>
            </div>
        `;
    }
    
    return `<div class="rating">${starsHtml}</div>`;
}

function updateCheckoutPaginationInfo(page) {
    const startIndex = (page - 1) * checkoutData.leadsPerPage + 1;
    const endIndex = Math.min(page * checkoutData.leadsPerPage, checkoutData.totalLeads);
    
    document.getElementById('checkout-showing-from').textContent = startIndex;
    document.getElementById('checkout-showing-to').textContent = endIndex;
    document.getElementById('checkout-total-leads').textContent = checkoutData.totalLeads;
}

function generateCheckoutPagination() {
    const totalPages = Math.ceil(checkoutData.totalLeads / checkoutData.leadsPerPage);
    const pagination = document.getElementById('checkout-leads-pagination');
    pagination.innerHTML = '';
    
    const prevItem = document.createElement('li');
    prevItem.className = `page-item ${checkoutData.currentPage === 1 ? 'disabled' : ''}`;
    prevItem.innerHTML = `
        <a class="page-link" href="#" onclick="loadCheckoutModalPage(${checkoutData.currentPage - 1}); return false;">
            <i class="previous"></i>
        </a>
    `;
    pagination.appendChild(prevItem);
    
    const startPage = Math.max(1, checkoutData.currentPage - 2);
    const endPage = Math.min(totalPages, startPage + 4);
    
    for (let i = startPage; i <= endPage; i++) {
        const pageItem = document.createElement('li');
        pageItem.className = `page-item ${i === checkoutData.currentPage ? 'active' : ''}`;
        pageItem.innerHTML = `
            <a class="page-link" href="#" onclick="loadCheckoutModalPage(${i}); return false;">${i}</a>
        `;
        pagination.appendChild(pageItem);
    }
    const nextItem = document.createElement('li');
    nextItem.className = `page-item ${checkoutData.currentPage === totalPages ? 'disabled' : ''}`;
    nextItem.innerHTML = `
        <a class="page-link" href="#" onclick="loadCheckoutModalPage(${checkoutData.currentPage + 1}); return false;">
            <i class="next"></i>
        </a>
    `;
    pagination.appendChild(nextItem);
}

function proceedToConfirmation() {
    const modal = bootstrap.Modal.getInstance(document.getElementById('checkoutLeadsModal'));
    modal.hide();
    

    Swal.fire({
        title: 'Processando Compra...',
        text: 'Aguarde enquanto processamos sua compra.',
        icon: 'info',
        allowOutsideClick: false,
        showConfirmButton: false,
        willOpen: () => {
            Swal.showLoading();
        }
    });
    
    setTimeout(() => {
        window.location.href = '/confirmation';
    }, 2000);
}

function setupCheckoutForm() {
    const finalizarBtn = document.getElementById('finalizarCompraFinal');
    
    if (finalizarBtn) {
        finalizarBtn.addEventListener('click', function() {
            Swal.fire({
                title: 'Finalizar Compra?',
                text: `Confirma a compra de ${checkoutData.totalLeads} leads por ${formatCurrency(checkoutData.totalValue)}?`,
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Sim, finalizar',
                cancelButtonText: 'Cancelar',
                customClass: {
                    confirmButton: 'btn btn-primary',
                    cancelButton: 'btn btn-light'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    proceedToConfirmation();
                }
            });
        });
    }
}

function formatCurrency(value) {
    return new Intl.NumberFormat('pt-BR', {
        style: 'currency',
        currency: 'BRL'
    }).format(value);
}


window.openCheckoutLeadsModal = openCheckoutLeadsModal;
window.loadCheckoutModalPage = loadCheckoutModalPage;
window.proceedToConfirmation = proceedToConfirmation;

function showNotification(message, type = 'info') {
    const toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer);
            toast.addEventListener('mouseleave', Swal.resumeTimer);
        }
    });

    toast.fire({
        icon: type,
        title: message
    });
}
</script> 