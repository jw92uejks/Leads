<style>
.text-primary,
.link-primary {
    color: #e71d73 !important;
}

.text-primary:hover,
.link-primary:hover {
    color: #a11753 !important;
}

.btn-primary {
    background-color: #e71d73;
    border-color: #e71d73;
}

.btn-primary:hover {
    background-color: #a11753;
    border-color: #a11753;
}

.badge-light-success {
    background-color: rgba(50, 205, 50, 0.1);
    color: #32cd32;
    border: 1px solid rgba(50, 205, 50, 0.2);
}

.text-hover-primary:hover {
    color: #e71d73 !important;
}

.confirmation-card {
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
    border-radius: 12px;
}

.confirmation-logo {
    max-height: 50px;
    width: auto;
}

.table-responsive {
    border-radius: 8px;
    overflow: hidden;
}

.table thead tr {
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
}

.table tbody tr {
    transition: all 0.2s ease;
    border-bottom: 1px solid #f1f3f6;
}

.table tbody tr:hover {
    background: linear-gradient(135deg, rgba(231, 29, 115, 0.05) 0%, rgba(231, 29, 115, 0.02) 100%);
    transform: scale(1.01);
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
}

.symbol-label {
    border-radius: 8px;
    transition: all 0.3s ease;
}

.symbol:hover .symbol-label {
    transform: scale(1.05);
}

.bg-lighten {
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
}

.card-rounded {
    border-radius: 12px;
}

.bullet-dot {
    width: 8px;
    height: 8px;
    border-radius: 50%;
    display: inline-block;
}

.bg-success {
    background-color: #32cd32 !important;
}

.text-success {
    color: #32cd32 !important;
}

.confirmation-success-animation {
    animation: confirmationPulse 2s ease-in-out infinite;
}

@keyframes confirmationPulse {
    0%, 100% {
        transform: scale(1);
        box-shadow: 0 0 0 0 rgba(50, 205, 50, 0.4);
    }
    50% {
        transform: scale(1.05);
        box-shadow: 0 0 0 10px rgba(50, 205, 50, 0);
    }
}

@media (max-width: 768px) {
    .table-responsive {
        font-size: 0.875rem;
    }
    
    .symbol-50px {
        width: 40px;
        height: 40px;
    }
    
    .min-w-md-350px {
        min-width: 100% !important;
    }
    
    .flex-xl-row {
        flex-direction: column !important;
    }
    
    .me-xl-18 {
        margin-right: 0 !important;
        margin-bottom: 2rem !important;
    }
}

.confirmation-header {
    background: linear-gradient(135deg, rgba(231, 29, 115, 0.1) 0%, rgba(231, 29, 115, 0.05) 100%);
    border-radius: 8px;
    padding: 1.5rem;
    margin-bottom: 2rem;
    border: 1px solid rgba(231, 29, 115, 0.2);
}

.confirmation-status {
    font-size: 1.1rem;
    font-weight: 600;
    color: #32cd32;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.confirmation-status i {
    font-size: 1.5rem;
}

.order-summary-box {
    background: white;
    border: 2px solid #e4e6ef;
    border-radius: 12px;
    padding: 1.5rem;
    position: sticky;
    top: 20px;
}

@media (max-width: 991px) {
    .order-summary-box {
        position: relative;
        top: auto;
    }
}
</style> 