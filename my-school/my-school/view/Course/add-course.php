<?php include '../../layouts/session.php'; ?>
<?php include '../../layouts/main.php'; ?>

<head>
    <?php includeFileWithVariables('../../layouts/title-meta.php', array('title' => 'Añadir Curso')); ?>
    <?php include '../../layouts/head2.php'; ?>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <style>
        .sidebar-label {
            color: #ffffff;

        }

        .sidebar-label:hover {
            color: #25a0e2;
        }
    </style>
</head>

<body>
    <div id="layout-wrapper">
        <?php include '../../layouts/topbar-admin.php'; ?>
        <?php include '../../layouts/sidebar.php'; ?>

        <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">
                    <a href="filter-course.php">
                        <?php includeFileWithVariables('../../layouts/page-title.php', array('pagetitle' => 'Establecimientos', 'title' => 'Agregar Curso')); ?>
                    </a>
                    <?php
                    //aqui para consultar de las regiones como inicio.
                    include("../../layouts/config.php");
                    $con = connection();
                    $sqlregion = "SELECT * FROM regiones";
                    $queryregion = mysqli_query($con, $sqlregion);
                    ?>
                    <!-- Formulario centrado -->
                    <div class="d-flex justify-content-center">
                        <div class="col-lg-6">
                            <form action="../../Models/Crud-course/insert-course.php" method="POST" onsubmit="confirmacion(event)">
                                <!-- Select de REGIONES -->
                                <div class="row mb-3">
                                    <label for="region" class="col-sm-3 col-form-label">Regiones</label>
                                    <div class="col-sm-9">
                                        <select name="region" id="region" class="form-select select2">
                                            <option selected disabled>Seleccione Región</option>
                                            <?php while ($row = mysqli_fetch_array($queryregion)) : ?>
                                                <option value="<?= $row['id_region'] . '|' . $row['nombre_region'] ?>">
                                                    <?= $row['nombre_region'] ?>
                                                </option>
                                            <?php endwhile; ?>
                                        </select>
                                    </div>
                                </div>
                                <!-- Select de COMUNAS -->
                                <div class="row mb-3">
                                    <label for="comuna" class="col-sm-3 col-form-label">Comuna</label>
                                    <div class="col-sm-9">
                                        <select name="comuna" id="comuna" class="form-select select2">
                                            <option selected disabled>Seleccione Comuna</option>
                                        </select>
                                    </div>
                                </div>
                                <!-- Select de COLEGIOS -->
                                <div class="row mb-3">
                                    <label for="colegio" class="col-sm-3 col-form-label">Colegios</label>
                                    <div class="col-sm-9">
                                        <select name="colegio" id="colegio" class="form-select select2">
                                            <option selected disabled>Seleccione Colegio</option>
                                        </select>
                                    </div>
                                </div>
                                <input type="text" name="nombreColegio" id="nombreColegio" class="form-control" style="display: none;">
                                <!-- Select de CURSO y LETRA -->
                                <div class="row mb-3">
                                    <label for="curso" class="col-sm-3 col-form-label">Ingrese Curso</label>
                                    <div class="col-sm-6">
                                        <select class="form-control" data-choices data-choices-groups data-placeholder="Select Course" name="curso" id="curso">
                                            <option value="" disabled selected>Seleccione El Curso</option>
                                            <optgroup label="Basica">
                                                <option value="PRIMERO BASICO">PRIMERO BÁSICO</option>
                                                <option value="SEGUNDO BASICO">SEGUNDO BÁSICO</option>
                                                <option value="TERCERO BASICO">TERCERO BÁSICO</option>
                                                <option value="CUARTO BASICO">CUARTO BÁSICO</option>
                                                <option value="QUINTO BASICO">QUINTO BÁSICO</option>
                                                <option value="SEXTO BASICO">SEXTO BÁSICO</option>
                                                <option value="SEPTIMO BASICO">SÉPTIMO BÁSICO</option>
                                                <option value="OCTAVO BASICO">OCTAVO BÁSICO</option>
                                            </optgroup>
                                            <optgroup label="Media">
                                                <option value="PRIMERO MEDIO">PRIMERO MEDIO</option>
                                                <option value="SEGUNDO MEDIO">SEGUNDO MEDIO</option>
                                                <option value="TERCERO MEDIO">TERCERO MEDIO</option>
                                                <option value="CUARTO MEDIO">CUARTO MEDIO</option>
                                            </optgroup>
                                        </select>
                                    </div>
                                    <div class="col-sm-3">
                                        <select id="letra" name="letra" class="form-select select2"></select>
                                    </div>
                                </div>
                                <!-- Botón Guardar -->
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary" oninput="confirmacion(event)">Guardar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Page-content -->
        </div>
        <!-- end main content-->
    </div>
    <!-- END layout-wrapper -->
    <?php include '../../layouts/footer.php'; ?>
    <?php include '../../layouts/vendor-scripts 2.php'; ?>
    <!-- App js -->
    <script src="../../assets/js/app.js"></script>

    <script>
        // Función para generar opciones del abecedario
        function generarAbecedario() {
            const select = document.getElementById('letra');
            const letra = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';

            // Limpiar opciones existentes
            select.innerHTML = '';

            // Crear y agregar las opciones
            for (let i = 0; i < letra.length; i++) {
                const option = document.createElement('option');
                option.value = letra[i];
                option.text = letra[i];
                select.appendChild(option);
            }
        }

        // Ejecutar la función cuando el DOM esté cargado
        document.addEventListener('DOMContentLoaded', generarAbecedario);
    </script>

    <!-- JavaScript para la funcionalidad de select dependiente region - comuna -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const regionSelect = document.getElementById('region');
            const comunaSelect = document.getElementById('comuna');

            regionSelect.addEventListener('change', function() {
                const idRegion = this.value.split('|')[0]; // Obtener el ID de la región seleccionada

                fetch('get-commune.php?id_region=' + idRegion)
                    .then(response => response.json())
                    .then(data => {
                        comunaSelect.innerHTML = '<option selected disabled>Seleccione Comuna</option>';
                        data.forEach(comuna => {
                            const option = document.createElement('option');
                            option.value = comuna.id_comuna + '|' + comuna.nombre_comuna;
                            option.textContent = comuna.nombre_comuna;
                            comunaSelect.appendChild(option);
                        });
                    });
            });
        });
    </script>
    <!-- JavaScript para la funcionalidad de select dependiente de comuna - colegio -->
    <script>
        <?php
        error_reporting(E_ALL);
        ?>
        document.addEventListener("DOMContentLoaded", function() {
            const comunaSelect = document.getElementById('comuna');
            const colegioSelect = document.getElementById('colegio');

            comunaSelect.addEventListener('change', function() {
                const idComuna = this.value.split('|')[0]; // Obtener el ID de la comuna seleccionada
                console.log(idComuna);
                fetch('get-school.php?id_comuna=' + idComuna)
                    .then(response => response.json()) // Agrega .json() aquí para parsear la respuesta como JSON
                    .then(data => {
                        colegioSelect.innerHTML = '<option selected disabled>Seleccione Colegio</option>';
                        data.forEach(colegio => {
                            const option = document.createElement('option');
                            option.value = colegio.id_colegio + '|' + colegio.nombre_colegio;
                            option.textContent = colegio.nombre_colegio;
                            colegioSelect.appendChild(option);
                        });
                    });

            });
        });
    </script>
    <!-- JavaScript para actualizar el nombre del colegio seleccionado -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const colegioSelect = document.getElementById('colegio');
            const nombreColegioInput = document.getElementById('nombreColegio');

            colegioSelect.addEventListener('change', function() {
                const colegioSeleccionado = this.value;
                const [idColegio, nombreColegio] = colegioSeleccionado.split('|');
                nombreColegioInput.value = nombreColegio;
            });
        });
    </script>
    <!-- scrip para alerta de ingreso correcto -->
    <script>
        function confirmacion(event) {
            // Evita que el formulario se envíe automáticamente
            event.preventDefault();
            Swal.fire({
                position: "center",
                icon: "success",
                title: "¡Curso Registrado Con Éxito!",
                showConfirmButton: false,
                timer: 1500
            }).then(() => {
                // Si deseas proceder con el envío del formulario después de mostrar la alerta
                event.target.submit();
            });
        }
    </script>

    <!--jquery cdn-->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <!--select2 cdn-->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script src="../../assets/js/pages/select2.init.js"></script>

</body>

</html>