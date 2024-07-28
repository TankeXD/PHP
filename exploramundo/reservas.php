<?php include 'layouts/session.php'; ?>
<?php include 'layouts/main.php'; ?>

<head>

    <?php includeFileWithVariables('layouts/title-meta.php', array('title' => 'Reservas')); ?>

    <?php include 'layouts/head-css.php'; ?>

</head>

<body>

    <!-- Begin page -->
    <div id="layout-wrapper">

        <?php include 'layouts/menu.php'; ?>

        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">

            <div class="page-content">
                <div class="container-fluid">

                    <?php includeFileWithVariables('layouts/page-title.php', array('pagetitle' => 'Inicio', 'title' => 'Registros De Reservas')); ?>

                </div>
                <!-- container-fluid -->

                <?php
                include("./layouts/config.php");
                $con = connection();
                $sqlcliente = "SELECT nombre_com,rut,fecha_nac,celular,email FROM clientes";
                $querycliente = mysqli_query($con, $sqlcliente);

                $sqlpaquete = "SELECT nom_pack FROM paquetes";
                $querypaquete = mysqli_query($con, $sqlpaquete);
                ?>

                <div class="row mb-3">
                    <div class="col-lg-3">
                        <label class="form-label">Buscar Clientes</label>
                    </div>

                    <select id="BuscarCliente" class="form-select mb-3" aria-label=".form-select-lg example" style="width: 300px; margin-left: 10px;">
                        <option selected disabled>Seleccione Al Cliente</option>
                        <?php while ($row = mysqli_fetch_array($querycliente)) : ?>
                            <option value="<?= $row['nombre_com'] . '|' . $row['rut'] . '|' . $row['fecha_nac'] . '|'. $row['celular'] . '|' . $row['email'] ?>">
                                <?= $row['nombre_com'] ?>
                            </option>
                        <?php endwhile; ?>
                    </select>
                </div>

                <form action="./CRUD/CRUD Reservas/insert_reserva.php" method="POST">
                    <div class="row mb-3">
                        <div class="col-lg-3">
                            <label class="form-label">Nombre Completo</label>
                        </div>
                        <div class="col-lg-9">
                            <input type="text"  id="buscar_nom_cli" name="nom_cli" class="form-control" placeholder="Ingrese Nombre Completo" style="width : 300px;">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-lg-3">
                            <label class="form-label">R.U.T</label>
                        </div>
                        <div class="col-lg-9">
                            <input type="text" id="buscar_rut" name="rut" class="form-control" id="nameInput" placeholder="Ingrese RUT" style="width : 300px;">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-lg-3">
                            <label class="form-label">Fecha de Nacimiento</label>
                        </div>
                        <div class="col-lg-9">
                            <input type="date" id="buscar_fecha_nac" name="fecha_nac" class="form-control" style="width : 300px;">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-lg-3">
                            <label class="form-label">Numero de Contacto</label>
                        </div>
                        <div class="col-lg-9">
                            <input type="number" id="buscar_telefono" name="telefono" class="form-control" placeholder="Ingrese Numero de Contacto" style="width : 300px;">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-lg-3">
                            <label class="form-label">Correo Electronico</label>
                        </div>
                        <div class="col-lg-9">
                            <input type="email" id="buscar_correo" name="correo" class="form-control" placeholder="Ingrese Email" style="width : 300px;">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-lg-3">
                            <label class="form-label">Paquetes Disponibles</label>
                        </div>

                        <select name="paquete" class="form-select mb-3" aria-label=".form-select-lg example" style="width: 300px; margin-left: 10px;">
                            <option selected disabled>Seleccione Paquete</option>
                            <?php while ($row = mysqli_fetch_array($querypaquete)) : ?>
                                <option value="<?= $row['nom_pack'] ?>"><?= $row['nom_pack'] ?></option>
                            <?php endwhile; ?>
                        </select>
                    </div>

                    <div class="row mb-3">
                        <div class="col-lg-3">
                            <label class="form-label">Fecha de Salida</label>
                        </div>
                        <div class="col-lg-9">
                            <input type="date" name="fecha_salida" class="form-control" style="width : 300px;">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-lg-3">
                            <label class="form-label">Numero de Personas</label>
                        </div>
                        <div class="col-lg-9">
                            <input type="number" name="numero_per" class="form-control" placeholder="Ingrese Cantidad de Personas" style="width : 300px;">
                        </div>
                    </div>



                    <div class="text-end" style="padding-right: 920px;">
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                </form>

            </div>

            <!-- End Page-content -->

            <?php include 'layouts/footer.php'; ?>
        </div>
        <!-- end main content-->

    </div>
    <!-- END layout-wrapper -->



    <?php include 'layouts/vendor-scripts.php'; ?>

    <!-- App js -->
    <script src="assets/js/reservas.js"></script>
    <script src="assets/js/app.js"></script>
</body>

</html>