@extends('layouts.app')
@section('title', 'Suporte')
@section('support', 'active')

@section('headlocal') @includeIf('pclient.support.jscss.css') @endsection
@section('jslocal') @includeIf('pclient.support.jscss.javascript') @endsection

@section('content')
<div class="d-flex flex-column flex-column-fluid">
    <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
        <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Central de Suporte</h1>
                <span class="text-muted">Wiki e Documentação do Sistema</span>
            </div>
        </div>
    </div>

    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-xxl">

            <div class="row g-5 g-xl-10 mb-5 mb-xl-10">
                <div class="col-md-12">
                    <div class="card card-flush search-card">
                        <div class="card-header pt-5">
                            <div class="card-title">
                                <h3 class="fw-bold text-gray-800">Pesquisar</h3>
                                <span class="text-gray-400 pt-1 fw-semibold fs-6">Encontre rapidamente o que você precisa</span>
                            </div>
                        </div>
                        <div class="card-body pt-2 pb-4">
                            <div class="search-input-wrapper position-relative">
                                <input type="text" id="searchInput" class="form-control form-control-lg ps-12" placeholder="Digite sua dúvida ou palavra-chave...">
                                <i class="ki-duotone ki-magnifier fs-3 position-absolute top-50 start-0 translate-middle-y ms-4">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row g-5 g-xl-10">
                <div class="col-xl-3">
                    <div class="card card-flush category-card">
                        <div class="card-header pt-5">
                            <div class="card-title">
                                <h3 class="fw-bold text-gray-800">Categorias</h3>
                            </div>
                        </div>
                        <div class="card-body pt-2 pb-4">
                            <div class="nav flex-column nav-pills nav-pills-custom" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                <button class="nav-link active mb-2" id="v-pills-getting-started-tab" data-bs-toggle="pill" data-bs-target="#v-pills-getting-started" type="button" role="tab">
                                    <span class="nav-link-icon-wrapper">
                                        <i class="ki-duotone ki-rocket fs-2">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                        </i>
                                    </span>
                                    <span class="nav-link-title">Primeiros Passos</span>
                                </button>

                                <button class="nav-link mb-2" id="v-pills-leads-tab" data-bs-toggle="pill" data-bs-target="#v-pills-leads" type="button" role="tab">
                                    <span class="nav-link-icon-wrapper">
                                        <i class="ki-duotone ki-profile-user fs-2">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                        </i>
                                    </span>
                                    <span class="nav-link-title">Gestão de Leads</span>
                                </button>

                                <button class="nav-link mb-2" id="v-pills-marketplace-tab" data-bs-toggle="pill" data-bs-target="#v-pills-marketplace" type="button" role="tab">
                                    <span class="nav-link-icon-wrapper">
                                        <i class="ki-duotone ki-shop fs-2">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                        </i>
                                    </span>
                                    <span class="nav-link-title">Marketplace</span>
                                </button>

                                <button class="nav-link mb-2" id="v-pills-payments-tab" data-bs-toggle="pill" data-bs-target="#v-pills-payments" type="button" role="tab">
                                    <span class="nav-link-icon-wrapper">
                                        <i class="ki-duotone ki-dollar fs-2">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                        </i>
                                    </span>
                                    <span class="nav-link-title">Pagamentos</span>
                                </button>

                                <button class="nav-link mb-2" id="v-pills-automation-tab" data-bs-toggle="pill" data-bs-target="#v-pills-automation" type="button" role="tab">
                                    <span class="nav-link-icon-wrapper">
                                        <i class="ki-duotone ki-abstract-26 fs-2">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                        </i>
                                    </span>
                                    <span class="nav-link-title">Automação</span>
                                </button>

                                <button class="nav-link mb-2" id="v-pills-api-tab" data-bs-toggle="pill" data-bs-target="#v-pills-api" type="button" role="tab">
                                    <span class="nav-link-icon-wrapper">
                                        <i class="ki-duotone ki-code fs-2">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                        </i>
                                    </span>
                                    <span class="nav-link-title">API & Integrações</span>
                                </button>

                                <button class="nav-link mb-2" id="v-pills-troubleshooting-tab" data-bs-toggle="pill" data-bs-target="#v-pills-troubleshooting" type="button" role="tab">
                                    <span class="nav-link-icon-wrapper">
                                        <i class="ki-duotone ki-shield-tick fs-2">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                        </i>
                                    </span>
                                    <span class="nav-link-title">Solução de Problemas</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-9">
                    <div class="tab-content" id="v-pills-tabContent">
                        <div class="tab-pane fade show active" id="v-pills-getting-started" role="tabpanel">
                            <div class="card card-flush content-card">
                                <div class="card-header pt-5">
                                    <div class="card-title">
                                        <h3 class="fw-bold text-gray-800">Primeiros Passos</h3>
                                        <span class="text-gray-400 pt-1 fw-semibold fs-6">Comece a usar o sistema SecretárIA do Corretor</span>
                                    </div>
                                </div>
                                <div class="card-body pt-2 pb-4">
                                    <div class="accordion" id="accordionGettingStarted">
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="headingGettingStarted1">
                                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseGettingStarted1">
                                                    Como criar minha conta?
                                                </button>
                                            </h2>
                                            <div id="collapseGettingStarted1" class="accordion-collapse collapse show" data-bs-parent="#accordionGettingStarted">
                                                <div class="accordion-body">
                                                    <p><strong>O sistema SecretárIA do Corretor</strong> é uma plataforma completa para gestão e comercialização de leads no setor de seguros e saúde. Para começar a usar todas as funcionalidades, siga este guia detalhado:</p>

                                                    <h6 class="mt-4 mb-3 text-primary"><i class="ki-duotone ki-user fs-3 me-2"><span class="path1"></span><span class="path2"></span></i>Passo a Passo para Criar sua Conta</h6>

                                                    <div class="row g-4">
                                                        <div class="col-12">
                                                            <div class="d-flex align-items-start mb-3">
                                                                <span class="badge badge-circle badge-primary me-3 mt-1">1</span>
                                                                <div>
                                                                    <h6 class="mb-2">Acesse a Página de Cadastro</h6>
                                                                    <p class="mb-2">Visite <code>www.secretariadocorretor.com.br/cadastro</code> e clique em "Criar Conta". Você será direcionado para o formulário de registro seguro.</p>
                                                                    <div class="alert py-2" style="background: linear-gradient(135deg, rgba(0, 201, 167, 0.1) 0%, rgba(0, 160, 133, 0.1) 100%); border: 2px solid #00c9a7;">
                                                                        <i class="ki-duotone ki-information-5 fs-2 me-2 text-info"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i>
                                                                        <strong class="text-info">Dica:</strong> Tenha em mãos seus documentos (CPF/CNPJ) e um email ativo.
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-12">
                                                            <div class="d-flex align-items-start mb-3">
                                                                <span class="badge badge-circle badge-primary me-3 mt-1">2</span>
                                                                <div>
                                                                    <h6 class="mb-2">Preencha seus Dados Pessoais</h6>
                                                                    <p class="mb-2">Complete todas as informações obrigatórias:</p>
                                                                    <ul class="list-unstyled ms-3">
                                                                        <li><i class="ki-duotone ki-check text-success me-2 fs-6"></i><strong>Dados Básicos:</strong> Nome completo, email, telefone</li>
                                                                        <li><i class="ki-duotone ki-check text-success me-2 fs-6"></i><strong>Documentação:</strong> CPF ou CNPJ válido</li>
                                                                        <li><i class="ki-duotone ki-check text-success me-2 fs-6"></i><strong>Endereço:</strong> CEP, estado, cidade e endereço completo</li>
                                                                        <li><i class="ki-duotone ki-check text-success me-2 fs-6"></i><strong>Segurança:</strong> Senha forte com pelo menos 8 caracteres</li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-12">
                                                            <div class="d-flex align-items-start mb-3">
                                                                <span class="badge badge-circle badge-primary me-3 mt-1">3</span>
                                                                <div>
                                                                    <h6 class="mb-2">Escolha seu Tipo de Usuário</h6>
                                                                    <div class="row g-3">
                                                                        <div class="col-md-6">
                                                                            <div class="card" style="border: 2px solid #e71d73;">
                                                                                <div class="card-body py-3">
                                                                                    <h6 class="text-primary mb-2"><i class="ki-duotone ki-profile-user me-2 fs-4"></i>Broker (Corretor)</h6>
                                                                                    <p class="fs-7 mb-0">Para corretores que compram leads para revenda e conversão em vendas de seguros.</p>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <div class="card" style="border: 2px solid #00c9a7;">
                                                                                <div class="card-body py-3">
                                                                                    <h6 class="text-success mb-2"><i class="ki-duotone ki-shop me-2 fs-2"></i>Supplier (Fornecedor)</h6>
                                                                                    <p class="fs-7 mb-0">Para empresas que vendem leads qualificados no marketplace.</p>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-12">
                                                            <div class="d-flex align-items-start mb-3">
                                                                <span class="badge badge-circle badge-primary me-3 mt-1">4</span>
                                                                <div>
                                                                    <h6 class="mb-2">Confirme seu Email</h6>
                                                                    <p class="mb-2">Após enviar o formulário, você receberá um email de confirmação em até 5 minutos. Clique no link para ativar sua conta.</p>
                                                                    <div class="alert py-2" style="background: linear-gradient(135deg, rgba(255, 184, 34, 0.1) 0%, rgba(247, 147, 30, 0.1) 100%); border: 2px solid #ffb822;">
                                                                        <i class="ki-duotone ki-warning fs-2 me-2 text-warning"><span class="path1"></span><span class="path2"></span></i>
                                                                        <strong class="text-warning">Importante:</strong> Verifique sua caixa de spam se não receber o email.
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-12">
                                                            <div class="d-flex align-items-start mb-3">
                                                                <span class="badge badge-circle badge-primary me-3 mt-1">5</span>
                                                                <div>
                                                                    <h6 class="mb-2">Complete seu Perfil</h6>
                                                                    <p class="mb-2">Após a confirmação do email, faça login e complete as informações adicionais:</p>
                                                                    <ul class="list-unstyled ms-3">
                                                                        <li><i class="ki-duotone ki-check text-success me-2 fs-6"></i>Upload da foto de perfil</li>
                                                                        <li><i class="ki-duotone ki-check text-success me-2 fs-6"></i>Dados bancários (para recebimentos)</li>
                                                                        <li><i class="ki-duotone ki-check text-success me-2 fs-6"></i>Certificações e licenças (se aplicável)</li>
                                                                        <li><i class="ki-duotone ki-check text-success me-2 fs-6"></i>Configurações de notificação</li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="alert mt-4" style="background: linear-gradient(135deg, rgba(0, 201, 167, 0.1) 0%, rgba(0, 160, 133, 0.1) 100%); border: 2px solid #00c9a7;">
                                                        <h6 class="alert-heading text-success"><i class="ki-duotone ki-check-circle fs-2 me-2"></i>Pronto!</h6>
                                                        <p class="mb-0">Sua conta está criada e você pode começar a usar todas as funcionalidades do SecretárIA do Corretor. Explore o dashboard e configure suas preferências.</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="headingGettingStarted2">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseGettingStarted2">
                                                    Como navegar pelo sistema?
                                                </button>
                                            </h2>
                                            <div id="collapseGettingStarted2" class="accordion-collapse collapse" data-bs-parent="#accordionGettingStarted">
                                                <div class="accordion-body">
                                                    <p>O <strong>SecretárIA do Corretor</strong> foi projetado com uma interface intuitiva e moderna para maximizar sua produtividade. Aqui está um guia completo da navegação:</p>

                                                    <h6 class="mt-4 mb-3 text-primary"><i class="ki-duotone ki-element-11 fs-3 me-2"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span></i>Estrutura Principal da Interface</h6>

                                                    <div class="row g-4">
                                                        <div class="col-md-6">
                                                            <div class="card border border-light-primary bg-light-primary">
                                                                <div class="card-body p-4">
                                                                    <h6 class="text-primary mb-3"><i class="ki-duotone ki-category fs-2 me-2"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span></i>Sidebar Principal</h6>
                                                                    <p class="mb-3">Menu de navegação sempre visível no lado esquerdo da tela com acesso a todas as funcionalidades:</p>
                                                                    <ul class="list-unstyled">
                                                                        <li class="mb-2"><i class="ki-duotone ki-home text-primary me-2 fs-6"></i><strong>Início:</strong> Dashboard principal</li>
                                                                        <li class="mb-2"><i class="ki-duotone ki-chart-simple text-primary me-2 fs-6"></i><strong>Dashboard:</strong> Métricas e visão geral</li>
                                                                        <li class="mb-2"><i class="ki-duotone ki-profile-user text-primary me-2 fs-6"></i><strong>Conexões:</strong> Rede de contatos</li>
                                                                        <li class="mb-2"><i class="ki-duotone ki-calendar text-primary me-2 fs-6"></i><strong>Agenda:</strong> Compromissos e tarefas</li>
                                                                        <li class="mb-2"><i class="ki-duotone ki-abstract-26 text-primary me-2 fs-6"></i><strong>Funil de Vendas:</strong> Pipeline completo</li>
                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="card border border-light-success bg-light-success">
                                                                <div class="card-body p-4">
                                                                    <h6 class="text-success mb-3"><i class="ki-duotone ki-chart-line-up fs-2 me-2"><span class="path1"></span><span class="path2"></span></i>Dashboard Inteligente</h6>
                                                                    <p class="mb-3">Central de controle com informações em tempo real:</p>
                                                                    <ul class="list-unstyled">
                                                                        <li class="mb-2"><i class="ki-duotone ki-abstract-25 text-success me-2 fs-6"></i><strong>KPIs:</strong> Métricas de performance</li>
                                                                        <li class="mb-2"><i class="ki-duotone ki-chart-pie-simple text-success me-2 fs-6"></i><strong>Gráficos:</strong> Análises visuais</li>
                                                                        <li class="mb-2"><i class="ki-duotone ki-notification-bing text-success me-2 fs-6"></i><strong>Alertas:</strong> Notificações importantes</li>
                                                                        <li class="mb-2"><i class="ki-duotone ki-timer text-success me-2 fs-6"></i><strong>Atividades:</strong> Ações recentes</li>
                                                                        <li class="mb-2"><i class="ki-duotone ki-goal text-success me-2 fs-6"></i><strong>Metas:</strong> Objetivos e progresso</li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="card border border-light-warning bg-light-warning">
                                                                <div class="card-body p-4">
                                                                    <h6 class="text-warning mb-3"><i class="ki-duotone ki-shop fs-2 me-2"><span class="path1"></span><span class="path2"></span></i>Marketplace</h6>
                                                                    <p class="mb-3">Centro de compra e venda de leads com ferramentas avançadas:</p>
                                                                    <ul class="list-unstyled">
                                                                        <li class="mb-2"><i class="ki-duotone ki-magnifier text-warning me-2 fs-6"></i><strong>Busca Avançada:</strong> Filtros personalizáveis</li>
                                                                        <li class="mb-2"><i class="ki-duotone ki-basket text-warning me-2 fs-6"></i><strong>Carrinho:</strong> Compras em lote</li>
                                                                        <li class="mb-2"><i class="ki-duotone ki-price-tag text-warning me-2 fs-6"></i><strong>Precificação:</strong> Estratégias dinâmicas</li>
                                                                        <li class="mb-2"><i class="ki-duotone ki-star text-warning me-2 fs-6"></i><strong>Avaliações:</strong> Sistema de qualidade</li>
                                                                        <li class="mb-2"><i class="ki-duotone ki-courier text-warning me-2 fs-6"></i><strong>Entregas:</strong> Gestão automática</li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="card border border-light-info bg-light-info">
                                                                <div class="card-body p-4">
                                                                    <h6 class="text-info mb-3"><i class="ki-duotone ki-setting-2 fs-2 me-2"><span class="path1"></span><span class="path2"></span></i>Gestão Avançada</h6>
                                                                    <p class="mb-3">Ferramentas completas para administração:</p>
                                                                    <ul class="list-unstyled">
                                                                        <li class="mb-2"><i class="ki-duotone ki-profile-circle text-info me-2 fs-6"></i><strong>Leads:</strong> Gestão completa do ciclo</li>
                                                                        <li class="mb-2"><i class="ki-duotone ki-message-text-2 text-info me-2 fs-6"></i><strong>Interações:</strong> Histórico detalhado</li>
                                                                        <li class="mb-2"><i class="ki-duotone ki-document text-info me-2 fs-6"></i><strong>Relatórios:</strong> Análises profundas</li>
                                                                        <li class="mb-2"><i class="ki-duotone ki-security-user text-info me-2 fs-6"></i><strong>Equipes:</strong> Controle de acesso</li>
                                                                        <li class="mb-2"><i class="ki-duotone ki-archive text-info me-2 fs-6"></i><strong>Backup:</strong> Segurança dos dados</li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <h6 class="mt-5 mb-3 text-primary"><i class="ki-duotone ki-rocket fs-3 me-2"><span class="path1"></span><span class="path2"></span></i>Dicas de Navegação Eficiente</h6>

                                                    <div class="row g-3">
                                                        <div class="col-md-4">
                                                            <div class="d-flex align-items-center p-3 bg-light rounded">
                                                                <i class="ki-duotone ki-keyboard fs-2x text-primary me-3"><span class="path1"></span><span class="path2"></span></i>
                                                                <div>
                                                                    <h6 class="mb-1">Atalhos de Teclado</h6>
                                                                    <p class="fs-7 mb-0">Use Ctrl+K para busca rápida</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="d-flex align-items-center p-3 bg-light rounded">
                                                                <i class="ki-duotone ki-bookmark fs-2x text-success me-3"><span class="path1"></span><span class="path2"></span></i>
                                                                <div>
                                                                    <h6 class="mb-1">Favoritos</h6>
                                                                    <p class="fs-7 mb-0">Salve páginas mais acessadas</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="d-flex align-items-center p-3 bg-light rounded">
                                                                <i class="ki-duotone ki-notification-bing fs-2x text-warning me-3"><span class="path1"></span><span class="path2"></span></i>
                                                                <div>
                                                                    <h6 class="mb-1">Notificações</h6>
                                                                    <p class="fs-7 mb-0">Configure alertas personalizados</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="alert mt-4" style="background: linear-gradient(135deg, rgba(231, 29, 115, 0.1) 0%, rgba(161, 23, 83, 0.1) 100%); border: 2px solid #e71d73;">
                                                        <h6 class="alert-heading text-primary"><i class="ki-duotone ki-bulb fs-2 me-2"></i>Dica Pro</h6>
                                                        <p class="mb-0">Use o modo "Foco" (ícone de tela cheia) para maximizar sua área de trabalho quando precisar de mais concentração em tarefas específicas.</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="headingGettingStarted3">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseGettingStarted3">
                                                    Quais são os tipos de usuário?
                                                </button>
                                            </h2>
                                            <div id="collapseGettingStarted3" class="accordion-collapse collapse" data-bs-parent="#accordionGettingStarted">
                                                <div class="accordion-body">
                                                    <p>O <strong>SecretárIA do Corretor</strong> trabalha com diferentes perfis de usuários, cada um com permissões e funcionalidades específicas. Compreender essas diferenças é fundamental para aproveitar ao máximo a plataforma:</p>

                                                    <h6 class="mt-4 mb-3 text-primary"><i class="ki-duotone ki-people fs-3 me-2"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span></i>Tipos de Usuário no Sistema</h6>

                                                    <div class="row g-4">
                                                        <div class="col-lg-6">
                                                            <div class="card" style="border: 2px solid #e71d73;">
                                                                <div class="card-header" style="background: linear-gradient(135deg, #e71d73 0%, #a11753 100%);">
                                                                    <h5 class="card-title text-white mb-0">
                                                                        <i class="ki-duotone ki-profile-user fs-2 me-2"><span class="path1"></span><span class="path2"></span></i>
                                                                        Broker (Corretor)
                                                                    </h5>
                                                                </div>
                                                                <div class="card-body">
                                                                    <p class="mb-3"><strong>Perfil:</strong> Profissionais que compram leads qualificados para conversão em vendas de seguros e planos de saúde.</p>

                                                                    <h6 class="text-primary mb-2">Funcionalidades Exclusivas:</h6>
                                                                    <ul class="list-unstyled mb-4">
                                                                        <li class="mb-2"><i class="ki-duotone ki-check-circle text-success me-2 fs-6"></i><strong>Marketplace Buyer:</strong> Acesso total para compras</li>
                                                                        <li class="mb-2"><i class="ki-duotone ki-check-circle text-success me-2 fs-6"></i><strong>CRM Integrado:</strong> Gestão de leads adquiridos</li>
                                                                        <li class="mb-2"><i class="ki-duotone ki-check-circle text-success me-2 fs-6"></i><strong>Funil de Vendas:</strong> Pipeline completo</li>
                                                                        <li class="mb-2"><i class="ki-duotone ki-check-circle text-success me-2 fs-6"></i><strong>Analytics de ROI:</strong> Retorno sobre investimento</li>
                                                                        <li class="mb-2"><i class="ki-duotone ki-check-circle text-success me-2 fs-6"></i><strong>Automação:</strong> Follow-up automático</li>
                                                    </ul>

                                                                    <h6 class="text-primary mb-2">Métricas Principais:</h6>
                                                                    <div class="row g-2">
                                                                        <div class="col-6">
                                                                            <div class="bg-light p-2 rounded text-center">
                                                                                <small class="text-muted">Taxa de Conversão</small>
                                                                                <div class="fw-bold text-primary">15-25%</div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-6">
                                                                            <div class="bg-light p-2 rounded text-center">
                                                                                <small class="text-muted">ROI Médio</small>
                                                                                <div class="fw-bold text-success">300-500%</div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-6">
                                                            <div class="card" style="border: 2px solid #00c9a7;">
                                                                <div class="card-header" style="background: linear-gradient(135deg, #00c9a7 0%, #00a085 100%);">
                                                                    <h5 class="card-title text-white mb-0">
                                                                        <i class="ki-duotone ki-shop fs-2 me-2"><span class="path1"></span><span class="path2"></span></i>
                                                                        Supplier (Fornecedor)
                                                                    </h5>
                                                                </div>
                                                                <div class="card-body">
                                                                    <p class="mb-3"><strong>Perfil:</strong> Empresas especializadas em geração e qualificação de leads para venda no marketplace.</p>

                                                                    <h6 class="text-success mb-2">Funcionalidades Exclusivas:</h6>
                                                                    <ul class="list-unstyled mb-4">
                                                                        <li class="mb-2"><i class="ki-duotone ki-check-circle text-success me-2 fs-6"></i><strong>Lead Builder:</strong> Criação e qualificação</li>
                                                                        <li class="mb-2"><i class="ki-duotone ki-check-circle text-success me-2 fs-6"></i><strong>Pricing Engine:</strong> Estratégias de preço</li>
                                                                        <li class="mb-2"><i class="ki-duotone ki-check-circle text-success me-2 fs-6"></i><strong>Quality Control:</strong> Validação automática</li>
                                                                        <li class="mb-2"><i class="ki-duotone ki-check-circle text-success me-2 fs-6"></i><strong>Multi-Channel:</strong> Múltiplas fontes</li>
                                                                        <li class="mb-2"><i class="ki-duotone ki-check-circle text-success me-2 fs-6"></i><strong>Revenue Analytics:</strong> Receita detalhada</li>
                                                                    </ul>

                                                                    <h6 class="text-success mb-2">Métricas Principais:</h6>
                                                                    <div class="row g-2">
                                                                        <div class="col-6">
                                                                            <div class="bg-light p-2 rounded text-center">
                                                                                <small class="text-muted">Qualidade Média</small>
                                                                                <div class="fw-bold text-success">85-95%</div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-6">
                                                                            <div class="bg-light p-2 rounded text-center">
                                                                                <small class="text-muted">Tempo de Venda</small>
                                                                                <div class="fw-bold text-primary">< 24h</div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <h6 class="mt-5 mb-3 text-primary"><i class="ki-duotone ki-security-user fs-3 me-2"><span class="path1"></span><span class="path2"></span></i>Roles e Permissões Detalhadas</h6>

                                                    <div class="table-responsive">
                                                        <table class="table table-rounded table-striped border">
                                                            <thead class="bg-light">
                                                                <tr>
                                                                    <th>Funcionalidade</th>
                                                                    <th class="text-center">Broker</th>
                                                                    <th class="text-center">Supplier</th>
                                                                    <th class="text-center">Admin</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td><i class="ki-duotone ki-basket me-2 text-warning"></i>Comprar Leads</td>
                                                                    <td class="text-center"><i class="ki-duotone ki-check text-success fs-4"></i></td>
                                                                    <td class="text-center"><i class="ki-duotone ki-cross text-danger fs-4"></i></td>
                                                                    <td class="text-center"><i class="ki-duotone ki-check text-success fs-4"></i></td>
                                                                </tr>
                                                                <tr>
                                                                    <td><i class="ki-duotone ki-shop me-2 text-primary"></i>Vender Leads</td>
                                                                    <td class="text-center"><i class="ki-duotone ki-cross text-danger fs-4"></i></td>
                                                                    <td class="text-center"><i class="ki-duotone ki-check text-success fs-4"></i></td>
                                                                    <td class="text-center"><i class="ki-duotone ki-check text-success fs-4"></i></td>
                                                                </tr>
                                                                <tr>
                                                                    <td><i class="ki-duotone ki-chart-line-up me-2 text-info"></i>Analytics Avançado</td>
                                                                    <td class="text-center"><i class="ki-duotone ki-check text-success fs-4"></i></td>
                                                                    <td class="text-center"><i class="ki-duotone ki-check text-success fs-4"></i></td>
                                                                    <td class="text-center"><i class="ki-duotone ki-check text-success fs-4"></i></td>
                                                                </tr>
                                                                <tr>
                                                                    <td><i class="ki-duotone ki-setting-2 me-2 text-secondary"></i>Configurações Sistema</td>
                                                                    <td class="text-center"><i class="ki-duotone ki-cross text-danger fs-4"></i></td>
                                                                    <td class="text-center"><i class="ki-duotone ki-cross text-danger fs-4"></i></td>
                                                                    <td class="text-center"><i class="ki-duotone ki-check text-success fs-4"></i></td>
                                                                </tr>
                                                                <tr>
                                                                    <td><i class="ki-duotone ki-people me-2 text-success"></i>Gestão de Equipe</td>
                                                                    <td class="text-center"><i class="ki-duotone ki-check text-success fs-4"></i></td>
                                                                    <td class="text-center"><i class="ki-duotone ki-check text-success fs-4"></i></td>
                                                                    <td class="text-center"><i class="ki-duotone ki-check text-success fs-4"></i></td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>

                                                    <div class="alert mt-4" style="background: linear-gradient(135deg, rgba(0, 201, 167, 0.1) 0%, rgba(0, 160, 133, 0.1) 100%); border: 2px solid #00c9a7;">
                                                        <h6 class="alert-heading text-info"><i class="ki-duotone ki-information-5 fs-2 me-2"></i>Importante</h6>
                                                        <p class="mb-0">Você pode ter contas com perfis diferentes (Broker e Supplier) usando emails distintos. Cada perfil terá seu próprio dashboard e métricas específicas.</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="v-pills-leads" role="tabpanel">
                            <div class="card card-flush content-card">
                                <div class="card-header pt-5">
                                    <div class="card-title">
                                        <h3 class="fw-bold text-gray-800">Gestão de Leads</h3>
                                        <span class="text-gray-400 pt-1 fw-semibold fs-6">Tudo sobre leads e interações</span>
                                    </div>
                                </div>
                                <div class="card-body pt-2 pb-4">
                                    <div class="accordion" id="accordionLeads">
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="headingLeads1">
                                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseLeads1">
                                                    O que são leads?
                                                </button>
                                            </h2>
                                            <div id="collapseLeads1" class="accordion-collapse collapse show" data-bs-parent="#accordionLeads">
                                                <div class="accordion-body">
                                                    <p><strong>Leads</strong> são potenciais clientes qualificados que demonstraram interesse em produtos de seguros ou saúde. No sistema SecretárIA do Corretor, trabalhamos com leads de alta qualidade e conversão comprovada.</p>

                                                    <h6 class="mt-4 mb-3 text-primary"><i class="ki-duotone ki-profile-circle fs-3 me-2"><span class="path1"></span><span class="path2"></span></i>Anatomia de um Lead SecretárIA do Corretor</h6>

                                                    <div class="row g-4">
                                                        <div class="col-lg-8">
                                                            <div class="card" style="background: linear-gradient(135deg, rgba(231, 29, 115, 0.1) 0%, rgba(161, 23, 83, 0.1) 100%); border: 2px solid #e71d73;">
                                                                <div class="card-body p-4">
                                                                    <h6 class="text-primary mb-4"><i class="ki-duotone ki-user-tick fs-2 me-2"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i>Dados Pessoais Completos</h6>

                                                                    <div class="row g-3">
                                                                        <div class="col-md-6">
                                                                            <ul class="list-unstyled">
                                                                                <li class="mb-2"><i class="ki-duotone ki-user text-primary me-2 fs-6"></i><strong>Nome Completo:</strong> Pessoa física ou razão social</li>
                                                                                <li class="mb-2"><i class="ki-duotone ki-sms text-primary me-2 fs-6"></i><strong>Email Validado:</strong> Endereço ativo e verificado</li>
                                                                                <li class="mb-2"><i class="ki-duotone ki-phone text-primary me-2 fs-6"></i><strong>Telefones:</strong> Fixo e celular com DDD</li>
                                                                                <li class="mb-2"><i class="ki-duotone ki-geolocation text-primary me-2 fs-6"></i><strong>Endereço Completo:</strong> CEP, rua, número, bairro</li>
                                                                            </ul>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <ul class="list-unstyled">
                                                                                <li class="mb-2"><i class="ki-duotone ki-profile-user text-primary me-2 fs-6"></i><strong>CPF/CNPJ:</strong> Documento válido e verificado</li>
                                                                                <li class="mb-2"><i class="ki-duotone ki-calendar-8 text-primary me-2 fs-6"></i><strong>Data de Nascimento:</strong> Para cálculos de seguro</li>
                                                                                <li class="mb-2"><i class="ki-duotone ki-briefcase text-primary me-2 fs-6"></i><strong>Profissão:</strong> Categoria de risco</li>
                                                                                <li class="mb-2"><i class="ki-duotone ki-dollar text-primary me-2 fs-6"></i><strong>Renda Declarada:</strong> Faixa de poder aquisitivo</li>
                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-4">
                                                            <div class="card" style="background: linear-gradient(135deg, rgba(0, 201, 167, 0.1) 0%, rgba(0, 160, 133, 0.1) 100%); border: 2px solid #00c9a7;">
                                                                <div class="card-body p-4 text-center">
                                                                    <i class="ki-duotone ki-medal-star fs-3x text-success mb-3"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i>
                                                                    <h6 class="text-success mb-2">Score de Qualidade</h6>
                                                                    <div class="fs-2x fw-bold text-success">95%</div>
                                                                    <p class="fs-7 text-muted mb-0">Média de conversão dos leads SecretárIA do Corretor</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <h6 class="mt-5 mb-3 text-primary"><i class="ki-duotone ki-category fs-3 me-2"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span></i>Classificações e Categorias</h6>

                                                    <div class="row g-4">
                                                        <div class="col-md-4">
                                                            <div class="card border-primary">
                                                                <div class="card-header" style="background: linear-gradient(135deg, #e71d73 0%, #a11753 100%);">
                                                                    <h6 class="text-white mb-0 text-center"><i class="ki-duotone ki-abstract-26 me-2 fs-4"></i>Por Tipo de Pessoa</h6>
                                                                </div>
                                                                <div class="card-body p-3">
                                                                    <ul class="list-unstyled mb-0">
                                                                        <li class="mb-2"><span class="badge badge-light-primary me-2">PF</span><strong>Pessoa Física:</strong> Seguros individuais</li>
                                                                        <li class="mb-2"><span class="badge badge-light-success me-2">PJ</span><strong>Pessoa Jurídica:</strong> Seguros empresariais</li>
                                                                        <li class="mb-0"><span class="badge badge-light-warning me-2">AD</span><strong>Adesão:</strong> Planos por categoria</li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-4">
                                                            <div class="card border-warning">
                                                                <div class="card-header" style="background: linear-gradient(135deg, #ffb822 0%, #f7931e 100%);">
                                                                    <h6 class="text-white mb-0 text-center"><i class="ki-duotone ki-abstract-35 me-2 fs-4"></i>Por Temperatura</h6>
                                                                </div>
                                                                <div class="card-body p-3">
                                                                    <ul class="list-unstyled mb-0">
                                                                        <li class="mb-2"><span class="badge badge-danger me-2">🔥</span><strong>Quente:</strong> Interesse imediato (80-90%)</li>
                                                                        <li class="mb-2"><span class="badge badge-warning me-2">🌡️</span><strong>Morno:</strong> Interesse moderado (60-80%)</li>
                                                                        <li class="mb-0"><span class="badge badge-info me-2">❄️</span><strong>Frio:</strong> Potencial futuro (40-60%)</li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-4">
                                                            <div class="card border-success">
                                                                <div class="card-header" style="background: linear-gradient(135deg, #00c9a7 0%, #00a085 100%);">
                                                                    <h6 class="text-white mb-0 text-center"><i class="ki-duotone ki-chart-pie-simple me-2 fs-4"></i>Por Status</h6>
                                                                </div>
                                                                <div class="card-body p-3">
                                                                    <ul class="list-unstyled mb-0">
                                                                        <li class="mb-2"><span class="badge badge-light-success me-2">•</span><strong>Disponível:</strong> Pronto para compra</li>
                                                                        <li class="mb-2"><span class="badge badge-light-warning me-2">•</span><strong>Em Processo:</strong> Sendo trabalhado</li>
                                                                        <li class="mb-0"><span class="badge badge-light-dark me-2">•</span><strong>Vendido:</strong> Convertido com sucesso</li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <h6 class="mt-5 mb-3 text-primary"><i class="ki-duotone ki-price-tag fs-3 me-2"><span class="path1"></span><span class="path2"></span></i>Sistema de Precificação Inteligente</h6>

                                                    <div class="alert" style="background: linear-gradient(135deg, rgba(231, 29, 115, 0.1) 0%, rgba(161, 23, 83, 0.1) 100%); border: 2px solid #e71d73;">
                                                        <div class="row align-items-center">
                                                            <div class="col-md-8">
                                                                <h6 class="alert-heading text-primary"><i class="ki-duotone ki-abstract-13 fs-2 me-2"></i>Preço Dinâmico</h6>
                                                                <p class="mb-2">Nossos leads possuem preços que variam automaticamente baseado em:</p>
                                                                <ul class="list-unstyled">
                                                                    <li><i class="ki-duotone ki-check text-success me-2 fs-6"></i><strong>Qualidade:</strong> Score de conversão histórico</li>
                                                                    <li><i class="ki-duotone ki-check text-success me-2 fs-6"></i><strong>Demanda:</strong> Concorrência no segmento</li>
                                                                    <li><i class="ki-duotone ki-check text-success me-2 fs-6"></i><strong>Urgência:</strong> Tempo no marketplace</li>
                                                                    <li><i class="ki-duotone ki-check text-success me-2 fs-6"></i><strong>Localização:</strong> Região geográfica</li>
                                                                </ul>
                                                            </div>
                                                            <div class="col-md-4 text-center">
                                                                <div class="bg-white p-3 rounded" style="border: 2px solid #e71d73;">
                                                                    <small class="text-muted">Preço Médio</small>
                                                                    <div class="fs-2x fw-bold text-primary">R$ 45</div>
                                                                    <small class="text-success">ROI: 350%</small>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <h6 class="mt-4 mb-3 text-primary"><i class="ki-duotone ki-shield-tick fs-3 me-2"><span class="path1"></span><span class="path2"></span></i>Garantias e Qualidade</h6>

                                                    <div class="row g-3">
                                                        <div class="col-md-6">
                                                            <div class="d-flex align-items-center p-3 rounded" style="background: linear-gradient(135deg, rgba(0, 201, 167, 0.1) 0%, rgba(0, 160, 133, 0.1) 100%); border: 2px solid #00c9a7;">
                                                                <i class="ki-duotone ki-verify fs-2x text-success me-3"><span class="path1"></span><span class="path2"></span></i>
                                                                <div>
                                                                    <h6 class="mb-1 text-success">100% Verificados</h6>
                                                                    <p class="fs-7 mb-0">Todos os dados são validados antes da disponibilização</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="d-flex align-items-center p-3 rounded" style="background: linear-gradient(135deg, rgba(255, 184, 34, 0.1) 0%, rgba(247, 147, 30, 0.1) 100%); border: 2px solid #ffb822;">
                                                                <i class="ki-duotone ki-clock fs-2x text-warning me-3"><span class="path1"></span><span class="path2"></span></i>
                                                                <div>
                                                                    <h6 class="mb-1 text-warning">Freshness < 24h</h6>
                                                                    <p class="fs-7 mb-0">Leads capturados e processados em menos de 24 horas</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="alert mt-4" style="background: linear-gradient(135deg, rgba(0, 201, 167, 0.1) 0%, rgba(0, 160, 133, 0.1) 100%); border: 2px solid #00c9a7;">
                                                        <h6 class="alert-heading text-success"><i class="ki-duotone ki-like fs-2 me-2"></i>Garantia de Satisfação</h6>
                                                        <p class="mb-0">Se um lead não atender aos critérios de qualidade prometidos, oferecemos reposição gratuita ou reembolso total em até 48 horas.</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="headingLeads2">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseLeads2">
                                                    Como criar um lead?
                                                </button>
                                            </h2>
                                            <div id="collapseLeads2" class="accordion-collapse collapse" data-bs-parent="#accordionLeads">
                                                <div class="accordion-body">
                                                    <p>Para criar um lead:</p>
                                                    <ol>
                                                        <li>Acesse a seção "Gestão de Leads"</li>
                                                        <li>Clique em "Novo Lead"</li>
                                                        <li>Preencha todos os campos obrigatórios</li>
                                                        <li>Defina o preço inicial</li>
                                                        <li>Escolha o tipo de precificação</li>
                                                        <li>Salve o lead</li>
                                                    </ol>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="headingLeads3">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseLeads3">
                                                    Como gerenciar interações?
                                                </button>
                                            </h2>
                                            <div id="collapseLeads3" class="accordion-collapse collapse" data-bs-parent="#accordionLeads">
                                                <div class="accordion-body">
                                                    <p>As interações permitem acompanhar o progresso do lead:</p>
                                                    <ul>
                                                        <li><strong>Steps:</strong> Etapas do processo de venda</li>
                                                        <li><strong>Histórico:</strong> Todas as ações realizadas</li>
                                                        <li><strong>Notas:</strong> Observações importantes</li>
                                                        <li><strong>Status:</strong> Atualização do progresso</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="v-pills-marketplace" role="tabpanel">
                            <div class="card card-flush content-card">
                                <div class="card-header pt-5">
                                    <div class="card-title">
                                        <h3 class="fw-bold text-gray-800">Marketplace</h3>
                                        <span class="text-gray-400 pt-1 fw-semibold fs-6">Compra e venda de leads</span>
                                    </div>
                                </div>
                                <div class="card-body pt-2 pb-4">
                                    <div class="accordion" id="accordionMarketplace">
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="headingMarketplace1">
                                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseMarketplace1">
                                                    Como funciona o marketplace?
                                                </button>
                                            </h2>
                                            <div id="collapseMarketplace1" class="accordion-collapse collapse show" data-bs-parent="#accordionMarketplace">
                                                <div class="accordion-body">
                                                    <p>O marketplace é onde brokers compram leads de suppliers:</p>
                                                    <ul>
                                                        <li><strong>Suppliers:</strong> Cadastram leads para venda</li>
                                                        <li><strong>Brokers:</strong> Navegam e compram leads</li>
                                                        <li><strong>Filtros:</strong> Busca por tipo, preço, localização</li>
                                                        <li><strong>Transação:</strong> Sistema de pagamento integrado</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="headingMarketplace2">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseMarketplace2">
                                                    Como comprar leads?
                                                </button>
                                            </h2>
                                            <div id="collapseMarketplace2" class="accordion-collapse collapse" data-bs-parent="#accordionMarketplace">
                                                <div class="accordion-body">
                                                    <p>Para comprar leads:</p>
                                                    <ol>
                                                        <li>Navegue pelo marketplace</li>
                                                        <li>Use os filtros para encontrar leads</li>
                                                        <li>Adicione ao carrinho</li>
                                                        <li>Finalize a compra</li>
                                                        <li>Realize o pagamento</li>
                                                        <li>Receba o lead automaticamente</li>
                                                    </ol>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="headingMarketplace3">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseMarketplace3">
                                                    Como vender leads?
                                                </button>
                                            </h2>
                                            <div id="collapseMarketplace3" class="accordion-collapse collapse" data-bs-parent="#accordionMarketplace">
                                                <div class="accordion-body">
                                                    <p>Para vender leads:</p>
                                                    <ol>
                                                        <li>Crie leads de qualidade</li>
                                                        <li>Defina preços competitivos</li>
                                                        <li>Configure estratégias de precificação</li>
                                                        <li>Monitore as vendas</li>
                                                        <li>Receba pagamentos automaticamente</li>
                                                    </ol>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="v-pills-payments" role="tabpanel">
                            <div class="card card-flush content-card">
                                <div class="card-header pt-5">
                                    <div class="card-title">
                                        <h3 class="fw-bold text-gray-800">Pagamentos</h3>
                                        <span class="text-gray-400 pt-1 fw-semibold fs-6">Sistema de pagamentos e cobranças</span>
                                    </div>
                                </div>
                                <div class="card-body pt-2 pb-4">
                                    <div class="accordion" id="accordionPayments">
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="headingPayments1">
                                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapsePayments1">
                                                    Quais formas de pagamento?
                                                </button>
                                            </h2>
                                            <div id="collapsePayments1" class="accordion-collapse collapse show" data-bs-parent="#accordionPayments">
                                                <div class="accordion-body">
                                                    <p>O sistema aceita múltiplas formas de pagamento:</p>
                                                    <ul>
                                                        <li><strong>Cartão de crédito:</strong> Todas as bandeiras</li>
                                                        <li><strong>PIX:</strong> Transferência instantânea</li>
                                                        <li><strong>Boleto bancário:</strong> Pagamento em até 3 dias</li>
                                                        <li><strong>Transferência:</strong> Entre contas bancárias</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="headingPayments2">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapsePayments2">
                                                    Como funciona a cobrança?
                                                </button>
                                            </h2>
                                            <div id="collapsePayments2" class="accordion-collapse collapse" data-bs-parent="#accordionPayments">
                                                <div class="accordion-body">
                                                    <p>O sistema de cobrança funciona assim:</p>
                                                    <ul>
                                                        <li><strong>Compra:</strong> Pagamento imediato ao comprar leads</li>
                                                        <li><strong>Comissão:</strong> Taxa automática do sistema</li>
                                                        <li><strong>Repasse:</strong> Valor para o supplier após confirmação</li>
                                                        <li><strong>Extrato:</strong> Histórico completo de transações</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="v-pills-automation" role="tabpanel">
                            <div class="card card-flush content-card">
                                <div class="card-header pt-5">
                                    <div class="card-title">
                                        <h3 class="fw-bold text-gray-800">Automação</h3>
                                        <span class="text-gray-400 pt-1 fw-semibold fs-6">Automatize seus processos</span>
                                    </div>
                                </div>
                                <div class="card-body pt-2 pb-4">
                                    <div class="accordion" id="accordionAutomation">
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="headingAutomation1">
                                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseAutomation1">
                                                    O que é automação de leads?
                                                </button>
                                            </h2>
                                            <div id="collapseAutomation1" class="accordion-collapse collapse show" data-bs-parent="#accordionAutomation">
                                                <div class="accordion-body">
                                                    <p>A automação permite:</p>
                                                    <ul>
                                                        <li><strong>Captura automática:</strong> Leads entram no sistema automaticamente</li>
                                                        <li><strong>Distribuição inteligente:</strong> Alocação baseada em regras</li>
                                                        <li><strong>Follow-up automático:</strong> Lembretes e notificações</li>
                                                        <li><strong>Relatórios:</strong> Métricas em tempo real</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="headingAutomation2">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseAutomation2">
                                                    Como configurar automações?
                                                </button>
                                            </h2>
                                            <div id="collapseAutomation2" class="accordion-collapse collapse" data-bs-parent="#accordionAutomation">
                                                <div class="accordion-body">
                                                    <p>Para configurar automações:</p>
                                                    <ol>
                                                        <li>Acesse as configurações de automação</li>
                                                        <li>Defina regras de captura</li>
                                                        <li>Configure workflows</li>
                                                        <li>Estabeleça gatilhos</li>
                                                        <li>Teste e ative</li>
                                                    </ol>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="v-pills-api" role="tabpanel">
                            <div class="card card-flush content-card">
                                <div class="card-header pt-5">
                                    <div class="card-title">
                                        <h3 class="fw-bold text-gray-800">API & Integrações</h3>
                                        <span class="text-gray-400 pt-1 fw-semibold fs-6">Integre com outros sistemas</span>
                                    </div>
                                </div>
                                <div class="card-body pt-2 pb-4">
                                    <div class="accordion" id="accordionAPI">
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="headingAPI1">
                                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseAPI1">
                                                    Como usar a API?
                                                </button>
                                            </h2>
                                            <div id="collapseAPI1" class="accordion-collapse collapse show" data-bs-parent="#accordionAPI">
                                                <div class="accordion-body">
                                                    <p>A API permite integração completa:</p>
                                                    <ul>
                                                        <li><strong>Autenticação:</strong> Token de acesso seguro</li>
                                                        <li><strong>Endpoints:</strong> CRUD completo de leads</li>
                                                        <li><strong>Webhooks:</strong> Notificações em tempo real</li>
                                                        <li><strong>Documentação:</strong> Swagger completo</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="headingAPI2">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseAPI2">
                                                    Quais integrações disponíveis?
                                                </button>
                                            </h2>
                                            <div id="collapseAPI2" class="accordion-collapse collapse" data-bs-parent="#accordionAPI">
                                                <div class="accordion-body">
                                                    <p>Integrações disponíveis:</p>
                                                    <ul>
                                                        <li><strong>CRM:</strong> Salesforce, HubSpot, Pipedrive</li>
                                                        <li><strong>Marketing:</strong> Mailchimp, ActiveCampaign</li>
                                                        <li><strong>Pagamentos:</strong> Stripe, PayPal</li>
                                                        <li><strong>Websites:</strong> WordPress, Shopify</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="v-pills-troubleshooting" role="tabpanel">
                            <div class="card card-flush content-card">
                                <div class="card-header pt-5">
                                    <div class="card-title">
                                        <h3 class="fw-bold text-gray-800">Solução de Problemas</h3>
                                        <span class="text-gray-400 pt-1 fw-semibold fs-6">Resolva problemas comuns</span>
                                    </div>
                                </div>
                                <div class="card-body pt-2 pb-4">
                                    <div class="accordion" id="accordionTroubleshooting">
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="headingTroubleshooting1">
                                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTroubleshooting1">
                                                    Problemas de login
                                                </button>
                                            </h2>
                                            <div id="collapseTroubleshooting1" class="accordion-collapse collapse show" data-bs-parent="#accordionTroubleshooting">
                                                <div class="accordion-body">
                                                    <p>Soluções para problemas de login:</p>
                                                    <ul>
                                                        <li><strong>Esqueci a senha:</strong> Use a recuperação por email</li>
                                                        <li><strong>Conta bloqueada:</strong> Entre em contato com suporte</li>
                                                        <li><strong>Problemas de rede:</strong> Verifique sua conexão</li>
                                                        <li><strong>Cache do navegador:</strong> Limpe cookies e cache</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="headingTroubleshooting2">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTroubleshooting2">
                                                    Problemas de pagamento
                                                </button>
                                            </h2>
                                            <div id="collapseTroubleshooting2" class="accordion-collapse collapse" data-bs-parent="#accordionTroubleshooting">
                                                <div class="accordion-body">
                                                    <p>Soluções para problemas de pagamento:</p>
                                                    <ul>
                                                        <li><strong>Pagamento não processado:</strong> Verifique dados do cartão</li>
                                                        <li><strong>Boleto vencido:</strong> Gere novo boleto</li>
                                                        <li><strong>PIX não confirmado:</strong> Aguarde confirmação</li>
                                                        <li><strong>Reembolso:</strong> Solicite via suporte</li>
                                                    </ul>
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

            <div class="row g-5 g-xl-10 mt-5">
                <div class="col-md-12">
                    <div class="card card-flush support-contact-card">
                        <div class="card-header pt-5">
                            <div class="card-title">
                                <h3 class="fw-bold text-gray-800">Precisa de Ajuda?</h3>
                                <span class="text-gray-400 pt-1 fw-semibold fs-6">Entre em contato com nossa equipe de suporte</span>
                            </div>
                        </div>
                        <div class="card-body pt-2 pb-4">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="support-contact-item">
                                        <div class="d-flex align-items-center">
                                        <div class="symbol symbol-50px me-3">
                                            <div class="symbol-label bg-light-primary">
                                                    <i class="ki-duotone ki-message-text-2 fs-2x text-white">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                </i>
                                            </div>
                                        </div>
                                        <div class="d-flex flex-column">
                                            <span class="fw-bold text-gray-800">Chat Online</span>
                                            <span class="text-gray-400">Disponível 24/7</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="support-contact-item">
                                        <div class="d-flex align-items-center">
                                        <div class="symbol symbol-50px me-3">
                                            <div class="symbol-label bg-light-success">
                                                    <i class="ki-duotone ki-sms fs-2x text-white">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                </i>
                                            </div>
                                        </div>
                                        <div class="d-flex flex-column">
                                            <span class="fw-bold text-gray-800">Email</span>
                                                <span class="text-gray-400">suporte@secretariadocorretor.com</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="support-contact-item">
                                        <div class="d-flex align-items-center">
                                        <div class="symbol symbol-50px me-3">
                                            <div class="symbol-label bg-light-warning">
                                                    <i class="ki-duotone ki-phone fs-2x text-white">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                </i>
                                            </div>
                                        </div>
                                        <div class="d-flex flex-column">
                                            <span class="fw-bold text-gray-800">Telefone</span>
                                            <span class="text-gray-400">0800 123 4567</span>
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
    </div>
</div>
@endsection

