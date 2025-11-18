<style>
.btn-pink {
    background-color: #e91e63;
    border-color: #e91e63;
    color: white;
}

.btn-pink:hover {
    background-color: #c2185b;
    border-color: #c2185b;
    color: white;
}

.btn-pink:focus {
    background-color: #d81b60;
    border-color: #d81b60;
    color: white;
    box-shadow: 0 0 0 0.2rem rgba(233, 30, 99, 0.25);
}

.btn-pink:active {
    background-color: #c2185b;
    border-color: #c2185b;
    color: white;
}

.text-pink {
    color: #e91e63 !important;
}

.bg-light-pink {
    background-color: rgba(233, 30, 99, 0.1) !important;
}

.btn-primary {
    background-color: #e91e63 !important;
    border-color: #e91e63 !important;
}

.btn-primary:hover {
    background-color: #c2185b !important;
    border-color: #c2185b !important;
}

.btn-primary:focus, .btn-primary.focus {
    box-shadow: 0 0 0 0.2rem rgba(233, 30, 99, 0.25) !important;
}

.btn-primary:active, .btn-primary.active {
    background-color: #ad1457 !important;
    border-color: #ad1457 !important;
}

.badge-light-primary {
    background-color: rgba(233, 30, 99, 0.1) !important;
    color: #e91e63 !important;
}

.checkout-card-pink .card-header {
    background-color: #e91e63;
    border-bottom: 1px solid rgba(255, 255, 255, 0.2);
}

.checkout-card-pink .card-body {
    background-color: #e91e63;
}

.table-pink thead th {
    background-color: rgba(233, 30, 99, 0.1);
    color: #e91e63;
    border-bottom: 2px solid #e91e63;
}

.rating .rating-label.checked i {
    color: #ffc107;
}

.table-hover tbody tr:hover {
    background-color: rgba(233, 30, 99, 0.05);
}

.border-pink {
    border-color: #e91e63 !important;
}

.ki-duotone.text-primary {
    color: #e91e63 !important;
}

.btn-pink {
    transition: all 0.3s ease;
}

.btn-pink:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 8px rgba(233, 30, 99, 0.3);
}

.card {
    transition: all 0.3s ease;
}

.card:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.1);
}

.bg-light-warning {
    background-color: #fff8dd !important;
}

@media (max-width: 768px) {
    .btn-lg {
        padding: 0.75rem 1.5rem;
        font-size: 1rem;
    }
    
    .table-responsive {
        border: none;
    }
    
    .d-flex.gap-5 {
        flex-direction: column;
        gap: 1rem !important;
    }
}

.btn-pink:disabled {
    background-color: rgba(233, 30, 99, 0.5);
    border-color: rgba(233, 30, 99, 0.5);
    cursor: not-allowed;
}

@keyframes successPulse {
    0% { transform: scale(1); }
    50% { transform: scale(1.05); }
    100% { transform: scale(1); }
}

.success-animation {
    animation: successPulse 0.6s ease-in-out;
}

.rating-label.checked {
    color: #ffc107;
}

.rating-label {
    color: #e4e6ef;
}

.card-body {
    padding: 1.5rem;
}

.table td {
    padding: 1rem 0.75rem;
}

.table th {
    padding: 1rem 0.75rem;
}

.symbol-label {
    display: flex;
    align-items: center;
    justify-content: center;
}

.border-dashed {
    border-style: dashed !important;
}

.border-gray-300 {
    border-color: #e4e6ef !important;
}

.min-w-80px {
    min-width: 80px;
}

.checkout-animation {
    animation: fadeInUp 0.6s ease-out;
}

@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.card-hover-effect:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
    transition: all 0.3s ease;
}

.table-responsive {
    border-radius: 8px;
    overflow: hidden;
}

.card {
    border-radius: 12px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
}

.badge {
    font-size: 0.8rem;
    padding: 0.4rem 0.8rem;
}

.fs-1 {
    font-size: 1.5rem !important;
}

.fs-6 {
    font-size: 1rem !important;
}

.text-end {
    text-align: right !important;
}

.pe-4 {
    padding-right: 1.5rem !important;
}

.me-5 {
    margin-right: 3rem !important;
}

.symbol-45px {
    width: 45px;
    height: 45px;
}

.symbol-circle {
    border-radius: 50%;
}

.bg-light-danger {
    background-color: #fff5f5 !important;
}

.bg-light-warning {
    background-color: #fff8dd !important;
}

.bg-light-info {
    background-color: #f0f9ff !important;
}

.text-danger {
    color: #dc3545 !important;
}

.text-warning {
    color: #ffc700 !important;
}

.text-info {
    color: #17a2b8 !important;
}

.badge-light-danger {
    color: #f1416c;
    background-color: #ffe2e5;
    border: 1px solid #ffc5cd;
}

.badge-light-warning {
    color: #ffc700;
    background-color: #fff8dd;
    border: 1px solid #ffe680;
}

.badge-light-info {
    color: #009ef7;
    background-color: #e1f0ff;
    border: 1px solid #b3d9ff;
}

.btn-light-primary {
    color: #3699ff;
    background-color: #f8fbff;
    border-color: #f8fbff;
}

.btn-light-primary:hover {
    color: #ffffff;
    background-color: #3699ff;
    border-color: #3699ff;
}

