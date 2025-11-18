<script>
document.addEventListener('DOMContentLoaded', function() {
    initializeCart();
    loadCartFromCache();
    setupCouponFunctionality();
});

const cartData = {
    totalLeads: 0,
    totalValue: 0,
    leadsPerPage: 20,
    currentPage: 1,
    leads: []
};

function generateMockLeads(count) {
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

function initializeCart() {
    updateCartTotals();
    setupFormValidation();
}

function loadCartFromCache() {
    const cachedItems = localStorage.getItem('cart_items');
    if (cachedItems) {
        try {
            const items = JSON.parse(cachedItems);
            cartData.leads = items;
            cartData.totalLeads = items.length;
            cartData.totalValue = items.reduce((sum, item) => sum + (item.price || 0), 0);

            updateCartDisplay();
            updateCartTotals();
        } catch (error) {
            console.error('Erro ao carregar carrinho do cache:', error);
        }
    } else {
        updateCartTotals();
    }
}

function updateCartDisplay() {
    const tbody = document.getElementById('cart-items-tbody');
    if (!tbody) return;

    if (cartData.leads.length === 0) {
        tbody.innerHTML = `
            <tr>
                <td colspan="6" class="text-center py-10">
                    <div class="text-muted">
                        <i class="ki-duotone ki-basket fs-3x mb-3">
                            <span class="path1"></span>
                            <span class="path2"></span>
                            <span class="path3"></span>
                            <span class="path4"></span>
                        </i>
                        <h5 class="fw-bold text-gray-600 mb-2">Seu carrinho está vazio</h5>
                        <p class="text-muted">Adicione leads do marketplace para começar</p>
                    </div>
                </td>
            </tr>
        `;
    } else {
        tbody.innerHTML = '';

        cartData.leads.forEach(item => {
            const row = document.createElement('tr');

            const getTypeBadge = (type) => {
                if (type === 'Pessoa Física') {
                    return '<span class="badge" style="background-color: rgba(116, 103, 239, 0.1); color: #7467ef;">Pessoa Física</span>';
                } else if (type === 'Pessoa Jurídica') {
                    return '<span class="badge badge-light-info">Pessoa Jurídica</span>';
                } else if (type === 'Adesão') {
                    return '<span class="badge badge-light-warning">Adesão</span>';
                } else {
                    return '<span class="badge badge-light-warning">Lead Misto</span>';
                }
            };

            row.innerHTML = `
                <td>
                    ${getTypeBadge(item.type || 'Lead Misto')}
                </td>
                <td class="text-center">
                    <span class="text-gray-600">DDD (${item.region || 'N/A'})</span>
                </td>
                <td class="text-center">
                    <span class="text-gray-600">${item.created_date || 'N/A'}</span>
                </td>
                <td class="text-center">
                    <span class="text-gray-600">${item.operadora || 'N/A'}</span>
                </td>
                <td class="text-end fw-bold">R$ ${(item.price || 0).toLocaleString('pt-BR', {minimumFractionDigits: 2})}</td>
                <td class="text-center">
                    <div class="d-flex justify-content-center">
                        <button type="button" class="btn btn-icon btn-sm btn-light-danger" onclick="removeLead(${item.id})">
                            <i class="ki-duotone ki-trash fs-5">
                                <span class="path1"></span>
                                <span class="path2"></span>
                                <span class="path3"></span>
                                <span class="path4"></span>
                                <span class="path5"></span>
                            </i>
                        </button>
                    </div>
                </td>
            `;
            tbody.appendChild(row);
        });
    }

    const itemCountElement = document.getElementById('cart-item-count');
    if (itemCountElement) {
        itemCountElement.textContent = cartData.totalLeads;
    }
}

function setupCouponFunctionality() {
    const applyButton = document.getElementById('apply_coupon');
    const couponInput = document.getElementById('coupon_code');

    if (applyButton && couponInput) {
        applyButton.addEventListener('click', function() {
            const couponCode = couponInput.value.trim();

            if (!couponCode) {
                toastr.warning('Digite um código de cupom');
                return;
            }

            applyCoupon(couponCode);
        });

        couponInput.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                applyButton.click();
            }
        });
    }
}

function applyCoupon(couponCode) {
    const applyButton = document.getElementById('apply_coupon');
    const originalText = applyButton.textContent;

    applyButton.disabled = true;
    applyButton.textContent = 'Aplicando...';

    setTimeout(() => {
        if (couponCode.toLowerCase() === 'desconto10') {
            const discount = cartData.totalValue * 0.1;
            cartData.totalValue -= discount;

            toastr.success(`Cupom aplicado! Desconto de R$ ${discount.toLocaleString('pt-BR', {minimumFractionDigits: 2})}`);

            updateCartTotals();

            const couponInput = document.getElementById('coupon_code');
            couponInput.disabled = true;
            applyButton.textContent = 'Aplicado';
            applyButton.classList.remove('btn-secondary');
            applyButton.classList.add('btn-success');
        } else {
            toastr.error('Código de cupom inválido');
        }

        applyButton.disabled = false;
        applyButton.textContent = originalText;
    }, 1000);
}



