
<style>
.menu-card {
    transition: all 0.3s ease;
    margin-top: 20px;
    border: none !important;
    border-radius: 12px !important;
    background: linear-gradient(135deg, #C2185B 0%, #A11753 50%, #8B1453 100%) !important;
    box-shadow: 
        inset 2px 2px 4px rgba(255, 255, 255, 0.1),
        inset -2px -2px 4px rgba(0, 0, 0, 0.2),
        0 4px 8px rgba(0, 0, 0, 0.1) !important;
    color: #ffffff !important;
    position: relative;
    overflow: hidden;
}

.menu-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(135deg, rgba(255, 255, 255, 0.1) 0%, rgba(255, 255, 255, 0.05) 50%, rgba(0, 0, 0, 0.1) 100%);
    border-radius: 12px;
    pointer-events: none;
}

.menu-card i {
    color: #ffffff !important;
    text-shadow: 0 1px 2px rgba(0, 0, 0, 0.3);
}

.menu-card .card-body h3,
.menu-card .card-body {
    color: #ffffff !important;
    text-shadow: 0 1px 2px rgba(0, 0, 0, 0.3);
    position: relative;
    z-index: 1;
}

.menu-card:hover {
    transform: translateY(-4px) scale(1.02);
    box-shadow: 
        inset 2px 2px 4px rgba(255, 255, 255, 0.15),
        inset -2px -2px 4px rgba(0, 0, 0, 0.25),
        0 8px 20px rgba(0, 0, 0, 0.2) !important;
    background: linear-gradient(135deg, #D32F6B 0%, #B91C5A 50%, #9A1A4F 100%) !important;
}

.menu-card:active {
    transform: translateY(-2px) scale(1.01);
    box-shadow: 
        inset 2px 2px 4px rgba(255, 255, 255, 0.1),
        inset -2px -2px 4px rgba(0, 0, 0, 0.3),
        0 4px 12px rgba(0, 0, 0, 0.25) !important;
}
</style> 