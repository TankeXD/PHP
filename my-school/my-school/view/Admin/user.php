<?php include '../../layouts/session.php'; ?>
<?php include '../../layouts/main.php'; ?>

<head>

    <?php includeFileWithVariables('../../layouts/title-meta.php', array('title' => 'Creación')); ?>
    <?php include '../../layouts/head2.php'; ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        .sidebar-label {
            color: #ffffff;

        }

        .sidebar-label:hover {
            color: #25a0e2;
        }
    </style>

</head>

<body>

    <!-- Begin page -->
    <div id="layout-wrapper">

        <?php include '../../layouts/topbar-admin.php'; ?>
        <?php include '../../layouts/sidebar.php'; ?>

        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">

            <div class="page-content">
                <div class="container-fluid">
                    <a href="view-admins.php">
                        <?php includeFileWithVariables('../../layouts/page-title.php', array('pagetitle' => 'Administradores', 'title' => 'Crear Nuevo Administrador')); ?>
                    </a>
                </div>
                <!-- container-fluid -->

                <div class="d-flex justify-content-center">
                    <div class="col-lg-6">
                        <form action="../../Models/Crud-user/insert-user.php" method="POST" onsubmit="confirmacion(event)">
                            <div class="container">
                                <div class="row mb-3">
                                    <div class="col-lg-3">
                                        <label for="username" class="form-label">Nombre y Apellidos</label>
                                    </div>
                                    <div class="col-lg-9">
                                        <input type="text" id="username" name="username" class="form-control" placeholder="Ingrese Nombre" required>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-lg-3">
                                        <label for="password-input" class="form-label">Contraseña</label>
                                    </div>
                                    <div class="col-lg-9">
                                        <div class="position-relative auth-pass-inputgroup mb-3">
                                            <input type="password" id="password-input" class="form-control password-input" placeholder="Ingrese Contraseña" name="password" />
                                            <span class="position-absolute end-0 top-0 mt-2 me-2" style="cursor: pointer;">
                                                <i id="toggle-password" class="ri-eye-fill align-middle"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-lg-3">
                                        <label for="email" class="form-label">Correo Electrónico</label>
                                    </div>
                                    <div class="col-lg-9">
                                        <input type="email" name="email" class="form-control" placeholder="Ingrese Correo Electrónico" required>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-lg-3">
                                        <label for="fecha_nac" class="form-label">Fecha de Nacimiento</label>
                                    </div>
                                    <div class="col-lg-9">
                                        <input type="date" name="fecha_nac" class="form-control" required>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-lg-3">
                                        <label for="rol" class="form-label">Tipo de Cargo</label>
                                    </div>
                                    <div class="col-lg-9">
                                        <select name="rol" class="form-select" aria-label="Seleccione Rol" required>
                                            <option selected disabled>Seleccione un Rol</option>
                                            <option value="Super Admin">Súper Administrador</option>
                                            <option value="Admin General">Administrador General</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-lg-12 text-center">
                                        <form onsubmit="confirmacion(event)">
                                            <input type="submit" class="btn btn-primary" value="Guardar">
                                        </form>
                                    </div>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include '../../layouts/footer.php'; ?>
    <?php include '../../layouts/vendor-scripts 2.php'; ?>
    <script src="../../assets/js/app.js"></script>
    <!-- este script para poner en mayusculas automaticamente -->
    <script>
        document.getElementById("username").addEventListener("keyup", function() {
            this.value = this.value.toUpperCase();
        });
    </script>
    <!-- scrip para alerta de ingreso correcto -->
    <script>
        document.getElementById('toggle-password').addEventListener('click', function() {
            var passwordInput = document.getElementById('password-input');
            var toggleIcon = document.getElementById('toggle-password');
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.classList.remove('ri-eye-fill');
                toggleIcon.classList.add('ri-eye-off-fill');
            } else {
                passwordInput.type = 'password';
                toggleIcon.classList.remove('ri-eye-off-fill');
                toggleIcon.classList.add('ri-eye-fill');
            }
        });

        function confirmacion(event) {
            // Evita que el formulario se envíe automáticamente
            event.preventDefault();
            Swal.fire({
                position: "center",
                icon: "success",
                title: "¡Administrador Registrado Con Éxito!",
                showConfirmButton: false,
                timer: 1500
            }).then(() => {
                // Si deseas proceder con el envío del formulario después de mostrar la alerta
                event.target.submit();
            });
        }
    </script>
    
    

</body>

</html>