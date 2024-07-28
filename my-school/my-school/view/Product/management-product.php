<?php include '../../layouts/session.php'; ?>
<?php include '../../layouts/main.php'; ?>

<head>
    <!--datatable css-->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" />
    <!--datatable responsive css-->
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">
    <?php includeFileWithVariables('../../layouts/title-meta.php', array('title' => 'Gestión Productos')); ?>
    <?php include '../../layouts/head2.php'; ?>
    <!-- SE HACE LA CONSULTA PARA TRAER DATOS DE PRODUCTOS QUE SERAN OCUPADOS EN LA TABLA -->
    <?php
    include("../../layouts/config.php");
    $con = connection();

    $sql = "SELECT producto.id_producto, producto.nombre_prod, producto.ruta_img, producto.stock_prod, producto.precio_prod, producto.descripcion_prod, marcas.nombre_marca, categorias.nombre_cat FROM producto inner join marcas inner join categorias where producto.id_marca = marcas.id_marca and producto.id_categoria = categorias.id_categoria ORDER BY nombre_prod ASC";
    $query = mysqli_query($con, $sql);
    $sql2 = "SELECT * FROM marcas ORDER BY nombre_marca ASC";
    $selectM = mysqli_query($con, $sql2);
    $sql3 = "SELECT * FROM categorias ORDER BY nombre_cat ASC";
    $selectC = mysqli_query($con, $sql3);
    ?>
    <!-- FIN DE CONSULTA -->

    <!-- estilos para titulos de sidebar color primario y cuando se pasa por encima -->
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

                    <?php includeFileWithVariables('../../layouts/page-title.php', array('pagetitle' => 'Comercio', 'title' => 'Gestionar Productos')); ?>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <div class="d-flex align-items-center">
                                        <h5 class="card-title flex-grow-1 mb-0">Tabla de Productos</h5>
                                        <div class="flex-shrink-0">

                                            <!-- BOTON DE MODAL AGREGAR PRODUCTOS -->
                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ModalProducto"><i class="ri-add-circle-fill"></i>
                                                Agregar Productos
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <!-- Empieza el Modal de agregar producto-->
                                <div data-aos="fade-up" class="modal fade" id="ModalProducto" tabindex="-1" aria-labelledby="exampleModalgridLabel" aria-modal="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="ModalProducto">Agregar Producto </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="../../Models/Crud-product/add-product.php" method="POST" enctype="multipart/form-data" onsubmit="confirmacionProduct(event)">
                                                    <div class="row g-3">
                                                        <div class="col-lg-12">
                                                            <div>
                                                                <label for="firstName" class="form-label">Nombre del producto</label>
                                                                <input type="text" class="form-control" name="nombre_prod" id="nombre_prod" oninput="Mayuscula(this)" placeholder="Ingrese el nombre del producto" required>
                                                            </div>
                                                        </div><!--end col-->
                                                        <div class="col-lg-12">
                                                            <div>
                                                                <label for="lastName" class="form-label">Precio por unidad</label>
                                                                <input type="number" class="form-control" name="precio_prod" id="precio_prod" oninput="Valida_numero_prod()" placeholder="Ingrese precio" required>
                                                            </div>
                                                        </div><!--end col-->
                                                        <div class="col-lg-12">
                                                            <div>
                                                                <label for="emailInput" class="form-label">stock</label>
                                                                <input type="number" class="form-control" name="stock_prod" id="stock_prod" oninput="Valida_numero_stock()" placeholder="stock del producto" required>
                                                            </div>
                                                        </div><!--end col-->
                                                        <div class="col-lg-12">
                                                            <div>
                                                                <label for="passwordInput" class="form-label">Descripción</label>
                                                                <input type="text" class="form-control" name="descripcion_prod" id="descripcion_prod" oninput="Mayuscula(this)" placeholder="Ingrese una  descripción breve" required>
                                                            </div>
                                                        </div><!--end col-->
                                                        <div class="col-lg-12">
                                                            <div>
                                                                <label for="passwordInput" class="form-label">Imagen</label>
                                                                <input type="file" class="form-control" name="img_prod" id="img_prod" required>
                                                            </div>
                                                        </div><!--end col-->
                                                        <!-- Select option de categorias -->
                                                        <div class="col-lg-12">
                                                            <div class="card-header">
                                                                <div class="d-flex align-items-center justify-content-center">
                                                                    <div class="input-group mb-3" style="width: 306px; margin-right: 10px;">
                                                                        <select id="categoriaSelect" name="id_categoria" class="form-select" aria-label=".form-select-lg example">
                                                                            <option selected disabled>Seleccionar Categoría</option>
                                                                            <?php while ($row = mysqli_fetch_array($selectC)) : ?>
                                                                                <option value="<?= $row['id_categoria'] ?>"><?= $row['nombre_cat'] ?></option>
                                                                            <?php endwhile; ?>
                                                                        </select>
                                                                        <!-- BOTON DE MODAL DE AGREGAR CATEGORIAS -->
                                                                        <button type="button" data-bs-toggle="modal" data-bs-target="#ModalCategoria" class="btn btn-primary" style="margin-right: 5px;">
                                                                            <i class="ri-add-circle-fill" style="font-size: 1.3rem;"></i>
                                                                        </button>
                                                                        <!-- BOTON DE MODAL DE ELIMINAR CATEGORIAS -->
                                                                        <button type="button" id="openEliminarModalCategoria" class="btn btn-danger">
                                                                            <i class="ri-delete-bin-6-fill" style="font-size: 1.3rem;"></i>
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- Select option de marcas -->
                                                        <div class="col-lg-12">
                                                            <div class="card-header">
                                                                <div class="d-flex align-items-center justify-content-center">
                                                                    <div class="input-group mb-3" style="width: 306px; margin-right: 10px;">
                                                                        <select id="marcaSelect" name="id_marca" class="form-select" aria-label=".form-select-lg example">
                                                                            <option selected disabled>Seleccionar Marca</option>
                                                                            <?php while ($row = mysqli_fetch_array($selectM)) : ?>
                                                                                <option value="<?= $row['id_marca'] ?>"><?= $row['nombre_marca'] ?></option>
                                                                            <?php endwhile; ?>
                                                                        </select>
                                                                        <!-- BOTON DE MODAL DE AGREGAR MARCAS -->
                                                                        <button type="button" data-bs-toggle="modal" data-bs-target="#ModalMarca" class="btn btn-primary" style="margin-right: 5px;">
                                                                            <i class="ri-add-circle-fill" style="font-size: 1.3rem;"></i>
                                                                        </button>
                                                                        <!-- BOTON DE MODAL DE ELIMINAR MARCAS -->
                                                                        <button type="button" id="openEliminarModalMarca" class="btn btn-danger">
                                                                            <i class="ri-delete-bin-6-fill" style="font-size: 1.3rem;"></i>
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- botones de ingreso -->
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
                                <!-- Termina El modal de agregar producto -->
                                <!-- ////////////////////////////////////////////////// -->
                                <!-- Empieza el modal de agregar categoria -->
                                <div class="modal fade" id="ModalCategoria" tabindex="-1" aria-labelledby="exampleModalgridLabel" aria-modal="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="ModalCategoria">Añadir Categoría</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="../../Models/Crud-product/add-category.php" method="POST" enctype="multipart/form-data" onsubmit="confirmacionCategory(event)">
                                                    <div class="row g-1">
                                                        <div class="col-xxl-6">
                                                            <div>
                                                                <label for="firstName" class="form-label">Categoria</label>
                                                                <input name="categoria" type="text" class="form-control" id="firstName" placeholder="Ingrese Categoria" oninput="Mayuscula(this)">
                                                            </div>
                                                        </div><!--end col-->
                                                        <div class="col-lg-12">
                                                            <div class="hstack gap-2 justify-content-end">
                                                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cerrar</button>
                                                                <button type="submit" class="btn btn-primary">Ingresar</button>
                                                            </div>
                                                        </div><!--end col-->
                                                    </div><!--end row-->
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Modal de Eliminar Categoria -->
                                <div class="modal fade" id="ModalEliminarCategoria" tabindex="-1" aria-labelledby="ModalEliminarCategoriaLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="ModalEliminarCategoriaLabel">Confirmar Eliminación</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                ¿Estás seguro de que deseas eliminar esta categoría?
                                                <input type="hidden" id="categoriaIdEliminar" name="id_categoria">
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                                <button type="button" class="btn btn-danger" id="confirmarEliminacionCategoria">Eliminar</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Termina modal de agregar categoria -->
                                <!-- /////////////////////////////////////////////////////////// -->
                                <!-- empieza modal para agregar marca y eliminar -->
                                <div class="modal fade" id="ModalMarca" tabindex="-1" aria-labelledby="exampleModalgridLabel" aria-modal="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="ModalCategoria">Añadir Marca</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="../../Models/Crud-product/add-brand.php" method="POST" enctype="multipart/form-data" onsubmit="confirmacionMarca(event)">
                                                    <div class="row g-1">
                                                        <div class="col-xxl-6">
                                                            <div>
                                                                <label for="firstName" class="form-label">Marca</label>
                                                                <input name="nombre_marca" type="text" class="form-control" id="firstName" placeholder="Ingrese Marca" oninput="Mayuscula(this)">
                                                            </div>
                                                        </div><!--end col-->
                                                        <div class="col-lg-12">
                                                            <div class="hstack gap-2 justify-content-end">
                                                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cerrar</button>
                                                                <button type="submit" class="btn btn-primary">Ingresar</button>
                                                            </div>
                                                        </div><!--end col-->
                                                    </div><!--end row-->
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Modal de Eliminar Marca -->
                                <div class="modal fade" id="ModalEliminarMarca" tabindex="-1" aria-labelledby="ModalEliminarMarcaLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="ModalEliminarMarcaLabel">Confirmar Eliminación</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                ¿Estás seguro de que deseas eliminar esta marca?
                                                <input type="hidden" id="marcaIdEliminar" name="id_marca">
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                                <button type="button" class="btn btn-danger" id="confirmarEliminacionMarca">Eliminar</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /////////////////////////////////////////////////////////// -->
                                <!-- Empieza el Modal de actualizar producto-->
                                <!-- Modal de Actualizar Producto -->
                                <div class="modal fade" id="UpdateProducto" tabindex="-1" aria-labelledby="exampleModalgridLabel" aria-modal="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="ModalProducto">Actualizar Producto</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="../../Models/Crud-product/edit-product.php" method="POST" enctype="multipart/form-data">
                                                    <div class="row g-3">
                                                        <div class="col-lg-12">
                                                            <div>
                                                                <label for="firstName" class="form-label">Nombre del producto</label>
                                                                <input type="text" class="form-control" name="nombre_prod" id="nombre_prod_edit" required>
                                                            </div>
                                                        </div><!--end col-->
                                                        <div class="col-lg-12">
                                                            <div>
                                                                <label for="lastName" class="form-label">Precio por unidad</label>
                                                                <input type="text" class="form-control" name="precio_prod" id="precio_prod_edit" placeholder="Ingrese precio" required>
                                                            </div>
                                                        </div><!--end col-->
                                                        <div class="col-lg-12">
                                                            <div>
                                                                <label for="emailInput" class="form-label">Stock</label>
                                                                <input type="number" class="form-control" name="stock_prod" id="stock_prod_edit" placeholder="Stock del producto" required>
                                                            </div>
                                                        </div><!--end col-->
                                                        <div class="col-lg-12">
                                                            <div>
                                                                <label for="passwordInput" class="form-label">Descripción</label>
                                                                <input type="text" class="form-control" name="descripcion_prod" id="descripcion_prod_edit" placeholder="Ingrese una descripción breve" required>
                                                            </div>
                                                        </div><!--end col-->
                                                        <div class="col-lg-12">
                                                            <div>
                                                                <label for="passwordInput" class="form-label">Imagen</label>
                                                                <input type="file" class="form-control" name="img_prod" id="img_prod" required>
                                                            </div>
                                                        </div><!--end col-->
                                                        <!-- Campo oculto para id_producto -->
                                                        <input type="hidden" name="id_producto" id="id_producto_edit">
                                                        <div class="col-lg-12">
                                                            <div class="hstack gap-2 justify-content-end">
                                                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cerrar</button>
                                                                <button type="submit" class="btn btn-primary" onsubmit="confirmacionProductUpdate(event)">Guardar</button>
                                                            </div>
                                                        </div><!--end col-->
                                                    </div><!--end row-->
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Termina El modal de actualizar producto -->
                                <!-- /////////////////////////////////////////////////////////// -->
                                <!-- Empieza tabla para mostrar productos -->
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="card">
                                            <div class="card-body">
                                                <table id="example" class="table nowrap dt-responsive align-middle table-hover table-bordered" style="width:100%">
                                                    <thead>
                                                        <tr>
                                                            <th></th>
                                                            <th scope="col">Nombre</th>
                                                            <th scope="col">Stock</th>
                                                            <th scope="col">Precio</th>
                                                            <th scope="col">Marca</th>
                                                            <th scope="col">Categoría</th>
                                                            <th scope="col">Total</th>
                                                            <th scope="col">Accion</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $total_dinero = 0; // Variable para almacenar el total en dinero

                                                        while ($row = mysqli_fetch_array($query)) :
                                                            $stock = $row['stock_prod'];
                                                            $precio = $row['precio_prod'];
                                                            $id = $row["id_producto"];
                                                            $total_producto = $stock * $precio; // Calcular total del producto (stock * precio)
                                                            $total_dinero += $total_producto; // Sumar al total en dinero
                                                        ?>
                                                            <tr>
                                                                <th scope="row">
                                                                    <div class="form-check">
                                                                        <input class="form-check-input fs-15" type="checkbox" name="product[]" value="<?= $id ?>">
                                                                    </div>
                                                                </th>
                                                                <td>
                                                                    <div class="d-flex align-items-center">
                                                                        <div class="flex-shrink-0 avatar-md bg-light rounded p-1" style="width: 150px; height: 150px;">
                                                                            <img src="<?= $row['ruta_img'] ?>" alt="" class="img-fluid d-block" style="max-width: 100%; height: auto;">
                                                                        </div>
                                                                        <div class="flex-grow-1 ms-3">
                                                                            <h5><?= $row['nombre_prod'] ?></h5>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td><?= $row['stock_prod'] ?></td>
                                                                <td>$<?= number_format($row["precio_prod"], 0, ',', '.') ?></td> <!-- Formatear precio con separadores de miles -->
                                                                <td><?= $row['nombre_marca'] ?></td>
                                                                <td><?= $row['nombre_cat'] ?></td>
                                                                <td>$<?= number_format($total_producto, 0, ',', '.') ?></td> <!-- Formatear total del producto con separadores de miles -->
                                                                <td>
                                                                    <div class="d-flex gap-2">
                                                                        <div class="edit">
                                                                            <button style="background-color: rgba(255, 255, 255, 0);border: none;" type="button" class="link-success fs-15" data-bs-toggle="modal" data-bs-target="#UpdateProducto" onclick="update(event, <?= $id ?>, '<?= $row['nombre_prod'] ?>', <?= $row['stock_prod'] ?>, <?= $row['precio_prod'] ?>, '<?= $row['descripcion_prod'] ?>', '<?= $row['nombre_marca'] ?>', '<?= $row['nombre_cat'] ?>')"><i class="ri-edit-2-line" style="font-size: 1.4rem !important;"></i>
                                                                            </button>
                                                                        </div>
                                                                        <div class="remove">
                                                                            <a href="#" class="text-danger d-inline-block remove-item-btn" onclick="deleteProduct(event, <?= $row['id_producto'] ?>)"><i class="ri-delete-bin-5-fill fs-16" style="font-size: 1.4rem !important;"></i></a>
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


                                <!-- TERMINA TABLA COMO TAL -->
                            </div>
                        </div>
                    </div>
                    <!-- Termina todo el contenido de la vista tabla  -->
                </div>
                <!-- termina pagina -->
            </div>
        </div>
    </div>
    <!--Scripts librerias-->
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="../../assets/js/pages/datatables.init.js"></script>
    <script src="../../assets/js/app.js"></script>
    <?php include '../../layouts/vendor-scripts 2.php'; ?>
    <?php include '../../layouts/footer.php'; ?>
    <!-- SCRIPT PARA ALERTAR DE ELIMINACION DE PRODUCTO -->
    <script>
        function deleteProduct(event, id_producto) {
            console.log("ID of the product to delete:", id_producto);
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
                        window.location.href = "../../Models/Crud-product/delete-product.php?id_producto=" + id_producto;
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
    <!-- Scripts para validar que solo se ingresen numeros en apartado de precio y stock -->
    <script>
        function Valida_numero_prod() {
            const input = document.getElementById('precio_prod');
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
    <!-- Script para las mayusculas -->
    <script>
        function Mayuscula(input) {
            input.value = input.value.toUpperCase();
        }
    </script>
    <!-- Script que trae los valores para actualizar producto seleccionado -->
    <script>
        function update(event, id_producto, nombre_prod, stock_prod, precio_prod, descripcion_prod) {
            let id = document.getElementById('id_producto_edit');
            let nombre = document.getElementById('nombre_prod_edit');
            let precio = document.getElementById('precio_prod_edit');
            let stock = document.getElementById('stock_prod_edit');
            let descripcion = document.getElementById('descripcion_prod_edit');

            id.value = id_producto; // Asignar el id_producto al campo oculto

            nombre.value = nombre_prod;
            precio.value = precio_prod;
            stock.value = stock_prod;
            descripcion.value = descripcion_prod;
        }
    </script>
    <!-- Script confirmacion del producto -->
    <script>
        function confirmacionProduct(event) {
            // Evita que el formulario se envíe automáticamente
            event.preventDefault();
            Swal.fire({
                position: "center",
                icon: "success",
                title: "¡Producto Registrado Con Éxito!",
                showConfirmButton: false,
                timer: 1500
            }).then(() => {
                // Procede con el envío del formulario después de mostrar la alerta
                event.target.closest('form').submit();
            });
        }
    </script>
    <!-- Script confirmacion de producto actualizado -->
    <script>
        function confirmacionProductUpdate(event) {
            // Evita que el formulario se envíe automáticamente
            event.preventDefault();
            Swal.fire({
                position: "center",
                icon: "success",
                title: "¡Producto Actualizado Con Éxito!",
                showConfirmButton: false,
                timer: 1500
            }).then(() => {
                // Procede con el envío del formulario después de mostrar la alerta
                event.target.closest('form').submit();
            });
        }
    </script>
    <!-- Script confirmacion de categoria -->
    <script>
        function confirmacionCategory(event) {
            // Evita que el formulario se envíe automáticamente
            event.preventDefault();
            Swal.fire({
                position: "center",
                icon: "success",
                title: "¡Categoría Registrada Con Éxito!",
                showConfirmButton: false,
                timer: 1500
            }).then(() => {
                // Procede con el envío del formulario después de mostrar la alerta
                event.target.closest('form').submit();
            });
        }
    </script>
    <!-- Script confirmacion de marca -->
    <script>
        function confirmacionMarca(event) {
            // Evita que el formulario se envíe automáticamente
            event.preventDefault();
            Swal.fire({
                position: "center",
                icon: "success",
                title: "¡Marca Registrada Con Éxito!",
                showConfirmButton: false,
                timer: 1500
            }).then(() => {
                // Procede con el envío del formulario después de mostrar la alerta
                event.target.closest('form').submit();
            });
        }
    </script>

    <!-- Script para eliminar marca -->
    <script>
        // Abrir modal de eliminación y pasar el ID seleccionado al input oculto
        document.getElementById('openEliminarModalMarca').addEventListener('click', function() {
            var select = document.getElementById('marcaSelect');
            var idMarca = select.value;

            if (idMarca) {
                document.getElementById('marcaIdEliminar').value = idMarca;
                var modal = new bootstrap.Modal(document.getElementById('ModalEliminarMarca'));
                modal.show();
            } else {
                alert('Por favor, selecciona una marca para eliminar');
            }
        });

        // Manejar la eliminación al confirmar en el modal marca
        document.getElementById('confirmarEliminacionMarca').addEventListener('click', function() {
            var idMarca = document.getElementById('marcaIdEliminar').value;

            if (idMarca) {
                // Aquí puedes realizar una solicitud AJAX para eliminar la marca
                fetch('/my-school/Models/crud-product/delete-brand.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({
                            id_marca: idMarca
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            // Cerrar el modal
                            var modal = bootstrap.Modal.getInstance(document.getElementById('ModalEliminarMarca'));
                            modal.hide();

                            // Actualizar el selector de marcas
                            document.getElementById('marcaSelect').querySelector('option[value="' + idMarca + '"]').remove();

                            // Mostrar mensaje de éxito con SweetAlert
                            Swal.fire({
                                icon: 'success',
                                title: '¡Éxito!',
                                text: 'Marca eliminada exitosamente',
                            });
                        } else {
                            // Mostrar mensaje de error con SweetAlert
                            Swal.fire({
                                icon: 'error',
                                title: '¡Error!',
                                text: 'Error al eliminar la marca',
                            });
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        // Mostrar mensaje de error con SweetAlert
                        Swal.fire({
                            icon: 'error',
                            title: '¡Error!',
                            text: 'Error al eliminar la marca',
                        });
                    });
            } else {
                // Mostrar mensaje de alerta con SweetAlert
                Swal.fire({
                    icon: 'warning',
                    title: '¡Alerta!',
                    text: 'Por favor, selecciona una marca para eliminar',
                });
            }
        });
    </script>
    <!-- Script para eliminar categoria -->
    <script>
        document.getElementById('openEliminarModalCategoria').addEventListener('click', function() {
            var select = document.getElementById('categoriaSelect');
            var idCategoria = select.value;

            if (idCategoria) {
                document.getElementById('categoriaIdEliminar').value = idCategoria;
                var modal = new bootstrap.Modal(document.getElementById('ModalEliminarCategoria'));
                modal.show();
            } else {
                alert('Por favor, selecciona una categoria para eliminar');
            }
        });

        document.getElementById('confirmarEliminacionCategoria').addEventListener('click', function() {
            var idCategoria = document.getElementById('categoriaIdEliminar').value;

            if (idCategoria) {
                // Realizar la solicitud AJAX para eliminar la categoría
                fetch('/my-school/Models/crud-product/delete-category.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({
                            id_categoria: idCategoria
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            // Cerrar el modal
                            var modal = bootstrap.Modal.getInstance(document.getElementById('ModalEliminarCategoria'));
                            modal.hide();

                            // Actualizar el selector de categorías
                            document.getElementById('categoriaSelect').querySelector('option[value="' + idCategoria + '"]').remove();

                            // Mostrar mensaje de éxito con SweetAlert
                            Swal.fire({
                                icon: 'success',
                                title: '¡Éxito!',
                                text: 'Categoría eliminada exitosamente',
                            });
                        } else {
                            // Mostrar mensaje de error con SweetAlert
                            Swal.fire({
                                icon: 'error',
                                title: '¡Error!',
                                text: 'Error al eliminar la categoría',
                            });
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        // Mostrar mensaje de error con SweetAlert
                        Swal.fire({
                            icon: 'error',
                            title: '¡Error!',
                            text: 'Error al eliminar la categoría',
                        });
                    });
            } else {
                // Mostrar mensaje de alerta con SweetAlert
                Swal.fire({
                    icon: 'warning',
                    title: '¡Alerta!',
                    text: 'Por favor, selecciona una categoría para eliminar',
                });
            }
        });
    </script>

    <!-- Fin de los Scripts -->
</body>

</html>