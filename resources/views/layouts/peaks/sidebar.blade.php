<div id="kt_app_sidebar" class="app-sidebar flex-column" data-kt-drawer="true" data-kt-drawer-name="app-sidebar" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="225px" data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_app_sidebar_mobile_toggle">
    <div class="app-sidebar-logo px-6 d-flex justify-content-center" id="kt_app_sidebar_logo">
        <a href="#">
            <img alt="NiceAPI" src="{{ asset('assets/logo.png') }}" class="h-50px app-sidebar-logo-default" />
            <img alt="NiceAPI" src="{{ asset('assets/logo-icon.png') }}" class="h-30px app-sidebar-logo-minimize" />
        </a>
        <div id="kt_app_sidebar_toggle" class="app-sidebar-toggle btn btn-icon btn-shadow btn-sm btn-color-muted btn-active-color-primary body-bg h-30px w-30px position-absolute top-50 start-100 translate-middle rotate" data-kt-toggle="true" data-kt-toggle-state="active" data-kt-toggle-target="body" data-kt-toggle-name="app-sidebar-minimize">
            <i class="ki-duotone ki-double-left fs-2 rotate-180">
                <span class="path1"></span>
                <span class="path2"></span>
            </i>
        </div>
    </div>
    <div class="app-sidebar-menu overflow-hidden flex-column-fluid">
        <div id="kt_app_sidebar_menu_wrapper" class="app-sidebar-wrapper hover-scroll-overlay-y my-5" data-kt-scroll="true" data-kt-scroll-activate="true" data-kt-scroll-height="auto" data-kt-scroll-dependencies="#kt_app_sidebar_logo, #kt_app_sidebar_footer" data-kt-scroll-wrappers="#kt_app_sidebar_menu" data-kt-scroll-offset="5px" data-kt-scroll-save-state="true">
            <div class="menu menu-column menu-rounded menu-sub-indention px-3" id="#kt_app_sidebar_menu" data-kt-menu="true" data-kt-menu-expand="false">
                <div class="menu-item">
                    <a href="{{ route('homepage.index') }}">
                        <span class="menu-link @yield('homepage')">
                            <span class="menu-icon">
                                <i class="ki-duotone ki-home fs-2">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i>
                            </span>
                            <span class="menu-title">Início</span>
                        </span>
                    </a>
                </div>

                <div class="menu-item">
                    <a href="{{ route('dashboard') }}">
                        <span class="menu-link @yield('dash')">
                            <span class="menu-icon">
                                <i class="ki-duotone ki-element-11 fs-2">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                    <span class="path3"></span>
                                    <span class="path4"></span>
                                </i>
                            </span>
                            <span class="menu-title">Dashboard</span>
                        </span>
                    </a>
                </div>

                @can('can-access-connections')
                <div class="menu-item">
                    <a href="{{ route('connect.index') }}">
                        <span class="menu-link @yield('connect')">
                            <span class="menu-icon">
                                <i class="ki-duotone ki-scan-barcode fs-2">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                    <span class="path3"></span>
                                    <span class="path4"></span>
                                    <span class="path5"></span>
                                    <span class="path6"></span>
                                    <span class="path7"></span>
                                    <span class="path8"></span>
                                </i>
                            </span>
                            <span class="menu-title">Conexões</span>
                        </span>
                    </a>
                </div>
                @endcan

                <div class="menu-item">
                    <a href="{{ route('calendar.index') }}">
                        <span class="menu-link @yield('calendar')">
                            <span class="menu-icon">
                                <i class="ki-duotone ki-calendar fs-2">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i>
                            </span>
                            <span class="menu-title">Agenda da Secretária</span>
                        </span>
                    </a>
                </div>

                <div class="menu-item">
                    <a href="{{ route('funnel.index') }}">
                        <span class="menu-link @yield('funnel')">
                            <span class="menu-icon">
                                <i class="ki-duotone ki-graph-up fs-2">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                    <span class="path3"></span>
                                    <span class="path4"></span>
                                    <span class="path5"></span>
                                    <span class="path6"></span>
                                </i>
                            </span>
                            <span class="menu-title">Funil de Vendas</span>
                        </span>
                    </a>
                </div>

                <div class="menu-item">
                    <a href="{{ route('customer.index') }}">
                        <span class="menu-link @yield('customer')">
                            <span class="menu-icon">
                                <i class="ki-duotone ki-wallet fs-2">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                    <span class="path3"></span>
                                    <span class="path4"></span>
                                </i>
                            </span>
                            <span class="menu-title">Carteira de Clientes</span>
                        </span>
                    </a>
                </div>

                <div class="menu-item">
                    <a href="{{ route('contact.index') }}">
                        <span class="menu-link @yield('contact')">
                            <span class="menu-icon">
                                <i class="ki-duotone ki-address-book fs-2">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                    <span class="path3"></span>
                                </i>
                            </span>
                            <span class="menu-title">Base de contatos</span>
                        </span>
                    </a>
                </div>

                <!-- Item "Mercado de Leads" movido para o header
                <div data-kt-menu-trigger="click" class="menu-item menu-accordion @if(in_array(Route::currentRouteName(), ['marketplace.index', 'leads.index', 'transactions.index', 'contestation.index'])) here show @endif">
                    <span class="menu-link">
                        <span class="menu-icon">
                            <i class="ki-duotone ki-shop fs-2">
                                <span class="path1"></span>
                                <span class="path2"></span>
                                <span class="path3"></span>
                                <span class="path4"></span>
                                <span class="path5"></span>
                            </i>
                        </span>
                        <span class="menu-title">Mercado de Leads</span>
                        <span class="menu-arrow"></span>
                    </span>
                    <div class="menu-sub menu-sub-accordion">
                        <div class="menu-item">
                            <a class="menu-link @yield('marketplace')" href="{{ route('marketplace.index') }}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">Fornecedores</span>
                            </a>
                        </div>
                        <div class="menu-item">
                            <a class="menu-link @yield('leads')" href="{{ route('leads.index') }}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">Leads Adquiridos</span>
                            </a>
                        </div>
                        <div class="menu-item">
                            <a class="menu-link @yield('transactions')" href="{{ route('transactions.index') }}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">Histórico de Transações</span>
                            </a>
                        </div>
                        <div class="menu-item">
                            <a class="menu-link @yield('contestation')" href="{{ route('contestation.index') }}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">Contestação</span>
                            </a>
                        </div>
                    </div>
                </div>
                -->

                <div data-kt-menu-trigger="click" class="menu-item menu-accordion @if(in_array(Route::currentRouteName(), ['supplier-dashboard.index', 'api-leads.index', 'manage-leads.index', 'company-profile.index'])) here show @endif">
                    <a href="#" class="menu-link">
                        <span class="menu-icon">
                            <i class="ki-duotone ki-graph-up fs-2">
                                <span class="path1"></span>
                                <span class="path2"></span>
                                <span class="path3"></span>
                                <span class="path4"></span>
                                <span class="path5"></span>
                                <span class="path6"></span>
                            </i>
                        </span>
                        <span class="menu-title">Telas de Fornecedor</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="menu-sub menu-sub-accordion">
                        <div class="menu-item">
                            <a class="menu-link @yield('supplier-dashboard')" href="{{ route('supplier-dashboard.index') }}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">Dashboard</span>
                            </a>
                        </div>
                        <div class="menu-item">
                            <a class="menu-link @yield('api-leads')" href="{{ route('api-leads.index') }}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">API de Leads</span>
                            </a>
                        </div>
                        <div class="menu-item">
                            <a class="menu-link @yield('manage-leads')" href="{{ route('manage-leads.index') }}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">Gerenciar Leads</span>
                            </a>
                        </div>
                        <div class="menu-item">
                            <a class="menu-link @yield('company-profile')" href="{{ route('company-profile.index') }}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">Perfil da Empresa</span>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Painel de Equipe - Menu expansível com subitens -->
                <div data-kt-menu-trigger="click" class="menu-item menu-accordion @if(in_array(Route::currentRouteName(), ['team-panel.index', 'team-panel.single-team.show', 'team-panel.single-team.edit', 'team-panel.single-team.members', 'team-panel.single-team.access', 'team-panel.single-team.transfer'])) here show @endif">
                    <a href="{{ route('team-panel.index') }}" class="menu-link">
                        <span class="menu-icon">
                            <i class="ki-duotone ki-profile-user fs-2">
                                <span class="path1"></span>
                                <span class="path2"></span>
                                <span class="path3"></span>
                                <span class="path4"></span>
                            </i>
                        </span>
                        <span class="menu-title">Painel de Equipe</span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="menu-sub menu-sub-accordion">
                        <div class="menu-item">
                            @php
                                // Obtém o ID da equipe atual pela rota ou primeira equipe do corretor via TeamMember
                                $currentTeamId = request()->route('id');
                                if(!$currentTeamId) {
                                    $broker = auth()->user()?->broker;
                                    if($broker) {
                                        $currentTeamId = \App\Models\TeamMember::where('broker_id', $broker->id)
                                            ->orderBy('team_id', 'asc')
                                            ->value('team_id');
                                    }
                                }
                            @endphp
                            <a class="menu-link @if(Route::currentRouteName() == 'team-panel.single-team.show') active @endif" href="{{ $currentTeamId ? route('team-panel.single-team.show', $currentTeamId) : route('team-panel.index') }}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">Visão Geral</span>
                            </a>
                        </div>
                        <div class="menu-item">
                            <a class="menu-link @if(Route::currentRouteName() == 'team-panel.single-team.edit') active @endif" href="{{ $currentTeamId ? route('team-panel.single-team.edit', $currentTeamId) : route('team-panel.index') }}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">Gerenciar Equipe</span>
                            </a>
                        </div>
                        <div class="menu-item">
                            <a class="menu-link @if(Route::currentRouteName() == 'team-panel.single-team.members') active @endif" href="{{ $currentTeamId ? route('team-panel.single-team.members', $currentTeamId) : route('team-panel.index') }}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">Membros</span>
                            </a>
                        </div>
                        <div class="menu-item">
                            <a class="menu-link @if(Route::currentRouteName() == 'team-panel.single-team.access') active @endif" href="{{ $currentTeamId ? route('team-panel.single-team.access', $currentTeamId) : route('team-panel.index') }}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">Controle de Acessos</span>
                            </a>
                        </div>
                        <div class="menu-item">
                            <a class="menu-link @if(Route::currentRouteName() == 'team-panel.single-team.transfer') active @endif" href="{{ $currentTeamId ? route('team-panel.single-team.transfer', $currentTeamId) : route('team-panel.index') }}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">Transferência de Leads</span>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="menu-item pt-5">
                    <div class="menu-content"><span class="menu-heading fw-bold text-uppercase fs-7">Configurações</span></div>
                </div>

                <div class="menu-item">
                    <a href="{{ route('access.index') }}">
                        <span class="menu-link @yield('access')">
                            <span class="menu-icon">
                                <i class="ki-duotone ki-lock fs-2">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                    <span class="path3"></span>
                                </i>
                            </span>
                            <span class="menu-title">Controle de acesso</span>
                        </span>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="app-sidebar-footer flex-column-auto pt-2 pb-6 px-6" id="kt_app_sidebar_footer">
        <a href="{{ route('support.index') }}" class="btn btn-flex flex-center btn-custom btn-secondary overflow-hidden text-nowrap px-0 h-40px w-100">
            <i class="ki-duotone ki-message-question fs-2">
                <span class="path1"></span>
                <span class="path2"></span>
                <span class="path3"></span>
            </i>
            <span class="btn-label">Suporte</span>
        </a>
    </div>
</div>

