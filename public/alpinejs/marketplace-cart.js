
window.Alpine = window.Alpine || {};

document.addEventListener('alpine:init', () => {
    Alpine.data('marketplaceCart', () => ({
        cartData: [],

        async init() {
            try {
                const leads = await this.sendToServer('get');

                if (Array.isArray(leads)) {
                    this.cartData.push(...leads);
                }
            } catch (error) {
                console.warn('Erro ao carregar carrinho:', error);
                this.cartData = [];
            }
        },

        formatCurrency(amount) {
            return new Intl.NumberFormat('pt-BR', {
                style: 'currency',
                currency: 'BRL'
            }).format(amount);
        },

        showToast(message, icon = 'info') {
            if (window.Swal) {
                window.Swal.fire({
                    title: message,
                    icon,
                    showConfirmButton: false,
                    timer: 1500,
                    timerProgressBar: true,
                    position: "bottom-end",
                });
            } else {
                console.log(message);
            }
        },

        removeItemCart(supplier) {
            const removedLeads = this.cartData.filter(item => item.supplier === supplier);
            const removedCount = removedLeads.length;

            this.cartData = this.cartData.filter(item => item.supplier !== supplier);

            const plural = removedCount > 1 ? 's' : '';
            this.showToast(`${removedCount} lead${plural} de ${supplier} removido${plural} do carrinho.`, 'info');

            removedLeads.forEach(lead => this.sendToServer('remove', lead.id));
        },

        addToCart(leadData) {
            const existingIndex = this.cartData.findIndex(item => item.id === leadData.id);

            if (existingIndex === -1) {
                this.cartData.push(leadData);
                this.showToast(`Lead "${leadData.name}" adicionado ao carrinho!`, 'success');
                this.sendToServer('add', leadData.id);
            } else {
                this.showToast(`Este lead já está no seu carrinho.`, 'info');
            }
        },

        get itemCount() {
            return this.cartData.length;
        },

        get cartTotal() {
            return this.cartData.reduce((sum, item) => sum + item.price, 0);
        },

        get hasItems() {
            return this.cartData.length > 0;
        },

        get groupedBySupplier() {
            const suppliers = {};
            this.cartData.forEach(item => {
                if (!suppliers[item.supplier]) {
                    suppliers[item.supplier] = [];
                }
                suppliers[item.supplier].push(item);
            });
            return suppliers;
        },

        get supplierGroups() {
            return Object.keys(this.groupedBySupplier).map(supplier => ({
                name: supplier,
                leads: this.groupedBySupplier[supplier],
                total: this.groupedBySupplier[supplier].reduce((sum, lead) => sum + lead.price, 0),
                count: this.groupedBySupplier[supplier].length
            }));
        },

        async sendToServer(type, leadId) {
            console.log(type, leadId);
            const methodMap = {
                add: 'POST',
                remove: 'DELETE',
                get: 'GET'
            };

            const isDelete = type === 'remove';
            const url = isDelete ? `/cart-items/${leadId}` : '/cart-items';
            const method = methodMap[type] || 'POST';

            const headers = {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            };

            let body = null;
            if (type === 'add') {
                body = JSON.stringify({ cartItems: [{ lead_id: leadId }] });
            }

            try {
                const response = await fetch(url, { method, headers, body });

                if (!response.ok) {
                    throw new Error(`Erro ${response.status}: ${response.statusText}`);
                }

                const data = await response.json();
                return data;
            } catch (error) {
                console.error('Erro ao enviar para o servidor:', error);
                return null;
            }
        }
    }));
});

window.addToCart = function (leadData) {
    const el = document.querySelector('[x-data*="marketplaceCart"]');
    if (el && Alpine.$data) {
        const cartComponent = Alpine.$data(el);
        cartComponent.addToCart(leadData);
    }
};

// Fallback para garantir que as variáveis estejam sempre disponíveis
if (typeof window.marketplaceCartFallback === 'undefined') {
    window.marketplaceCartFallback = {
        hasItems: false,
        itemCount: 0,
        cartTotal: 0,
        supplierGroups: [],
        formatCurrency: (amount) => new Intl.NumberFormat('pt-BR', {
            style: 'currency',
            currency: 'BRL'
        }).format(amount || 0)
    };
}
