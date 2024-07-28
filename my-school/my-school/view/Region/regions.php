<!DOCTYPE html>
<html lang="es">

<head>
    <?php include '../../layouts/session.php'; ?>
    <?php include '../../layouts/main.php'; ?>
    <?php includeFileWithVariables('../../layouts/title-meta.php', array('title' => 'Añadir Comunas')); ?>
    <?php include '../../layouts/head2.php'; ?>
    <!--links para responsavilizar el datatable-->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">
</head>

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

<body>
    <div id="layout-wrapper">
        <?php include '../../layouts/sidebar.php'; ?>
        <?php include '../../layouts/topbar-admin.php'; ?>
        <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">
                    <?php includeFileWithVariables('../../layouts/page-title.php', array('pagetitle' => 'Regiones', 'title' => 'Ingreso De Comunas')); ?>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <?php
                        include("../../layouts/config.php");
                        $con = connection();
                        $id_region_seleccionada = isset($_GET['id']) ? $_GET['id'] : null;
                        $nombre_region_seleccionada = '';

                        if ($id_region_seleccionada) {
                            // Obtener el nombre de la región seleccionada
                            $region_sql = "SELECT nombre_region FROM regiones WHERE id_region = $id_region_seleccionada";
                            $region_query = mysqli_query($con, $region_sql);
                            $region_row = mysqli_fetch_assoc($region_query);
                            $nombre_region_seleccionada = $region_row['nombre_region'];
                        }

                        if ($id_region_seleccionada) {
                            // Obtener las comunas de la región
                            $sql = "SELECT comunas.id_comuna, comunas.nombre_comuna, regiones.nombre_region, regiones.id_region FROM comunas INNER JOIN regiones ON comunas.id_region = regiones.id_region WHERE comunas.id_region = $id_region_seleccionada";
                            $query = mysqli_query($con, $sql);
                        } else {
                            echo "Esta región no posee comunas";
                        }
                        ?>
                        <div class="card">
                            <div class="card-header">
                                <div class="d-flex align-items-center">
                                    <h5 class="card-title flex-grow-1 mb-0">Tabla de Comunas: <?= $nombre_region_seleccionada ?></h5>
                                    <div class="flex-shrink-0">
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ModalProducto"><i class="ri-add-circle-line"></i> Agregar Comunas</button>
                                    </div>
                                </div>
                            </div>
                            <div class="modal fade" id="ModalProducto" tabindex="-1" aria-labelledby="exampleModalgridLabel" aria-modal="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="ModalProducto">Agregar Comunas</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="../../Models/Crud-commune/insert-commune.php" method="post" onsubmit="confirmacion(event)">
                                                <div class="row g-3">
                                                    <div class="col-xxl-12">
                                                        <div class="card-header">
                                                            <div class="d-flex align-items-center">
                                                                <label for="region"></label>
                                                                <select name="id_region" class="form-control">
                                                                    <?php
                                                                    $conexion = new mysqli("localhost", "root", "", "mi_colegio");

                                                                    if ($conexion->connect_error) {
                                                                        die("Error de conexión: " . $conexion->connect_error);
                                                                    }

                                                                    $consulta = "SELECT id_region, nombre_region FROM regiones";
                                                                    $result = $conexion->query($consulta);

                                                                    if ($result->num_rows > 0) {
                                                                        while ($fila = $result->fetch_assoc()) {
                                                                            $selected = ($fila["id_region"] == $id_region_seleccionada) ? 'selected' : '';
                                                                            echo "<option value='" . $fila["id_region"] . "' $selected>" . $fila["nombre_region"] . "</option>";
                                                                        }
                                                                    } else {
                                                                        echo "<option value=''>No hay regiones disponibles</option>";
                                                                    }

                                                                    $conexion->close();
                                                                    ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-xxl-6">
                                                        <div>
                                                            <label for="nombrecomuna" class="form-label">Nombre De La Comuna</label>
                                                            <input type="text" class="form-control" name="nombre_comuna" placeholder="Ingrese Comuna" id="nombrecomuna">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <div class="hstack gap-2 justify-content-end">
                                                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cerrar</button>
                                                            <button type="submit" class="btn btn-primary">Ingresar</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
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
                                            <th scope="col">Nombre Comuna</th>
                                            <th scope="col">Acción</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php while ($row = mysqli_fetch_array($query)) : ?>
                                            <tr>
                                                <th scope="row">
                                                    <div class="form-check">
                                                        <input class="form-check-input fs-15" type="checkbox" name="checkAll" value="option1">
                                                    </div>
                                                </th>
                                                <td><?= $row['nombre_comuna'] ?></td>
                                                <td>
                                                    <div class="d-flex gap-2">
                                                        <div class="remove">
                                                            <a href="#" class="text-danger d-inline-block remove-item-btn" onclick="deleteCommune(event, <?= $row['id_comuna']; ?>, <?= $row['id_region']; ?>)"><i class="ri-delete-bin-5-fill fs-16" style="font-size: 1.4rem !important;"></i></a>
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
    </div>
    <?php include '../../layouts/footer.php'; ?>
    <?php include '../../layouts/vendor-scripts 2.php'; ?>
    <script src="../../assets/js/app.js"></script>
    <!-- TODO datatable JS-->
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
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.colVis.min.js"></script>
    <script src="../../assets/js/pages/traduction-report.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var nombreComunaInput = document.getElementById('nombrecomuna');

            nombreComunaInput.addEventListener('input', function() {
                var value = this.value.toUpperCase();
                if (!value.startsWith("COMUNA DE")) {
                    this.value = "COMUNA DE " + value.replace(/^COMUNA DE\s*/i, "");
                } else {
                    this.value = value;
                }
            });

            nombreComunaInput.dispatchEvent(new Event('input')); // Initialize the input value
        });
    </script>
    <script>
        function deleteCommune(event, id_comuna, id_region) {
            console.log("ID of the user to delete:", id_comuna);
            event.preventDefault();
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: "btn btn-success",
                    cancelButton: "btn btn-danger"
                },
                buttonsStyling: false
            });
            return swalWithBootstrapButtons.fire({
                title: "¿Desea Realmente Borrar la comuna?",
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
                        "Comuna Eliminado con Éxito.",
                        "success"
                    );
                    setTimeout(() => {
                        window.location.href = "../../Models/Crud-commune/delete-commune.php?id_comuna=" + id_comuna + "&id_region=" + id_region;
                    }, 1500);
                } else if (result.dismiss === Swal.DismissReason.cancel) {
                    swalWithBootstrapButtons.fire(
                        "Cancelado",
                        "Comuna a salvo :)",
                        "error"
                    );
                }
            });
        }
    </script>
</body>

</html>