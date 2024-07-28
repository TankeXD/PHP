<header id="page-topbar">
    <div class="layout-width">
        <div class="navbar-header">
            <div class="d-flex">
                <!-- LOGO para que se vea solo en horizontal-->
                <div class="navbar-brand-box horizontal-logo">
                    <a href="index" class="logo logo-dark">
                        <span class="logo-sm">
                            <img src="assets/images/LogoTopBar.png" alt="" height="22">
                        </span>
                        <span class="logo-lg">
                            <img src="assets/images/LogoTopBar.png" alt="" height="17">
                        </span>
                    </a>

                    <a href="index" class="logo logo-light">
                        <span class="logo-sm">
                            <img src="assets/images/LogoTopBar.png" alt="" height="22">
                        </span>
                        <span class="logo-lg">
                            <img src="assets/images/LogoTopBar.png" alt="" height="17">
                        </span>
                    </a>
                </div>

              
               
               
            </div>
            <!--empieza topbar-->
            <div class="d-flex align-items-center">

                <!--button de fullscreen-->
                <div class="ms-1 header-item d-none d-sm-flex">
                    <button type="button" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle" data-toggle="fullscreen">
                        <i class='bx bx-fullscreen fs-22'></i>
                    </button>
                </div>

                <!--button de white or black-->
                <div class="ms-1 header-item d-none d-sm-flex">
                    <button type="button" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle light-dark-mode">
                        <i class='bx bx-moon fs-22'></i>
                    </button>
                </div>

              <!--Perfil de usuario-->
                <div class="dropdown ms-sm-3 header-item topbar-user">
                    <button type="button" class="btn" id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="d-flex align-items-center">
                            <img class="rounded-circle header-profile-user" src="assets/images/users/user-dummy-img.jpg" alt="Header Avatar">
                            <span class="text-start ms-xl-2">
                                <span class="d-none d-xl-inline-block ms-1 fw-medium user-name-text">Daniel González</span>
                                <span class="d-none d-xl-block ms-1 fs-12 user-name-sub-text">Administrador</span>
                            </span>
                        </span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end">
                        <a class="dropdown-item" href="auth-logout-basic"><i class="mdi mdi-logout text-muted fs-16 align-middle me-1"></i> <span class="align-middle" data-key="t-logout">Cerrar Sesión</span></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>


