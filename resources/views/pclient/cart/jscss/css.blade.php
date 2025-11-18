<style>
.package-item {
    transition: all 0.3s ease;
}

.package-item:hover {
    background-color: #f8f9fa;
    border-radius: 8px;
    padding: 8px;
    margin: -8px;
}

.symbol-label {
    border-radius: 8px;
}

#kt_cart_selected_packages {
    max-height: 400px;
    overflow-y: auto;
}

.text-pink {
    color: #e4426d !important;
}

.cart-empty-state {
    text-align: center;
    padding: 60px 20px;
}

.cart-empty-state .empty-icon {
    font-size: 4rem;
    color: #e4e6ef;
    margin-bottom: 20px;
}

.btn-icon.btn-sm {
    width: 30px;
    height: 30px;
    padding: 0;
    display: flex;
    align-items: center;
    justify-content: center;
}

.package-price {
    color: #009ef7;
    font-weight: 700;
}

.cart-summary-card {
    position: sticky;
    top: 20px;
}

#cart-total{
  margin-left:10px;
}

.sticky-top{
  z-index: 0;
}

@media (max-width: 991px) {
    .cart-summary-card {
        position: relative;
        top: auto;
    }
}
</style> 
