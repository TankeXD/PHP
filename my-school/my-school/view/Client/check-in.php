<?php
// Include config file
require_once "../../layouts/config.php";

?>
<?php include '../../layouts/main.php'; ?>


<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
    <?php includeFileWithVariables('../../layouts/title-meta.php', array('title' => 'Registrarse')); ?>
    <?php include '../../layouts/head2.php'; ?>
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
                                <a href="../../index.php" class="d-inline-block auth-logo">
                                    <img src="assets/images/material-escolar.png" alt="" height="100">
                                </a>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- end row -->

                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6 col-xl-5">
                        <div class="card mt-4">

                            <div class="card-body p-4">
                                <div class="text-center mt-2">
                                    <h5 class="text-primary">Crearte una nueva cuenta</h5>
                                </div>
                                <div class="p-2 mt-4">
                                    <form class="needs-validation" form action="../../Models/Crud-client/insert-client.php" method="POST">

                                        <div class="mb-3">
                                            <label for="useremail" class="form-label">Nombre <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="nombre" placeholder="Ej: Daniel" required>

                                        </div>
                                        <div class="mb-3">
                                            <label for="useremail" class="form-label">Apellidos <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="apellido" placeholder="Ej: Irrazabal Sanchez" required>

                                        </div>
                                        <div class="mb-3">
                                            <label for="useremail" class="form-label">Rut <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="rut" id="rut" placeholder="Ej: 9.596.814-7" required oninput="formatearRut(this)">
                                        </div>

                                        <div class="mb-3">
                                            <label for="useremail" class="form-label">Correo Electrónico <span class="text-danger">*</span></label>
                                            <input type="email" class="form-control" name="email" placeholder="Ej: Micolegio@gmail.com" required>

                                        </div>

                                        <div class="mb-3 ">
                                            <label class="form-label" for="password-input">Contraseña</label>
                                            <div class="position-relative auth-pass-inputgroup">
                                                <input type="password" class="form-control pe-5 password-input" name="password" onpaste="return false" placeholder="Ingrese Contraseña" id="password-input" aria-describedby="passwordInput" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" required>
                                                <button class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted password-addon" type="button" id="password-addon"><i class="ri-eye-fill align-middle"></i></button>
                                            </div>
                                        </div>
                                        <div id="password-contain" class="p-3 bg-light mb-2 rounded">
                                            <h5 class="fs-13 fw-semibold">La contraseña debe contener...:</h5>
                                            <p id="pass-length" class="invalid fs-12 mb-2">Minimo <b>8 caracteres</b></p>
                                            <p id="pass-lower" class="invalid fs-12 mb-2"><b>minúsculas</b> (a-z)</p>
                                            <p id="pass-upper" class="invalid fs-12 mb-2"><b>mayúsculas</b> (A-Z)</p>
                                            <p id="pass-number" class="invalid fs-12 mb-0"><b>Números</b> (0-9)</p>
                                        </div>

                                        <div class="mt-4">
                                            <button class="btn btn-success w-100" id="btn_registro" onclick="validarCampos()" disabled>Registrarse</button>
                                        </div>


                                    </form>

                                </div>
                            </div>
                            <!-- end card body -->
                        </div>
                        <!-- end card -->


                        <div class="mt-4 text-center">
                            <p class="mb-0">Ya tienes una cuenta ? <a href=".././Login/login.php" class="fw-semibold text-primary text-decoration-underline"> iniciar sesión </a> </p>
                        </div>

                    </div>
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->


        </div>
        <!-- end auth page content -->

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
    <!-- end auth-page-wrapper -->

    <?php include '../../layouts/vendor-scripts.php'; ?>
    <!-- particles js -->
    <script src="../../assets/libs/particles.js/particles.js"></script>
    <!-- particles app js -->
    <script src="../../assets/js/pages/particles.app.js"></script>
    <!-- validation init -->
    <script src="../../assets/js/pages/form-validation.init.js"></script>
    <!-- password create init -->
    <script src="../../assets/js/pages/passowrd-create.init.js"></script>

    <!-- script para controlar los campos que se rellenan y bloquear o desbloquear el boton de registrar -->
    <script>
        function validarCampos() {
            // Obtener referencias a los campos
            const nombre = document.querySelector('input[name="nombre"]');
            const apellido = document.querySelector('input[name="apellido"]');
            const rut = document.querySelector('input[name="rut"]');
            const email = document.querySelector('input[name="email"]');


            // Verificar si todos los campos obligatorios están llenos
            if (nombre?.value?.trim() !== '' && apellido?.value?.trim() !== '' && rut?.value?.trim() !== '' && email?.value?.trim() !== '') {
                document.getElementById('btn_registro').disabled = false; // Habilitar el botón
            } else {
                document.getElementById('btn_registro').disabled = true; // Deshabilitar el botón
            }
        }
        // Llamar a la función validarCampos() cada vez que se produzca un cambio en un campo de entrada
        document.querySelectorAll('input[name="nombre"], input[name="apellido"], input[name="rut"], input[name="email"], input[name="password"]').forEach(input => {
            input.addEventListener('input', validarCampos);
        });
    </script>


    <!-- Script para hacer automatico el rut y controlado -->
    <script>
        function formatearRut(input) {
            // Obtener solo los dígitos y la letra 'K/k'
            var value = input.value.replace(/[^0-9kK]/g, '').toUpperCase();

            // Limitar a solo poner 12 digitos contando puntos y guión
            if (value.length > 9) {
                value = value.slice(0, 9) + value.slice(9, 9);
            }

            // Formatear el RUT
            var formattedValue = '';
            if (value.length > 1) {
                var num = value.slice(0, -1);
                var dv = value.slice(-1);
                formattedValue = num.replace(/\B(?=(\d{3})+(?!\d))/g, '.') + '-' + dv;
            } else {
                formattedValue = value;
            }

            // Actualizar el valor del input con el formato
            input.value = formattedValue;
        }
    </script>
</body>

</html>