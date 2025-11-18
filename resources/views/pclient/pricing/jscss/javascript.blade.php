<script>
document.addEventListener('DOMContentLoaded', function() {
    const monthlyBtn = document.querySelector('[data-kt-plan="month"]');
    const annualBtn = document.querySelector('[data-kt-plan="annual"]');
    const priceElements = document.querySelectorAll('[data-kt-plan-price-month]');

    if (monthlyBtn && annualBtn) {
        monthlyBtn.addEventListener('click', function() {
            updatePrices('month');
            updateActiveButton(monthlyBtn, annualBtn);
        });

        annualBtn.addEventListener('click', function() {
            updatePrices('annual');
            updateActiveButton(annualBtn, monthlyBtn);
        });
    }

    function updatePrices(plan) {
        priceElements.forEach(element => {
            const monthlyPrice = element.getAttribute('data-kt-plan-price-month');
            const annualPrice = element.getAttribute('data-kt-plan-price-annual');

            if (plan === 'month') {
                element.textContent = monthlyPrice;
                updatePeriodText('Mês');
            } else {
                element.textContent = annualPrice;
                updatePeriodText('Ano');
            }
        });
    }

    function updatePeriodText(period) {
        const periodElements = document.querySelectorAll('[data-kt-element="period"]');
        periodElements.forEach(element => {
            element.textContent = period;
        });
    }

    function updateActiveButton(activeBtn, inactiveBtn) {
        activeBtn.classList.add('active');
        inactiveBtn.classList.remove('active');
    }

    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver(function(entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
            }
        });
    }, observerOptions);

    const pricingCards = document.querySelectorAll('.pricing-card');
    pricingCards.forEach(card => {
        observer.observe(card);
    });

    const selectButtons = document.querySelectorAll('.pricing-select-btn');
    selectButtons.forEach(button => {
        button.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-2px)';
        });

        button.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0)';
        });

        button.addEventListener('click', function(e) {
            document.querySelectorAll('.pricing-card').forEach(card => {
                card.classList.remove('selected');
            });

            this.closest('.pricing-card').classList.add('selected');

            this.style.transform = 'translateY(0)';
            setTimeout(() => {
                this.style.transform = 'translateY(-2px)';
            }, 150);

            const planName = this.closest('.pricing-card').querySelector('h1').textContent;
            console.log('Plano selecionado:', planName);
        });
        });

    const featureItems = document.querySelectorAll('.feature-item');
    featureItems.forEach(item => {
        item.addEventListener('mouseenter', function() {
            const featureText = this.querySelector('.feature-text')?.textContent;
            if (featureText) {
                const similarFeatures = document.querySelectorAll('.feature-text');
                similarFeatures.forEach(feature => {
                    if (feature.textContent === featureText) {
                        feature.closest('.feature-item')?.classList.add('highlight-feature');
                    }
                });
            }
        });

        item.addEventListener('mouseleave', function() {
            const highlightedFeatures = document.querySelectorAll('.highlight-feature');
            highlightedFeatures.forEach(feature => {
                feature.classList.remove('highlight-feature');
            });
        });
    });

    const anchorLinks = document.querySelectorAll('a[href^="#"]');
    anchorLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            const targetId = this.getAttribute('href').substring(1);
            const targetElement = document.getElementById(targetId);

            if (targetElement) {
                targetElement.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });
});

const style = document.createElement('style');
style.textContent = `
    .highlight-feature {
        background-color: rgba(231, 29, 115, 0.05) !important;
        border-radius: 0.5rem;
        transition: all 0.3s ease;
    }

    .feature-item {
        transition: all 0.3s ease;
        padding: 0.5rem;
        margin: 0 -0.5rem;
        border-radius: 0.5rem;
    }
`;
document.head.appendChild(style);
</script>