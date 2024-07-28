<?php include '../../layouts/session.php'; ?>
<?php include '../../layouts/main.php'; ?>


<head>
    <!--datatable css-->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" />
    <!--datatable responsive css-->
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">


    <?php includeFileWithVariables('../../layouts/title-meta.php', array('title' => 'Añadir Lista')); ?>
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
                    <?php includeFileWithVariables('../../layouts/page-title.php', array('pagetitle' => 'Establecimientos', 'title' => 'Filtrar Cursos')); ?>

                    <?php
                    //aqui para consultar de las regiones como inicio.
                    include("../../layouts/config.php");
                    $con = connection();
                    $sqlregion = "SELECT * FROM regiones";
                    $queryregion = mysqli_query($con, $sqlregion);
                    $sqlcursos = "SELECT DISTINCT c.*, col.*,l1.id_list, l1.id_curso AS list_1_id_curso, l1.id_producto FROM cursos c INNER JOIN colegio col ON c.id_colegio = col.id_colegio LEFT JOIN (SELECT id_curso, MIN(id_list) AS id_list, MIN(id_producto) AS id_producto FROM list_1 GROUP BY id_curso) l1 ON c.id_curso = l1.id_curso;";
                    $querycursos = mysqli_query($con, $sqlcursos);
                    ?>
                    <div class="row">
                        <div class="col-xl-4">
                            <!-- Select de REGIONES -->
                            <div class="row mb-3">
                                <label for="region" class="form-label">Regiones</label>
                                <select name="region" id="region" class="form-select mb-3" aria-label=".form-select-lg example" style="width: 300px;">
                                    <option selected disabled>Seleccione Región</option>
                                    <!-- Las opciones de regiones se cargarán desde PHP -->
                                    <?php while ($row = mysqli_fetch_array($queryregion)) : ?>
                                        <option value="<?= $row['id_region'] . '|' . $row['nombre_region'] ?>">
                                            <?= $row['nombre_region'] ?>
                                        </option>
                                    <?php endwhile; ?>
                                </select>
                            </div>
                            <!-- SELECT DE COMUNAS -->
                            <div class="row mb-3">
                                <label for="comuna" class="form-label">Comuna</label>
                                <select name="comuna" id="comuna" class="form-select mb-3" aria-label=".form-select-lg example" style="width: 300px;">
                                    <option selected disabled>Seleccione Comuna</option>
                                    <!-- Las opciones de comunas se cargarán dinámicamente con JavaScript desde el PHP de get_comunas -->
                                </select>
                            </div>
                            <!-- SELECT DE COLEGIOS -->
                            <form action="" method="GET">
                                <div class="row mb-3">
                                    <label for="colegio" class="form-label">Colegios</label>
                                    <select name="colegio" id="colegio" class="form-select mb-3" aria-label=".form-select-lg example" style="width: 300px;">
                                        <option selected disabled>Seleccione Colegio</option>
                                        <!-- Las opciones de comunas se cargarán dinámicamente con JavaScript desde el PHP de get_colegio -->
                                    </select>
                                </div>
                                <!-- BOTON DE MODAL AGREGAR PRODUCTOS -->
                                <div class="row mb-3">
                                    <button type="button" class="btn btn-primary" style="width: 250px;" id="filterButton" onclick="filtrarPorColegio()">
                                        <i class="ri-add-circle-line"></i> Filtrar por colegio
                                    </button>
                                </div>
                            </form>

                        </div>
                        <div class="col-xl-8">
                            <!-- Empieza tabla para mostrar productos -->
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        <table id="example" class="table nowrap dt-responsive align-middle table-hover table-bordered" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Curso</th>
                                                    <th scope="col">lista</th>
                                                    <th scope="col">Acción</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php while ($row = mysqli_fetch_array($querycursos)) :
                                                    $nombre_curso = $row['curso'] . " | " . $row['nombre_colegio'];
                                                    $id_curso = $row['id_curso'];
                                                ?>
                                                    <tr>
                                                        <td><?= $nombre_curso ?></td>
                                                        <?php if (is_null($row['id_list'])) : ?>
                                                            <td>
                                                                <div class="d-flex gap-2">
                                                                    <div class="edit">
                                                                        <a href="/my-school/view/Product/list-course.php?id_curso=<?= $row['id_curso'] ?>" style="background-color: rgba(255, 255, 255, 0);border: none;" type="button"><i class="ri-file-add-line" style="color: #00BD9D; font-size: 1.4rem;"></i></a>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        <?php else : ?>
                                                            <td>
                                                                <div class="d-flex gap-2">
                                                                    <div class="edit">
                                                                        <a href="/my-school/view/Product/list-course.php?id_curso=<?= $row['id_curso'] ?>" style="background-color: rgba(255, 255, 255, 0);border: none; font-size: 1.4rem;" type="button"><i class="ri-file-text-line"></i></a>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        <?php endif; ?>
                                                        <td>
                                                            <div class="remove">
                                                                <a href="#" class="text-danger d-inline-block remove-item-btn" onclick="confirmacion(event, <?= $id_curso ?>)" name="id_curso" value="<?= $id_curso
                                                                                                                                                                                                        ?>"><i class="ri-delete-bin-5-fill fs-16" style="font-size: 1.4rem !important;"></i></a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                <?php endwhile; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- TERMINA TABLA COMO TAL -->
                </div>
            </div>
        </div>
    </div>
    <?php include '../../layouts/footer.php'; ?>
    <?php include '../../layouts/vendor-scripts 2.php'; ?>
    <!-- App js -->
    <script src="../../assets/js/app.js"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <!--datatable js-->
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>

    <script src="../../assets/js/pages/datatables.init.js"></script>
    <!-- App js -->

    <!-- SCRIPT PARA ALERTAR DE ELIMINACION DE PRODUCTO -->
    <script>
        function confirmacion(event, id_curso) {
            console.log("ID of the student to delete:", id_curso);
            // Evita que el enlace se siga automáticamente
            event.preventDefault();
            // Utilizamos SweetAlert en lugar de confirm
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: "btn btn-success",
                    cancelButton: "btn btn-danger"
                },
                buttonsStyling: false
            });

            // Mostramos la ventana de confirmación de SweetAlert
            return swalWithBootstrapButtons.fire({
                title: "¿Desea Realmente Borrar La Lista Del Curso?",
                text: "Esta acción no se puede deshacer",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Sí, borrar!",
                cancelButtonText: "No, cancelar!",
                reverseButtons: true
            }).then((result) => {
                // Según la decisión del usuario se ejecuta si entrar al if o else
                if (result.isConfirmed) {
                    swalWithBootstrapButtons.fire(
                        "Borrado!",
                        "Lista Eliminada con Exíto.",
                        "success"

                    );
                    setTimeout(() => {
                        window.location.href = "../../Models/Crud-course/delete-list.php?id_curso=" + id_curso;
                    }, 1500); // se controla que se demore 1.5 segundos para la eliminacion 


                } else if (
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    // Aquí maneja la cancelación
                    swalWithBootstrapButtons.fire(
                        "Cancelado",
                        "Lista a salvo :)",
                        "error"
                    );
                }
            });
        }
    </script>
    <!-- JavaScript para la funcionalidad de select dependiente region - comuna -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const regionSelect = document.getElementById('region');
            const comunaSelect = document.getElementById('comuna');

            regionSelect.addEventListener('change', function() {
                const idRegion = this.value.split('|')[0]; // Obtener el ID de la región seleccionada
                console.log(idRegion);
                fetch('../Course/get-commune.php?id_region=' + idRegion)
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
                fetch('../Course/get-school.php?id_comuna=' + idComuna)
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
    <!-- JavaScript para la funcionalidad de select dependiente de colegio - cursos -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const colegioSelect = document.getElementById('colegio');

            colegioSelect.addEventListener('change', function() {
                const colegioSeleccionado = this.value;
                const idColegio = colegioSeleccionado.split('|')[0];
                console.log(idColegio);
            });
        });
    </script>
    <!-- JavaScript para la funcionalidad de select dependiente de colegio - cursos -->
    <script>
        <?php
        error_reporting(E_ALL);
        ?>
        document.addEventListener("DOMContentLoaded", function() {
            const colegioSelect = document.getElementById('colegio');
            const cursosTable = document.getElementById('example');
            var tabla = document.getElementById('example').getElementsByTagName('tbody')[0];
            colegioSelect.addEventListener('change', function() {
                const idColegio = this.value.split('|')[0]; // Obtener el ID de la comuna seleccionada
                console.log(idColegio);
                fetch('../Course/get-school.php?id_colegio=' + idColegio)
                    .then(response => response.json()) // Agrega .json() aquí para parsear la respuesta como JSON
                    .then(data => {
                        data.forEach(cursos => {
                            var fila = tabla.insertRow();
                            var curso = fila.insertCell(0);
                            var accion = fila.insertcell(1);

                            curso.textContent = cursos.curso;

                        });
                    });

            });
        });
    </script>
    <!-- Script para filtrar -->
    <script>
        function filtrarPorColegio() {
            const colegioSelect = document.getElementById('colegio');
            const idColegio = colegioSelect.value.split('|')[0]; // Obtener el ID del colegio seleccionado

            fetch('../Course/get-course.php?id_colegio=' + idColegio)
                .then(response => response.json())
                .then(data => {
                    const tabla = document.getElementById('example').getElementsByTagName('tbody')[0];
                    tabla.innerHTML = ''; // Limpiar la tabla antes de agregar los nuevos datos

                    data.forEach(curso => {
                        const fila = tabla.insertRow();
                        const nombreCurso = fila.insertCell(0);
                        const lista = fila.insertCell(1);
                        const accion = fila.insertCell(2);

                        nombreCurso.textContent = `${curso.curso} | ${curso.nombre_colegio}`;

                        if (curso.id_list === null) {
                            lista.innerHTML = `
                        <div class="d-flex gap-2">
                            <div class="edit">
                                <a href="/my-school/view/Product/list-course.php?id_curso=${curso.id_curso}" style="background-color: rgba(255, 255, 255, 0);border: none;" type="button">
                                    <i class="ri-file-add-line" style="color: #00BD9D; font-size: 1.4rem;"></i>
                                </a>
                            </div>
                        </div>
                    `;
                        } else {
                            lista.innerHTML = `
                        <div class="d-flex gap-2">
                            <div class="edit">
                                <a href="/my-school/view/Product/list-course.php?id_curso=${curso.id_curso}" style="background-color: rgba(255, 255, 255, 0);border: none; font-size: 1.4rem;" type="button">
                                    <i class="ri-file-text-line"></i>
                                </a>
                            </div>
                        </div>
                    `;
                        }

                        accion.innerHTML = `
                    <div class="remove">
                        <a href="#" class="text-danger d-inline-block remove-item-btn" onclick="confirmacion(event, ${curso.id_curso})">
                            <i class="ri-delete-bin-5-fill fs-16" style="font-size: 1.4rem !important;"></i>
                        </a>
                    </div>
                `;
                    });
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