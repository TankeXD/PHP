<?php include '../../layouts/session.php'; ?>
<?php include '../../layouts/main.php'; ?>

<?php
include '../../layouts/config.php';
$id_client = $_SESSION['id_cliente'];
$id_alumno = $_GET['id_alumno'];
$con = connection();
$boleta = 0;
// Consulta SQL para contar el número de filas en la tabla
$sql_count = "SELECT COUNT(*) AS total FROM pedidos";
$result = $con->query($sql_count);

// Verificar si hay resultados y obtener el conteo
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $conteo = $row["total"];
} else {
    echo "No se encontraron resultados";
}

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
$total = 0;

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

                    <?php includeFileWithVariables('layouts/page-title.php', array('pagetitle' => 'Ecommerce', 'title' => 'Shopping Cart')); ?>

                    <div class="row mb-3">
                        <div class="col-xl-8">
                            <div class="row align-items-center gy-3 mb-3">
                                <div class="col-sm">
                                    <div>
                                        <h5 class="fs-14 mb-0">Tu Carrito (<?php echo ($conteo); ?>)</h5>
                                    </div>
                                </div>
                                <div class="col-sm-auto">
                                    <a href="../../index.php" class="link-primary text-decoration-underline">Volver al inicio</a>
                                </div>
                            </div>
                            <?php while ($row = mysqli_fetch_array($query)) : 
                                $img = $row['ruta_img'];
                                $total_prod = $row['cant_prod'] * $row['precio_prod'];
                                $total += $total_prod;
                                $precio = $row['precio_prod'];
                                $precio_formateado = number_format($precio, 0, '.', '.');
                                $total_formateado = number_format($total, 0, '.', '.');
                                $total_prod_formateado = number_format($total_prod, 0, '.', '.');
                                ?>
                            <div class="card product">
                                <!-- card body -->
                                <div class="card-body">
                                    <div class="row gy-3">
                                        <div class="col-sm-auto">
                                            <div class="avatar-lg bg-light rounded p-1">
                                                <img src="<?= $img ?>" alt="" class="img-fluid d-block">
                                            </div>
                                        </div>
                                        <div class="col-sm">
                                            <h5 class="fs-14 text-truncate"><a href="ecommerce-product-detail.php" class="text-body"><?= $row['nombre_prod'] ?></a></h5>
                                            <p class="fs-14 "  ><?php echo($row['descripcion_prod']); ?> </p>
                                            <p class="fs-14 text-truncate">Cantidad: <b><?= $row['cant_prod'] ?></b></p>
                                        </div>
                                        
                                        <div class="col-sm-auto">
                                            <div class="text-lg-end">
                                                <p class="text-muted mb-1">Valor unidad:</p>
                                                <h5 class="fs-14">$<span id="ticket_price" class="product-price"><?= $precio_formateado ?></span></h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--card footer -->
                                <div class="card-footer">
                                    <div class="row align-items-center gy-3">
                                        <div class="col-sm-auto">
                                            <div class="d-flex align-items-center gap-2 text-muted">
                                                <div>Total :</div>
                                                <h5 class="fs-14 mb-0">$<span class="product-line-price"><?= $total_prod_formateado ?></span></h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- end card footer -->
                            </div>
                            <!-- end card -->
                            <?php endwhile; 
                            ?>


                        <form action="pago.php" id="controler-form" method="post"></form>
                        <input type="hidden" form="controler-form" name="id_alumno" value="<?= $id_alumno ?>">
                        <input type="hidden" form="controler-form" name="total_boleta" value="<?= $boleta ?>">
                            <div class="text-end mb-4">
                                <button type="submit" form="controler-form" class="btn btn-primary btn-label right ms-auto"><i class="ri-arrow-right-line label-icon align-bottom fs-16 ms-2"></i> Proceder al Pago</button>
                            </div>
                        </div>
                        <!-- end col -->

                        <div class="col-xl-4">
                            <div class="sticky-side-div">
                                <div class="card">
                                    <div class="card-header border-bottom-dashed">
                                        <h5 class="card-title mb-0">Total de la boleta</h5>
                                    </div>
                                    <div class="card-body pt-2">
                                        <div class="table-responsive">
                                            <table class="table table-borderless mb-0">
                                                <tbody>
                                                    <tr>
                                                        <td>Sub Total :</td>
                                                        <td class="text-end" id="cart-subtotal">$ <?= $total_formateado ?></td>
                                                    </tr>
                                                    <?php 
                                                    $servicio = ($total * 12.5)/100;
                                                    $servicio_formateado = number_format($servicio, 0, '.', '.');
                                                    $boleta = $servicio + $total;
                                                    $boleta_formateado = number_format($boleta, 0, '.', '.');
                                                    ?>
                                                    <tr>
                                                        <td>Costo de servicio (12.5%) : </td>
                                                        <td class="text-end" id="cart-tax">$ <?= $servicio_formateado ?></td>
                                                    </tr>
                                                    <tr class="table-active">
                                                        <th>Total :</th>
                                                        <td class="text-end">
                                                            <span class="fw-semibold" id="cart-total">
                                                                $<?= $boleta_formateado?>
                                                            </span>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <!-- end table-responsive -->
                                    </div>
                                </div>
                            </div>
                            <!-- end stickey -->

                        </div>
                    </div>
                    <!-- end row -->
                </div>
                <!-- container-fluid -->
            </div>
            <!-- End Page-content -->

            <?php include '../../layouts/footer_index.php'; ?>
        </div>
        <!-- end main content-->
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