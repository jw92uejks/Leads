<div class="d-flex align-items-center flex-grow-1 flex-lg-grow-0">
    <a href="#" class="d-lg-none">
        <img alt="Logo" src="{{ asset('assets/logo-icon.png') }}" class="h-30px" />
    </a>
</div>
<div class="d-flex align-items-stretch justify-content-between flex-lg-grow-1" id="kt_app_header_wrapper">
    <div class="app-header-menu app-header-mobile-drawer align-items-stretch" data-kt-drawer="true" data-kt-drawer-name="app-header-menu" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="250px" data-kt-drawer-direction="end" data-kt-drawer-toggle="#kt_app_header_menu_toggle" data-kt-swapper="true" data-kt-swapper-mode="{default: 'append', lg: 'prepend'}" data-kt-swapper-parent="{default: '#kt_app_body', lg: '#kt_app_header_wrapper'}"></div>

    <div class="app-navbar flex-shrink-0">
        <div class="app-navbar-item ms-1 ms-md-3">
            <div class="btn btn-light border py-2 px-5 rounded-pill" style="" data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end">
                <i class="ki-duotone ki-shop" style="font-size: 2rem;">
                    <span class="path1"></span>
                    <span class="path2"></span>
                    <span class="path3"></span>
                    <span class="path4"></span>
                    <span class="path5"></span>
                </i>
                <span>Mercado de Leads</span>
            </div>
            <div class="menu menu-sub menu-sub-dropdown menu-column w-100 w-sm-250px" data-kt-menu="true">
                <div class="card">
                    <div class="card-body p-0">
                        <div class="mh-450px scroll-y me-n5 pe-5">
                            <div class="row g-2">
                                <div class="col-12">
                                    <div class="menu-item px-3 py-2">
                                        <a href="{{ route('marketplace.index') }}" class="menu-link px-3 py-2 d-flex align-items-center">
                                            <i class="ki-duotone ki-shop fs-3 me-3">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                                <span class="path3"></span>
                                                <span class="path4"></span>
                                                <span class="path5"></span>
                                            </i>
                                            <span class="menu-title">Fornecedores</span>
                                        </a>
                                    </div>
                                    <div class="menu-item px-3 py-2">
                                        <a href="{{ route('leads.index') }}" class="menu-link px-3 py-2 d-flex align-items-center">
                                            <i class="ki-duotone ki-profile-user fs-3 me-3">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                                <span class="path3"></span>
                                                <span class="path4"></span>
                                            </i>
                                            <span class="menu-title">Leads Adquiridos</span>
                                        </a>
                                    </div>
                                    <div class="menu-item px-3 py-2">
                                        <a href="{{ route('myplan.index') }}" class="menu-link px-3 py-2 d-flex align-items-center">
                                            <i class="ki-duotone ki-wallet fs-3 me-3">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                                <span class="path3"></span>
                                                <span class="path4"></span>
                                            </i>
                                            <span class="menu-title">Histórico e Transações</span>
                                        </a>
                                    </div>
                                    <div class="menu-item px-3 py-2">
                                        <a href="{{ route('contestation.index') }}" class="menu-link px-3 py-2 d-flex align-items-center">
                                            <i class="ki-duotone ki-information-3 fs-3 me-3">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                                <span class="path3"></span>
                                            </i>
                                            <span class="menu-title">Contestação</span>
                                        </a>
                                    </div>
                                    <div class="separator my-2" style="border-color: #e1e3ea; opacity: 0.5;"></div>
                                    <div class="menu-item px-3 py-2">
                                        <a href="{{ route('cart.index') }}" class="menu-link px-3 py-2 d-flex align-items-center">
                                            <i class="ki-duotone ki-handcart fs-3 me-3" style="color: #e71d73;">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                                <span class="path3"></span>
                                                <span class="path4"></span>
                                                <span class="path5"></span>
                                            </i>
                                            <span class="menu-title" style="font-size: 1.1em;">Carrinho</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @include('layouts.peaks.usermenu', ['avatar' => optional(Auth::user())->avatar])
    </div>
</div>

