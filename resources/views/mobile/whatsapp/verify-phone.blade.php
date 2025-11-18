<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Verificação de Telefone - SecretárIA do Corretor</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .verify-card {
            background: white;
            border-radius: 20px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.2);
            max-width: 400px;
            width: 90%;
            padding: 2rem;
        }
        .verify-header {
            text-align: center;
            margin-bottom: 2rem;
        }
        .verify-icon {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1rem;
        }
        .verify-icon i {
            font-size: 2.5rem;
            color: white;
        }
        .verify-title {
            font-size: 1.5rem;
            font-weight: bold;
            color: #333;
            margin-bottom: 0.5rem;
        }
        .verify-subtitle {
            color: #666;
            font-size: 0.9rem;
        }
        .form-label {
            font-weight: 600;
            color: #333;
            margin-bottom: 0.5rem;
        }
        .form-control {
            border-radius: 10px;
            border: 2px solid #e0e0e0;
            padding: 0.75rem 1rem;
            font-size: 1rem;
        }
        .form-control:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
        }
        .btn-verify {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            border-radius: 10px;
            padding: 0.75rem 2rem;
            font-size: 1rem;
            font-weight: 600;
            color: white;
            width: 100%;
            margin-top: 1rem;
            transition: transform 0.2s;
        }
        .btn-verify:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
        }
        .btn-verify:disabled {
            opacity: 0.6;
            cursor: not-allowed;
        }
        .alert {
            border-radius: 10px;
            margin-bottom: 1rem;
        }
        .info-box {
            background: #f8f9fa;
            border-radius: 10px;
            padding: 1rem;
            margin-bottom: 1.5rem;
            border-left: 4px solid #667eea;
        }
        .info-box p {
            margin: 0;
            font-size: 0.9rem;
            color: #555;
        }
        .spinner {
            display: none;
            margin-left: 0.5rem;
        }
        .loading .spinner {
            display: inline-block;
        }
        .alert {
            border-radius: 10px;
            padding: 1rem;
            margin-bottom: 1rem;
            border: none;
            font-size: 0.95rem;
        }
        .alert-danger {
            background: #fee;
            color: #c33;
            border-left: 4px solid #dc3545;
        }
        .alert-success {
            background: #d4edda;
            color: #155724;
            border-left: 4px solid #28a745;
        }
        .alert-info {
            background: #d1ecf1;
            color: #0c5460;
            border-left: 4px solid #17a2b8;
        }
        .alert ul {
            padding-left: 1.2rem;
            margin-top: 0.5rem;
        }
        .invalid-feedback {
            color: #dc3545;
            font-size: 0.9rem;
            margin-top: 0.3rem;
        }
        .is-invalid {
            border-color: #dc3545 !important;
            box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.25);
        }
        .btn-close {
            background: transparent;
            border: none;
            font-size: 1.2rem;
            opacity: 0.5;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="verify-card">
        <div class="verify-header">
            <div class="verify-icon">
                <i class="fas fa-shield-alt"></i>
            </div>
            <h1 class="verify-title">Verificação de Segurança</h1>
            <p class="verify-subtitle">Para sua proteção, confirme seu número de telefone</p>
        </div>

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-circle me-2"></i>
                <strong>Erro:</strong> {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i>
                <strong>Sucesso:</strong> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if(session('info'))
            <div class="alert alert-info alert-dismissible fade show" role="alert">
                <i class="fas fa-info-circle me-2"></i>
                {{ session('info') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-triangle me-2"></i>
                <strong>Atenção!</strong>
                <ul class="mb-0 mt-2">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="info-box">
            <p><strong>Olá, {{ $userName }}!</strong></p>
            <p class="mt-2">Por favor, confirme que o número de telefone cadastrado é o mesmo deste dispositivo.</p>
            <p class="mt-2 mb-0"><small><i class="fas fa-info-circle me-1"></i>Esta verificação ocorre apenas uma vez por segurança.</small></p>
        </div>

        <form id="verifyForm" method="POST" action="{{ route('whatsapp.verify-phone') }}">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">
            <input type="hidden" name="device_fingerprint" id="deviceFingerprint">

            <div class="mb-3">
                <label for="phone" class="form-label">
                    <i class="fas fa-phone me-2"></i>Número de Telefone
                </label>
                <input
                    type="text"
                    class="form-control @error('phone') is-invalid @enderror"
                    id="phone"
                    name="phone"
                    placeholder="11987654321"
                    value="{{ old('phone') }}"
                    required
                    inputmode="numeric"
                >
                @error('phone')
                    <div class="invalid-feedback d-block">
                        <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                    </div>
                @enderror
                <small class="text-muted d-block">
                    <i class="fas fa-phone me-1"></i>
                    Seu número cadastrado: {{ substr($userPhone, 0, 4) }}********{{ substr($userPhone, -2) }}
                </small>
                <small class="text-muted d-block">
                    <i class="fas fa-check-circle me-1 text-success"></i>
                    O código do país +55 será adicionado automaticamente
                </small>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">
                    <i class="fas fa-lock me-2"></i>Senha
                </label>
                <input
                    type="password"
                    class="form-control @error('password') is-invalid @enderror"
                    id="password"
                    name="password"
                    placeholder="Digite sua senha"
                    required
                >
                @error('password')
                    <div class="invalid-feedback d-block">
                        <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                    </div>
                @enderror
                <small class="text-muted d-block">
                    <i class="fas fa-info-circle me-1"></i>
                    Digite a mesma senha que você usa para acessar o sistema
                </small>
            </div>

            <div id="fingerprintStatus" class="alert alert-warning mb-3" style="display: none;">
                <i class="fas fa-spinner fa-spin me-2"></i>
                Gerando identificação de segurança do dispositivo...
            </div>

            <div id="fingerprintSuccess" class="alert alert-success mb-3" style="display: none;">
                <i class="fas fa-check-circle me-2"></i>
                <div>Dispositivo identificado com sucesso!</div>
                <small id="fingerprintDisplay" class="d-block mt-1 font-monospace" style="font-size: 0.75rem;"></small>
            </div>

            <button type="submit" class="btn btn-verify" id="submitBtn">
                <i class="fas fa-check-circle me-2"></i>Verificar Telefone
                <span class="spinner spinner-border spinner-border-sm"></span>
            </button>
        </form>

        <div class="text-center mt-3">
            <small class="text-muted">
                <i class="fas fa-lock me-1"></i>
                Conexão segura e criptografada
            </small>
        </div>

        <div id="debugConsole" class="mt-3" style="display: none; background: #000; color: #0f0; padding: 1rem; border-radius: 8px; font-family: monospace; font-size: 0.75rem; max-height: 300px; overflow-y: auto;">
            <div style="margin-bottom: 0.5rem; color: #fff; font-weight: bold;">
                📱 Debug Console Mobile
            </div>
            <div id="debugOutput"></div>
        </div>

        <div class="text-center mt-2">
            <button type="button" class="btn btn-sm btn-outline-secondary" onclick="toggleDebug()">
                <i class="fas fa-bug me-1"></i>Mostrar Debug
            </button>
        </div>
    </div>

    <script src="{{ asset('assets/js/device-fingerprint.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function debugLog(message, isError = false) {
            const output = document.getElementById('debugOutput');
            const time = new Date().toLocaleTimeString();
            const color = isError ? '#f00' : '#0f0';
            const icon = isError ? '❌' : '✅';

            const line = document.createElement('div');
            line.style.color = color;
            line.style.marginBottom = '0.25rem';
            line.textContent = `[${time}] ${icon} ${message}`;
            output.appendChild(line);

            output.scrollTop = output.scrollHeight;
        }

        function toggleDebug() {
            const debugConsole = document.getElementById('debugConsole');
            debugConsole.style.display = debugConsole.style.display === 'none' ? 'block' : 'none';
        }

        document.addEventListener('DOMContentLoaded', async function() {
            debugLog('=== INICIANDO VERIFICAÇÃO ===');
            debugLog('1. Página carregada');

            const statusEl = document.getElementById('fingerprintStatus');
            const successEl = document.getElementById('fingerprintSuccess');
            const submitBtn = document.getElementById('submitBtn');

            debugLog('2. Elementos: status=' + !!statusEl + ', success=' + !!successEl + ', btn=' + !!submitBtn);

            setTimeout(() => {
                const fpInput = document.getElementById('deviceFingerprint');
                if (!fpInput.value) {
                    debugLog('⏰ TIMEOUT: Gerando FP emergência', true);
                    const emergencyFP = 'timeout-' + Date.now();
                    fpInput.value = emergencyFP;
                    statusEl.style.display = 'none';
                }
            }, 10000);

            statusEl.style.display = 'block';
            debugLog('3. Status "Gerando..." exibido');

            debugLog('4. Função existe? ' + (typeof generateDeviceFingerprint));

            if (typeof generateDeviceFingerprint === 'undefined') {
                debugLog('Função NÃO ENCONTRADA!', true);
                debugLog('Arquivo JS não carregou', true);
                statusEl.style.display = 'none';

                const fallbackFingerprint = 'emergency-' + Date.now() + '-' + Math.random().toString(36).substring(2, 15);
                document.getElementById('deviceFingerprint').value = fallbackFingerprint;

                debugLog('Usando ID emergência', true);
                return;
            }

            try {
                debugLog('5. Chamando gerador...');

                const fingerprintPromise = generateDeviceFingerprint();
                const timeoutPromise = new Promise((_, reject) =>
                    setTimeout(() => reject(new Error('Timeout 5s')), 5000)
                );

                const fingerprint = await Promise.race([fingerprintPromise, timeoutPromise]);

                debugLog('6. FP gerado: ' + fingerprint.substring(0, 16) + '...');
                debugLog('Tamanho: ' + fingerprint.length);

                document.getElementById('deviceFingerprint').value = fingerprint;
                debugLog('7. FP salvo no hidden');

                statusEl.style.display = 'none';
                successEl.style.display = 'block';
                document.getElementById('fingerprintDisplay').textContent =
                    'ID: ' + fingerprint.substring(0, 8) + '...' + fingerprint.substring(fingerprint.length - 8);

                debugLog('8. Fingerprint salvo!');
                debugLog('=== PRONTO ===');

                setTimeout(() => {
                    successEl.style.display = 'none';
                }, 5000);

            } catch (error) {
                debugLog('ERRO: ' + error.message, true);
                debugLog('Tipo: ' + error.name, true);
                statusEl.style.display = 'none';

                const fallbackFingerprint = 'manual-' + Date.now() + '-' + Math.random().toString(36).substring(2, 15);
                document.getElementById('deviceFingerprint').value = fallbackFingerprint;

                debugLog('Usando FP emergência', true);
                debugLog('FP: ' + fallbackFingerprint);
            }

            const phoneInput = document.getElementById('phone');
            phoneInput.addEventListener('input', function(e) {
                let value = e.target.value.replace(/\D/g, '');

                if (value.length > 11) {
                    value = value.substring(0, 11);
                }

                e.target.value = value;
            });

            const form = document.getElementById('verifyForm');
            const submitBtn = document.getElementById('submitBtn');

            form.addEventListener('submit', function(e) {
                const fingerprintValue = document.getElementById('deviceFingerprint').value;

                if (!fingerprintValue) {
                    const emergencyFP = 'submit-' + Date.now();
                    document.getElementById('deviceFingerprint').value = emergencyFP;
                }

                submitBtn.disabled = true;
                submitBtn.classList.add('loading');
            });
        });
    </script>
</body>
</html>



