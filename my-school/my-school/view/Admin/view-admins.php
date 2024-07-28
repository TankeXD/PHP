<?php include '../../layouts/session.php'; ?>
<?php include '../../layouts/main.php'; ?>

<head>
    <?php includeFileWithVariables('../../layouts/title-meta.php', array('title' => 'Gestión Administradores')); ?>
    <?php include '../../layouts/head2.php'; ?>
    <!--links para responsavilizar el datatable-->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">
    <style>
        .sidebar-label {
            color: #ffffff;

        }

        .sidebar-label:hover {
            color: #25a0e2;
        }
    </style>
</head>
<!-- script para alertar de eliminacion -->
<script>
    function confirmacion(event, id_user) {
        console.log("ID of the user to delete:", id_user);
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
            title: "¿Desea Realmente Borrar Al Administrador?",
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
                    "Administrador Eliminado con Exíto.",
                    "success"

                );
                setTimeout(() => {
                    window.location.href = "../../Models/Crud-user/delete-user.php?id_user=" + id_user;
                }, 1500); // se controla que se demore 1,5 segundos para la eliminacion 


            } else if (
                result.dismiss === Swal.DismissReason.cancel
            ) {
                // Aquí maneja la cancelación
                swalWithBootstrapButtons.fire(
                    "Cancelado",
                    "Administrador a salvo :)",
                    "error"
                );
            }
        });
    }
</script>

<!-- body general -->

