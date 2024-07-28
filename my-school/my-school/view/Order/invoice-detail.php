
<?php include '../../layouts/session.php'; ?>
<?php include '../../layouts/main.php'; ?>

<?php
include '../../layouts/config.php';
$id_alumno = $_GET['id_alumno'];
$cod_pedido = $_GET['cod_pedido'];

// Verificar y convertir el valor de $_GET['total']
$total = isset($_GET['total']) && is_numeric($_GET['total']) ? (float)$_GET['total'] : 0;
$numero_tarjeta = $_GET['numero_tj'];
$visible = substr($numero_tarjeta, -4);
$nombre_completo = $_GET['nombre_boleta'];
$total_format = number_format($total, 0, '.', '.');
$num = 1;
$total_venta = 0;
$con = connection();

$sql = " SELECT DISTINCT
            pedidos.id_pedido,
            pedidos.id_prod,
            pedidos.cant_prod,
            pedidos.id_alumno,
            pedidos.cod_pedido,
            producto.id_producto,
            producto.nombre_prod,
            producto.ruta_img,
            producto.precio_prod,
            producto.stock_prod,
            producto.descripcion_prod,
            producto.id_categoria
        FROM pedidos
        INNER JOIN producto ON pedidos.id_prod = producto.id_producto
        INNER JOIN alumnos ON pedidos.id_alumno = alumnos.id_alumno
        WHERE pedidos.id_alumno = $id_alumno
        ORDER BY producto.nombre_prod ASC";
$query = mysqli_query($con, $sql);

$sql_colegio = $con->prepare("SELECT DISTINCT * FROM alumnos INNER JOIN cursos ON alumnos.id_curso = cursos.id_curso INNER JOIN colegio ON cursos.id_colegio = colegio.id_colegio WHERE alumnos.id_alumno = ?");
$sql_colegio->bind_param("i", $id_alumno);
$sql_colegio->execute();
$result = $sql_colegio->get_result();

if ($result) {
    while ($row = $result->fetch_assoc()) {
        $direccion_colegio = $row['direc_colegio'];
        $fono_colegio = $row['fono'];
        $nombre_colegio = $row['nombre_colegio'];
    }
}
$sql_boleta = $con->prepare("SELECT * FROM boleta WHERE cod_pedido = ?");
$sql_boleta->bind_param("i", $cod_pedido);
$sql_boleta->execute();
$result_boleta = $sql_boleta->get_result();

if ($result_boleta) {
    while ($row = $result_boleta->fetch_assoc()) {
        $fecha_boleta = $row['fecha_boleta'];
    }
}


?>

<head>
    <!--datatable css-->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" />
    <!--datatable responsive css-->
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">
    <?php includeFileWithVariables('../../layouts/title-meta.php', array('title' => 'Vista Productos')); ?>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <?php include '../../layouts/head2.php'; ?>

    <style>
        .description-input-group .desc {
            max-width: 400px;
            white-space: normal;
            word-break: break-word;
            overflow-wrap: break-word;
        }

        .description-input-group {
            display: flex;
            align-items: flex-start;
            width: 100%;
        }

        .description-input-group .avatar-md {
            flex-shrink: 0;
            margin-right: 10px;
        }

        .description-input-group .desc-container {
            flex-grow: 1;
        }

        /* estilos para el navbar privado de clientes el sidebar_index */
        #scrollbar .navbar-nav .nav-link:hover {
            color: rgba(20, 157, 255) !important;
        }

        #scrollbar .navbar-nav .nav-link {
            color: black !important;
        }

        #scrollbar .container-fluid {
            display: flex;
            justify-content: center;
        }

        #scrollbar .navbar-nav {
            display: flex;
            align-items: center;
            list-style: none;
            padding: 0;
            margin: 0;
        }

        #scrollbar .navbar-nav .menu-title {
            margin: 0 10px;
        }

        #scrollbar .navbar-nav .menu-title span {
            color: black;
        }
    </style>

</head>

