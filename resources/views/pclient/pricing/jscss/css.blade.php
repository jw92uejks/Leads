<style>
.pricing-primary {
    color: #e71d73 !important;
}

.pricing-primary-bg {
    background-color: #e71d73 !important;
}

.pricing-primary-border {
    border-color: #e71d73 !important;
}

.text-primary {
    color: #e71d73 !important;
}

.btn-primary {
    background-color: #e71d73 !important;
    border-color: #e71d73 !important;
}

.btn-primary:hover {
    background-color: #a11753 !important;
    border-color: #a11753 !important;
}

.btn-active-secondary {
    background-color: #e71d73 !important;
    color: white !important;
}

.btn-active-secondary:hover {
    background-color: #a11753 !important;
}

.pricing-card {
    transition: all 0.3s ease;
    border: 1px solid #e4e6ef;
    border-radius: 0.75rem;
}

.pricing-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 30px rgba(231, 29, 115, 0.15);
    border: 2px solid #e71d73;
}

.pricing-card.selected {
    border: 2px solid #e71d73;
    transform: scale(1.02);
    box-shadow: 0 10px 30px rgba(231, 29, 115, 0.2);
}

.pricing-select-btn {
    background: linear-gradient(135deg, #e71d73 0%, #a11753 100%);
    border: none;
    color: white;
    padding: 0.75rem 2rem;
    border-radius: 0.5rem;
    font-weight: 600;
    transition: all 0.3s ease;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.pricing-select-btn:hover {
    background: linear-gradient(135deg, #a11753 0%, #7d1140 100%);
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(231, 29, 115, 0.3);
    color: white !important;
}

.nav-group {
    background: #f8f9fa;
    border-radius: 0.75rem;
    padding: 0.25rem;
    border: 1px solid #e4e6ef;
}

.nav-group .btn {
    background: #f1f1f4 !important;
    color: #a1a5b7 !important;
    border: 1px solid #e4e6ef;
}

.nav-group .btn.active {
    background: #e71d73 !important;
    color: white !important;
    box-shadow: 0 2px 8px rgba(231, 29, 115, 0.3);
    border-color: #e71d73 !important;
}

.check-icon-custom {
    color: #e71d73 !important;
}

@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.pricing-card {
    opacity: 0;
    animation: fadeInUp 0.6s ease forwards;
}

.pricing-card:nth-child(1) { animation-delay: 0.1s; }
.pricing-card:nth-child(2) { animation-delay: 0.2s; }
.pricing-card:nth-child(3) { animation-delay: 0.3s; }

.price-display {
    font-size: 3.5rem;
    font-weight: 700;
    color: #e71d73;
}

.price-currency {
    font-size: 1.5rem;
    vertical-align: top;
}

.price-period {
    font-size: 0.875rem;
    opacity: 0.7;
}

@media (max-width: 768px) {
    .price-display {
        font-size: 2.5rem;
    }
    
    .col-xl-5 {
        margin-bottom: 2rem;
    }
    
    .pricing-cards-row {
        flex-direction: column;
        gap: 1rem;
    }
}

.feature-included {
    color: #181c32 !important;
}

.feature-not-included {
    color: #a1a5b7 !important;
}

.pricing-main-title {
    font-size: 2.5rem;
    font-weight: 700;
    color: #181c32;
    margin-bottom: 1rem;
}

.pricing-subtitle {
    font-size: 1.125rem;
    color: #a1a5b7;
    margin-bottom: 2.5rem;
}

.plan-description {
    color: #7e8299 !important;
}

.pricing-container {
    padding: 2rem 0;
}

.pricing-cards-row {
    display: flex;
    justify-content: center;
    gap: 2rem;
}

.pricing-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: linear-gradient(90deg, #e71d73, #a11753);
    border-radius: 0.75rem 0.75rem 0 0;
    opacity: 0;
    transition: opacity 0.3s ease;
}

.pricing-card:hover::before {
    opacity: 1;
}

.pricing-card-featured {
    border: 3px solid #e71d73 !important;
    box-shadow: 0 15px 35px rgba(231, 29, 115, 0.2) !important;
    transform: scale(1.05);
    position: relative;
}

.pricing-card-featured::before {
    content: '';
    position: absolute;
    top: -3px;
    left: -3px;
    right: -3px;
    bottom: -3px;
    background: linear-gradient(45deg, #e71d73, #ff6b9d, #e71d73, #a11753);
    background-size: 400% 400%;
    border-radius: 0.75rem;
    z-index: -1;
    animation: gradientBorder 3s ease infinite;
}

@keyframes gradientBorder {
    0% {
        background-position: 0% 50%;
    }
    50% {
        background-position: 100% 50%;
    }
    100% {
        background-position: 0% 50%;
    }
}

.pricing-card-featured .badge {
    z-index: 10;
    box-shadow: 0 4px 15px rgba(231, 29, 115, 0.3);
}

.pricing-card-featured { 
    animation-delay: 0.2s; 
}

@media (max-width: 1200px) {
    .pricing-card-featured {
        transform: scale(1.02);
    }
}

@media (max-width: 768px) {
    .pricing-card-featured {
        transform: none;
        margin: 1rem 0;
    }
}
</style> 