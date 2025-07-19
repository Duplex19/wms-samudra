<nav
class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
id="layout-navbar"
>
<div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
    <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
    <i class="bx bx-menu bx-sm"></i>
    </a>
</div>

<div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
    <!-- Search -->
    <div class="navbar-nav align-items-center">
      <div class="nav-item d-flex align-items-center">
          <i class="bx bx-search fs-4 lh-0"></i>
          <input
          type="text"
          class="form-control border-0 shadow-none"
          placeholder="Search..."
          />
      </div>
    </div>
    <!-- /Search -->

    <ul class="navbar-nav flex-row align-items-center ms-auto">
        <li class="nav-item dropdown me-2 me-xl-0">
          <a class="nav-link dropdown-toggle hide-arrow" id="nav-theme" href="javascript:void(0);" data-bs-toggle="dropdown">
            <i class="icon-base bx bx-sun icon-md theme-icon-active"></i>
            <span class="d-none ms-2" id="nav-theme-text">Toggle theme</span>
          </a>
          <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="nav-theme-text">
            <li>
              <button type="button" class="dropdown-item align-items-center active" data-bs-theme-value="light" aria-pressed="false">
                <span><i class="icon-base bx bx-sun icon-md me-3" data-icon="sun"></i>Light</span>
              </button>
            </li>
            <li>
              <button type="button" class="dropdown-item align-items-center" data-bs-theme-value="dark" aria-pressed="true">
                <span><i class="icon-base bx bx-moon icon-md me-3" data-icon="moon"></i>Dark</span>
              </button>
            </li>
            <li>
              <button type="button" class="dropdown-item align-items-center" data-bs-theme-value="system" aria-pressed="false">
                <span><i class="icon-base bx bx-desktop icon-md me-3" data-icon="desktop"></i>System</span>
              </button>
            </li>
          </ul>
        </li>

    <!-- User -->
    <li class="nav-item navbar-dropdown dropdown-user dropdown">
        <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
        <div class="avatar avatar-online">
            <img src="https://ui-avatars.com/api/?background=2563eb&name={{ session('user_data.name') }}&color=fff" alt class="w-px-40 h-auto rounded-circle" />
        </div>
        </a>
        <ul class="dropdown-menu dropdown-menu-end">
        <li>
            <a class="dropdown-item" href="#">
            <div class="d-flex">
                <div class="flex-shrink-0 me-3">
                <div class="avatar avatar-online">
                    <img src="https://ui-avatars.com/api/?background=2563eb&name=Dev KH&color=fff" alt class="w-px-40 h-auto rounded-circle" />
                </div>
                </div>
                <div class="flex-grow-1">
                <span class="fw-semibold d-block">Devkh</span>
                <small class="text-muted">Admin</small>
                </div>
            </div>
            </a>
        </li>
        <li>
            <div class="dropdown-divider"></div>
        </li>
        <li>
            <a class="dropdown-item" href="#">
            <i class="bx bx-user me-2"></i>
            <span class="align-middle">My Profile</span>
            </a>
        </li>
        <li>
            <div class="dropdown-divider"></div>
        </li>
        <li>
            <a class="dropdown-item" href="javascript:void()" onclick="logOut()">
            <i class="bx bx-power-off me-2"></i>
            <span class="align-middle">Log Out</span>
            </a>
        </li>
        </ul>
    </li>
    <!--/ User -->
    </ul>
</div>
</nav>