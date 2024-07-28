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

                    <?php includeFileWithVariables('layouts/page-title.php', array('pagetitle' => 'Inicio', 'title' => 'Actualizar Administradores')); ?>

                </div>
                <!-- container-fluid -->
                <?php
                ?>
                <?php
                include("./layouts/config.php");
                $con = connection();

                $id = $_GET['id_user'];

                $sql = "SELECT * FROM users WHERE id_user='$id'";
                $query = mysqli_query($con, $sql);

                $row = mysqli_fetch_array($query);
                ?>

                <body>

                    <div class="users-form">
                        <form action="./CRUD/CRUD USER/edit_user.php" method="POST">
                            <!--toma los nuevos datos ingresados y los manda a edit user-->
                            <input type="hidden" name="id_user" value="<?= $row['id_user'] ?>">
                            <input type="text" name="username" placeholder="Ingrese Nombre de Usuario" value="<?= $row['username'] ?>">
                            <input type="text" name="password" placeholder="Ingrese Contraseña" value="<?= $row['password'] ?>">
                            <input type="email" name="email" placeholder="Ingrese Email" value="<?= $row['email'] ?>">
                            <input type="date" name="fecha_nac" placeholder="Ingrese Fecha Nacimiento" value="<?= $row['fecha_nac'] ?>">
                            <input type="text" name="rol" placeholder="Ingrese Tipo de Cargo" value="<?= $row['rol'] ?>">

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

















