<script>
document.addEventListener('DOMContentLoaded', function() {
    // Inicialização da página de créditos/financeiro
    
    // Função para formatar valores monetários
    function formatCurrency(value) {
        return new Intl.NumberFormat('pt-BR', {
            style: 'currency',
            currency: 'BRL'
        }).format(value);
    }
    
    // Função para confirmar cancelamento de assinatura
    const cancelButton = document.querySelector('#cancelSubscription');
    if (cancelButton) {
        cancelButton.addEventListener('click', function(e) {
            e.preventDefault();
            
            Swal.fire({
                title: 'Tem certeza?',
                text: "Você realmente deseja cancelar sua assinatura?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Sim, cancelar!',
                cancelButtonText: 'Não, manter'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Aqui você faria a requisição para cancelar
                    Swal.fire(
                        'Cancelado!',
                        'Sua assinatura foi cancelada.',
                        'success'
                    );
                }
            });
        });
    }
    
    // Função para abrir modal de detalhes de evento
    const eventLinks = document.querySelectorAll('.event-detail-link');
    eventLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            // Aqui você pode adicionar lógica para mostrar detalhes do evento
            console.log('Exibir detalhes do evento:', this.dataset.eventId);
        });
    });
    
    // Tooltip initialization
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });
    
    // Menu dropdown initialization
    KTMenu.init();
    
    console.log('Página de Créditos carregada com sucesso!');
});
</script> 