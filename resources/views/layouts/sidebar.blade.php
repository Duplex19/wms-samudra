<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="#" class="app-brand-link">
            <img src="{{ asset('assets/img/logo/samudra-wasesa.png') }}" alt="logo" width="35">
            <span class="app-brand-text demo menu-text fw-bolder ms-2" style="color: #2563eb">Samudra</span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        <!-- Dashboard -->
        <li class="menu-item {{ Request::is('wms/dashboard') ? 'active' : '' }}">
            <a href="{{ route('wms.dashboard') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-building-house"></i>
                <div data-i18n="Analytics">Dashboard</div>
            </a>
        </li>
        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">{{ __('cms.sidebar_registration') }}</span>
        </li>
        <li class="menu-item {{ Request::is('wms/registration') ? 'active' : '' }}">
            <a href="{{ route('wms.registrationx') }}" class="menu-link">
                <i class="menu-icon icon-base bx bx-user-plus"></i>
                <div data-i18n="Basic">{{ __('cms.sidebar_customer_registration') }}</div>
            </a>
        </li>
        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">{{ __('cms.sidebar_network') }}</span>
        </li>

        <li class="menu-item {{ Request::is('wms/config/pppoe') ? 'active open' : '' }} {{ Request::is('wms/config/profile_ppp') ? 'active open' : '' }}"
            style="">
            <a href="javascript:void(0);" class="menu-link menu-toggle ">
                {{-- <i class="menu-icon tf-icons bx bx-dock-top"></i> --}}
                <i class="menu-icon tf-icons bx bx-vector"></i>
                <div data-i18n="Account Settings">PPPoE</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item {{ Request::is('wms/config/pppoe') ? 'active' : '' }}">
                    <a href="{{ route('wms.pppoe') }}" class="menu-link">
                        <div data-i18n="Account">{{ __('cms.sidebar_user') }}</div>
                    </a>
                </li>
                <li class="menu-item {{ Request::is('wms/config/profile_ppp') ? 'active' : '' }}">
                    <a href="{{ route('wms.profile_ppp') }}" class="menu-link">
                        <div data-i18n="Notifications">{{ __('cms.sidebar_profile') }}</div>
                    </a>
                </li>
            </ul>
        </li>

        <li class="menu-item {{ Request::is('wms/config/vpn') ? 'active open' : '' }} {{ Request::is('wms/config/router') ? 'active open' : '' }}"
            style="">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon icon-base bx bx-cog"></i>
                <div data-i18n="Account Settings">{{ __('cms.sidebar_setting') }}</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item {{ Request::is('wms/config/vpn') ? 'active' : '' }}">
                    <a href="{{ route('wms.vpn') }}" class="menu-link">
                        <div data-i18n="Account">VPN Server</div>
                    </a>
                </li>
                <li class="menu-item {{ Request::is('wms/config/router') ? 'active' : '' }}">
                    <a href="{{ route('wms.router') }}" class="menu-link">
                        <div data-i18n="Notifications">Router</div>
                    </a>
                </li>
            </ul>
        </li>


        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">{{ __('cms.sidebar_finance') }}</span>
        </li>
        {{-- <li class="menu-item {{ Request::is('wms/balance') ? 'active' : '' }}">
            <a href="{{ route('finance.balance') }}" class="menu-link">
                <i class="menu-icon icon-base bx bx-wallet-alt"></i>
                <div data-i18n="Basic">{{ __('cms.sidebar_balance') }}</div>
            </a>
        </li> --}}
        <li class="menu-item {{ request()->routeIs('finance.transaction') ? 'active' : '' }}">
            <a href="{{ route('finance.transaction') }}" class="menu-link">
                <i class="menu-icon icon-base bx bx-dollar-circle"></i>
                <div data-i18n="Basic">{{ __('cms.sidebar_transaction') }}</div>
            </a>
        </li>
        <li class="menu-item {{ Request::is('wms/member*') ? 'active open' : '' }} {{ Request::is('wms/config/setting*') ? 'active open' : '' }}"
            style="">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon icon-base bx bx-food-menu"></i>
                <div data-i18n="Account Settings">{{ __('cms.sidebar_monthly_billing') }}</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item {{ Request::is('wms/member/customer') ? 'active' : '' }}">
                    <a href="{{ route('wms.member.customer') }}" class="menu-link">
                        <div data-i18n="Account">{{ __('cms.sidebar_member') }}</div>
                    </a>
                </li>
                <li class="menu-item {{ Request::is('wms/member/invoice') ? 'active' : '' }}">
                    <a href="{{ route('wms.member.invoice') }}" class="menu-link">
                        <div data-i18n="Notifications">{{ __('cms.sidebar_billing') }}</div>
                    </a>
                </li>
                <li class="menu-item {{ Request::is('wms/config/setting*') ? 'active' : '' }}">
                    <a href="{{ route('wms.sechedule') }}" class="menu-link">
                        <div data-i18n="Notifications">{{ __('cms.sidebar_setting') }}</div>
                    </a>
                </li>
            </ul>
        </li>
        <li class="menu-item">
            <a href="#" class="menu-link">
                <i class="menu-icon icon-base bx bx-edit"></i>
                <div data-i18n="Basic">{{ __('cms.sidebar_manual_billing') }}</div>
            </a>
        </li>
        <li class="menu-item {{ Request::is('wms/salary*') ? 'active' : '' }}">
            <a href="{{ route('finance.salary') }}" class="menu-link">
                <i class="menu-icon icon-base bx bx-receipt"></i>
                <div data-i18n="Basic">{{ __('cms.salary') }}</div>
            </a>
        </li>
        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">{{ __('cms.sidebar_tim_management') }}</span>
        </li>
        <li class="menu-item {{ Request::is('wms/users') ? 'active' : '' }}">
            <a href="{{ route('wms.users.index') }}" class="menu-link">
                <i class="menu-icon icon-base bx bx-user"></i>
                <div data-i18n="Basic">User</div>
            </a>
        </li>
        {{-- <li class="menu-item {{ Request::is('wms/registration') ? 'active' : '' }}">
            <a href="{{ route('wms.registrationx') }}" class="menu-link">
                <i class="menu-icon icon-base bx bx-user-plus"></i>
                <div data-i18n="Basic">Registrasi</div>
            </a>
        </li> --}}
        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">System</span>
        </li>
        <li class="menu-item {{ Request::is('wms/services/log') ? 'active' : '' }}">
            <a href="{{ route('wms.log') }}" class="menu-link">
                <i class="menu-icon icon-base bx bx-list-ul"></i>
                <div data-i18n="Basic">Log</div>
            </a>
        </li>
    </ul>
</aside>
