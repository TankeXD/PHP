<?php include '../../layouts/session.php'; ?>
<?php include '../../layouts/main.php'; ?>
<!DOCTYPE html>
<html lang="en">
<?php
include '../../layouts/config.php';
$con = connection();
$id_alumno = $_POST['id_alumno'];
$total_boleta = $_POST['total_boleta'];
$total = 0;
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
?>

<head>

    <!--datatable css-->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" />
    <!--datatable responsive css-->
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">
    <?php includeFileWithVariables('../../layouts/title-meta.php', array('title' => 'Proceso de Pago')); ?>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
    <style>
        .disabled {
            pointer-events: none;
            /* No permite eventos de clic */
            opacity: 0.5;
            /* Hace que el elemento parezca deshabilitado */
            cursor: not-allowed;
            /* Cambia el cursor para indicar que está deshabilitado */
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

    <?php include '../../layouts/head2.php'; ?>

</head>


<body>
    <div id="layout-wrapper">
        <?php include '../../layouts/sidebar_index.php'; ?>
        <?php include '../../layouts/topbar_index.php'; ?>

        <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">
                    <?php includeFileWithVariables('layouts/page-title.php', array('pagetitle' => 'Ecommerce', 'title' => 'Checkout')); ?>

                    <div class="row">
                        <div class="col-xl-8">
                            <div class="card">
                                <div class="card-body checkout-tab">
                                    <form action="../../Models/Crud-order/invoice.php" id="ingreso_datos" method="post">
                                        <div class="step-arrow-nav mt-n3 mx-n3 mb-3">
                                            <ul class="nav nav-pills nav-justified custom-nav" role="tablist">
                                                <li class="nav-item" role="presentation">
                                                    <button class="nav-link fs-15 p-3 active" id="pills-bill-info-tab" data-bs-toggle="pill" data-bs-target="#pills-bill-info" type="button" role="tab" aria-controls="pills-bill-info" aria-selected="true"><i class="ri-user-2-line fs-16 p-2 bg-primary-subtle text-primary rounded-circle align-middle me-2"></i>
                                                        Datos de Envio</button>
                                                </li>
                                                <li class="nav-item disabled" class="disabled" role="presentation">
                                                    <button class="nav-link fs-15 p-3" id="pills-payment-tab" data-bs-toggle="pill" data-bs-target="#pills-payment" type="button" role="tab" aria-controls="pills-payment" aria-selected="false"><i class="ri-bank-card-line fs-16 p-2 bg-primary-subtle text-primary rounded-circle align-middle me-2"></i>
                                                        Informacion de Pago</button>
                                                </li>
                                            </ul>
                                        </div>

                                        <div class="tab-content">
                                            <div class="tab-pane fade show active" id="pills-bill-info" role="tabpanel" aria-labelledby="pills-bill-info-tab">
                                                <div>
                                                    <h5 class="mb-1">Datos de Envio</h5>
                                                    <p class="text-muted mb-4">Por favor complete la información requerida para continuar.</p>
                                                </div>

                                                <div>
                                                    <div class="row">
                                                        <div class="col-sm-6">
                                                            <div class="mb-3">
                                                                <label for="billinginfo-firstName" class="form-label">Nombre</label>
                                                                <input type="text" form="ingreso_datos" name="nombre" class="form-control" id="billinginfo-firstName" placeholder="Ingrese su Nombre" value="" required oninput="this.value = this.value.toUpperCase()">
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-6">
                                                            <div class="mb-3">
                                                                <label for="billinginfo-lastName" class="form-label">Apellidos</label>
                                                                <input type="text" form="ingreso_datos" name="apellidos" class="form-control" id="billinginfo-lastName" placeholder="Ingrese sus Apellidos" value="" required oninput="this.value = this.value.toUpperCase()">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-sm-6">
                                                            <div class="mb-3">
                                                                <label for="billinginfo-email" class="form-label">Email</label>
                                                                <input type="email" form="ingreso_datos" name="email" class="form-control" id="billinginfo-email" placeholder="Ingrese su Email" required>
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-6">
                                                            <div class="mb-3">
                                                                <label for="billinginfo-phone" class="form-label">Teléfono o Celular</label>
                                                                <input type="tel" form="ingreso_datos" name="fono" class="form-control" id="phone" placeholder="+56912345678" pattern="[0-9]*" inputmode="numeric" required oninput="if(this.value.length > 9) this.value = this.value.slice(0, 9);">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-sm-6">
                                                            <div class="mb-3">
                                                                <label for="billinginfo-direccion" class="form-label">Dirección</label>
                                                                <input type="text" form="ingreso_datos" name="direccion" class="form-control" id="billinginfo-direccion" placeholder="Ingrese su Dirección" required>
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-6">
                                                            <div class="mb-3">
                                                                <label for="billinginfo-departamento" class="form-label">Departamento
                                                                    <span class="text-muted">(Opcional)</span></label>
                                                                <input type="text" form="ingreso_datos" name="descripcion" class="form-control" id="billinginfo-departamento" placeholder="Ingresa su Departamento.">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="d-flex align-items-start gap-3 mt-3">
                                                    <button id="btn_registro" type="button" class="btn btn-primary btn-label right ms-auto nexttab" data-nexttab="pills-payment-tab" onclick="validarCampos()" disabled><i class="ri-bank-card-line label-icon align-middle fs-16 ms-2"></i>Continuar el Pago</button>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end tab pane -->

                                        <div class="tab-pane fade" id="pills-payment" role="tabpanel" aria-labelledby="pills-payment-tab">
                                            <div>
                                                <h5 class="mb-1">Informacion de Pago</h5>
                                                <p class="text-muted mb-4">Por favor complete la información requerida para continuar.</p>
                                            </div>

                                            <div>
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <div class="card border shadow-none mb-3 mb-lg-0">
                                                            <div class="card-body">
                                                                <div class="row g-3">
                                                                    <div class="col-lg-12">
                                                                        <label for="cardNumber" class="form-label">Numero de Tarjeta</label>
                                                                        <input type="text" form="ingreso_datos" name="numero_tarjeta" class="form-control" id="cardNumber" placeholder="1234 5678 9876 5432" required oninput="if(this.value.length > 16) this.value = this.value.slice(0, 16);">
                                                                    </div>
                                                                    <!-- end col -->
                                                                    <div class="col-lg-4">
                                                                        <label for="expirydate" class="form-label">Fecha de Expiración</label>
                                                                        <input type="text" form="ingreso_datos" name="fecha_exp" class="form-control" id="expirydate" placeholder="MM/YY" required pattern="(?:0[1-9]|1[0-2])/[0-9]{2}" oninput="formatExpiryDate(this)">
                                                                    </div>
                                                                    <!-- end col -->
                                                                    <div class="col-lg-4">
                                                                        <label for="cvvcode" class="form-label">CVV Codigo</label>
                                                                        <input type="number" form="ingreso_datos" name="ccv" class="form-control" id="cvvcode" placeholder="CVV" pattern="\d{3}" required oninput="if(this.value.length > 3) this.value = this.value.slice(0, 3);">
                                                                    </div>
                                                                    <!-- end col -->
                                                                </div>
                                                                <!-- end row -->
                                                            </div>
                                                        </div>
                                                        <!-- end card -->
                                                    </div>
                                                </div>
                                                <!-- end row -->
                                            </div>
                                            <div class="d-flex align-items-start gap-3 mt-3">
                                                <button type="button" class="btn btn-light btn-label previestab" data-previous="pills-bill-info-tab"><i class="ri-arrow-left-line label-icon align-middle fs-16 me-2"></i> Volver a Información de Facturación</button>
                                                <button id="btn-finish" type="submit" form="ingreso_datos" class="btn btn-primary btn-label right ms-auto nexttab" onclick="confirmacion(event, <?= $id_alumno ?>, <?= $total_boleta ?>)"><i class="ri-shopping-basket-line label-icon align-middle fs-16 ms-2"></i>Finalizar Pago</button>
                                            </div>
                                        </div>
                                        <!-- end tab pane -->
                                        <input type="hidden" name="id_alumno" value="<?= $id_alumno ?>">
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- end col -->

                        <div class="col-xl-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <h5 class="card-title">Tu Orden</h5>
                                    </div>

                                    <div class="table-responsive">
                                        <table class="table table-borderless mb-0">
                                            <thead class="table-light">

                                                <tr>
                                                    <th scope="col">Producto</th>
                                                    <th scope="col">Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php while ($row = mysqli_fetch_array($query)) :
                                                    $precio_prod = $row['precio_prod'] * $row['cant_prod'];
                                                    $total += $precio_prod;
                                                ?>
                                                    <tr>
                                                        <td><?= $row['nombre_prod'] ?></td>
                                                        <td><?= $precio = number_format($precio_prod, 0, '.', '.'); ?></td>
                                                    </tr>
                                                <?php endwhile;
                                                $servicio = ($total * 12.5) / 100;
                                                $boleta = $servicio + $total;
                                                ?>
                                                <tr>
                                                    <td>Tarifa de servicio (12.5%)</td>
                                                    <td><?= $servicio_format = number_format($servicio, 0, '.', '.') ?></td>
                                                </tr>
                                                <tr class="table-active">
                                                    <th scope="row">Total :</th>
                                                    <td>
                                                        <div class="fw-medium"><?= $total_format = number_format(($boleta), 0, '.', '.') ?></div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end col -->
                    </div>
                    <!-- end row -->
                </div>
                <!-- container-fluid -->
            </div>
            <!-- End Page-content -->

            <?php include '../../layouts/footer.php'; ?>
        </div>
        <!-- end main content-->
    </div>
    <!-- END layout-wrapper -->

    <?php include '../../layouts/vendor-scripts 2.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="../../assets/libs/particles.js/particles.js"></script>
    <!-- particles app js -->
    <script src="../../assets/js/pages/particles.app.js"></script>
    <!-- validation init -->
    <script src="../../assets/js/pages/form-validation.init.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var nextButtons = document.querySelectorAll('.nexttab');
            var prevButtons = document.querySelectorAll('.previestab');

            nextButtons.forEach(function(button) {
                button.addEventListener('click', function() {
                    var nextTab = button.getAttribute('data-nexttab');
                    var nextTabElement = document.querySelector('#' + nextTab);

                    if (nextTabElement) {
                        var nextTabButton = new bootstrap.Tab(nextTabElement);
                        nextTabButton.show();
                    }
                });
            });

            prevButtons.forEach(function(button) {
                button.addEventListener('click', function() {
                    var prevTab = button.getAttribute('data-previous');
                    var prevTabElement = document.querySelector('#' + prevTab);

                    if (prevTabElement) {
                        var prevTabButton = new bootstrap.Tab(prevTabElement);
                        prevTabButton.show();
                    }
                });
            });
        });

        function validatePhoneNumber(input) {
            input.value = input.value.replace(/\D/g, '');
        }

        function addPlusSign(input) {
            if (input.value === '') {
                input.value = '+';
            }
        }
    </script>
    <!-- SCRIPT PARA ALERTAR DE PAGO DE PEDIDO -->
    <script>
        function confirmacion(event, id_alumno, total_boleta) {
            console.log("ID of the student to delete: ", id_alumno);
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
                title: "¿DESEA REALMENTE CONFIRMAR EL PAGO?",
                text: "Esta acción no se puede deshacer",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Sí, Pagar!",
                cancelButtonText: "No, cancelar!",
                reverseButtons: true
            }).then((result) => {
                // Según la decisión del usuario se ejecuta si entrar al if o else
                if (result.isConfirmed) {
                    swalWithBootstrapButtons.fire(
                        "Procesado",
                        "Pago realizado con Exíto.",
                        "success"

                    );
                    setTimeout(() => {
                        // Obtener el formulario existente por su ID
                        var form = document.getElementById("ingreso_datos");

                        // Crear un campo oculto para enviar el id_alumno si no existe ya en el formulario
                        var input = document.createElement("input");
                        input.type = "hidden";
                        input.name = "id_alumno";
                        input.value = id_alumno;
                        form.appendChild(input);

                        form.submit();
                    }, 1500); // se controla que se demore 1.5 segundos para la eliminacion 


                } else if (
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    // Aquí maneja la cancelación
                    swalWithBootstrapButtons.fire(
                        "Cancelado",
                        "Pago no realizado :)",
                        "error"
                    );
                }
            });
        }
    </script>

    <script>
        function validarCampos() {
            // Obtener referencias a los campos
            const nombre = document.querySelector('input[name="nombre"]');
            const apellido = document.querySelector('input[name="apellido"]');
            const email = document.querySelector('input[name="email"]');
            const fono = document.querySelector('input[name="fono"]');
            const direccion = document.querySelector('input[name="direccion"]');
            const numero_tarjeta = document.querySelector('input[name="numero_tarjeta"]');
            const fecha_exp = document.querySelector('input[name="fecha_exp"]');
            const ccv = document.querySelector('input[name="ccv"]');


            // Verificar si todos los campos obligatorios están llenos
            if (nombre?.value?.trim() !== '' && apellido?.value?.trim() !== '' && email?.value?.trim() !== '' && fono?.value?.trim() !== '' && direccion?.value?.trim() !== '') {
                document.getElementById('btn_registro').disabled = false; // Habilitar el botón
            } else {
                document.getElementById('btn_registro').disabled = true; // Deshabilitar el botón
            }

            // Verificar si todos los campos obligatorios están llenos
            if (numero_tarjeta?.value?.trim() !== '' && fecha_exp?.value?.trim() !== '' && ccv?.value?.trim() !== '') {
                document.getElementById('btn-finish').disabled = false; // Habilitar el botón
            } else {
                document.getElementById('btn-finish').disabled = true; // Deshabilitar el botón
            }
        }
        // Llamar a la función validarCampos() cada vez que se produzca un cambio en un campo de entrada
        document.querySelectorAll('input[name="nombre"], input[name="apellido"], input[name="email"], input[name="fono"], input[name="direccion"], input[name="numero_tarjeta"], input[name="fecha_exp"], input[name="ccv"]').forEach(input => {
            input.addEventListener('input', validarCampos);
        });
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


    <script>
        function formatExpiryDate(input) {
            let value = input.value.replace(/[^0-9]/g, '');

            if (value.length >= 2) {
                value = value.slice(0, 2) + '/' + value.slice(2);
            }

            input.value = value.slice(0, 5);
        }
    </script>
</body>

</html>