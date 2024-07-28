<?php
// ternarios para imprimir username y rol
$id_cliente = isset($_SESSION['id_cliente']) ? $_SESSION['id_cliente'] : null;
?>

<!-- ========== App Menu ========== -->
<div class="app-menu navbar-menu" style="background-color: #FFFFFF;">
    <!-- LOGO -->
    <div class="navbar-brand-box">
        <!-- Dark Logo-->
        <a href="major.php" class="logo logo-dark">
            <span class="logo-sm">
                <img src="assets/images/LogoTopBar.png" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="assets/images/LogoTopBar.png" alt="" height="17">
            </span>
        </a>
        <!-- Light Logo-->
        <a href="major.php" class="logo logo-light">
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
            <ul class="navbar-nav">
                <li class="menu-title"><span data-key="t-menu">Menu</span></li>
                <li class="nav-item">
                    <a href="/my-school/index.php" class="nav-link">
                        <i class="ri-home-4-line"></i> <span>Inicio</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/my-school/index.php" class="nav-link">
                        <i class=" ri-parent-line"></i> <span>Alumnos</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="" class="nav-link">
                        <i class=" ri-truck-line"></i> <span>Pedidos</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>

</div>
<!-- Sidebar -->
</div>
<!--ingresar una lista con todos los clientes un boton añadir y 3 botones visualizar, eliminar y editar-->
<div class="sidebar-background"></div>
</div>
<!-- Left Sidebar End -->
<!-- Vertical Overlay-->
<div class="vertical-overlay"></div>