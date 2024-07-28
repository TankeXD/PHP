<?php include 'layouts/session.php'; ?>
<?php include 'layouts/main.php'; ?>

<head>

    <?php includeFileWithVariables('layouts/title-meta.php', array('title' => 'Ver Reservas')); ?>

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

                    <?php includeFileWithVariables('layouts/page-title.php', array('pagetitle' => 'Inicio', 'title' => 'Ver Reservas')); ?>

                </div>
                <!-- container-fluid -->
                <?php
                include("./layouts/config.php");
                $con = connection();

                $sql = "SELECT * FROM reservas";
                $query = mysqli_query($con, $sql);
                ?>
                


                <body>

                    <!--nueva-->
                    <table class="table align-middle table-nowrap mb-0 mt-2">
                        <thead>
                            <tr class="table-light">

                                <th scope="col">Nombre Completo</th>
                                <th scope="col">Rut</th>
                                <th scope="col">Fecha de Nacimiento</th>
                                <th scope="col">Telefono</th>
                                <th scope="col">Correo Electronico</th>
                                <th scope="col">Fecha de Salida</th>
                                <th scope="col">Numero de Personas</th>
                                <th scope="col">Paquete</th>
                                <th scope="col"></th>
                                <th scope="col"></th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = mysqli_fetch_array($query)) : ?>
                                <tr class="table-light">
                                    <!--toma la informacion que se muestra en la tabla -->

                                    <th><?= $row['nom_cli'] ?></th>
                                    <th><?= $row['rut'] ?></th>
                                    <th><?= $row['fecha_nac'] ?></th>
                                    <th><?= $row['telefono'] ?></th>
                                    <th><?= $row['correo'] ?></th>
                                    <th><?= $row['fecha_salida'] ?></th>
                                    <th><?= $row['numero_per'] ?></th>
                                    <th><?= $row['paquete'] ?></th>
                                
                                    <!--botones de editar y eliminar-->
                                    <th><a href="update_reservas.php?id_reser=<?= $row['id_reser'] ?>" class="users-table--edit">Editar</a></th>
                                    <th><a href="./CRUD/CRUD Reservas/delete_reserva.php? id_reser=<?= $row['id_reser'] ?>" class="users-table--delete">Eliminar</a></th>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>

                </body>



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