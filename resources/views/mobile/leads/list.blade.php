<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OnDeal - Lista de Leads</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 min-h-screen">
    <div id="app" class="max-w-md mx-auto pb-24">
        <div class="bg-blue-600 text-white p-4 sticky top-0 z-10 shadow-lg">
            <div class="flex justify-between items-center">
                <h1 class="text-xl font-bold">OnDeal - Meus Leads</h1>
                <a id="createLeadBtn" href="/whatsapp/leads/create" class="bg-white text-blue-600 px-4 py-2 rounded-lg font-semibold text-sm hover:bg-blue-50 transition">
                    + Novo Lead
                </a>
            </div>
        </div>

        <div id="loading" class="p-4 text-center">
            <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-blue-600 mx-auto"></div>
            <p class="mt-2 text-gray-600">Carregando...</p>
        </div>

        <div id="errorMessage" class="hidden bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded m-4"></div>

        <div id="leadsSection" class="hidden m-4">
            <h2 class="text-lg font-semibold mb-3">Meus Leads</h2>
            <div id="leadsList" class="space-y-3"></div>
            <p id="noLeads" class="hidden text-center text-gray-500 py-8">Nenhum lead encontrado</p>
        </div>
    </div>

    <div id="backToWhatsAppBtn" class="hidden fixed bottom-0 left-0 right-0 max-w-md mx-auto bg-white border-t border-gray-200 p-4 shadow-lg">
        <button onclick="backToWhatsApp()" class="w-full bg-green-600 text-white py-3 rounded-lg font-semibold hover:bg-green-700 transition flex items-center justify-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/>
            </svg>
            Voltar ao WhatsApp
        </button>
    </div>

    <script src="{{ asset('assets/js/device-fingerprint.js') }}"></script>
    <script>
        const API_BASE_URL = window.location.origin + '/api/v1';
        let authToken = null;

        function showError(message) {
            const errorDiv = document.getElementById('errorMessage');
            errorDiv.textContent = message;
            errorDiv.classList.remove('hidden');
            setTimeout(() => errorDiv.classList.add('hidden'), 5000);
        }

        function decodeToken(encodedToken) {
            try {
                return atob(encodedToken.replace(/-/g, '+').replace(/_/g, '/'));
            } catch (e) {
                return null;
            }
        }

        function loadToken() {
            const urlParams = new URLSearchParams(window.location.search);
            const encodedToken = urlParams.get('token') || localStorage.getItem('whatsapp_token_encoded');

            if (encodedToken) {
                const decodedToken = decodeToken(encodedToken);
                if (decodedToken) {
                    authToken = decodedToken;
                    localStorage.setItem('whatsapp_token_encoded', encodedToken);
                    localStorage.setItem('whatsapp_token', decodedToken);
                    return true;
                }
            }
            return false;
        }


        function backToWhatsApp() {
            const secretaryPhone = '{{ env("SECRETARY_PHONE") }}';
            window.location.href = `https://wa.me/${secretaryPhone}`;
        }

        async function loadLeads() {
            try {
                const response = await fetch(API_BASE_URL + '/leads', {
                    headers: {
                        'Authorization': `Bearer ${authToken}`,
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    }
                });

                if (!response.ok) {
                    const error = await response.json();
                    throw new Error(error.message || 'Erro na requisição');
                }

                const data = await response.json();

                let leads = [];
                if (data.data && data.data.leads && Array.isArray(data.data.leads)) {
                    leads = data.data.leads;
                } else if (Array.isArray(data.data)) {
                    leads = data.data;
                } else if (Array.isArray(data)) {
                    leads = data;
                }

                const leadsList = document.getElementById('leadsList');
                const noLeads = document.getElementById('noLeads');

                leadsList.innerHTML = '';

                if (leads.length === 0) {
                    noLeads.classList.remove('hidden');
                } else {
                    noLeads.classList.add('hidden');

                    leads.forEach(lead => {
                        const leadCard = document.createElement('div');
                        leadCard.className = 'bg-white p-4 rounded-lg shadow border border-gray-200';
                        leadCard.innerHTML = `
                            <div class="flex justify-between items-start">
                                <div>
                                    <h3 class="font-semibold text-gray-900">${lead.name || 'Sem nome'}</h3>
                                    <p class="text-sm text-gray-600">${lead.phone || 'Sem telefone'}</p>
                                    ${lead.email ? `<p class="text-sm text-gray-600">${lead.email}</p>` : ''}
                                    ${lead.city && lead.state ? `<p class="text-xs text-gray-500 mt-1">${lead.city} - ${lead.state}</p>` : ''}
                                </div>
                                <span class="text-xs px-2 py-1 rounded ${lead.temperature === 'hot' ? 'bg-red-100 text-red-700' : lead.temperature === 'warm' ? 'bg-yellow-100 text-yellow-700' : 'bg-blue-100 text-blue-700'}">
                                    ${lead.temperature_label || lead.temperature || 'N/A'}
                                </span>
                            </div>
                            ${lead.source ? `<p class="text-xs text-gray-500 mt-2">Origem: ${lead.source}</p>` : ''}
                        `;
                        leadsList.appendChild(leadCard);
                    });

                    if (data.data && data.data.pagination) {
                        const pagination = data.data.pagination;
                        const paginationInfo = document.createElement('div');
                        paginationInfo.className = 'text-center text-sm text-gray-600 mt-4';
                        paginationInfo.textContent = `Total: ${pagination.total} leads (Página ${pagination.current_page} de ${pagination.last_page})`;
                        leadsList.appendChild(paginationInfo);
                    }
                }

                document.getElementById('leadsSection').classList.remove('hidden');
            } catch (error) {
                console.error('Erro ao carregar leads:', error);
                showError('Erro ao carregar leads: ' + error.message);
            } finally {
                document.getElementById('loading').classList.add('hidden');
            }
        }

        document.addEventListener('DOMContentLoaded', async () => {
            await DeviceFingerprint.init();

            if (!loadToken()) {
                showError('Token de autenticação não encontrado. Acesse via WhatsApp.');
                document.getElementById('loading').innerHTML = '<p class="text-red-600">Token não encontrado.</p>';
                return;
            }

            const createBtn = document.getElementById('createLeadBtn');
            const encodedToken = localStorage.getItem('whatsapp_token_encoded');
            if (createBtn && encodedToken) {
                createBtn.href = `/whatsapp/leads/create?token=${encodedToken}`;
            }

            document.getElementById('backToWhatsAppBtn').classList.remove('hidden');

            await loadLeads();
        });
    </script>
</body>
</html>

