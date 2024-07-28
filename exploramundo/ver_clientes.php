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

                    <?php includeFileWithVariables('layouts/page-title.php', array('pagetitle' => 'Inicio', 'title' => 'Ver Clientes')); ?>

                </div>
                <!-- container-fluid -->
               
                <?php
                include("./layouts/config.php");
                $con = connection();

                $sql = "SELECT * FROM clientes";
                $query = mysqli_query($con, $sql);
                ?>


                <body>

                    <!--nueva-->
                    <table class="table align-middle table-nowrap mb-0 mt-2">
                        <thead>
                            <tr class="table-light">

                                <th scope="col">Nombre Completo</th>
                                <th scope="col">RUT</th>
                                <th scope="col">Fecha de Nacimiento</th>
                                <th scope="col">Celular</th>
                                <th scope="col">Email</th>
                                <th scope="col">Dirección</th>
                                <th scope="col"></th>
                                <th scope="col"></th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = mysqli_fetch_array($query)) : ?>
                                <tr class="table-light">
                                    <!--toma la informacion que se muestra en la tabla -->
                                    <th><?= $row['nombre_com'] ?> </th>
                                    <th><?= $row['rut'] ?> </th>
                                    <th><?= $row['fecha_nac'] ?> </th>
                                    <th><?= $row['celular'] ?> </th>
                                    <th><?= $row['email'] ?> </th>
                                    <th><?= $row['direccion'] ?> </th>
                                    
                                    <!--botones de editar y eliminar-->
                                    <th><a href="update_clientes.php?id_cliente=<?= $row['id_cliente'] ?>" class="users-table--edit">Editar</a></th>
                                    <th><a href="./CRUD/CRUD Clientes/delete_cliente.php? id_cliente=<?= $row['id_cliente'] ?>" class="users-table--delete">Eliminar</a></th>
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