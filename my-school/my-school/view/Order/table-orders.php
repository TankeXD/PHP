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
        .btn-excel {
            background-color: #28a745 !important;
            color: white !important;
        }

        .btn-pdf {
            background-color: #dc3545 !important;
            color: white !important;
        }

        .sidebar-label {
            color: #ffffff;
        }

        .sidebar-label:hover {
            color: #25a0e2;
        }

        .status-en-proceso {
            background-color: #87CEEB;
            /* azul claro */
            color: black;
            width: 120px;
            /* ancho estándar */
            height: 35px;
            /* altura estándar */
        }

        .status-en-camino {
            background-color: #40E0D0;
            /* turquesa */
            color: white;
            width: 120px;
            /* ancho estándar */
            height: 35px;
            /* altura estándar */
        }

        .status-entregado {
            background-color: green;
            /* verde */
            color: white;
            width: 120px;
            /* ancho estándar */
            height: 35px;
            /* altura estándar */
        }
    </style>
</head>
<script>
    function updateOrderStatus(orderId, status) {
        const statusElement = document.getElementById(`order-status-${orderId}`);

        // Remover todas las clases de estado
        statusElement.classList.remove('status-en-proceso', 'status-en-camino', 'status-entregado');

        // Asignar la clase correspondiente al nuevo estado
        if (status === 'En proceso') {
            statusElement.classList.add('status-en-proceso');
        } else if (status === 'En camino') {
            statusElement.classList.add('status-en-camino');
        } else if (status === 'Entregado') {
            statusElement.classList.add('status-entregado');
        }

        // Actualizar el texto del botón de estado
        statusElement.textContent = status;

        // Enviar solicitud AJAX para actualizar el estado en la base de datos
        const xhr = new XMLHttpRequest();
        xhr.open('POST', '../../Models/Crud-order/update-status.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                console.log('Estado actualizado exitosamente');
                console.log(xhr.responseText); // Para verificar la respuesta del servidor
            }
        };
        xhr.send(`id_boleta=${orderId}&status=${status}`);
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

                $sql = "SELECT * FROM boleta";
                $query = mysqli_query($con, $sql);
                ?>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Tabla de Pedidos</h5>
                            </div>
                            <div class="card-body">
                                <table id="ordersTable" class="table table-bordered dt-responsive nowrap table-striped align-middle" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th scope="col" style="width: 10px;">
                                                <div class="form-check">
                                                    <input class="form-check-input fs-15" type="checkbox" id="checkAll" value="option">
                                                </div>
                                            </th>
                                            <th>Número de Orden</th>
                                            <th>Cliente</th>
                                            <th>Teléfono</th>
                                            <th>Dirección</th>
                                            <th>Fecha</th>
                                            <th>Total</th>
                                            <th>Estado</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php while ($row = mysqli_fetch_assoc($query)) { ?>
                                            <tr>
                                                <th scope="row">
                                                    <div class="form-check">
                                                        <input class="form-check-input fs-15" type="checkbox" name="checkAll" value="option1">
                                                    </div>
                                                </th>
                                                <td><?php echo $row['cod_pedido']; ?></td>
                                                <td><?php echo $row['nombre_boleta'] . ' ' . $row['apellido_boleta']; ?></td>
                                                <td><?php echo $row['tel_boleta']; ?></td>
                                                <td><?php echo $row['direccion_boleta']; ?></td>
                                                <td><?php echo $row['fecha_boleta']; ?></td>
                                                <td><?php echo $row['total']; ?></td>
                                                <td>
                                                    <div class="btn-group">
                                                        <button type="button" id="order-status-<?php echo $row['id_boleta']; ?>" class="btn btn-secondary dropdown-toggle status-en-proceso" data-bs-toggle="dropdown" aria-expanded="false">
                                                            <?php echo $row['estado']; ?>
                                                        </button>
                                                        <ul class="dropdown-menu">
                                                            <li><a class="dropdown-item" href="#" onclick="updateOrderStatus(<?php echo $row['id_boleta']; ?>, 'En proceso')">En proceso</a></li>
                                                            <li><a class="dropdown-item" href="#" onclick="updateOrderStatus(<?php echo $row['id_boleta']; ?>, 'En camino')">En camino</a></li>
                                                            <li><a class="dropdown-item" href="#" onclick="updateOrderStatus(<?php echo $row['id_boleta']; ?>, 'Entregado')">Entregado</a></li>
                                                        </ul>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php } ?>
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