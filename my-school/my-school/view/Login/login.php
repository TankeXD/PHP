<!DOCTYPE html>
<html lang="es">
<?php include '../../layouts/main.php'; ?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include '../../layouts/head2.php'; ?>
    <?php includeFileWithVariables('../../layouts/title-meta.php', array('title' => 'Iniciar Sesión')); ?>
    <!-- Incluir Remix Icon -->
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
</head>

<body>
    <div class="auth-page-wrapper pt-5">
        <!-- auth page bg -->
        <div class="auth-one-bg-position auth-one-bg" id="auth-particles">
            <div class="bg-overlay"></div>
            <div class="shape">
                <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 1440 120">
                    <path d="M 0,36 C 144,53.6 432,123.2 720,124 C 1008,124.8 1296,56.8 1440,40L1440 140L0 140z"></path>
                </svg>
            </div>
        </div>

        <!-- auth page content -->
        <div class="auth-page-content">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-center mt-sm-5 mb-4 text-white-50">
                            <div>
                                <a href="index.php" class="d-inline-block auth-logo">
                                    <img src="assets/images/material-escolar.png" alt="" height="100">
                                </a>
                            </div>
                            <p class="mt-3 fs-15 fw-medium" style="color: white;"><i>Los Mejores Precios y a tu Elección</i></p>
                        </div>
                    </div>
                </div>
                <section class="vh-100">
                    <div class="row justify-content-center">
                        <div class="col-md-8 col-lg-6 col-xl-5">
                            <div class="card mt-4">

                                <div class="card-body p-4">
                                    <div class="text-center mt-2">
                                        <h5 class="text-primary">Bienvenido!</h5>
                                        <p class="text-muted">Ingresa a Mi Colegio.</p>
                                    </div>
                                    <div class="p-2 mt-4">
                                        <form method="post" action="">

                                            <?php
                                            include("../../layouts/config.php");
                                            include("./controller.php");
                                            ?>
                                            <div class="mb-3">
                                                <label class="form-label" for="form3Example3">Dirección de Correo Electrónico</label>
                                                <input type="email" id="form3Example3" class="form-control" placeholder="Ingrese Email" name="email" />
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label" for="password-input">Contraseña</label>
                                                <div class="position-relative auth-pass-inputgroup mb-3">
                                                    <input type="password" id="password-input" class="form-control pe-5 password-input" placeholder="Ingrese Contraseña" name="password" />
                                                    <span class="position-absolute end-0 top-0 mt-2 me-2" style="cursor: pointer;">
                                                        <i id="toggle-password" class="ri-eye-fill align-middle"></i>
                                                    </span>
                                                </div>
                                            </div>

                                            <div class="mt-4">
                                                <input type="submit" class="btn btn-success w-100" style="padding-left: 2.5rem; padding-right: 2.5rem;" name="btningresar" value="Ingresar" href="major.php">
                                            </div>
                                        </form>
                                        <div class="mt-3 text-center">
                                            <a href="../../recover-password.php" class="text-muted">¿Olvidaste tu contraseña?</a>
                                        </div>
                                    </div>
                                </div>
                                <!-- end card body -->
                            </div>
                            <!-- end card -->

                            <div class="mt-4 text-center">
                                <p class="mb-0">No Tienes Cuenta? <a href="../Client/check-in.php" class="fw-semibold text-primary text-decoration-underline"> Registrarse </a> </p>
                            </div>

                        </div>
                        <!-- footer -->
                        <footer class="footer">
                            <div class="container">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="text-center">
                                            <p class="mb-0 text-muted">&copy;
                                                <script>
                                                    document.write(new Date().getFullYear())
                                                </script> Mi Colegio <i class="mdi mdi-heart text-danger"></i>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </footer>
                        <!-- end Footer -->

                    </div>
                </section>
            </div>
        </div>
    </div>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script>
        document.getElementById('toggle-password').addEventListener('click', function () {
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
    </script>
</body>

</html>