<!DOCTYPE html>
<html lang="es">
<?php include 'layouts/main.php'; ?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include 'layouts/head-css.php'; ?>
    <?php includeFileWithVariables('layouts/title-meta.php', array('title' => 'Iniciar Sesión')); ?>
    
    
</head>

<body>

    <section class="vh-100">
        <div class="container-fluid h-custom">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-md-9 col-lg-6 col-xl-5">
                    <img src="./assets/images/Logo_ExploraMundo.PNG.png" class="img-fluid" alt="Sample image">
                </div>
                <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
                    <form method="post" action="">
                        <?php
                        include("./layouts/config.php");
                        include("./CRUD/CRUD USER/controlador.php");

                        ?>
                        <div class="divider d-flex align-items-center my-4">
                            <p class="text-center fw-bold mx-3 mb-0">Iniciar Sesión</p>
                        </div>
                        <!-- Email input -->
                        <div class="form-outline mb-4 d-flex flex-column align-items-start"  >
                            <input type="email" id="form3Example3" class="form-control form-control-lg" placeholder="Ingrese Email" name="email" />
                            <label class="form-label" for="form3Example3"  >Dirección de Correo Electrónico</label>
                        </div>

                        <!-- Password input -->
                        <div class="form-outline mb-3 d-flex flex-column align-items-start">
                            <input type="password" id="form3Example4" class="form-control form-control-lg" placeholder="Ingrese Contraseña" name="password" />
                            <label class="form-label" for="form3Example4">Contraseña</label>
                        </div>

                        <div class="text-center text-lg-start mt-4 pt-2">
                            <input type="submit" class="btn btn-primary btn-lg" style="padding-left: 2.5rem; padding-right: 2.5rem;" name="btningresar" value="Ingresar"href="principal.php">
                           
                        </div>
                    </form>
                </div>
            </div>
        </div>
     
    </section>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</body>

</html>