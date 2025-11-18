@extends('layouts.app')
@section('title', 'Segurança WhatsApp')
@section('profile', 'active')

@section('content')
<div class="d-flex flex-column flex-column-fluid">
    <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
        <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
                    Segurança WhatsApp
                </h1>
                <span class="text-muted">Gerencie a segurança da sua conta WhatsApp</span>
            </div>
            <div class="d-flex align-items-center gap-2 gap-lg-3">
                <a href="{{ route('profile.index') }}" class="btn btn-sm btn-light">
                    <i class="fas fa-arrow-left me-1"></i>Voltar ao Perfil
                </a>
            </div>
        </div>
    </div>

    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div class="app-container container-fluid">
            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            @endif

            @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            @endif

            <div class="row g-5 g-xl-8">
                <div class="col-xl-6">
                    <div class="card card-flush h-100">
                        <div class="card-header">
                            <h3 class="card-title">Status da Verificação</h3>
                        </div>
                        <div class="card-body">
                            @if($user->isWhatsAppVerified())
                            <div class="d-flex align-items-center mb-5">
                                <div class="symbol symbol-50px me-3">
                                    <span class="symbol-label bg-light-success">
                                        <i class="fas fa-check-circle text-success fs-2x"></i>
                                    </span>
                                </div>
                                <div class="flex-grow-1">
                                    <div class="text-dark fw-bold fs-5">WhatsApp Verificado</div>
                                    <div class="text-muted fs-7">
                                        Verificado em {{ $user->whatsapp_verified_at->format('d/m/Y H:i') }}
                                    </div>
                                </div>
                            </div>

                            <div class="separator my-5"></div>

                            <div class="mb-5">
                                <label class="form-label fw-bold">Telefone WhatsApp Vinculado</label>
                                <div class="fs-6">{{ $user->whatsapp_phone }}</div>
                            </div>

                            <div class="mb-5">
                                <label class="form-label fw-bold">Dispositivo Autorizado</label>
                                <div class="fs-6 font-monospace">
                                    {{ substr($user->device_fingerprint, 0, 8) }}...{{ substr($user->device_fingerprint, -8) }}
                                </div>
                            </div>

                            <div class="mb-5">
                                <label class="form-label fw-bold">Múltiplos Dispositivos</label>
                                <div class="form-check form-switch">
                                    <input
                                        class="form-check-input"
                                        type="checkbox"
                                        id="allowMultipleDevices"
                                        {{ $user->allow_multiple_devices ? 'checked' : '' }}
                                        onchange="toggleMultipleDevices(this.checked)"
                                    >
                                    <label class="form-check-label" for="allowMultipleDevices">
                                        {{ $user->allow_multiple_devices ? 'Ativado' : 'Desativado' }}
                                    </label>
                                </div>
                                <small class="text-muted">
                                    Quando ativado, permite acesso de qualquer dispositivo após verificação do telefone.
                                </small>
                            </div>

                            @else
                            <div class="d-flex align-items-center mb-5">
                                <div class="symbol symbol-50px me-3">
                                    <span class="symbol-label bg-light-warning">
                                        <i class="fas fa-exclamation-triangle text-warning fs-2x"></i>
                                    </span>
                                </div>
                                <div class="flex-grow-1">
                                    <div class="text-dark fw-bold fs-5">WhatsApp Não Verificado</div>
                                    <div class="text-muted fs-7">
                                        Acesse o sistema via WhatsApp para verificar seu telefone
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="col-xl-6">
                    <div class="card card-flush h-100">
                        <div class="card-header">
                            <h3 class="card-title">Ações de Segurança</h3>
                        </div>
                        <div class="card-body">
                            @if($user->isWhatsAppVerified())
                            <div class="alert alert-info d-flex align-items-center mb-5">
                                <i class="fas fa-info-circle me-3 fs-2x"></i>
                                <div>
                                    <strong>Proteção Ativa</strong>
                                    <p class="mb-0 mt-1">
                                        Seu acesso via WhatsApp está protegido. Apenas você pode acessar com o telefone e dispositivo verificados.
                                    </p>
                                </div>
                            </div>

                            <div class="d-grid gap-3">
                                <button
                                    type="button"
                                    class="btn btn-warning"
                                    data-bs-toggle="modal"
                                    data-bs-target="#resetModal"
                                >
                                    <i class="fas fa-sync-alt me-2"></i>Resetar Validação WhatsApp
                                </button>

                                <button
                                    type="button"
                                    class="btn btn-primary"
                                    onclick="authorizeCurrentDevice()"
                                >
                                    <i class="fas fa-mobile-alt me-2"></i>Autorizar Este Dispositivo
                                </button>
                            </div>

                            <div class="separator my-5"></div>

                            <div class="alert alert-warning">
                                <h5 class="alert-heading">
                                    <i class="fas fa-exclamation-triangle me-2"></i>Atenção
                                </h5>
                                <p class="mb-0">
                                    Ao resetar a validação, você precisará verificar seu telefone novamente no próximo acesso via WhatsApp.
                                </p>
                            </div>

                            @else
                            <div class="alert alert-primary">
                                <h5 class="alert-heading">
                                    <i class="fas fa-info-circle me-2"></i>Como Verificar
                                </h5>
                                <ol class="mb-0 ps-3">
                                    <li>Entre em contato com o suporte ou acesse o link de verificação</li>
                                    <li>Confirme seu número de telefone</li>
                                    <li>Seu dispositivo será automaticamente autorizado</li>
                                </ol>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@if($user->isWhatsAppVerified())
@include('pclient.profile.partials.reset-whatsapp-modal')
@endif

<script src="{{ asset('assets/js/device-fingerprint.js') }}"></script>
<script>
function toggleMultipleDevices(allow) {
    fetch('{{ route('profile.whatsapp-security.toggle-multiple-devices') }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({
            allow_multiple_devices: allow
        })
    })
    .then(response => response.json())
    .then(data => {
        location.reload();
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Erro ao atualizar configuração');
    });
}

async function authorizeCurrentDevice() {
    const password = prompt('Digite sua senha para autorizar este dispositivo:');

    if (!password) return;

    const fingerprint = await generateDeviceFingerprint();

    fetch('{{ route('profile.whatsapp-security.authorize-device') }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({
            current_password: password,
            device_fingerprint: fingerprint
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.errors) {
            alert(data.errors.current_password ? data.errors.current_password[0] : 'Erro ao autorizar dispositivo');
        } else {
            alert('Dispositivo autorizado com sucesso!');
            location.reload();
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Erro ao autorizar dispositivo');
    });
}
</script>
@endsection