function removeLead(leadId) {
    Swal.fire({
        title: 'Remover Item',
        text: 'Tem certeza que deseja remover este lead do carrinho?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Sim, remover',
        cancelButtonText: 'Cancelar',
        customClass: {
            confirmButton: 'btn btn-danger',
            cancelButton: 'btn btn-light'
        }
    }).then((result) => {
        if (result.isConfirmed) {
            cartData.leads = cartData.leads.filter(lead => lead.id !== leadId);
            cartData.totalLeads = cartData.leads.length;
            cartData.totalValue = cartData.leads.reduce((sum, item) => sum + (item.price || 0), 0);

            localStorage.setItem('cart_items', JSON.stringify(cartData.leads));

            updateCartDisplay();
            updateCartTotals();
        }
    });
}

function removeLeadFromModal(leadId) {
    removeLead(leadId);
}

function removeAllSelectedLeads() {
    Swal.fire({
        title: 'Remover Todos os Leads',
        text: 'Tem certeza que deseja remover TODOS os leads do carrinho?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Sim, remover todos',
        cancelButtonText: 'Cancelar',
        customClass: {
            confirmButton: 'btn btn-danger',
            cancelButton: 'btn btn-light'
        }
    }).then((result) => {
        if (result.isConfirmed) {
            cartData.leads = [];
            cartData.totalLeads = 0;

            const modal = bootstrap.Modal.getInstance(document.getElementById('leadsModal'));
            modal.hide();

            showEmptyCart();

            toastr.success('Todos os leads foram removidos do carrinho');
        }
    });
}

function updateCartTotals() {
    const subtotal = cartData.totalValue;
    const tax = subtotal * 0.02;
    const total = subtotal + tax;

    const subtotalElement = document.querySelector('td[data-subtotal]');
    const taxElement = document.querySelector('td[data-tax]');
    const totalElement = document.getElementById('cart-total');

    if (subtotalElement) {
        subtotalElement.textContent = formatCurrency(subtotal);
    }
    if (taxElement) {
        taxElement.textContent = formatCurrency(tax);
    }
    if (totalElement) {
        totalElement.textContent = formatCurrency(total);
    }
}

function formatCurrency(value) {
    return new Intl.NumberFormat('pt-BR', {
        style: 'currency',
        currency: 'BRL'
    }).format(value);
}

function showEmptyCart() {
    const container = document.getElementById('kt_cart_selected_leads');
    container.innerHTML = `
        <div class="cart-empty-state text-center p-10">
            <div class="empty-icon mb-5">
                <i class="ki-duotone ki-basket fs-3x text-muted">
                    <span class="path1"></span>
                    <span class="path2"></span>
                    <span class="path3"></span>
                    <span class="path4"></span>
                </i>
            </div>
            <h4 class="text-gray-700 fw-bold mb-3">Seu carrinho está vazio</h4>
            <p class="text-muted mb-5">Navegue pelo marketplace e adicione leads ao seu carrinho.</p>
            <a href="${window.location.origin}/marketplace" class="btn btn-primary">
                <i class="ki-duotone ki-shop fs-2 me-2">
                    <span class="path1"></span>
                    <span class="path2"></span>
                    <span class="path3"></span>
                    <span class="path4"></span>
                    <span class="path5"></span>
                </i>
                Ir para Marketplace
            </a>
        </div>
    `;
}

function setupFormValidation() {
    const form = document.getElementById('kt_cart_form');
    const submitBtn = document.getElementById('kt_cart_submit');

    if (form) {
        form.addEventListener('submit', function(e) {
            e.preventDefault();

            if (cartData.totalLeads === 0) {
                toastr.warning('Adicione pelo menos um lead ao carrinho');
                return;
            }

            processCheckout();
        });
    }
}

function processCheckout() {
    const submitBtn = document.getElementById('kt_cart_submit');
    const indicator = submitBtn.querySelector('.indicator-label');
    const progress = submitBtn.querySelector('.indicator-progress');

    submitBtn.disabled = true;
    indicator.style.display = 'none';
    progress.style.display = 'inline-block';

    setTimeout(() => {

        window.location.href = '/checkout';
    }, 1500);
}


window.removeLead = removeLead;
</script>