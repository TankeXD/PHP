<?php include 'layouts/session.php'; ?>
<?php include 'layouts/main.php'; ?>

<head>

    <?php includeFileWithVariables('layouts/title-meta.php', array('title' => 'Usuarios')); ?>

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

                    <?php includeFileWithVariables('layouts/page-title.php', array('pagetitle' => 'Inicio', 'title' => 'Registros De Usuarios')); ?>

                </div>
                <!-- container-fluid -->
                <?php
                ?>

                <body>
                    <form action="./CRUD/CRUD USER/insert_user.php" method="POST">
                        <div class="row mb-3">
                            <div class="col-lg-3">
                                <label for="username"  class="form-label">Nombre de Usuario</label>
                            </div>
                            <div class="col-lg-9">
                                <input type="text"  name="username" class="form-control" placeholder="Ingrese Usuario" style="width : 300px;">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-lg-3">
                                <label for="password" class="form-label">Contraseña</label>
                            </div>
                            <div class="col-lg-9">
                                <input type="password" name="password" class="form-control"  placeholder="Ingrese Contraseña" style="width : 300px;">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-lg-3">
                                <label for="email" class="form-label">Correo Electronico</label>
                            </div>
                            <div class="col-lg-9">
                                <input type="email"  name="email" class="form-control"  placeholder="Ingrese Email" style="width : 300px;">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-lg-3">
                                <label for="fecha_nac" class="form-label">Fecha de Nacimiento</label>
                            </div>
                            <div class="col-lg-9">
                                <input type="date"  name="fecha_nac" class="form-control"  style="width : 300px;">
                            </div>
                        </div>
                
                        <div class="row mb-3">
                            <div class="col-lg-3">
                                <label for="rol" class="form-label">Tipo de Cargo</label>
                            </div>
                            <div class="col-lg-9">
                                <input type="text"  name="rol" class="form-control"  placeholder="Ingrese Cargo" style="width : 300px;">
                            </div>
                        </div>
                        <div class="text-end" style="padding-right: 920px;">
                            <input type="submit" class="btn btn-primary"  value="Guardar"></input>
                        </div>
                    </form>

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