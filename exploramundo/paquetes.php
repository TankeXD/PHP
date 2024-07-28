<?php include 'layouts/session.php'; ?>
<?php include 'layouts/main.php'; ?>

<head>

    <?php includeFileWithVariables('layouts/title-meta.php', array('title' => 'Paquetes')); ?>

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

                    <?php includeFileWithVariables('layouts/page-title.php', array('pagetitle' => 'Inicio', 'title' => 'Registros De Paquetes')); ?>

                </div>
                <!-- container-fluid -->
                <?php
                ?>
                <form action="./CRUD/CRUD Paquetes/insert_paquete.php" method="POST">
                    <div class="row mb-3">
                        <div class="col-lg-3">
                            <label  class="form-label">Nombre del Paquete</label>
                        </div>
                        <div class="col-lg-9">
                            <input type="text" name="nom_pack" class="form-control"  placeholder="Nombre del Paquete" style="width : 300px;">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-lg-3">
                            <label  class="form-label">Destino</label>
                        </div>
                        <div class="col-lg-9">
                            <input type="text" name="destino" class="form-control"  placeholder="Ingrese Destino" style="width : 300px;">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-lg-3">
                            <label  class="form-label">Fecha de Salida</label>
                        </div>
                        <div class="col-lg-9">
                            <input type="date" name="fecha_salida" class="form-control"  style="width : 300px;">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-lg-3">
                            <label  class="form-label">Fecha de LLegada</label>
                        </div>
                        <div class="col-lg-9">
                            <input type="date" name="fecha_llegada" class="form-control"  style="width : 300px;">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-lg-3">
                            <label  class="form-label">Descripción del Paquete</label>
                        </div>
                        <div class="col-lg-9">
                            <input type="text" name="info" class="form-control"  placeholder="Descripción del Paquete" style="width : 300px;">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-lg-3">
                            <label  class="form-label">Precio</label>
                        </div>
                        <div class="col-lg-9">
                            <input type="number" name="precio" class="form-control"  placeholder="Ingrese Precio" style="width : 300px;">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-lg-3">
                            <label class="form-label">Inclusión del Paquete</label>
                        </div>
                        <select name="inclusion" class="form-select mb-3" aria-label=".form-select-lg example" style="width: 300px; margin-left: 10px;">
                            <option selected>Seleccione Inclusión</option>
                            <option value="Tour en Ciudad">Tour en Ciudad</option>
                            <option value="Tour en Playas">Tour en Playas</option>
                            <option value="Tour en Bosque">Tour en Bosque</option>
                        </select>
                    </div>
                    <div class="row mb-3">
                        <div class="col-lg-3">
                            <label  class="form-label">Fecha Publicar Paquete </label>
                        </div>
                        <div class="col-lg-9">
                            <input type="date" name="fecha_public" class="form-control"  style="width : 300px;">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-lg-3">
                            <label  class="form-label">Fecha Expiración</label>
                        </div>
                        <div class="col-lg-9">
                            <input type="date" name="fecha_expi" class="form-control"  style="width : 300px;">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-lg-3">
                            <label  class="form-label">Imagen del Paquete</label>
                        </div>
                        <div class="col-lg-9">
                            <input type="file" name="img" class="form-control"  placeholder="" style="width : 300px;">
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
    <script src="assets/js/app.js"></script>
</body>

</html>