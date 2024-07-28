<div class="app-menu navbar-menu" style="background-color: #0A2B3D;">
    <!-- LOGO -->
    <div class="navbar-brand-box">

        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover" id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>
    </div>

    <div id="scrollbar">
        <div class="container-fluid">

            <div id="two-column-menu">
            </div>
            <ul class="navbar-nav" id="navbar-nav">
                <!-- APARATADO DE MENU -->
                <li class="menu-title"><span data-key="t-menu">Menu</span></li>
                <!-- APARTADO DE INICIO -->
                <li class="nav-item">
                    <a href="/my-school/major.php" class="nav-link menu-link">
                        <i class=" ri-home-4-line sidebar-label"></i> <span class="sidebar-label">Inicio</span>
                    </a>
                </li>
                <?php
                $nombre_usuario = isset($_SESSION['username']) ? $_SESSION['username'] : "Usuario";
                $rol = isset($_SESSION['rol']) ? $_SESSION['rol'] : "Cargo";
                if ($rol == "Super Admin") {
                    // Mostrar contenido para superadministradores
                ?>
                    <!-- APARTADO DE USUARIO SIDEBAR -->
                    <li class="nav-item">
                        <a class="nav-link menu-link" href="#sidebarAdmin" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarDashboards">
                            <i class="mdi mdi-account-tie sidebar-label "></i> <span class="sidebar-label">Administradores</span>
                        </a>
                        <div class="collapse menu-dropdown" id="sidebarAdmin">
                            <ul class="nav nav-sm flex-column">
                                <li class="nav-item">
                                    <a href="/my-school/view/Admin/user.php" class="nav-link">Crear Nuevo Admin</a>
                                    <!-- aquí para la ruta desde el origen -->
                                </li>
                                <li class="nav-item">
                                    <a href="/my-school/view/Admin/view-admins.php" class="nav-link">Gestión de Admins</a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    <!--APARTADO DE APODERADOS-->
                    <li class="nav-item">
                        <a href="/my-school/view/Client/view-clients.php" class="nav-link menu-link" role="button" aria-expanded="false">
                            <i class="mdi mdi-account-group-outline sidebar-label"></i><span class="sidebar-label">Apoderados</span>
                        </a>
                    </li>
                <?php
                } elseif ($rol == "Admin General") {
                }
                ?>

                <!-- APARTADO DE REGION Y COMUNA -->
                <li class="nav-item">

                    <a class="nav-link menu-link" href="#Regiones" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarDashboards">
                        <i class="las la-globe sidebar-label"></i> <span class="sidebar-label">Regiones</span>
                    </a>
                    <div class="collapse menu-dropdown" id="Regiones">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="/my-school/view/Region/regions?id=1" class="nav-link ">Arica y Parinacota</a>
                                <!-- aqui para la ruta desde el origen  -->
                            </li>
                            <li class="nav-item">
                                <a href="/my-school/view/Region/regions?id=2" class="nav-link">Tarapaca</a>
                            </li>
                            <li class="nav-item">
                                <a href="/my-school/view/Region/regions?id=3" class="nav-link">Antofagasta</a>
                            </li>
                            <li class="nav-item">
                                <a href="/my-school/view/Region/regions?id=4" class="nav-link">Atacama</a>
                            </li>
                            <li class="nav-item">
                                <a href="/my-school/view/Region/regions?id=5" class="nav-link">Coquimbo</a>
                            </li>
                            <li class="nav-item">
                                <a href="/my-school/view/Region/regions?id=6" class="nav-link">Valparaíso</a>
                            </li>
                            <li class="nav-item">
                                <a href="/my-school/view/Region/regions?id=7" class="nav-link">Metropolitana</a>
                            </li>
                            <li class="nav-item">
                                <a href="/my-school/view/Region/regions?id=8" class="nav-link">O'Higgins</a>
                            </li>
                            <li class="nav-item">
                                <a href="/my-school/view/Region/regions?id=9" class="nav-link">Maule</a>
                            </li>
                            <li class="nav-item">
                                <a href="/my-school/view/Region/regions?id=10" class="nav-link">Ñuble</a>
                            </li>
                            <li class="nav-item">
                                <a href="/my-school/view/Region/regions?id=11" class="nav-link">Biobío</a>
                            </li>
                            <li class="nav-item">
                                <a href="/my-school/view/Region/regions?id=12" class="nav-link">La Araucanía</a>
                            </li>
                            <li class="nav-item">
                                <a href="/my-school/view/Region/regions?id=13" class="nav-link">Los Ríos</a>
                            </li>
                            <li class="nav-item">
                                <a href="/my-school/view/Region/regions?id=14" class="nav-link">Los Lagos</a>
                            </li>
                            <li class="nav-item">
                                <a href="/my-school/view/Region/regions?id=15" class="nav-link">Aysén</a>
                            </li>
                            <li class="nav-item">
                                <a href="/my-school/view/Region/regions?id=16" class="nav-link">Magallanes y Antartica</a>
                            </li>
                    </div>
                </li>
                <!-- APARTADO DE COLEGIO Y CURSO -->
                <li class="nav-item">

                    <a class="nav-link menu-link" href="#sidebarColegio_Curso" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarDashboards">
                        <i class="las la-university sidebar-label"></i> <span class="sidebar-label">Establecimientos</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarColegio_Curso">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="/my-school/view/School/list-school.php" class="nav-link">Colegios</a>
                                <!-- aqui para la ruta desde el origen  -->
                            </li>
                            <li class="nav-item">
                                <a href="/my-school/view/Course/add-course.php" class="nav-link">Agregar Curso</a>
                            </li>
                            <li class="nav-item">
                                <a href="/my-school/view/Course/filter-course.php" class="nav-link">Lista de Cursos</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <!-- APARTADO DE PRODUCTO Y CATEGORIA -->
                <li class="nav-item">
                    <a href="#sidebarComercio" class="nav-link menu-link" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="sidebarEcommerce">
                        <i class="mdi mdi-package-variant-closed sidebar-label"></i> <span class="sidebar-label">Comercio</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarComercio">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="/my-school/view/Product/management-product.php" class="nav-link" data-key="t-order-details"> Gestion de Productos </a>
                            </li>

                        </ul>
                <!-- APARTADO DE VISTA PEDIDOS -->
                <li class="nav-item">
                    <a href="/my-school/view/Order/table-orders.php" class="nav-link menu-link" role="button" aria-expanded="false">
                        <i class=" ri-file-list-2-line sidebar-label"></i><span class="sidebar-label">Gestión de Pedidos</span>
                    </a>
                </li>
                <!-- APARTADO DE LOGOUT -->
                <li class="nav-item">
                    <a href="/my-school/view/Logout/logout.php" class="nav-link menu-link">
                        <i class="mdi mdi-logout sidebar-label"></i> <span class="sidebar-label">Cerrar Sesión</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>

<!--ingresar una lista con todos los clientes un boton añadir y 3 botones visualizar, eliminar y editar-->
<div class="sidebar-background"></div>
</div>
<!-- Left Sidebar End -->
<!-- Vertical Overlay-->
<div class="vertical-overlay"></div>