.btn-light-primary:focus {
    color: #ffffff;
    background-color: #3699ff;
    border-color: #3699ff;
    box-shadow: 0 0 0 0.2rem rgba(54, 153, 255, 0.25);
}

.btn-light-primary:active {
    color: #ffffff;
    background-color: #2884ef;
    border-color: #2884ef;
}

.border-warning {
    border-color: #ffc700 !important;
}

.policy-warning-box {
    background-color: #fff8e1;
    border: 2px dashed #ffc107;
    border-radius: 8px;
    padding: 1.5rem;
    margin-top: 1rem;
}

.policy-warning-box h4 {
    color: #f57c00;
    margin-bottom: 0.5rem;
}

.policy-warning-box p {
    color: #6c757d;
    margin-bottom: 0;
    line-height: 1.5;
}

.separator {
    height: 1px;
    background-color: #e4e6ef;
    margin: 1.5rem 0;
}

.my-6 {
    margin-top: 2rem !important;
    margin-bottom: 2rem !important;
}

.ms-5 {
    margin-left: 3rem !important;
}

div.pacotes-selecionados{
  margin-bottom:90px;
}

@media (max-width: 768px) {
    .card-body {
        padding: 1rem;
    }
    
    .table td, .table th {
        padding: 0.75rem 0.5rem;
    }
    
    .symbol-45px {
        width: 35px;
        height: 35px;
    }
    
    .me-5 {
        margin-right: 1rem !important;
    }
    
    .pe-4 {
        padding-right: 1rem !important;
    }
    
    .ms-5 {
        margin-left: 1rem !important;
    }
    
    .d-flex.align-items-center.justify-content-between {
        flex-direction: column;
        align-items: flex-start !important;
    }
    
    .ms-5 {
        margin-left: 0 !important;
        margin-top: 1rem !important;
        width: 100%;
    }
    
    .policy-warning-box {
        padding: 1rem;
    }
}

.btn {
    transition: all 0.3s ease;
}

.btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
}

.table th {
    border-bottom: 2px solid #f1f1f4;
    font-weight: 600;
    font-size: 0.85rem;
    letter-spacing: 0.5px;
}

.table td {
    border-bottom: 1px solid #f1f1f4;
    vertical-align: middle;
    padding: 1rem 0.75rem;
}

.symbol-label {
    transition: all 0.3s ease;
}

.table tbody tr:hover .symbol-label {
    transform: scale(1.05);
}

.rating {
    display: flex;
    gap: 2px;
}

.rating-label {
    transition: transform 0.2s ease;
}

.rating-label:hover {
    transform: scale(1.1);
}

.rating-label:not(.checked) i {
    color: #e4e6ef;
}

.badge {
    font-weight: 600;
    padding: 0.5rem 0.75rem;
    font-size: 0.75rem;
}

.notice {
    border-radius: 0.75rem;
    transition: all 0.3s ease;
}

.notice:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(233, 30, 99, 0.1);
}

.symbol-circle img {
    border-radius: 50%;
    object-fit: cover;
}

@media (max-width: 991.98px) {
    .card-body {
        padding: 1rem;
    }
    
    .table-responsive {
        border-radius: 0.5rem;
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
    }
    
    .btn {
        width: 100%;
        margin-bottom: 0.5rem;
    }
    
    .d-flex.gap-2.gap-lg-3 {
        flex-direction: column;
        gap: 0.5rem !important;
    }
    
    .row.g-5.g-xl-10 {
        row-gap: 2rem !important;
    }
    
    .fs-5 {
        font-size: 1rem !important;
    }
    
    .fs-7 {
        font-size: 0.75rem !important;
    }
    
    .symbol {
        width: 40px !important;
        height: 40px !important;
    }
    
    .symbol .fs-1 {
        font-size: 1.5rem !important;
    }
    
    .card-title h2 {
        font-size: 1.25rem;
    }
    
    .notice {
        flex-direction: column;
        text-align: center;
        gap: 1rem;
    }
    
    .notice .d-flex.flex-stack {
        flex-direction: column;
        align-items: center;
        gap: 1rem;
    }
}

@media (max-width: 575.98px) {
    .container-xxl {
        padding: 0 1rem;
    }
    
    .app-toolbar {
        padding: 1rem 0;
    }
    
    .page-heading {
        font-size: 1.5rem !important;
    }
    
    .card {
        margin-bottom: 1rem;
    }
    
    .table td, .table th {
        padding: 0.75rem 0.5rem;
        font-size: 0.875rem;
    }
    
    .btn {
        padding: 0.75rem 1rem;
        font-size: 0.875rem !important;
    }
}

.loading-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(255, 255, 255, 0.9);
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 9999;
}

.loading-spinner {
    width: 3rem;
    height: 3rem;
    border: 0.3rem solid #f3f3f3;
    border-top: 0.3rem solid #e91e63;
    border-radius: 50%;
    animation: spin 1s linear infinite;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

.ki-information {
    font-size: 2rem;
}

.pagination .page-item.active .page-link {
    background-color: #e91e63 !important;
    border-color: #e91e63 !important;
    color: white !important;
}

.pagination .page-link:hover {
    background-color: rgba(233, 30, 99, 0.1) !important;
    border-color: #e91e63 !important;
    color: #e91e63 !important;
}
</style> 