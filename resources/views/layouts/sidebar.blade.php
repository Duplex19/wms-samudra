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

    <!-- Layouts -->
    <li class="menu-item {{ Request::is('wms/config/router') ? 'active' : '' }}">
        <a href="{{ route('wms.router') }}" class="menu-link">
            <i class='bx  bx-grid-circle-diagonal-left'  ></i> 
        <i class="menu-icon tf-icons bx bx-directions"></i>
        <div data-i18n="Basic">Router</div>
        </a>
    </li>
    <li class="menu-item {{ Request::is('wms/config/profile_ppp') ? 'active' : '' }}">
        <a href="{{ route('wms.profile_ppp') }}" class="menu-link">
        <i class="menu-icon tf-icons bx bx-user"></i>
        <div data-i18n="Basic">Profil PPP</div>
        </a>
    </li>
   <li class="menu-item {{ Request::is('wms/config/pppoe') ? 'active' : '' }}">
        <a href="{{ route('wms.pppoe') }}" class="menu-link">
        <i class="menu-icon tf-icons bx bx-vector"></i>
        <div data-i18n="Basic">Pppoe</div>
        </a>
    </li>
    <li class="menu-item {{ Request::is('wms/config/vpn') ? 'active' : '' }}">
        <a href="{{ route('wms.vpn') }}" class="menu-link">
        <i class="menu-icon tf-icons bx bx-server"></i>
        <div data-i18n="Basic">VPN Server</div>
        </a>
    </li>
    <li class="menu-item {{ Request::is('wms/config/template_whatsapp') ? 'active' : '' }}">
        <a href="{{ route('wms.templateWhatsapp') }}" class="menu-link">
        <i class='menu-icon bx  bx-message-detail'  ></i> 
        <div data-i18n="Basic">Template WhatsApp</div>
        </a>
    </li>
        <li class="menu-item {{ Request::is('wms/member/invoice') ? 'active' : '' }}">
        <a href="{{ route('wms.member.invoice') }}" class="menu-link">
        <i class="menu-icon icon-base bx bx-food-menu"></i>
        <div data-i18n="Basic">Penagihan</div>
        </a>
    </li>
    <li class="menu-item {{ Request::is('wms/config/setting*') ? 'active' : '' }}">
        <a href="{{ route('wms.sechedule') }}" class="menu-link">
        <i class="menu-icon icon-base bx bx-cog"></i>
        <div data-i18n="Basic">Pengaturan</div>
        </a>
    </li>


    {{-- <li class="menu-header small text-uppercase">
        <span class="menu-header-text">Anggota</span>
    </li>
     <li class="menu-item">
        <a href="#" class="menu-link">
        <i class="menu-icon tf-icons bx bx-group"></i>
        <div data-i18n="Basic">Anggota</div>
        </a>
    </li>
    <li class="menu-header small text-uppercase">
        <span class="menu-header-text">Kegunaan</span>
    </li>
     <li class="menu-item">
        <a href="#" class="menu-link">
        <i class="menu-icon tf-icons bx bx-map"></i>
        <div data-i18n="Basic">Map</div>
        </a>
    </li> --}}
    </ul>
</aside>
