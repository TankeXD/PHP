<?php include '../../layouts/session.php'; ?>
<?php include '../../layouts/main.php'; ?>

<head>
    <?php includeFileWithVariables('../../layouts/title-meta.php', array('title' => 'Añadir Colegios')); ?>
    <?php include '../../layouts/head2.php'; ?>
    <!--links para responsavilizar el datatable-->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">
    <style>
       /* Estilos para los botones de DataTables */
       .dt-buttons .dt-button {
            border-color: transparent !important;
            /* Elimina el borde */
            margin-right: 5px;
            /* Espacio entre los botones */
        }

        /* Estilo para el botón de PDF */
        .buttons-pdf {
            background-color: #dc3545 !important;
            /* Rojo */
            color: #ffffff !important;
            /* Texto blanco */
        }

        /* Estilo para el botón de Excel */
        .buttons-excel {
            background-color: #28a745 !important;
            /* Verde */
            color: #ffffff !important;
            /* Texto blanco */
        }

        /* Estilo para el botón de Print */
        .buttons-print {
            background-color: #7F8C8D !important;
            /* Gris clarito */
            color: #ffffff !important;
            /* Texto gris oscuro */
        }

        /* Estilos hover */
        .dt-buttons .dt-button:hover,
        .dt-buttons .dt-button:focus {
            opacity: 0.85;
            /* Opacidad al pasar el mouse */
        }
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
                    <?php includeFileWithVariables('../../layouts/page-title.php', array('pagetitle' => 'Establecimientos', 'title' => 'Agregar Nuevos Colegios')); ?>
                    <?php
                    // Consulta de regiones
                    include("../../layouts/config.php");
                    $con = connection();
                    $sqlregion = "SELECT * FROM regiones";
                    $queryregion = mysqli_query($con, $sqlregion);
                    $sqlregion2 = "SELECT * FROM regiones";
                    $queryregion2 = mysqli_query($con, $sqlregion2);
                    // Consulta para mostrar la tabla
                    $sqltable = "SELECT colegio.id_colegio, colegio.nombre_colegio, colegio.direc_colegio, colegio.fono, comunas.nombre_comuna
                        FROM colegio
                        INNER JOIN comunas ON colegio.id_comuna = comunas.id_comuna;";
                    $querytable = mysqli_query($con, $sqltable);
                    ?>

                    <!-- Modal para agregar colegios -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Insertar Colegio</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <!-- Formulario para insertar colegios -->
                                    <form action="../../Models/Crud-school/insert_colegios.php" method="POST" onsubmit="confirmacion(event)">
                                        <!-- Select de REGIONES -->
                                        <div class="row mb-3">
                                            <div class="col-lg-3">
                                                <label for="region" class="form-label">Regiones</label>
                                            </div>
                                            <select name="region" id="region" class="form-select mb-3" aria-label=".form-select-lg example" style="width: 300px; margin-left: 10px;">
                                                <option selected disabled>Seleccione Región</option>
                                                <?php while ($row = mysqli_fetch_array($queryregion)) : ?>
                                                    <option value="<?= $row['id_region'] . '|' . $row['nombre_region'] ?>">
                                                        <?= $row['nombre_region'] ?>
                                                    </option>
                                                <?php endwhile; ?>
                                            </select>
                                        </div>
                                        <!-- SELECT DE COMUNAS -->
                                        <div class="row mb-3">
                                            <div class="col-lg-3">
                                                <label for="comuna" class="form-label">Comuna</label>
                                            </div>
                                            <select name="comuna" id="comuna" class="form-select mb-3" aria-label=".form-select-lg example" style="width: 300px; margin-left: 10px;">
                                                <option selected disabled>Seleccione Comuna</option>
                                            </select>
                                        </div>
                                        <!-- SELECT DE INSTITUCION -->
                                        <div class="row mb-3">
                                            <div class="col-lg-3">
                                                <label for="institucion" class="form-label">Institución</label>
                                            </div>
                                            <select name="institucion" id="institucion" class="form-select mb-3" aria-label=".form-select-lg example" style="width: 300px; margin-left: 10px;">
                                                <option selected disabled>Seleccione Institución</option>
                                                <option value>ESCUELA </option>
                                                <option value>LICEO </option>
                                                <option value>COLEGIO </option>
                                            </select>
                                        </div>
                                        <!-- INPUT DE COLEGIOS-->
                                        <div class="row mb-3">
                                            <div class="col-lg-3">
                                                <label for="colegio" class="form-label">Ingrese Institución</label>
                                            </div>
                                            <div class="col-lg-9">
                                                <input type="text" name="colegio" class="form-control" id="colegio" placeholder="Ingrese nombre de su Institución" style="width: 300px;" oninput="convertToUpperCase()">
                                            </div>
                                        </div>
                                        <!-- INPUT DIRECCION DE COLEGIOS-->
                                        <div class="row mb-3">
                                            <div class="col-lg-3">
                                                <label for="colegio" class="form-label">Dirección</label>
                                            </div>
                                            <div class="col-lg-9">
                                                <input type="text" name="direc_colegio" class="form-control" id="colegio" placeholder="Ingrese dirección de su Institución" style="width: 300px;" oninput="convertToUpperCase()">
                                            </div>
                                        </div>
                                        <!-- INPUT NUMERO DE COLEGIOS-->
                                        <div class="row mb-3">
                                            <div class="col-lg-3">
                                                <label for="telefono" class="form-label">Teléfono</label>
                                            </div>
                                            <div class="col-lg-9">
                                                <input type="text" name="telefono" class="form-control" id="telefono" placeholder="Ingrese número de su Institución" style="width: 300px;" maxlength="8" pattern="\d{8}" oninput="validateNumber()">
                                            </div>
                                        </div>


                                        <div class="text-end">
                                            <button type="submit" class="btn btn-primary">Guardar</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal para filtrar por comuna -->
                    <div class="modal fade" id="filterModal" tabindex="-1" aria-labelledby="filterModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="filterModalLabel">Filtrar por Comuna</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <!-- Formulario para filtrar por comuna -->
                                    <form id="filterForm">
                                        <div class="row mb-3">
                                            <div class="col-lg-3">
                                                <label for="filterRegion" class="form-label">Regiones</label>
                                            </div>
                                            <select name="filterRegion" id="filterRegion" class="form-select mb-3" aria-label=".form-select-lg example" style="width: 300px; margin-left: 10px;">
                                                <option selected disabled>Seleccione Región</option>
                                                <?php while ($row = mysqli_fetch_array($queryregion2)) : ?>
                                                    <option value="<?= $row['id_region'] . '|' . $row['nombre_region'] ?>">
                                                        <?= $row['nombre_region'] ?>
                                                    </option>
                                                <?php endwhile; ?>
                                            </select>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-lg-3">
                                                <label for="filterComuna" class="form-label">Comuna</label>
                                            </div>
                                            <select name="filterComuna" id="filterComuna" class="form-select mb-3" aria-label=".form-select-lg example" style="width: 300px; margin-left: 10px;">
                                                <option selected disabled>Seleccione Comuna</option>
                                            </select>
                                        </div>
                                        <div class="text-end">
                                            <button type="button" class="btn btn-primary" onclick="applyFilter()">Aplicar Filtro</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <div class="d-flex align-items-center">
                                        <h5 class="card-title flex-grow-1 mb-0">Tabla de Colegios</h5>
                                        <div class="flex-shrink-0">
                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class=" ri-add-circle-line"></i>
                                                Agregar Colegios
                                            </button>
                                            <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#filterModal"><i class=" ri-filter-line"></i>
                                                Filtrar por Comuna
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <table id="example" class="table table-bordered dt-responsive nowrap table-striped align-middle" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th scope="col" style="width: 10px;">
                                                    <div class="form-check">
                                                        <input class="form-check-input fs-15" type="checkbox" id="checkAll" value="option">
                                                    </div>
                                                </th>
                                                <th data-ordering="col">Nombre Colegio</th>
                                                <th data-ordering="col">Dirección</th>
                                                <th data-ordering="col">Teléfono</th>
                                                <th data-ordering="col">Comuna</th>
                                                <th data-ordering="false">Acción</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php while ($row = mysqli_fetch_array($querytable)) : ?>
                                                <tr>
                                                    <th scope="row">
                                                        <div class="form-check">
                                                            <input class="form-check-input fs-15" type="checkbox" name="checkAll" value="option1">
                                                        </div>
                                                    </th>
                                                    <td><?= $row['nombre_colegio'] ?></td>
                                                    <td><?= $row['direc_colegio'] ?></td>
                                                    <td><?= $row['fono'] ?></td>
                                                    <td><?= $row['nombre_comuna'] ?></td>
                                                    <td>
                                                        <div class="d-flex gap-2">
                                                            <div class="remove">
                                                                <a href="#" class="text-danger d-inline-block remove-item-btn" onclick="deleteSchool(event, <?= $row['id_colegio'] ?>, )"><i class="ri-delete-bin-5-fill fs-16" style="font-size: 1.4rem !important;"></i></a>
                                                            </div>
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
            </div>
            <?php include '../../layouts/footer.php'; ?>
        </div>
    </div>
    <?php include '../../layouts/vendor-scripts 2.php'; ?>
    <script src="../../assets/js/app.js"></script>
    <script>
        function deleteSchool(event, id_colegio) {
            console.log("ID of the school to delete:", id_colegio);
            event.preventDefault();
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: "btn btn-success",
                    cancelButton: "btn btn-danger"
                },
                buttonsStyling: false
            });

            return swalWithBootstrapButtons.fire({
                title: "¿Desea Realmente Borrar Colegio?",
                text: "Esta acción no se puede deshacer",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Sí, borrar!",
                cancelButtonText: "No, cancelar!",
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    swalWithBootstrapButtons.fire(
                        "Borrado!",
                        "Colegio Eliminado con Éxito.",
                        "success"
                    );
                    setTimeout(() => {
                        window.location.href = "../../Models/Crud-school/delete_colegio.php?id_colegio=" + id_colegio;
                    }, 1500);
                } else if (result.dismiss === Swal.DismissReason.cancel) {
                    swalWithBootstrapButtons.fire(
                        "Cancelado",
                        "Colegio No Eliminado",
                        "error"
                    );
                }
            });
        }
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const regionSelect = document.getElementById('region');
            const comunaSelect = document.getElementById('comuna');

            regionSelect.addEventListener('change', function() {
                const idRegion = this.value.split('|')[0];

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

            const filterRegionSelect = document.getElementById('filterRegion');
            const filterComunaSelect = document.getElementById('filterComuna');

            filterRegionSelect.addEventListener('change', function() {
                const idRegion = this.value.split('|')[0];

                fetch('get-commune.php?id_region=' + idRegion)
                    .then(response => response.json())
                    .then(data => {
                        filterComunaSelect.innerHTML = '<option selected disabled>Seleccione Comuna</option>';
                        data.forEach(comuna => {
                            const option = document.createElement('option');
                            option.value = comuna.id_comuna + '|' + comuna.nombre_comuna;
                            option.textContent = comuna.nombre_comuna;
                            filterComunaSelect.appendChild(option);
                        });
                    });
            });
        });
    </script>
    <script>
        document.getElementById('institucion').addEventListener('change', function() {
            var selectedInstitution = this.options[this.selectedIndex].text;
            document.getElementById('colegio').value = selectedInstitution + ' ';
            document.getElementById('colegio').focus();
        });

        function convertToUpperCase() {
            var input = document.getElementById('colegio');
            input.value = input.value.toUpperCase();
            checkAndRestoreInstitution();
        }

        function checkAndRestoreInstitution() {
            var input = document.getElementById('colegio');
            var selectedInstitution = document.getElementById('institucion').options[document.getElementById('institucion').selectedIndex].text;
            if (input.value.trim() === '') {
                input.value = selectedInstitution + ' ';
            }
        }

        document.getElementById('colegio').addEventListener('input', convertToUpperCase);
    </script>
    <script>
        function confirmacion(event) {
            event.preventDefault();
            Swal.fire({
                position: "center",
                icon: "success",
                title: "¡Colegio Registrado Con Éxito!",
                showConfirmButton: false,
                timer: 1500
            }).then(() => {
                event.target.closest('form').submit();
            });
        }
    </script>
    <script>
        function applyFilter() {
            const comunaSelect = document.getElementById('filterComuna');
            const selectedComuna = comunaSelect.value.split('|')[1];
            const dataTable = $('#example').DataTable();

            // Filtra la tabla por la comuna seleccionada
            dataTable.column(4).search(selectedComuna).draw();

            // Cierra el modal después de aplicar el filtro
            $('#filterModal').modal('hide');
        }
    </script>
    <script>
        // Evento change para cargar las comunas según la región seleccionada
        $('#region').on('change', function() {
            var region = $(this).val().split('|')[0];
            $.ajax({
                url: '../../Models/Crud-school/get_comunas.php',
                type: 'POST',
                data: {
                    id_region: region
                },
                success: function(response) {
                    $('#comuna').html(response);
                }
            });
        });

        // Función para convertir el texto a mayúsculas
        function convertToUpperCase() {
            const input = document.getElementById('colegio');
            input.value = input.value.toUpperCase();
        }

        // Confirmación de formulario
        function confirmacion(event) {
            if (!confirm('¿Estás seguro de que deseas guardar este colegio?')) {
                event.preventDefault();
            }
        }
    </script>
    <script>
        function validateNumber() {
            const telefono = document.getElementById('telefono');
            const regex = /^[0-9]*$/;

            if (!regex.test(telefono.value)) {
                telefono.value = telefono.value.slice(0, -1); // Eliminar el último carácter si no es un número
            }
        }
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="../../assets/js/pages/traduction-report.js"></script>
</body>

</html>