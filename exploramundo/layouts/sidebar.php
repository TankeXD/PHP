<!-- ========== App Menu ========== -->
<div class="app-menu navbar-menu">
    <!-- LOGO -->
    <div class="navbar-brand-box">
        <!-- Dark Logo-->
        <a href="principal.php" class="logo logo-dark">
            <span class="logo-sm">
                <img src="assets/images/LogoTopBar.png" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="assets/images/LogoTopBar.png" alt="" height="17">
            </span>
        </a>
        <!-- Light Logo-->
        <a href="principal.php" class="logo logo-light">
            <span class="logo-sm">
                <img src="assets/images/LogoTopBar.png" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="assets/images/LogoTopBar.png" alt="" height="35">
            </span>
        </a>
        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover" id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>
    </div>

    <div id="scrollbar">
        <div class="container-fluid">

            <div id="two-column-menu">
            </div>
            <ul class="navbar-nav" id="navbar-nav">
                <li class="menu-title"><span data-key="t-menu">Menu</span></li>
                <li class="nav-item">
                    <!--APARTADO DE USUARIO SIDEBAR-->
                    <a class="nav-link menu-link" href="#sidebarAdmin" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarDashboards">
                        <i class="mdi mdi-account-tie"></i> <span data-key="t-dashboard">Administradores</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarAdmin">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="Usuario.php" class="nav-link" data-key="t-crm">Registro Administradores</a>
                            </li>
                            <li class="nav-item">
                                <a href="ver_Usuarios.php" class="nav-link" data-key="t-ecommerce">Ver Administradores</a>
                            </li>
                </li>
            </ul>
        </div>
        <!--APARTADO DE Clientes SIDEBAR-->
        <li class="nav-item">
            <a class="nav-link menu-link" href="#sidebarClientes" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarApps">
                <i class="mdi mdi-account-group-outline"></i> <span data-key="t-apps">Clientes</span>
            </a>
            <div class="collapse menu-dropdown" id="sidebarClientes">
                <ul class="nav nav-sm flex-column">
                    <li class="nav-item">
                        <a href="clientes.php" class="nav-link" data-key="t-calendar">Registro Clientes</a>
                    </li>
                    <li class="nav-item">
                        <a href="ver_clientes.php" class="nav-link" data-key="t-chat">Ver Clientes</a>
                    </li>
                </ul>
            </div>
        </li>
        <!--APARTADO DE Reservas SIDEBAR-->
        <li class="nav-item">
            <a class="nav-link menu-link" href="#sidebarReservas" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarApps">
                <i class="ri-todo-line"></i> <span data-key="t-apps">Reservas</span>
            </a>
            <div class="collapse menu-dropdown" id="sidebarReservas">
                <ul class="nav nav-sm flex-column">
                    <li class="nav-item">
                        <a href="reservas.php" class="nav-link" data-key="t-calendar">Registro Reservas</a>
                    </li>
                    <li class="nav-item">
                        <a href="ver_reservas.php" class="nav-link" data-key="t-chat">Ver Reservas</a>
                    </li>
                </ul>
            </div>
        </li>
        <!--APARTADO DE PAQUETES SIDEBAR-->
        <li class="nav-item">
            <a href="#sidebarPaquete" class="nav-link" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarEcommerce" data-key="t-ecommerce">
                <i class="mdi mdi-package-variant-closed"></i> <span data-key="t-apps">Paquetes</span>
            </a>
            <div class="collapse menu-dropdown" id="sidebarPaquete">
                <ul class="nav nav-sm flex-column">
                    <li class="nav-item">
                        <a href="paquetes.php" class="nav-link" data-key="t-products">Registro Paquetes</a>
                    </li>
                    <li class="nav-item">
                        <a href="ver_paquetes" class="nav-link" data-key="t-product-Details">Ver Paquetes</a>
                    </li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a href="index.php" class="nav-link" data-key="t-products">
                <i class="mdi mdi-logout"></i> <span data-key="t-apps">Cerrar Sesión</span>
            </a>
        </li>
    </div>
    <!-- Sidebar -->
</div>
<!--ingresar una lista con todos los clientes un boton añadir y 3 botones visualizar, eliminar y editar-->
<div class="sidebar-background"></div>
</div>
<!-- Left Sidebar End -->
<!-- Vertical Overlay-->
<div class="vertical-overlay"></div>