<body>

    <div id="../../layout-wrapper">
        <!-- trae a sidebar y topbar copia -->
        <?php include '../../layouts/sidebar.php'; ?>
        <?php include '../../layouts/topbar-admin.php'; ?>

        <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">
                    <a href="user.php">
                        <?php includeFileWithVariables('../../layouts/page-title.php', array('pagetitle' => 'Administradores', 'title' => 'Gestión De Administradores')); ?>
                    </a>
                </div>

                <!-- consulta para traer datos de user -->
                <?php
                include("../../layouts/config.php");
                $con = connection();

                $sql = "SELECT * FROM users";
                $query = mysqli_query($con, $sql);
                ?>

                <!-- Modal de Actualizar Administrador -->
                <div class="modal fade" id="UpdateProducto" tabindex="-1" aria-labelledby="exampleModalgridLabel" aria-modal="true" onsubmit="actualizar(event)">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="ModalProducto">Actualizar Administrador</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>

                            <div class="modal-body">
                                <form action="/my-school/Models/Crud-user/edit-user.php" method="POST" enctype="multipart/form-data">
                                    <div class="row g-3">
                                        <div class="col-lg-12">
                                            <div>
                                                <label for="nombre_administrador" class="form-label">Nombres y Apellidos</label>
                                                <input type="text" class="form-control" name="username" id="username" required oninput="convertirAMayusculas(this)">
                                            </div>
                                        </div><!--end col-->
                                        <div class="col-lg-12">
                                            <div>
                                                <label for="password_administrador" class="form-label">Contraseña</label>
                                                <div class="input-group mb-3">
                                                    <input type="password" id="password-input" class="form-control pe-5 password-input" placeholder="Ingrese Contraseña" name="password" />
                                                    <span class="input-group-text" id="toggle-password-icon" style="cursor: pointer;">
                                                        <i class="ri-eye-fill align-middle"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div><!--end col-->
                                        <div class="col-lg-12 mb-3">
                                            <label for="email_administrador" class="form-label">Correo Electrónico</label>
                                            <input type="text" class="form-control" name="email" id="email" required>
                                        </div><!--end col-->

                                        <div class="row mb-3">
                                            <div class="col-lg-3">
                                                <label for="rol" class="form-label">Tipo de Cargo</label>
                                            </div>
                                            <div class="col-lg-9">
                                                <select name="rol" id="rol" class="form-select" aria-label="Seleccione Rol" required>
                                                    <option selected disabled>Seleccione un Rol</option>
                                                    <option value="Super Admin">Súper Administrador</option>
                                                    <option value="Admin General">Administrador General</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="hstack gap-2 justify-content-end">
                                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cerrar</button>
                                                <button type="submit" class="btn btn-primary" onsubmit="confirmacionProductUpdate(event)">Guardar</button>
                                            </div>
                                        </div><!--end col-->
                                        <input type="hidden" name="id_user" id="id_user">
                                    </div><!--end row-->
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- body que contiene la tabla de administradores -->

                <body>

                    <!--empieza el div de la tabla-->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">Tabla de Administradores</h5>
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
                                                <th data-ordering="false">Nombre</th>
                                                <th data-ordering="false">Correo Electrónico</th>
                                                <th data-ordering="false">Fecha de Nacimiento</th>
                                                <th data-ordering="false">Tipo de Cargo</th>
                                                <th data-ordering="false">Acción</th>
                                            </tr>
                                        </thead>
                                        <!-- body de la tabla donde trae y muestra los datos en orden de los row -->
                                        <tbody>
                                            <?php while ($row = mysqli_fetch_array($query)) : ?>
                                                <tr>
                                                    <th scope="row">
                                                        <div class="form-check">
                                                            <input class="form-check-input fs-15" type="checkbox" name="checkAll" value="option1">
                                                        </div>
                                                    </th>
                                                    <td><?= $row['username'] ?></td>
                                                    <td><?= $row['email'] ?></td>
                                                    <td><?= $row['fecha_nac'] ?></td>
                                                    <td><?= $row['rol'] ?></td>
                                                    <td>
                                                        <div class="d-flex gap-2">
                                                            <div class="edit">
                                                                <a href="#" class="link-success fs-15" onclick="openUpdateModal('<?= $row['id_user'] ?>', '<?= $row['username'] ?>', '<?= $row['email'] ?>', '<?= $row['rol'] ?>')"><i class="ri-edit-2-line" style="font-size: 1.4rem !important;"></i></a>
                                                            </div>
                                                            <div class="remove">
                                                                <a href="#" class="text-danger d-inline-block remove-item-btn" onclick="confirmacion(event, <?= $row['id_user'] ?>, )"><i class="ri-delete-bin-5-fill fs-16" style="font-size: 1.4rem !important;"></i></a>
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
                </body>
                <!-- trae al footer -->
            </div>
        </div>
        <!--////////////////////////////////////////////////////////////////-->
        <!-- TRAE TODO DE SCRIPTS -->

        <!-- SCRIPT PARA TRAER LA INFORMACIÓN -->
        <script>
            function openUpdateModal(id_user, username, email, rol) {
                document.getElementById('id_user').value = id_user;
                document.getElementById('username').value = username;
                document.getElementById('email').value = email;
                document.getElementById('rol').value = rol;
                var updateModal = new bootstrap.Modal(document.getElementById('UpdateProducto'));
                updateModal.show();
            }

            function convertirAMayusculas(element) {
                element.value = element.value.toUpperCase();
            }
        </script>
        <!-- SCRIPT MENSAJE ACTUALIZAR ADMINISTRADOR -->
        <script>
            function actualizar(event) {
                // Evita que el formulario se envíe automáticamente
                event.preventDefault();
                Swal.fire({
                    position: "center",
                    icon: "success",
                    title: "¡Administrador Actualizado Con Éxito!",
                    showConfirmButton: false,
                    timer: 1500
                }).then(() => {
                    // Procede con el envío del formulario después de mostrar la alerta
                    event.target.submit();
                });
            }
        </script>
        <!-- SCRIPT PARA OJITO DE CONTRASEÑA -->
        <script>
            document.getElementById('toggle-password-icon').addEventListener('click', function() {
                var passwordInput = document.getElementById('password-input');
                var toggleIcon = document.getElementById('toggle-password-icon').querySelector('i');

                if (passwordInput.type === 'password') {
                    passwordInput.type = 'text';
                    toggleIcon.classList.remove('ri-eye-fill');
                    toggleIcon.classList.add('ri-eye-off-fill');
                } else {
                    passwordInput.type = 'password';
                    toggleIcon.classList.remove('ri-eye-off-fill');
                    toggleIcon.classList.add('ri-eye-fill');
                }
            });
        </script>

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
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
        <script src="../../assets/js/pages/datatables.init.js"></script>
        <!-- HASTA ACA DATATABLES -->
</body>

</html>