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
    include("../../layouts/config.php");
    $con = connection();
    $sql_prod = "SELECT DISTINCT producto.id_producto, producto.nombre_prod, producto.ruta_img, producto.stock_prod, producto.precio_prod, producto.descripcion_prod, marcas.nombre_marca, categorias.nombre_cat FROM producto inner join marcas inner join categorias where producto.id_marca = marcas.id_marca and producto.id_categoria = categorias.id_categoria ORDER BY nombre_prod ASC";
    $query_prod = mysqli_query($con, $sql_prod);
    $id_curso_select = isset($_GET['id_curso']) ? $_GET['id_curso'] : null;
    if ($id_curso_select !== null && is_numeric($id_curso_select)) {
        $sqlCursos = "SELECT * FROM cursos WHERE id_curso = $id_curso_select";
        $sql = "
            SELECT DISTINCT
                list_1.id_list,
                list_1.id_producto,
                list_1.cant_prod,
                list_1.id_curso,
                producto.id_producto,
                producto.nombre_prod,
                producto.ruta_img,
                producto.precio_prod,
                producto.stock_prod,
                producto.descripcion_prod
            FROM list_1
            INNER JOIN producto ON list_1.id_producto = producto.id_producto
            INNER JOIN cursos ON list_1.id_curso = cursos.id_curso
            WHERE list_1.id_curso = $id_curso_select";

        $query = mysqli_query($con, $sql);

        if (!$query) {
            die("Error en la consulta: " . mysqli_error($con));
        }
    } else {
        die("ID de curso no válido o no proporcionado." . $id_curso_select);
    }
    ?>
    <!-- FIN DE CONSULTA -->
    <style>
        .quantity-input-group .btn {
            font-size: 0.8rem;
            width: 30px;
            height: 30px;
            line-height: 0.8;
            border-radius: 0.25rem;
        }

        .quantity-input-group .form-control {
            max-width: 35px;
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

        .sidebar-label {
            color: #ffffff;

        }

        .sidebar-label:hover {
            color: #25a0e2;
        }
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
    </style>

</head>


<body>

    <!-- Begin page -->
    <div id="layout-wrapper">
        <?php include '../../layouts/sidebar.php'; ?>
        <?php include '../../layouts/topbar-admin.php'; ?>

        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">

            <div class="page-content">
                <div class="container-fluid">

                    <?php includeFileWithVariables('../../layouts/page-title.php', array('pagetitle' => 'Comercio', 'title' => 'Lista de Utiles Escolares')); ?>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <div class="d-flex align-items-center">
                                        <h5 class="card-title flex-grow-1 mb-0">Tabla de Útiles Escolares</h5>

                                        <div class="flex-shrink-0">

                                            <!-- BOTON DE MODAL AGREGAR PRODUCTOS -->
                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ModalProducto"><i class=" ri-add-circle-line"></i>
                                                Agregar Productos
                                            </button>
                                        </div>

                                    </div>
                                </div>
                                <!-- Empieza el Modal de agregar producto-->
                                <div data-aos="fade-up" class="modal fade" id="ModalProducto" tabindex="-1" aria-labelledby="exampleModalgridLabel" aria-modal="true">
                                    <div class="modal-dialog modal-xl">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="ModalProducto">Agregar Producto </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="../../Models/Crud-course/insert-list-course.php" method="POST" enctype="multipart/form-data" onsubmit="validarSeleccion()">
                                                    <input type="hidden" name="id_curso" value="<?= $id_curso_select ?>">
                                                    <table id="agregar_prod" class="table nowrap dt-responsive align-middle table-hover table-bordered" style="width:100%">
                                                        <thead>
                                                            <tr>
                                                                <th></th>
                                                                <th scope="col">Nombre</th>
                                                                <th scope="col">Unidades</th>
                                                                <th scope="col">Precio</th>
                                                                <th scope="col">Stock</th>

                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php while ($row = mysqli_fetch_array($query_prod)) :
                                                                $stock = $row['stock_prod'];
                                                                $precio = $row['precio_prod'];
                                                                $id = $row["id_producto"];
                                                            ?>
                                                                <tr>
                                                                    <th scope="row">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input fs-15" type="checkbox" name="product[]" value="<?= $id ?>">
                                                                        </div>
                                                                    </th>
                                                                    <td>
                                                                        <div class="d-flex flex-column">
                                                                            <div class="flex-grow-1 ms-3" style="padding-top: 5%;">
                                                                                <h5><?= $row['nombre_prod']; ?></h5>
                                                                            </div>
                                                                            <div class="input-group description-input-group">
                                                                                <div class="flex-shrink-0 avatar-md bg-light rounded p-1">
                                                                                    <img src="<?= $row['ruta_img']; ?>" alt="" class="img-fluid d-block">
                                                                                </div>
                                                                                <p class="desc" style="color: #000000a7;">
                                                                                    <?= $row['descripcion_prod']; ?>
                                                                                </p>
                                                                            </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="input-group quantity-input-group">
                                                                            <!-- Botón de menos con ícono de menos -->
                                                                            <button type="button" class="btn btn-sm btn-sm btn-danger" onclick="changeQuantity(this, -1, <?= $precio ?>, <?= $stock ?>)">-</button>
                                                                            <input type="number" class="form-control form-control-sm quantity" name="quantity[<?= $id ?>]" min="1" max="<?= $stock ?>" value="1" onchange="updateTotal(this, <?= $precio ?>)">
                                                                            <!-- Botón de más -->
                                                                            <button type="button" class="btn btn-sm btn-success increment" onclick="changeQuantity(this, 1, <?= $precio ?>, <?= $stock ?>)">+</button>
                                                                        </div>
                                                                    </td>
                                                                    <td>$<span class="price"><?= $precio ?></span></td>
                                                                    <td><?= $stock ?></td>

                                                                </tr>
                                                            <?php endwhile; ?>
                                                        </tbody>
                                                    </table>
                                                    <button type="submit" class="btn btn-primary">Guardar Selección</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Termina El modal de ageegar producto -->
                                <!-- ////////////////////////////////////////////////// -->
                                <!-- Empieza tabla para mostrar productos -->
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="card">
                                            <div class="card-body">
                                                <form action="../../Models/Crud-course/update-list.php" method="POST" enctype="multipart/form-data">
                                                    <input type="hidden" name="id_curso" value="<?= $id_curso_select ?>">
                                                    <table id="example" class="table nowrap dt-responsive align-middle table-hover table-bordered" style="width:100%">
                                                        <p style="color: #000000a7;">Para actualizar las unidades de productos, por favor seleccione el producto primero.</p>
                                                        <thead>
                                                            <tr>
                                                                <th></th>
                                                                <th scope="col">Nombre</th>
                                                                <th scope="col">Unidades</th>
                                                                <th scope="col">Precio</th>
                                                                <th scope="col">Stock</th>
                                                                <th scope="col">Total</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php while ($row = mysqli_fetch_array($query)) :
                                                                $stock = $row['stock_prod'];
                                                                $precio = $row['precio_prod'];
                                                                $id = $row["id_producto"];
                                                                $id_list = $row['id_list'];
                                                                $cant_prod = $row['cant_prod'];
                                                                $total = $cant_prod * $precio;
                                                            ?>
                                                                <tr>
                                                                    <th scope="row">
                                                                        <div class="form-check">
                                                                            <input class="form-check-input fs-15" type="checkbox" name="product[]" value="<?= $id; ?>">
                                                                        </div>
                                                                    </th>
                                                                    <td>
                                                                        <div class="d-flex flex-column">
                                                                            <div class="flex-grow-1 ms-3" style="padding-top: 5%;">
                                                                                <h5><?= $row['nombre_prod']; ?></h5>
                                                                            </div>
                                                                            <div class="input-group description-input-group">
                                                                                <div class="flex-shrink-0 avatar-md bg-light rounded p-1">
                                                                                    <img src="<?= $row['ruta_img']; ?>" alt="" class="img-fluid d-block">
                                                                                </div>
                                                                                <p class="desc" style="color: #000000a7;">
                                                                                    <?= $row['descripcion_prod']; ?>
                                                                                </p>
                                                                            </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="input-group quantity-input-group">
                                                                            <!-- Botón de eliminar con ícono de tarro de basura -->
                                                                            <button type="button" class="btn btn-sm btn-danger" onclick="deleteProduct(event, <?= $id_list ?>, <?= $id_curso_select ?>)"><i class="ri-delete-bin-5-line"></i></button>

                                                                            <input type="number" class="form-control form-control-sm quantity" name="quantity[<?= $id ?>]" min="1" max="<?= $stock ?>" value="<?= $cant_prod; ?>" onchange="updateTotal(this, <?= $precio ?>)">

                                                                            <!-- Botón de menos con ícono de menos -->
                                                                            <button type="button" class="btn btn-sm btn-sm btn-danger" onclick="changeQuantity(this, -1, <?= $precio ?>, <?= $stock ?>)">-</button>
                                                                            <!-- Botón de más -->
                                                                            <button type="button" class="btn btn-sm btn-success increment" onclick="changeQuantity(this, 1, <?= $precio ?>, <?= $stock ?>)">+</button>
                                                                        </div>
                                                                    </td>
                                                                    <td>$<span class="price"><?= $precio ?></span></td>
                                                                    <td><?= $stock ?></td>
                                                                    <td id="formatted-number"><span class="total"><?= number_format($total, 0, ',', '.') ?></span></td>
                                                                </tr>
                                                            <?php endwhile; ?>
                                                        </tbody>
                                                        <tfoot>
                                                            <tr>
                                                                <th colspan="5" style="text-align:right">Valorización de la lista:</th>
                                                                <th><span id="grandTotal">0</span></th>

                                                            </tr>
                                                        </tfoot>
                                                    </table>
                                                    <input type="hidden" name="grandTotalHidden" id="grandTotalHidden">
                                                    <button type="submit" class="btn btn-primary">Actualizar unidades</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- TERMINA TABLA COMO TAL -->
                            </div><!-- container-fluid -->
                        </div>

                    </div>
                    <!-- Termina todo el contenido de la vista tabla  -->
                </div>
                <!-- termina pagina -->
            </div>
        </div>
    </div>
    <?php include '../../layouts/footer.php'; ?>
    <?php include '../../layouts/vendor-scripts.php'; ?>

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
    <script src="../../assets/js/pages/traduction-report.js"></script>
    <script src="../../assets/js/pages/datatables.init.js"></script>
    <script src="../../assets/js/pages/datatable_list.init.js"></script>
    <!-- App js -->

    <script src="../../assets/js/app.js"></script>
    <?php include '../../layouts/vendor-scripts 2.php'; ?>
    <script src="../../assets/js/app.js"></script>

    <script>
        function updateTotal(element, price) {
            const quantity = element.value;
            const totalElement = element.closest('tr').querySelector('.total');
            const total = quantity * price;
            totalElement.textContent = total;
        }

        function changeQuantity(button, increment, price, maxStock) {
            const input = button.closest('.quantity-input-group').querySelector('.quantity');
            let newValue = parseInt(input.value) + increment;
            if (newValue < 1) newValue = 1;
            if (newValue > maxStock) newValue = maxStock;
            input.value = newValue;
            updateTotal(input, price);
        }
    </script>

    <!-- SCRIPT PARA ALERTAR DE ELIMINACION DE PRODUCTO -->
    <script>
        function deleteProduct(event, id_list, id_curso_select) {
            console.log("ID of the product to delete:", id_list, " curso: ", id_curso_select);
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
                title: "¿Desea Realmente Borrar El Producto",
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
                        "Producto Eliminado con Exíto.",
                        "success"

                    );
                    setTimeout(() => {
                        window.location.href = "../../Models/Crud-course/delete-prod-list.php?id_list=" + id_list + "&id_curso=" + id_curso_select;
                    }, 1500); // se controla que se demore 1.5 segundos para la eliminacion 


                } else if (
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    // Aquí maneja la cancelación
                    swalWithBootstrapButtons.fire(
                        "Cancelado",
                        "Producto a salvo :)",
                        "error"
                    );
                }
            });
        }
    </script>
    <!-- Termina Script -->
    <!-- Scripts para validar que solo se ingresen numeros en apartado de precio y stock -->
    <script>
        function Valida_numero_prod() {
            const input = document.getElementById('precio_prod');
            const value = input.value;
            const isValid = /^\d*/.test(value); // Expresión regular para solo números

            if (!isValid) {
                input.setCustomValidity('Por favor, ingresa solo números.');
                input.reportValidity();
                return false; // Evita el envío del formulario
            } else {
                input.setCustomValidity(''); // Resetea el mensaje de validación
                return true; // Permite el envío del formulario
            }
        }
    </script>
    <script>
        function Valida_numero_stock() {
            const input = document.getElementById('stock_prod');
            const value = input.value;
            const isValid = /^\d*$/.test(value); // Expresión regular para solo números

            if (!isValid) {
                input.setCustomValidity('Por favor, ingresa solo números.');
                input.reportValidity();
                return false; // Evita el envío del formulario
            } else {
                input.setCustomValidity(''); // Resetea el mensaje de validación
                return true; // Permite el envío del formulario
            }
        }
    </script>
    <script>
        function Mayuscula(input) {
            input.value = input.value.toUpperCase();
        }
    </script>
    <script>
        function update(event, id_producto, nombre_prod, stock_prod, precio_prod, descripcion_prod) {
            alert(id_producto);
            var nombre = document.getElementById('nombre_prod_edit');
            var precio = document.getElementById('precio_prod_edit');
            var stock = document.getElementById('stock_prod_edit');
            var descripcion = document.getElementById('descripcion_prod_edit');
            nombre.value = nombre_prod
            precio.value = precio_prod;
            stock.value = stock_prod;
            descripcion.value = descripcion_prod;
        }
    </script>

    <script>
        function formatAsChileanPeso(amount) {
            return new Intl.NumberFormat('es-CL', {
                style: 'currency',
                currency: 'CLP'
            }).format(amount);
        }

        // Function to update the total of each row and the grand total
        function updateTotal(element, price) {
            const quantity = parseInt(element.value);
            if (isNaN(quantity) || quantity < 0) return;
            const totalElement = element.closest('tr').querySelector('.total');
            const total = quantity * price;
            totalElement.textContent = formatAsChileanPeso(total);

            // Update grand total
            calculateGrandTotal();
        }

        // Function to change the quantity and update the total
        function changeQuantity(button, increment, price, maxStock) {
            const input = button.closest('.quantity-input-group').querySelector('.quantity');
            let newValue = parseInt(input.value) + increment;
            if (newValue < 1) newValue = 1;
            if (newValue > maxStock) newValue = maxStock;
            input.value = newValue;
            updateTotal(input, price);
        }

        // Function to calculate the grand total
        function calculateGrandTotal() {
            let grandTotal = 0;
            // Only select rows from the visible table
            document.querySelectorAll('table tbody tr').forEach(row => {
                const totalElement = row.querySelector('.total');
                if (totalElement) {
                    const totalText = totalElement.textContent.replace(/[^\d,-]/g, '').replace('.', '').replace(',', '.');
                    const totalValue = parseFloat(totalText);
                    if (!isNaN(totalValue)) {
                        grandTotal += totalValue;
                    }
                }
            });

            document.getElementById('grandTotal').textContent = formatAsChileanPeso(grandTotal);
            document.getElementById('grandTotalHidden').value = grandTotal;
        }
        // Calculate grand total on page load
        document.addEventListener('DOMContentLoaded', calculateGrandTotal);
    </script>
    <!-- Script que valida si toma algun checkbox para lanzar un mensaje -->
    <script>
        // Función para validar selección de productos antes de enviar el formulario
        function validarSeleccion() {
            var checkboxes = document.querySelectorAll('input[type="checkbox"][name="product[]"]');
            var seleccionado = false;

            checkboxes.forEach(function(checkbox) {
                if (checkbox.checked) {
                    seleccionado = true;
                }
            });

            if (!seleccionado) {
                // Mostrar SweetAlert indicando que debe seleccionar al menos un producto
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Debe seleccionar al menos un producto antes de guardar.',
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'Entendido'
                });
                return false; // Evita que el formulario se envíe
            }

            // Si hay al menos un producto seleccionado, enviar el formulario
            return true;
        }

        // Agregar el evento onSubmit al formulario para llamar a la función validarSeleccion
        document.querySelector('form').addEventListener('submit', function(event) {
            if (!validarSeleccion()) {
                event.preventDefault(); // Evita que el formulario se envíe si no hay productos seleccionados
            }
        });
    </script>
    <!-- Fin de los Scripts -->
</body>

</html>