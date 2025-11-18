@extends('layouts.app')
@section('title', 'Editar Conexão')
@section('connect', 'active')

@section('headlocal') @includeIf('pclient.connect.jscss.css') @endsection
@section('jslocal') @includeIf('pclient.connect.jscss.javascript') @endsection

@section('content')
<div class="d-flex flex-column flex-column-fluid">
    <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
        <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Editar Conexão</h1>
                <span class="text-muted">Configurações da Instância</span>
            </div>
            <div class="d-flex align-items-center gap-2">
                <a href="{{ route('connect.index') }}" class="btn btn-light">
                    <i class="ki-duotone ki-arrow-left fs-2"></i>
                    Voltar
                </a>
            </div>
        </div>
    </div>
    
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-xxl">
            <div class="row g-6">
                <!-- Instance Data -->
                <div class="col-8">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Dados da Instância</h3>
                            <div class="card-toolbar">
                                <span class="badge badge-light-success me-2">Conectado</span>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="instanceStatus" />
                                    <label class="form-check-label" for="instanceStatus"></label>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <!-- KPIs -->
                            <div class="row g-4 mb-6">
                                <div class="col-4">
                                    <div class="border border-gray-300 border-dashed rounded p-4 text-center">
                                        <div class="d-flex flex-column align-items-center">
                                            <i class="ki-duotone ki-people text-pink kpi-icon">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                                <span class="path3"></span>
                                                <span class="path4"></span>
                                                <span class="path5"></span>
                                            </i>
                                            <div class="fs-2 fw-bold text-gray-800">790</div>
                                        </div>
                                        <div class="fw-semibold fs-6 text-muted-dark">Contatos</div>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="border border-gray-300 border-dashed rounded p-4 text-center">
                                        <div class="d-flex flex-column align-items-center">
                                            <i class="ki-duotone ki-message-text-2 text-pink kpi-icon">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                                <span class="path3"></span>
                                                <span class="path4"></span>
                                            </i>
                                            <div class="fs-2 fw-bold text-gray-800">55</div>
                                        </div>
                                        <div class="fw-semibold fs-6 text-muted-dark">Chats</div>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="border border-gray-300 border-dashed rounded p-4 text-center">
                                        <div class="d-flex flex-column align-items-center">
                                            <i class="ki-duotone ki-sms text-pink kpi-icon">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                            </i>
                                            <div class="fs-2 fw-bold text-gray-800">2595</div>
                                        </div>
                                        <div class="fw-semibold fs-6 text-muted-dark">Mensagens</div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Instance Details -->
                            <div class="row g-4">
                                <div class="col-6">
                                    <label class="form-label fw-semibold">Nome da Instância</label>
                                    <input type="text" class="form-control" value="tbottestes" />
                                </div>
                                <div class="col-6">
                                    <label class="form-label fw-semibold">Telefone</label>
                                    <input type="text" class="form-control" value="(21) 46782-0484" />
                                </div>
                                <div class="col-12">
                                    <label class="form-label fw-semibold">Token</label>
                                    <input type="text" class="form-control" value="C8A471E2-5C70-4172-8DC0-B6027B692CF9" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Preferences -->
                <div class="col-4">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Preferências</h3>
                            <div class="card-toolbar">
                                <button type="button" class="btn btn-md" style="background-color: #E71D73; border-color: #E71D73; color: white;">Salvar</button>
                            </div>
                        </div>
                        <div class="card-body h-100">
                            <div class="d-flex flex-column gap-6">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div class="d-flex align-items-center">
                                        <span class="fw-semibold me-2">Rejeitar Chamadas</span>
                                        <i class="ki-duotone ki-information-5 fs-6 text-muted" data-bs-toggle="tooltip" title="Rejeita automaticamente chamadas recebidas"></i>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" />
                                    </div>
                                </div>
                                <div class="d-flex align-items-center justify-content-between">
                                    <div class="d-flex align-items-center">
                                        <span class="fw-semibold me-2">Ignorar Grupos</span>
                                        <i class="ki-duotone ki-information-5 fs-6 text-muted" data-bs-toggle="tooltip" title="Ignora mensagens de grupos"></i>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" />
                                    </div>
                                </div>
                                <div class="d-flex align-items-center justify-content-between">
                                    <div class="d-flex align-items-center">
                                        <span class="fw-semibold me-2">Sempre Online</span>
                                        <i class="ki-duotone ki-information-5 fs-6 text-muted" data-bs-toggle="tooltip" title="Mantém a instância sempre online"></i>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" />
                                    </div>
                                </div>
                                <div class="d-flex align-items-center justify-content-between">
                                    <div class="d-flex align-items-center">
                                        <span class="fw-semibold me-2">Ler Mensagens</span>
                                        <i class="ki-duotone ki-information-5 fs-6 text-muted" data-bs-toggle="tooltip" title="Marca mensagens como lidas automaticamente"></i>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" />
                                    </div>
                                </div>
                                <div class="d-flex align-items-center justify-content-between">
                                    <div class="d-flex align-items-center">
                                        <span class="fw-semibold me-2">Sincronizar Histórico</span>
                                        <i class="ki-duotone ki-information-5 fs-6 text-muted" data-bs-toggle="tooltip" title="Sincroniza histórico de mensagens"></i>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" />
                                    </div>
                                </div>
                                <div class="d-flex align-items-center justify-content-between">
                                    <div class="d-flex align-items-center">
                                        <span class="fw-semibold me-2">Ler Status</span>
                                        <i class="ki-duotone ki-information-5 fs-6 text-muted" data-bs-toggle="tooltip" title="Lê status de mensagens"></i>
                                    </div>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Actions -->
            <div class="row mt-6">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6 border-end">
                                    <div class="px-4 py-2">
                                        <p class="mb-6 fs-4">Sincronize as informações da instância</p>
                                        <button type="button" class="btn" style="background-color: #E71D73; border-color: #E71D73; color: white;">
                                            <i class="ki-duotone ki-arrows-loop fs-1 me-2" style="color: white;">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                            </i>
                                            Atualizar
                                        </button>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="px-4 py-2">
                                        <p class="mb-6 fs-4">Clique para eliminar esta instância permanentemente.</p>
                                        <button type="button" class="btn" style="background-color: #feeaf1; border-color: #feeaf1; color: #e71d73;">
                                            <i class="ki-duotone ki-trash fs-1 me-2" style="color: #e71d73;">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                                <span class="path3"></span>
                                                <span class="path4"></span>
                                                <span class="path5"></span>
                                            </i>
                                            Deletar
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.form-switch .form-check-input {
    height: 21px !important;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const statusSwitch = document.getElementById('instanceStatus');
    const statusBadge = statusSwitch.closest('.card-toolbar').querySelector('.badge');
    
    statusSwitch.addEventListener('change', function() {
        if (this.checked) {
            statusBadge.textContent = 'Desconectado';
            statusBadge.className = 'badge badge-light-danger me-2';
        } else {
            statusBadge.textContent = 'Conectado';
            statusBadge.className = 'badge badge-light-success me-2';
        }
    });
});
</script>
@endsection
