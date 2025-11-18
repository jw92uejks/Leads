<script>
document.addEventListener('DOMContentLoaded', function() {
    if (typeof Chart !== 'undefined') {
        initLeadsSalesChart();
        initRatingChart();
        initMonthlyPerformanceChart();
    }
});

function initLeadsSalesChart() {
    const ctx = document.getElementById('leadsSalesChart');
    if (!ctx) return;

    window.leadsChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: ['Leads Vendidos', 'Leads Pendentes', 'Leads Rejeitados'],
            datasets: [{
                data: [65, 25, 10],
                backgroundColor: ['#17c653', '#1B84FF', '#e91e63'],
                borderWidth: 0
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom'
                }
            }
        }
    });
}

function initRatingChart() {
    const ctx = document.getElementById('ratingChart');
    if (!ctx) return;

    window.ratingChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['1★', '2★', '3★', '4★', '5★'],
            datasets: [{
                label: 'Avaliações',
                data: [2, 5, 15, 35, 43],
                backgroundColor: '#e91e63',
                borderRadius: 4
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
}

function initMonthlyPerformanceChart() {
    const ctx = document.getElementById('monthlyPerformanceChart');
    if (!ctx) return;

    window.monthlyChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun'],
            datasets: [{
                label: 'Leads Vendidos',
                data: [45, 62, 78, 85, 73, 95],
                borderColor: '#e91e63',
                backgroundColor: 'rgba(233, 30, 99, 0.1)',
                tension: 0.4,
                fill: true
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return value + ' leads';
                        }
                    }
                }
            }
        }
    });
}

function refreshDashboard() {
    location.reload();
}

function updateCharts() {
    const period = document.getElementById('periodFilter').value;
    
    const periodData = {
        7: {
            leads: [15, 5, 2],
            ratings: [0, 1, 3, 8, 15],
            monthly: [8, 12, 15, 18, 22, 25]
        },
        30: {
            leads: [65, 25, 10],
            ratings: [2, 5, 15, 35, 43],
            monthly: [45, 62, 78, 85, 73, 95]
        },
        90: {
            leads: [180, 70, 25],
            ratings: [5, 12, 35, 88, 120],
            monthly: [135, 185, 220, 245, 195, 275]
        },
        365: {
            leads: [720, 280, 100],
            ratings: [15, 45, 120, 280, 450],
            monthly: [450, 520, 580, 620, 550, 680]
        }
    };

    const data = periodData[period];
    
    if (window.leadsChart) {
        window.leadsChart.data.datasets[0].data = data.leads;
        window.leadsChart.update();
    }
    
    if (window.ratingChart) {
        window.ratingChart.data.datasets[0].data = data.ratings;
        window.ratingChart.update();
    }
    
    if (window.monthlyChart) {
        window.monthlyChart.data.datasets[0].data = data.monthly;
        window.monthlyChart.update();
    }
}

setInterval(function() {
    document.querySelector('.current-time').textContent = new Date().toLocaleTimeString('pt-BR');
}, 1000);

document.addEventListener('DOMContentLoaded', function() {
    initEarningsCharts();
    initEarningsTabs();
});

function initEarningsCharts() {
    const earningsData = {
        '1d': {
            labels: ['Manhã', 'Tarde', 'Noite'],
            values: [850, 1200, 950],
            tableData: [
                { time: 'Manhã', value: 850.43, change: -45.20 },
                { time: 'Tarde', value: 1200.18, change: 349.75 },
                { time: 'Noite', value: 950.63, change: -249.55 }
            ]
        },
        '5d': {
            labels: ['Seg', 'Ter', 'Qua', 'Qui', 'Sex'],
            values: [2200, 2450, 2680, 2520, 2847],
            tableData: [
                { time: 'Segunda', value: 2200.50, change: 150.25 },
                { time: 'Terça', value: 2450.75, change: 250.25 },
                { time: 'Quarta', value: 2680.30, change: 229.55 }
            ]
        },
        '1m': {
            labels: ['Sem 1', 'Sem 2', 'Sem 3', 'Sem 4'],
            values: [8500, 9200, 9800, 11200],
            tableData: [
                { time: 'Semana 1', value: 8500.00, change: 400.00 },
                { time: 'Semana 2', value: 9200.00, change: 700.00 },
                { time: 'Semana 3', value: 9800.00, change: 600.00 }
            ]
        },
        '6m': {
            labels: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun'],
            values: [25000, 28000, 32000, 29000, 34000, 38000],
            tableData: [
                { time: 'Abril', value: 29000.00, change: -3000.00 },
                { time: 'Maio', value: 34000.00, change: 5000.00 },
                { time: 'Junho', value: 38000.00, change: 4000.00 }
            ]
        },
        '1a': {
            labels: ['Q1', 'Q2', 'Q3', 'Q4'],
            values: [85000, 95000, 105000, 120000],
            tableData: [
                { time: 'Q1 2024', value: 85000.00, change: 5000.00 },
                { time: 'Q2 2024', value: 95000.00, change: 10000.00 },
                { time: 'Q3 2024', value: 105000.00, change: 10000.00 }
            ]
        }
    };

    for (let i = 1; i <= 5; i++) {
        const ctx = document.getElementById(`earningsChart${i}`);
        if (ctx) {
            const period = ['1d', '5d', '1m', '6m', '1a'][i - 1];
            const data = earningsData[period];
            
            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: data.labels,
                    datasets: [{
                        label: 'Ganhos',
                        data: data.values,
                        borderColor: '#e91e63',
                        backgroundColor: 'rgba(233, 30, 99, 0.1)',
                        tension: 0.4,
                        fill: true,
                        pointBackgroundColor: '#e91e63',
                        pointBorderColor: '#fff',
                        pointBorderWidth: 2,
                        pointRadius: 4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: false,
                            ticks: {
                                callback: function(value) {
                                    return 'R$ ' + value.toLocaleString('pt-BR');
                                }
                            }
                        }
                    }
                }
            });
        }
    }
    
    updateEarningsTable('1', earningsData['1d'].tableData);
}