<body>

    <div id="layout-wrapper">
        <?php include '../../layouts/sidebar_index.php'; ?>
        <?php include '../../layouts/topbar_index.php'; ?>

        <div class="main-content">

            <div class="page-content">
                <div class="container-fluid">

                    <?php includeFileWithVariables('layouts/page-title.php', array('pagetitle' => 'Invoices', 'title' => 'Invoice Details')); ?>

                    <div class="row justify-content-center">
                        <div class="col-xxl-9">
                            <div class="card" id="demo">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="card-header border-bottom-dashed p-4">
                                            <div class="d-flex">
                                                <div class="flex-grow-1">
                                                    <img src="../../assets/images/bolsa-para-la-escuela.png" class="card-logo card-logo-dark" alt="logo dark" height="80">
                                                    <div class="mt-sm-5 mt-4">
                                                        <h6 class="text-muted text-uppercase fw-semibold">Dirección</h6>
                                                        <p class="text-muted mb-1" id="address-details">Coquimbo, La Serena</p>
                                                        <p class="text-muted mb-0" id="zip-code"><span>Codigo Postal:</span> 1700000</p>
                                                    </div>
                                                </div>
                                                <div class="flex-shrink-0 mt-sm-0 mt-3">
                                                    <h6><span class="text-muted fw-normal">Registro Legal No:</span><span id="legal-register-no">987654</span></h6>
                                                    <h6><span class="text-muted fw-normal">Correo:</span><span id="email">christian.rojas@micolegio.com</span></h6>
                                                    <h6><span class="text-muted fw-normal">Sitio web:</span> <a href="../../index.php" class="link-primary" target="_blank" id="website">www.mi_colegio.com</a></h6>
                                                    <h6 class="mb-0"><span class="text-muted fw-normal">Telefono No: </span><span id="contact-no"> +(569) 2234 6789</span></h6>
                                                </div>
                                            </div>
                                        </div>
                                        <!--end card-header-->
                                    </div><!--end col-->
                                    <div class="col-lg-12">
                                        <div class="card-body p-4">
                                            <div class="row g-3">
                                                <div class="col-lg-3 col-6">
                                                    <p class="text-muted mb-2 text-uppercase fw-semibold">N° Boleta</p>
                                                    <h5 class="fs-14 mb-0">#<span id="invoice-no"><?= $cod_pedido ?></span></h5>
                                                </div>
                                                <!--end col-->
                                                <div class="col-lg-3 col-6">
                                                    <p class="text-muted mb-2 text-uppercase fw-semibold">Fecha</p>
                                                    <h5 class="fs-14 mb-0"><span id="invoice-date"><?= $fecha_boleta ?></span></h5>
                                                </div>
                                                <!--end col-->
                                                <div class="col-lg-3 col-6">
                                                    <p class="text-muted mb-2 text-uppercase fw-semibold">Payment Status</p>
                                                    <span class="badge bg-success-subtle text-success fs-11" id="payment-status">Paid</span>
                                                </div>
                                                <!--end col-->
                                                <div class="col-lg-3 col-6">
                                                    <p class="text-muted mb-2 text-uppercase fw-semibold">Monto Total</p>
                                                    <h5 class="fs-14 mb-0">$<span id="total-amount"><?= $total_format ?></span></h5>
                                                </div>
                                                <!--end col-->
                                            </div>
                                            <!--end row-->
                                        </div>
                                        <!--end card-body-->
                                    </div><!--end col-->
                                    <div class="col-lg-12">
                                        <div class="card-body p-4 border-top border-top-dashed">
                                            <div class="row g-3">
                                                <div class="col-6">
                                                    <h6 class="text-muted text-uppercase fw-semibold mb-3">Dirección de envio</h6>
                                                    <p class="fw-medium mb-2" id="billing-name">Mi Colegio SPA</p>
                                                    <p class="text-muted mb-1" id="billing-address-line-1">Balmaceda #1543</p>
                                                    <p class="text-muted mb-1"><span>Telefono: +</span><span id="billing-phone-no">(569) 9456-7890</span></p>
                                                </div>
                                                <!--end col-->
                                                <div class="col-6">
                                                    <h6 class="text-muted text-uppercase fw-semibold mb-3">Dirección de envio</h6>
                                                    <p class="fw-medium mb-2" id="shipping-name"><?= $nombre_colegio ?></p>
                                                    <p class="text-muted mb-1" id="shipping-address-line-1"><?= $direccion_colegio ?></p>
                                                    <p class="text-muted mb-1"><span>Phone: +</span><span id="shipping-phone-no">(56) <?= $fono_colegio ?></span></p>
                                                </div>
                                                <!--end col-->
                                            </div>
                                            <!--end row-->
                                        </div>
                                        <!--end card-body-->
                                    </div><!--end col-->
                                    <div class="col-lg-12">
                                        <div class="card-body p-4">
                                            <div class="table-responsive">
                                                <table class="table table-borderless text-center table-nowrap align-middle mb-0">
                                                    <thead>
                                                        <tr class="table-active">
                                                            <th scope="col" style="width: 50px;">#</th>
                                                            <th scope="col" class="detalle_prod">Detalle de Producto</th>
                                                            <th scope="col">Precio</th>
                                                            <th scope="col">cantidad</th>
                                                            <th scope="col" class="text-end">Total</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="products-list">
                                                        <?php while ($row = mysqli_fetch_array($query)) :
                                                            $precio_format = number_format($row['precio_prod'], 0, '.', '.');
                                                            $tot_prod = $row['precio_prod'] * $row['cant_prod'];
                                                            $tot_prod_format = number_format($tot_prod, 0, '.', '.');
                                                            $total_venta += $tot_prod;
                                                        ?>
                                                            <tr>
                                                                <th scope="row"><?= $num ?></th>
                                                                <td class="text-start" class="detalle_prod">
                                                                    <span class="fw-medium"><?= $row['nombre_prod'] ?></span>
                                                                    <div class="input-group description-input-group">
                                                                        <p class="desc" style="color: #000000a7;">
                                                                            <?= $row['descripcion_prod']; ?>
                                                                        </p>
                                                                    </div>
                                                                </td>
                                                                <td>$<?= $precio_format ?></td>
                                                                <td><?= $row['cant_prod'] ?></td>
                                                                <td class="text-end">$<?= $tot_prod_format ?></td>
                                                            </tr>
                                                        <?php

                                                            $num++;
                                                        endwhile; ?>
                                                    </tbody>
                                                </table><!--end table-->
                                            </div>
                                            <div class="border-top border-top-dashed mt-2">
                                                <table class="table table-borderless table-nowrap align-middle mb-0 ms-auto" style="width:250px">
                                                    <tbody>
                                                        <tr>
                                                            <td>Sub Total</td>
                                                            <td class="text-end">$<?= $sub_total = number_format($total_venta, 0, '.', '.'); ?></td>
                                                        </tr>
                                                        <tr><?php $cobro_servicio = ($total_venta * 12.5) / 100;
                                                            $cobro_servicio_format = number_format($cobro_servicio, 0, '.', '.');
                                                            $total_boleta = $cobro_servicio + $total_venta;
                                                            ?>
                                                            <td>Cobro por servicio (12.5%)</td>
                                                            <td class="text-end">$<?= $cobro_servicio_format ?></td>
                                                        </tr>
                                                        <tr class="border-top border-top-dashed fs-15">
                                                            <th scope="row">Monto total</th>
                                                            <th class="text-end">$<?= $total_boleta_format = number_format($total_boleta, 0, '.', '.') ?></th>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                <!--end table-->
                                            </div>
                                            <div class="mt-3">
                                                <h6 class="text-muted text-uppercase fw-semibold mb-3">Payment Details:</h6>
                                                <p class="text-muted mb-1">Metodo de pago: <span class="fw-medium" id="payment-method">Mastercard</span></p>
                                                <p class="text-muted mb-1">Titular de tarjeta: <span class="fw-medium" id="card-holder-name"><?= $nombre_completo ?></span></p>
                                                <p class="text-muted mb-1">Card Number: <span class="fw-medium" id="card-number">xxx xxxx xxxx <?= $visible ?></span></p>
                                                <p class="text-muted">Monto total: <span class="fw-medium" id="">$ </span><span id="card-total-amount"><?= $total_boleta_format ?></span></p>
                                            </div>
                                            <div class="hstack gap-2 justify-content-end d-print-none mt-4">
                                                <a href="javascript:window.print()" class="btn btn-soft-primary"><i class="ri-printer-line align-bottom me-1"></i> Print</a>
                                                <a href="javascript:void(0);" class="btn btn-primary"><i class="ri-download-2-line align-bottom me-1"></i> Download</a>
                                            </div>
                                        </div>
                                        <!--end card-body-->
                                    </div><!--end col-->
                                </div><!--end row-->
                            </div>
                            <!--end card-->
                        </div>
                        <!--end col-->
                    </div>
                    <!--end row-->

                </div><!-- container-fluid -->
            </div><!-- End Page-content -->

            <?php include '../../layouts/footer_index.php'; ?>
        </div><!-- end main content-->
    </div>
    </div>


    </div>
    <?php include '../../layouts/vendor-scripts 2.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $(document).ready(function() {
            $('.change-brand-btn').on('click', function() {
                var productId = $(this).data('product-id');
                var productDescription = $(this).data('product-description');
                var idList = $(this).data('id-list');
                var idAlumno = $(this).data('id-alumno');
                var nombreColegio = $(this).data('nombre-colegio');
                var idCurso = $(this).data('id-curso');
                $.ajax({
                    url: 'get_related_products.php',
                    method: 'GET',
                    data: {
                        product_description: productDescription,
                        productid: productId,
                        idList: idList,
                        idAlumno: idAlumno,
                        nombreColegio: nombreColegio,
                        idCurso: idCurso
                    },
                    success: function(response) {
                        $('#relatedProductsContainer' + productId).html(response);
                        // Abrir el modal
                        $('#updateProductModal' + productId).modal('show');
                    }
                });
            });

            // Añadir un evento para desplazarse hacia el modal cuando se abra
            $('.modal').on('shown.bs.modal', function() {
                $('html, body').animate({
                    scrollTop: $(this).offset().top - 100
                }, 'slow');
            });
        });

        function changeQuantity(button, change, price, stock) {
            var quantityInput = $(button).siblings('.quantity');
            var newQuantity = parseInt(quantityInput.val()) + change;
            if (newQuantity >= 1 && newQuantity <= stock) {
                quantityInput.val(newQuantity);
                updateTotal(quantityInput[0], price);
            }
        }

        function updateTotal(input, price) {
            var quantity = parseInt(input.value);
            var total = quantity * price;
            $(input).closest('.card-body').find('.total').text('Total: $' + total);
        }
    </script>
    <script>
        document.getElementById('addToCartButton').addEventListener('click', function() {
            var selectedProducts = document.querySelectorAll('.product-checkbox:checked');

            var cartForm = document.createElement('form');
            cartForm.method = 'post';
            cartForm.action = '../Order/carrito.php';

            selectedProducts.forEach(function(checkbox) {
                var productId = checkbox.value;
                var quantityInput = document.querySelector('input[name="products[' + productId + '][quantity]"]');
                var quantity = quantityInput ? quantityInput.value : 1; // Valor por defecto de 1 si no se encuentra el input de cantidad

                var hiddenIdInput = document.createElement('input');
                hiddenIdInput.type = 'hidden';
                hiddenIdInput.name = 'products[' + productId + '][id_producto]';
                hiddenIdInput.value = productId;

                var hiddenQuantityInput = document.createElement('input');
                hiddenQuantityInput.type = 'hidden';
                hiddenQuantityInput.name = 'products[' + productId + '][quantity]';
                hiddenQuantityInput.value = quantity;

                cartForm.appendChild(hiddenIdInput);
                cartForm.appendChild(hiddenQuantityInput);
            });

            document.body.appendChild(cartForm);
            cartForm.submit();
        });
    </script>
    <!-- input step init -->
    <script src="../../assets/js/pages/form-input-spin.init.js"></script>

    <!-- ecommerce cart js -->
    <script src="../../assets/js/pages/ecommerce-cart.init.js"></script>

    <!-- App js -->
    <script src="../../assets/js/app.js"></script>


</body>

</html>