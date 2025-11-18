<script>
    Alpine.data('purchaseLeads', () => ({
        handlePurchaseLeads() {
            const tableLeads = document.getElementById("kt_leads_table");
            const checkedRows = Array.from(
                tableLeads.querySelectorAll('input.form-check-input[type="checkbox"]:checked')
            ).map(checkbox => checkbox.closest('tr'));

            for (const row of checkedRows) {
                const attribute = row.getAttribute('data-lead');
                const lead = JSON.parse(attribute);

                if(lead){
                    window.addToCart(lead);
                }
            }
        },
    }));
</script>
