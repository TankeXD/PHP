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

                    <?php includeFileWithVariables('layouts/page-title.php', array('pagetitle' => 'Inicio', 'title' => 'Actualizar Cliente')); ?>

                </div>
                <!-- container-fluid -->
                <?php
                ?>
                <?php
                include("./layouts/config.php");
                $con = connection();

                $id = $_GET['id_cliente'];

                $sql = "SELECT * FROM clientes WHERE id_cliente='$id'";
                $query = mysqli_query($con, $sql);

                $row = mysqli_fetch_array($query);
                ?>

                <body>

                    <div class="users-form">
                        <form action="./CRUD/CRUD Cliente/edit_cliente.php" method="POST">
                            <!--toma los nuevos datos ingresados y los manda a edit user-->
                            <input type="hidden" name="id_cliente" value="<?= $row['id_cliente'] ?>">
                            <input type="text" name="nom_com" placeholder="Ingrese Nombre Completo" value="<?= $row['nom_com'] ?>">
                            <input type="text" name="rut" placeholder="Ingrese Contraseña" value="<?= $row['rut'] ?>">
                            <input type="date" name="fecha_nac" value="<?= $row['fecha_nac'] ?>">
                            <input type="number" name="celular" placeholder="Ingrese Movil" value="<?= $row['celular'] ?>">
                            <input type="email" name="email" placeholder="Ingrese Email" value="<?= $row['email'] ?>">
                            <input type="text" name="direccion" placeholder="Ingrese Dirección" value="<?= $row['direccion'] ?>">
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
