<?php include '../../layouts/session.php'; ?>
<?php include '../../layouts/main.php'; ?>

<head>
    <!--datatable css-->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" />
    <!--datatable responsive css-->
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">
    <?php includeFileWithVariables('../../layouts/title-meta.php', array('title' => 'Vista Productos')); ?>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <?php include '../../layouts/head2.php'; ?>
    <!-- SE HACE LA CONSULTA PARA TRAER DATOS DE PRODUCTOS QUE SERAN OCUPADOS EN LA TABLA -->
    <?php
    $nombre_colegio = $_GET['nombre_colegio'];
    include("../../layouts/config.php");
    $con = connection();
    $sql_prod = "SELECT DISTINCT producto.id_producto, producto.nombre_prod, producto.ruta_img, producto.stock_prod, producto.precio_prod, producto.descripcion_prod, marcas.nombre_marca, categorias.id_categoria, categorias.nombre_cat FROM producto INNER JOIN marcas ON producto.id_marca = marcas.id_marca INNER JOIN categorias ON producto.id_categoria = categorias.id_categoria ORDER BY nombre_prod ASC";
    $query_prod = mysqli_query($con, $sql_prod);
    $id_curso_select = isset($_GET['id_curso']) ? $_GET['id_curso'] : null;
    $id_alumno = isset($_GET['id_alumno']) ? $_GET['id_alumno'] : null;
    if ($id_curso_select !== null && is_numeric($id_curso_select)) {
        $sqlCursos = "SELECT * FROM cursos WHERE id_curso = $id_curso_select";
        $sql = "
            SELECT DISTINCT
                list_2.id_list,
                list_2.id_producto,
                list_2.cant_prod,
                list_2.id_alumno,
                producto.id_producto,
                producto.nombre_prod,
                producto.ruta_img,
                producto.precio_prod,
                producto.stock_prod,
                producto.descripcion_prod,
                producto.id_categoria
            FROM list_2
            INNER JOIN producto ON list_2.id_producto = producto.id_producto
            INNER JOIN alumnos ON list_2.id_alumno = alumnos.id_alumno
            WHERE list_2.id_alumno = $id_alumno
            ORDER BY producto.nombre_prod ASC";

        $query = mysqli_query($con, $sql);
        $query_curso = mysqli_query($con, $sqlCursos);
        while ($row = mysqli_fetch_array($query_curso)) :
            $curso = $row['curso'];
        endwhile;
        if (!$query) {
            die("Error en la consulta: " . mysqli_error($con));
        }
    } else {
        die("ID de curso no válido o no proporcionado." . $id_curso_select);
    }
    ?>
    <!-- FIN DE CONSULTA -->
    <style>
        /* estilos para sidebar horizontal */
        #scrollbar .navbar-nav .nav-link:hover {
            color: rgba(20, 157, 255);
        }

        #scrollbar .navbar-nav .nav-link {
            color: black;
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

        /* termina estilos para el siderbarhorizontal */

        /* estilos de cards */
        .card {
            height: 100%;
        }

        .card-img-top {
            width: auto;
            height: 200px;
            object-fit: contain;
            display: block;
            margin: 0 auto;
        }

        .card-body {
            text-align: center;
        }

        .card-body .input-group {
            margin-bottom: 10px;
        }

        .card-body .total {
            font-weight: bold;
        }

        .card-body .d-flex.justify-content-center {
            margin-top: 10px;
        }

        .card-body {
            text-align: center;
        }

        .card-body .input-group {
            margin-bottom: 10px;
        }

        .card-body .total {
            font-weight: bold;
        }

        .card-body .d-flex.justify-content-center {
            margin-top: 10px;
        }

        .quantity-input-group {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .quantity-input-group .btn {
            margin: 0 5px;
        }

        .quantity-input-group .form-control {
            width: 50px;
            text-align: center;
        }

        .product-button {
            display: flex;
            justify-content: center;
        }

        .product-button .btn-primary {
            margin-top: 10px;
        }

        quantity-input-group .btn {
            font-size: 0.8rem;
            width: 30px;
            height: 30px;
            line-height: 0.8;
            border-radius: 0.25rem;
        }

        .quantity-input-group .form-control {
            max-width: 50px;
            text-align: center;
        }

        .description-input-group .desc {
            max-width: 300px;
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

        /* terminan estilos para cards  */

        /* estilos para el modal de cambiar producto */
        .modal-lg .card-img-top {
            width: 100%;
            height: 250px;
            /* Ajusta la altura según tus necesidades */
            object-fit: cover;
        }

        .modal-lg .card-body {
            text-align: center;
        }

        .modal-lg .form-check {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        @media (max-width: 768px) {
            .modal-dialog {
                max-width: 100%;
                margin: 10px;
            }

            .modal-lg .col-md-4 {
                flex: 0 0 100%;
                max-width: 100%;
            }
        }

        .modal-dialog-centered {
            display: flex;
            align-items: center;
            min-height: calc(100% - 1rem);
        }

        .modal-dialog-scrollable .modal-content {
            max-height: 80vh;
            /* Ajusta este valor según sea necesario */
            overflow: hidden;
        }

        .navbar-header {
            background: linear-gradient(45deg, #6ab1d7, #33d9b2);
        }

        .invisible-checkbox {
            display: none;
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
                    <!-- Your page content here -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <div class="d-flex align-items-center">
                                        <h5 class="card-title flex-grow-1 mb-0">Lista de Productos</h5>
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ModalProducto">
                                            <i class="ri-add-circle-line"></i> Agregar Productos
                                        </button>
                                    </div>
                                </div>

                                <!-- MODAL PARA AGREGAR MÁS PRODUCTOS-->
                                <div class="modal fade" id="ModalProducto" tabindex="-1" aria-labelledby="ModalProductoLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-xl">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="ModalProductoLabel">Agregar Producto</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="/my-school/Models/Crud-student/insert-list-student.php" method="POST" enctype="multipart/form-data">
                                                    <input type="hidden" name="id_curso" value="<?= $id_curso_select ?>">
                                                    <input type="hidden" name="id_alumno" value="<?= $id_alumno ?>">
                                                    <input type="hidden" name="nombre_colegio" value="<?= $nombre_colegio ?>">
                                                    <div class="row">
                                                        <?php while ($row = mysqli_fetch_array($query_prod)) :
                                                            $stock = $row['stock_prod'];
                                                            $precio = $row['precio_prod'];
                                                            $id = $row["id_producto"];
                                                        ?>
                                                            <div class="col-md-4">
                                                                <div class="card mb-4">
                                                                    <img class="card-img-top" src="<?= $row['ruta_img']; ?>" alt="Product image">
                                                                    <div class="card-body">
                                                                        <h5 class="card-title"><?= $row['nombre_prod']; ?></h5>
                                                                        <p class="card-text"><?= $row['descripcion_prod']; ?></p>
                                                                        <p class="card-text">Precio: $<?= $precio ?></p>
                                                                        <p class="card-text">Stock: <?= $stock ?></p>
                                                                        <div class="input-group quantity-input-group mb-3">
                                                                            <button type="button" class="btn btn-sm btn-danger" onclick="changeQuantity(this, -1, <?= $precio ?>, <?= $stock ?>)">-</button>
                                                                            <input type="number" class="form-control form-control-sm quantity" name="quantity[<?= $id ?>]" min="1" max="<?= $stock ?>" value="1" onchange="updateTotal(this, <?= $precio ?>)">
                                                                            <button type="button" class="btn btn-sm btn-success increment" onclick="changeQuantity(this, 1, <?= $precio ?>, <?= $stock ?>)">+</button>
                                                                        </div>
                                                                        <div class="form-check">
                                                                            <input class="form-check-input" type="checkbox" value="<?= $id ?>" name="product[]" id="product_<?= $id ?>">
                                                                            <label class="form-check-label" for="product_<?= $id ?>">Seleccionar</label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        <?php endwhile; ?>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                                        <button type="submit" class="btn btn-primary">Agregar Productos</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-body">
                                    <form id="order-form" action="../../Models/Crud-order/cart.php" method="POST">

                                        <input form="oder-form" type="hidden" name="id_curso" value="<?= $id_curso_select ?>">
                                        <input form="oder-form" type="hidden" name="id_alumno" value="<?= $id_alumno ?>">
                                        <input form="oder-form" type="hidden" name="id_cliente" value="<?= $id ?>">
                                        <div class="row">
                                            <?php while ($row = mysqli_fetch_array($query)) :
                                                $cantidad = $row['cant_prod'];
                                                $precio = $row['precio_prod'];
                                                $id_producto = $row['id_producto'];
                                                $stock = $row['stock_prod'];
                                                $id_list = $row['id_list'];
                                            ?>
                                                <!-- Cards de productos del cliente -->
                                                <div class="col-md-4">
                                                    <div class="card mb-4">
                                                        <img class="card-img-top" src="<?= $row['ruta_img']; ?>" alt="Product image">
                                                        <div class="card-body">
                                                            <input type="checkbox" class="product-checkbox invisible-checkbox" name="products[<?= $id_producto ?>][id_producto]" value="<?= $id_producto ?>" checked>
                                                            <h5 class="card-title"><?= $row['nombre_prod']; ?></h5>
                                                            <p class="card-text desc"><?= $row['descripcion_prod']; ?></p>
                                                            <p class="card-text">Precio Unitario: $<?= $precio ?></p>
                                                            <p class="card-text">Stock: <?= $stock ?></p>
                                                            <div class="input-group quantity-input-group">
                                                                <button type="button" class="btn btn-sm btn-danger" onclick="changeQuantity(this, -1, <?= $precio ?>, <?= $stock ?>)">-</button>
                                                                <input type="number" class="form-control form-control-sm quantity" name="products[<?= $id_producto ?>][quantity]" min="1" max="<?= $stock ?>" value="<?= $cantidad ?>" onchange="updateTotal(this, <?= $precio ?>)">
                                                                <button type="button" class="btn btn-sm btn-success increment" onclick="changeQuantity(this, 1, <?= $precio ?>, <?= $stock ?>)">+</button>
                                                            </div>
                                                            <p class="total">Total: $<?= $cantidad * $precio ?></p>
                                                            <div class="d-flex justify-content-space-between" style="display: flex; justify-content:space-between">
                                                                <a style="margin-left: 30px;" href="../../Models/Crud-student/update-product.php?id_curso=<?= $id_curso_select ?>&id_alumno=<?= $id_alumno ?>&nombre_colegio=<?= $nombre_colegio ?>" class="btn btn-primary">Actualizar</a>
                                                                <button type="button" style="margin-right: 30px;" class="btn btn-sm btn-primary change-brand-btn" data-product-id="<?= $id_producto; ?>" data-product-description="<?= $row['descripcion_prod']; ?>" data-id-list="<?= $id_list ?>" data-id-alumno="<?= $id_alumno ?>" data-nombre-colegio="<?= $nombre_colegio ?>" data-id-curso="<?= $id_curso_select ?>" data-bs-toggle="modal" data-bs-target="#updateProductModal<?= $id_producto; ?>">Cambiar Marca</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Modal para cambiar marca -->
                                                <div class="modal fade" id="updateProductModal<?= $id_producto; ?>" tabindex="-1" aria-labelledby="updateProductModalLabel<?= $id_producto; ?>" aria-hidden="true">
                                                    <form id="changeBrandForm<?= $id_producto; ?>" action="../../Models/Crud-student/update-product-brand.php" method="POST"></form>
                                                        <input type="hidden" name="id_list" value="<?= $id_list; ?>">
                                                        <input type="hidden" name="id_producto_original" value="<?= $id_producto; ?>">
                                                        <input type="hidden" name="id_alumno" value="<?= $id_alumno; ?>">
                                                        <input type="hidden" name="nombre_colegio" value="<?= $nombre_colegio; ?>">
                                                        <input type="hidden" name="id_curso" value="<?= $id_curso_select; ?>">
                                                        <input type="hidden" name="new_product" id="new_product_<?= $id_producto; ?>" value="">
                                                        <div class="modal-dialog modal-lg modal-dialog-scrollable">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="updateProductModalLabel<?= $id_producto; ?>">Cambiar Marca</h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="row" id="relatedProductsContainer<?= $id_producto; ?>">
                                                                        <!-- Aquí se insertarán los productos relacionados mediante AJAX -->
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="submit" form="changeBrandForm<?= $id_producto; ?>" class="btn btn-primary">Guardar Cambios</button>
                                                                </div>
                                                    
                                                </div>
                                        </div>
                                    </form>
                                </div>
                            <?php endwhile; ?>
                            </div>
                        </div>
                        <div class="card-footer">
                            <a href="../../index.php" class="btn btn-secondary">Volver</a>
                            <button id="addToCartButton" class="btn btn-primary" form="order-form">Confirmar Carrito</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>


    <?php include '../../layouts/footer_index.php'; ?>
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


    <!-- Script para al apretar el boton confirmar producto mande a carrito  y salga el mensaje de alerta -->
    <script>
        document.getElementById("addToCartButton").addEventListener("click", function(event) {
            event.preventDefault();

            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: "btn btn-success",
                    cancelButton: "btn btn-danger"
                },
                buttonsStyling: false
            });

            swalWithBootstrapButtons.fire({
                title: "¿Está seguro de confirmar el carrito?",
                html: '<span style="color: red;">Si confirma no podrá volver a modificar su lista</span>',
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Sí, confirmar!",
                cancelButtonText: "No, cancelar!",
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    swalWithBootstrapButtons.fire(
                        "Confirmado!",
                        "Su carrito ha sido confirmado.",
                        "success"
                    );

                    setTimeout(() => {
                        var selectedProducts = document.querySelectorAll('.product-checkbox:checked');
                        var cartForm = document.getElementById('order-form');

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

                        cartForm.submit();
                    }, 1500); // Esperar 1.5 segundos antes de enviar el formulario
                } else if (result.dismiss === Swal.DismissReason.cancel) {
                    swalWithBootstrapButtons.fire(
                        "Cancelado",
                        "Su carrito no ha sido confirmado :)",
                        "error"
                    );
                }
            });
        });
    </script>
</body>

</html>