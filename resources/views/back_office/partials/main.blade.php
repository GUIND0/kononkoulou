@include('back_office.partials.header')
<body>
 <!-- Layout wrapper -->
 <div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">
      <!-- Menu -->
      @include('flash-toastr::message')
      @include('back_office.partials.sidebar')
      <!-- / Menu -->

      <!-- Layout container -->
      <div class="layout-page">
        <!-- Navbar -->

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

            <!-- /Search -->

            <ul class="navbar-nav flex-row align-items-center ms-auto">

              <!-- User -->
              @if (auth()->user())
                <li class="nav-item navbar-dropdown dropdown-user dropdown">
                    <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                    <div class="avatar avatar-online">
                        @if (auth()->user()->photo != '' && auth()->user()->photo != null)
                            <img src="/{{ auth()->user()->photo }}" alt class="rounded-circle" />
                        @else
                            <img src="/templatef/assets/avatar.png" alt class="rounded-circle" />
                        @endif
                    </div>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                        <a class="dropdown-item" href="#">
                        <div class="d-flex">
                            <div class="flex-shrink-0 me-3">
                            <div class="avatar avatar-online">
                                @if (auth()->user()->photo != '' && auth()->user()->photo != null)
                                    <img src="/{{ auth()->user()->photo }}" alt class="rounded-circle" />
                                @else
                                    <img src="/templatef/assets/avatar.png" alt class="rounded-circle" />
                                @endif
                            </div>
                            </div>
                            <div class="flex-grow-1">
                            <span class="fw-semibold d-block">{{ auth()->user()->firstname .'  '. auth()->user()->lastname}}</span>

                            @if (auth()->user()->profil->name == "users")
                                <small class="text-muted">Porteur de Projet</small>
                            @else
                                <small class="text-muted">Admin</small>
                            @endif
                            </div>
                        </div>
                        </a>
                    </li>
                    <li>
                        <div class="dropdown-divider"></div>
                    </li>
                    <li>
                        <a class="dropdown-item" href="{{ route('settings.index') }}">
                        <i class="bx bx-user me-2"></i>
                        <span class="align-middle">Mon Profile</span>
                        </a>
                    </li>

                    <li>
                        <div class="dropdown-divider"></div>
                    </li>
                    <li>
                        <a class="dropdown-item" href="{{ route('logout') }}">
                        <i class="bx bx-power-off me-2"></i>
                        <span class="align-middle">Deconnexion</span>
                        </a>
                    </li>
                    </ul>
                </li>
              @else
                    <a class="btn rounded-pill btn-outline-primary" href="{{ route('login')}}">Se connecter</a>

              @endif

              <!--/ User -->
            </ul>
          </div>
        </nav>

        <!-- / Navbar -->

        <!-- Content wrapper -->
        <div class="content-wrapper">
          <!-- Content -->

          <div class="container-xxl flex-grow-1 container-p-y">
                @yield('content')
          </div>
          <!-- / Content -->

          <!-- Footer -->
          <footer class="content-footer footer bg-footer-theme">
            <div class="container-xxl d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column">
              <div class="mb-2 mb-md-0">

                Developpé Par Kononkoulou

              </div>

            </div>
          </footer>
          <!-- / Footer -->

          <div class="content-backdrop fade"></div>
        </div>
        <!-- Content wrapper -->
      </div>
      <!-- / Layout page -->
    </div>

    <!-- Overlay -->
    <div class="layout-overlay layout-menu-toggle"></div>
  </div>
  <!-- / Layout wrapper -->
    @include('back_office.partials.script')
    @yield('script')
</body>
</html>


