<div class="app-navbar-item ms-4 ms-md-5" id="kt_header_user_menu_toggle">
    <div class="cursor-pointer symbol symbol-circle symbol-md-40px" data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end">
        @if (empty($avatar))
            <img src="{{ asset('assets/images/avatars/blank.png') }}" alt="user" />
        @else
            <img src="{{ asset('storage/'.$avatar) }}" alt="user" />
        @endif
    </div>
    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-color fw-semibold py-4 fs-6 w-275px"
        data-kt-menu="true">
        <div class="menu-item px-3">
            <div class="menu-content d-flex align-items-center px-3">
                <div class="symbol symbol-circle symbol-50px me-5">
                    @if (empty($avatar))
                        <img class="border-active-danger" src="{{ asset('assets/images/avatars/blank.png') }}" alt="user" />
                    @else
                        <img src="{{ asset('storage/'.$avatar) }}" alt="user" />
                    @endif
                </div>
                <div class="d-flex flex-column">
                    <div class="fw-bold d-flex align-items-center fs-5">
                        {{ Auth::user()->name }}
                    </div>
                    <span class="fw-semibold text-muted text-hover-primary fs-7">
                        {{ Auth::user()->email }}
                    </span>
                </div>
            </div>
        </div>

        <div class="separator my-2"></div>

        <div class="menu-item px-5">
            <a href="{{ route('profile.index') }}" class="menu-link px-5">Perfil do usuário</a>
        </div>

        <div class="menu-item px-5 my-1">
            <a href="{{route('myplan.index')}}" class="menu-link px-5">
                <span class="menu-title position-relative">
                    Meu Plano
                    <span class="fs-8 rounded bg-light px-3 py-2 position-absolute translate-middle-y top-50 end-0 d-flex align-items-center">
                        {{ Auth::user()->getPlanName() }}
                        @if(Auth::user()->isBasicPlan())
                        <i class="ki-duotone ki-award fs-4 ms-2">
                            <span class="path1" style="color: #6c757d"></span>
                            <span class="path2" style="color: #080808"></span>
                            <span class="path3" style="color: #080808"></span>
                        </i>
                        @elseif(Auth::user()->isIndividualPlan())
                        <i class="ki-duotone ki-award fs-4 ms-2">
                            <span class="path1" style="color:rgb(250, 165, 7)"></span>
                            <span class="path2" style="color:rgb(7, 185, 37)"></span>
                            <span class="path3" style="color:rgb(153, 5, 146)"></span>
                        </i>
                        @elseif(Auth::user()->isTeamsPlan())
                        <i class="ki-duotone ki-award fs-4 ms-2">
                            <span class="path1" style="color:rgb(31, 30, 30)"></span>
                            <span class="path2" style="color:rgb(255, 4, 121)"></span>
                            <span class="path3" style="color:rgb(250, 56, 8)"></span>
                        </i>
                        @elseif(Auth::user()->isEnterprisePlan())
                        <i class="ki-duotone ki-award fs-4 ms-2">
                            <span class="path1" style="color: #f7bd01"></span>
                            <span class="path2" style="color: #f7140c"></span>
                            <span class="path3" style="color:rgb(250, 172, 28)"></span>
                        </i>
                        @endif
                    </span>
                </span>
            </a>
        </div>

        @canany(['admin', 'suadmin'])
        <div class="separator my-2"></div>
        <div class="menu-item px-5 my-1">
            <a href="{{ route('admin.index') }}" class="menu-link px-5 text-info">Admin Area</a>
        </div>
        @endcanany
        <div class="separator my-2"></div>

        <div class="menu-item px-5">
            <a class="text-danger menu-link px-5" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="bx bx-power-off font-size-18 align-middle text-danger"></i>
                <span class="text-danger m-1">Sair do sistema</span>
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </div>
    </div>
</div>