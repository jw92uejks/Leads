<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OnDeal - Criar Lead</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 min-h-screen">
    <div id="app" class="max-w-md mx-auto pb-24">
        <div class="bg-blue-600 text-white p-4 sticky top-0 z-10 shadow-lg">
            <div class="flex items-center gap-3">
                <a id="backToListBtn" href="/whatsapp/leads" class="text-white hover:text-blue-100 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                </a>
                <h1 class="text-xl font-bold">OnDeal - Novo Lead</h1>
            </div>
        </div>

        <div id="errorMessage" class="hidden bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded m-4"></div>
        <div id="successMessage" class="hidden bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded m-4"></div>

        <div class="bg-white m-4 p-4 rounded-lg shadow">
            <h2 class="text-lg font-semibold mb-4">Novo Lead</h2>
            <form id="leadForm" class="space-y-3">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nome *</label>
                    <input type="text" name="name" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Telefone *</label>
                    <input type="tel" name="phone" required placeholder="11999887766" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    <p class="text-xs text-gray-500 mt-1">Apenas números (10-11 dígitos)</p>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                    <input type="email" name="email" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Cidade</label>
                    <input type="text" name="city" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Estado (UF)</label>
                    <input type="text" name="state" maxlength="2" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Tipo</label>
                    <select name="type" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <option value="1">Pessoa Física (PF)</option>
                        <option value="2">Pessoa Jurídica (PJ)</option>
                        <option value="3">Adesão</option>
                        <option value="4">Mista</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Origem</label>
                    <input type="text" name="source" placeholder="Ex: WhatsApp, Indicação..." class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                </div>

                <button type="submit" class="w-full bg-blue-600 text-white py-3 rounded-lg font-semibold hover:bg-blue-700 transition">
                    Criar Lead
                </button>
            </form>
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

    <script src="{{ asset('js/device-fingerprint.js') }}"></script>
    <script>
        const API_BASE_URL = window.location.origin + '/api/v1';
        let authToken = null;

        function showError(message) {
            const errorDiv = document.getElementById('errorMessage');
            errorDiv.textContent = message;
            errorDiv.classList.remove('hidden');
            setTimeout(() => errorDiv.classList.add('hidden'), 5000);
        }

        function showSuccess(message) {
            const successDiv = document.getElementById('successMessage');
            successDiv.textContent = message;
            successDiv.classList.remove('hidden');
            setTimeout(() => successDiv.classList.add('hidden'), 3000);
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

        async function createLead(formData) {
            try {
                const leadData = {
                    name: formData.get('name'),
                    phone: formData.get('phone'),
                    email: formData.get('email') || null,
                    city: formData.get('city') || null,
                    state: formData.get('state') || null,
                    type: parseInt(formData.get('type')),
                    source: formData.get('source') || 'WhatsApp Mobile',
                    temperature: 'warm',
                    step: 1
                };

                const response = await fetch(API_BASE_URL + '/leads', {
                    method: 'POST',
                    headers: {
                        'Authorization': `Bearer ${authToken}`,
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify(leadData)
                });

                if (!response.ok) {
                    const error = await response.json();
                    throw new Error(error.message || 'Erro na requisição');
                }

                showSuccess('Lead criado com sucesso! Redirecionando...');
                document.getElementById('leadForm').reset();

                const encodedToken = localStorage.getItem('whatsapp_token_encoded');
                setTimeout(() => {
                    window.location.href = `/whatsapp/leads?token=${encodedToken}`;
                }, 2000);
            } catch (error) {
                console.error('Erro ao criar lead:', error);
                showError('Erro ao criar lead: ' + error.message);
            }
        }

        document.addEventListener('DOMContentLoaded', async () => {
            await DeviceFingerprint.init();

            if (!loadToken()) {
                showError('Token de autenticação não encontrado. Acesse via WhatsApp.');
                return;
            }

            const backBtn = document.getElementById('backToListBtn');
            const encodedToken = localStorage.getItem('whatsapp_token_encoded');
            if (backBtn && encodedToken) {
                backBtn.href = `/whatsapp/leads?token=${encodedToken}`;
            }

            document.getElementById('backToWhatsAppBtn').classList.remove('hidden');

            document.getElementById('leadForm').addEventListener('submit', async (e) => {
                e.preventDefault();
                const formData = new FormData(e.target);
                await createLead(formData);
            });
        });
    </script>
</body>
</html>

