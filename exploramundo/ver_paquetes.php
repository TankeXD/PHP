<?php include 'layouts/session.php'; ?>
<?php include 'layouts/main.php'; ?>

<head>

    <?php includeFileWithVariables('layouts/title-meta.php', array('title' => 'Ver Paquetes')); ?>

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

                    <?php includeFileWithVariables('layouts/page-title.php', array('pagetitle' => 'Inicio', 'title' => 'Ver Paquetes')); ?>

                </div>
                <!-- container-fluid -->
               
                <?php
                include("./layouts/config.php");
                $con = connection();

                $sql = "SELECT * FROM paquetes";
                $query = mysqli_query($con, $sql);
                ?>


                <body>

                    <!--nueva-->
                    <table class="table align-middle table-nowrap mb-0 mt-2">
                        <thead>
                            <tr class="table-light">

                                <th scope="col">Nombre del Paquete</th>
                                <th scope="col">Destino</th>
                                <th scope="col">Fecha de Salida</th>
                                <th scope="col">Fecha de Llegada</th>
                                <th scope="col">Descripción</th>
                                <th scope="col">Precio</th>
                                <th scope="col">Inclusión</th>
                                <th scope="col">Fecha Publicado</th>
                                <th scope="col">Fecha de Expiración</th>
                                <th scope="col"></th>
                                <th scope="col"></th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = mysqli_fetch_array($query)) : ?>
                                <tr class="table-light">
                                    <!--toma la informacion que se muestra en la tabla -->
                                    <th><?= $row['nom_pack'] ?> </th>
                                    <th><?= $row['destino'] ?> </th>
                                    <th><?= $row['fecha_salida'] ?> </th>
                                    <th><?= $row['fecha_llegada'] ?> </th>
                                    <th><?= $row['info'] ?> </th>
                                    <th><?= $row['precio'] ?> </th>
                                    <th><?= $row['inclusion'] ?> </th>
                                    <th><?= $row['fecha_public'] ?></th>
                                    <th><?= $row['fecha_expi'] ?> </th>
                                   
                                    <!--botones de editar y eliminar-->
                                    <th><a href="update_paquetes.php?id_pack=<?= $row['id_pack'] ?>" class="users-table--edit">Editar</a></th>
                                    <th><a href="./CRUD/CRUD Paquetes/delete_paquete.php? id_pack=<?= $row['id_pack'] ?>" class="users-table--delete">Eliminar</a></th>
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