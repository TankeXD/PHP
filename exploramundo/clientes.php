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
                    <form action="./CRUD/CRUD Clientes/insert_cliente.php" method="POST">
                        <div class="row mb-3">
                            <div class="col-lg-3">
                                <label  class="form-label">Nombre Completo</label>
                            </div>
                            <div class="col-lg-9">
                                <input type="text"  name="nombre_com" class="form-control" placeholder="Ingrese Nombre Completo" style="width : 300px;">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-lg-3">
                                <label  class="form-label">R.U.T</label>
                            </div>
                            <div class="col-lg-9">
                                <input type="text" name="rut" class="form-control"  placeholder="Ingrese Rut" style="width : 300px;">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-lg-3">
                                <label  class="form-label">Fecha de Nacimiento</label>
                            </div>
                            <div class="col-lg-9">
                                <input type="date"  name="fecha_nac" class="form-control"  style="width : 300px;">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-lg-3">
                                <label  class="form-label">Celular</label>
                            </div>
                            <div class="col-lg-9">
                                <input type="number"  name="celular" class="form-control" placeholder="Ingrese Movil"  style="width : 300px;">
                            </div>
                        </div>
                
                        <div class="row mb-3">
                            <div class="col-lg-3">
                                <label  class="form-label">Correo Electronico</label>
                            </div>
                            <div class="col-lg-9">
                                <input type="email"  name="email" class="form-control"  placeholder="Ingrese Email" style="width : 300px;">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-lg-3">
                                <label  class="form-label">Dirección</label>
                            </div>
                            <div class="col-lg-9">
                                <input type="text"  name="direccion" class="form-control"  placeholder="Ingrese Dirección" style="width : 300px;">
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