<?php
// ternarios para imprimir username y rol
$nombre_usuario = isset($_SESSION['username']) ? $_SESSION['username'] : "Usuario";
$rol = isset($_SESSION['rol']) ? $_SESSION['rol'] : "Cargo";
?>


<header id="page-topbar" style="background-color: rgba(228, 226, 226, 1);">
    <div class="layout-width">
        <div class="navbar-header">
            <div class="d-flex">
                <!-- LOGO para que se vea solo en horizontal-->
                <div class="navbar-brand-box horizontal-logo">
                    <a href="index" class="logo logo-dark">
                        <span class="logo-sm">
                            <img src="../../assets/images/LogoTopBar.png" alt="" height="22">
                        </span>
                        <span class="logo-lg">
                            <img src="../../assets/images/LogoTopBar.png" alt="" height="17">
                        </span>
                    </a>

                    <a href="index" class="logo logo-light">
                        <span class="logo-sm">
                            <img src="../../assets/images/LogoTopBar.png" alt="" height="22">
                        </span>
                        <span class="logo-lg">
                            <img src="../../assets/images/LogoTopBar.png" alt="" height="17">
                        </span>
                    </a>
                </div>
                <!--empieza topbar-->
                <button type="button" class="btn btn-sm px-3 fs-16 header-item vertical-menu-btn topnav-hamburger" id="topnav-hamburger-icon">
                    <span class="hamburger-icon">
                        <span></span>
                        <span></span>
                        <span></span>
                    </span>
                </button>
            </div>

            <div class="d-flex align-items-center">
                <!--Perfil de usuario-->
                <div class="dropdown ms-sm-3 header-item topbar-user" style="background-color: rgba(228, 226, 226, 1);">
                    <button type="button" class="btn" id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="d-flex align-items-center">
                            <span class="text-start ms-xl-2">
                                <span class="d-none d-xl-inline-block ms-1 fw-medium user-name-text" style="color: rgba(88, 115, 255, 1);"><?php echo $nombre_usuario; ?></span>
                                <span class="d-none d-xl-block ms-1 fs-12 user-name-sub-text" style="color: rgba(114, 136, 255, 1);"><?php echo $rol; ?></span>
                            </span>
                        </span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end">
                        <a class="dropdown-item" href="/my-school/view/Logout/logout.php"><i class="mdi mdi-logout text-muted fs-16 align-middle me-1"></i> <span class="align-middle" data-key="t-logout">Cerrar Sesión</span></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>