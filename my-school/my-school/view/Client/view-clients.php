<!DOCTYPE html>
<html lang="es">

<head>
    <?php include '../../layouts/session.php'; ?>
    <?php include '../../layouts/main.php'; ?>
    <?php includeFileWithVariables('../../layouts/title-meta.php', array('title' => 'Gestión Apoderados')); ?>
    <?php include '../../layouts/head2.php'; ?>
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

<script>
    function confirmacion(event, id_cliente) {
        console.log("ID of the user to delete:", id_cliente);
        event.preventDefault();
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: "btn btn-success",
                cancelButton: "btn btn-danger"
            },
            buttonsStyling: false
        });
        return swalWithBootstrapButtons.fire({
            title: "¿Desea Realmente Borrar Al Apoderado?",
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
                    "Apoderado Eliminado con Éxito.",
                    "success"
                );
                setTimeout(() => {
                    window.location.href = "../../Models/Crud-client/delete-client.php?id_cliente=" + id_cliente;
                }, 1500);
            } else if (
                result.dismiss === Swal.DismissReason.cancel
            ) {
                swalWithBootstrapButtons.fire(
                    "Cancelado",
                    "Apoderado a salvo :)",
                    "error"
                );
            }
        });
    }
</script>

<body>

    <div id="layout-wrapper">
        <?php include '../../layouts/topbar-admin.php'; ?>
        <?php include '../../layouts/sidebar.php'; ?>

        <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">
                    <?php includeFileWithVariables('../../layouts/page-title.php', array('pagetitle' => 'Apoderados', 'title' => 'Gestión de Apoderados')); ?>
                </div>

                <?php
                include("../../layouts/config.php");
                $con = connection();

                $sql = "SELECT * FROM clientes";
                $query = mysqli_query($con, $sql);
                ?>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Tabla de Apoderados</h5>
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
                                            <th>Nombre</th>
                                            <th>Apellido</th>
                                            <th>RUT</th>
                                            <th>Correo Electrónico</th>
                                            <th>Acción</th>
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
                                                <td><?= $row['nombre'] ?></td>
                                                <td><?= $row['apellido'] ?></td>
                                                <td><?= $row['rut'] ?></td>
                                                <td><?= $row['email'] ?></td>
                                                <td>
                                                    <div class="d-flex gap-2">
                                                        <div class="remove">
                                                            <a href="#" class="text-danger d-inline-block remove-item-btn" onclick="confirmacion(event, <?= $row['id_cliente'] ?>)"><i class="ri-delete-bin-5-fill fs-16" style="font-size: 1.4rem !important;"></i></a>
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
        <?php include '../../layouts/vendor-scripts 2.php'; ?>
        <script src="../../assets/js/app.js"></script>
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