<script>
document.addEventListener('DOMContentLoaded', function() {
    initializeConfirmation();
});


const confirmationData = {
    totalLeads: 1024,
    totalValue: 245760.00,
    leadsPerPage: 20,
    currentPage: 1,
    leads: generateMockConfirmationLeads(1024)
};

function generateMockConfirmationLeads(count) {
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
    
    const statuses = ['Disponível', 'Processando', 'Validado'];
    
    const leads = [];
    for (let i = 1; i <= count; i++) {
        const randomName = names[Math.floor(Math.random() * names.length)];
        const randomSegment = segments[Math.floor(Math.random() * segments.length)];
        const randomSupplier = suppliers[Math.floor(Math.random() * suppliers.length)];
        const randomRating = (Math.random() * 2 + 3).toFixed(1);
        const randomPrice = (Math.random() * 400 + 100).toFixed(2);
        const randomStatus = statuses[Math.floor(Math.random() * statuses.length)];
        
        leads.push({
            id: i,
            name: `${randomName} ${randomSegment}`,
            supplier: randomSupplier,
            rating: parseFloat(randomRating),
            price: parseFloat(randomPrice),
            location: `Lead #${i.toString().padStart(4, '0')}`,
            status: randomStatus
        });
    }
    return leads;
}

function initializeConfirmation() {
    showSuccessMessage();
}

function showSuccessMessage() {
    toastr.success('Compra realizada com sucesso! Seus leads estão disponíveis.');
}



function formatCurrency(value) {
    return new Intl.NumberFormat('pt-BR', {
        style: 'currency',
        currency: 'BRL'
    }).format(value);
}
</script> 