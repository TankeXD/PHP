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

                    <?php includeFileWithVariables('layouts/page-title.php', array('pagetitle' => 'Inicio', 'title' => 'Actualizar Paquetes')); ?>

                </div>
                <!-- container-fluid -->
                <?php
                ?>
                <?php
                include("./layouts/config.php");
                $con = connection();

                $id = $_GET['id_pack'];

                $sql = "SELECT * FROM paquetes WHERE id_pack='$id'";
                $query = mysqli_query($con, $sql);

                $row = mysqli_fetch_array($query);
                ?>

                <body>

                    <div class="users-form">
                        <form action="./CRUD/CRUD Paquetes/edit_paquete.php" method="POST">
                            <!--toma los nuevos datos ingresados y los manda a edit user-->
                            <input type="hidden" name="id_pack" value="<?= $row['id_pack'] ?>">
                            <input type="text" name="nom_pack" placeholder="Ingrese Nombre de Usuario" value="<?= $row['nom_pack'] ?>">
                            <input type="text" name="destino" placeholder="Ingrese Contraseña" value="<?= $row['destino'] ?>">
                            <input type="date" name="fecha_salida" placeholder="Ingrese Email" value="<?= $row['fecha_salida'] ?>">
                            <input type="date" name="fecha_llegada" placeholder="Ingrese Fecha Nacimiento" value="<?= $row['fecha_llegada'] ?>">
                            <input type="text" name="info" placeholder="Ingrese Tipo de Cargo" value="<?= $row['info'] ?>">
                            <input type="double" name="precio" placeholder="Ingrese Tipo de Cargo" value="<?= $row['precio'] ?>">
                            <input type="text" name="inclusion" placeholder="Ingrese Tipo de Cargo" value="<?= $row['inclusion'] ?>">
                            <input type="date" name="fecha_public" placeholder="Ingrese Tipo de Cargo" value="<?= $row['fecha_public'] ?>">
                            <input type="date" name="fecha_expi" placeholder="Ingrese Tipo de Cargo" value="<?= $row['fecha_expi'] ?>">
                            <input type="file" name="img" placeholder="Ingrese Tipo de Cargo" value="<?= $row['img'] ?>">

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