function initEarningsTabs() {
    const tabs = document.querySelectorAll('[id^="earnings_tab_"]');
    
    tabs.forEach(tab => {
        tab.addEventListener('click', function(e) {
            e.preventDefault();
            
            tabs.forEach(t => t.classList.remove('active'));
            this.classList.add('active');
            
            document.querySelectorAll('[id^="earnings_tab_content_"]').forEach(content => {
                content.classList.remove('active', 'show');
            });
            
            const targetId = this.getAttribute('href').substring(1);
            const targetContent = document.getElementById(targetId);
            if (targetContent) {
                targetContent.classList.add('active', 'show');
            }
            
            const tabNumber = this.id.split('_').pop();
            const periods = ['1d', '5d', '1m', '6m', '1a'];
                         const periodData = {
                 '1d': [
                     { time: 'Manhã', value: 850.43, change: -45.20 },
                     { time: 'Tarde', value: 1200.18, change: 349.75 },
                     { time: 'Noite', value: 950.63, change: -249.55 }
                 ],
                 '5d': [
                     { time: 'Segunda', value: 2200.50, change: 150.25 },
                     { time: 'Terça', value: 2450.75, change: 250.25 },
                     { time: 'Quarta', value: 2680.30, change: 229.55 }
                 ],
                 '1m': [
                     { time: 'Semana 1', value: 8500.00, change: 400.00 },
                     { time: 'Semana 2', value: 9200.00, change: 700.00 },
                     { time: 'Semana 3', value: 9800.00, change: 600.00 }
                 ],
                 '6m': [
                     { time: 'Abril', value: 29000.00, change: -3000.00 },
                     { time: 'Maio', value: 34000.00, change: 5000.00 },
                     { time: 'Junho', value: 38000.00, change: 4000.00 }
                 ],
                 '1a': [
                     { time: 'Q1 2024', value: 85000.00, change: 5000.00 },
                     { time: 'Q2 2024', value: 95000.00, change: 10000.00 },
                     { time: 'Q3 2024', value: 105000.00, change: 10000.00 }
                 ]
             };
            
            const period = periods[parseInt(tabNumber) - 1];
            updateEarningsTable(tabNumber, periodData[period]);
            
                         const values = [1000.58, 2450.75, 9800.00, 34000.00, 105000.00];
             const percents = [3.2, 5.2, 12.5, 8.9, 15.2];
            
            document.getElementById('avgEarningsValue').textContent = values[parseInt(tabNumber) - 1].toLocaleString('pt-BR', {
                minimumFractionDigits: 2,
                maximumFractionDigits: 2
            });
            document.getElementById('avgEarningsPercent').textContent = percents[parseInt(tabNumber) - 1] + '%';
        });
    });
}

function updateEarningsTable(tabNumber, data) {
    const tbody = document.getElementById(`earningsTable${tabNumber}`);
    if (!tbody) return;
    
    tbody.innerHTML = data.map(item => `
        <tr>
            <td>
                <a href="#" class="text-gray-600 fw-bold fs-6">${item.time}</a>
            </td>
            <td class="pe-0 text-end">
                <span class="text-gray-800 fw-bold fs-6 me-1">R$ ${item.value.toLocaleString('pt-BR', {
                    minimumFractionDigits: 2,
                    maximumFractionDigits: 2
                })}</span>
            </td>
            <td class="pe-0 text-end">
                <span class="fw-bold fs-6 ${item.change >= 0 ? 'text-success' : 'text-danger'}">
                    ${item.change >= 0 ? '+' : ''}${item.change.toLocaleString('pt-BR', {
                        minimumFractionDigits: 2,
                        maximumFractionDigits: 2
                    })}
                </span>
            </td>
        </tr>
    `).join('');
}
</script> 