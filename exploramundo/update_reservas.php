<?php include 'layouts/session.php'; ?>
<?php include 'layouts/main.php'; ?>

<head>

    <?php includeFileWithVariables('layouts/title-meta.php', array('title' => 'Actualizar Usuario')); ?>

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

                    <?php includeFileWithVariables('layouts/page-title.php', array('pagetitle' => 'Inicio', 'title' => 'Actualizar Reservas')); ?>

                </div>
                <!-- container-fluid -->
                <?php
                ?>
                <?php
                include("./layouts/config.php");
                $con = connection();

                $id = $_GET['id_reser'];

                $sql = "SELECT * FROM reservas WHERE id_reser='$id'";
                $query = mysqli_query($con, $sql);

                $row = mysqli_fetch_array($query);
                ?>

                <body>

                    <div class="users-form">
                        <form action="./CRUD/CRUD Reservas/edit_reserva.php" method="POST">
                            <!--toma los nuevos datos ingresados y los manda a edit user-->
                            <input type="hidden" name="id_reser" value="<?= $row['id_reser'] ?>">
                            <input type="text" name="nom_cli" placeholder="Ingrese Nombre Completo" value="<?= $row['nom_cli'] ?>">
                            <input type="text" name="rut" placeholder="Ingrese Contraseña" value="<?= $row['rut'] ?>">
                            <input type="date" name="fecha_nac" placeholder="Ingrese Email" value="<?= $row['fecha_nac'] ?>">
                            <input type="number" name="telefono" placeholder="Ingrese Celular" value="<?= $row['telefono'] ?>">
                            <input type="email" name="correo" placeholder="Ingrese Email" value="<?= $row['correo'] ?>">
                            <input type="date" name="fecha_salida" value="<?= $row['fecha_salida'] ?>">
                            <input type="text" name="numero_per" placeholder="Ingrese Numero de Personas" value="<?= $row['numero_per'] ?>">
                            <input type="text" name="paquete" placeholder="Ingrese paquete" value="<?= $row['paquete'] ?>">
                            <input type="submit" value="Actualizar">
                        </form>
                    </div>
                </body>

                <!-- empieza tabla-->
            </div>
            <!-- End Page-content -->

            <?php include 'layouts/footer.php'; ?>
        </div>
        <!-- end main content-->

    </div>
    <!-- END layout-wrapper -->

  

    <?php include 'layouts/vendor-scripts.php'; ?>

    <!-- App js -->
    <script src="assets/js/app.js"></script>
</body>

</html>