<script>
function createPaymentLink(subscriptionId) {
    console.log('Criando link de pagamento para subscription:', subscriptionId);

    fetch('{{ route("subscriptions.create-payment-link") }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({ subscription_id: subscriptionId })
    })
    .then(response => {
        console.log('Response status:', response.status);
        return response.json();
    })
    .then(data => {
        console.log('Response data:', data);
        if (data.success) {
            console.log('Abrindo URL:', data.payment_url);
            window.open(data.payment_url, '_blank');
        } else {
            console.error('Erro ao criar link de pagamento:', data.message);
            alert('Erro ao criar link de pagamento: ' + (data.message || 'Erro desconhecido'));
        }
    })
    .catch(error => {
        console.error('Erro na requisição:', error);
        alert('Erro na requisição: ' + error.message);
    });
}
</script>
