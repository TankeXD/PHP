<?php
include 'layouts/config.php';
$con = connection();
$id = $_SESSION['id_cliente'];
$sql = "SELECT alumnos.id_alumno, alumnos.nombre_alumno, alumnos.apellido_alumno, alumnos.rut_alumno, cursos.curso, cursos.id_curso, colegio.nombre_colegio FROM alumnos INNER JOIN cursos ON alumnos.id_curso = cursos.id_curso INNER JOIN colegio ON colegio.id_colegio = cursos.id_colegio WHERE alumnos.id_cliente = $id;";
$query = mysqli_query($con, $sql);
//aqui para consultar de las regiones como inicio.
$sqlregion = "SELECT * FROM regiones";
$queryregion = mysqli_query($con, $sqlregion);
// Obtener los cursos con lista
$query_list = "SELECT id_curso FROM list_1";
$result_list = $con->query($query_list);
$courses_with_list = [];

while ($row_list = $result_list->fetch_assoc()) {
    $courses_with_list[] = $row_list['id_curso'];
}
?>
<link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<div class="container-fluid">
    <div class="row student-cards">
        <!-- IMPRIME LOS ALUMNOS ASOCIADOS AL CLIENTE -->
        <?php while ($row = mysqli_fetch_array($query)) :
            $nombre_completo = $row['nombre_alumno'] . " " . $row['apellido_alumno'];
            $id_curso = $row['id_curso'];
            $id_alumno = $row['id_alumno'];
            $has_list = in_array($id_curso, $courses_with_list);
        ?>
            <div class="col-xl-3" style="padding-top: 10px;">
                <div class="card student-card card-equal-height">
                    <div class="card-header">
                        <h6 class="card-title mb-0"><?= $nombre_completo ?></h6>
                    </div>
                    <div class="card-body p-4 text-center">
                        <div class="mx-auto avatar-md mb-3">
                            <img src="assets/images/alumnos/estudiante.png" alt="" class="img-fluid rounded-circle">
                        </div>
                        <p class="text-muted mb-0">Curso: <?= $row['curso'] ?></p>
                        <p class="text-muted mb-0">Colegio: <?= $row['nombre_colegio'] ?></p>
                        <?php
                        $sql_condicional = "SELECT * FROM pedidos WHERE id_alumno = $id_alumno";
                        $result = $con->query($sql_condicional);




                        if ($result->num_rows > 0) : ?>
                            <a href="view/Order/pedido.php?id_alumno=<?= $id_alumno ?>" class="link-warning fw-medium">Ver Pedido <i class="ri-arrow-right-line align-middle"></i></a>
                        <?php else : ?>
                            <a href="view/Client/controller.php?id_curso=<?= urlencode($row['id_curso']); ?>&id_alumno=<?= urlencode($row['id_alumno']); ?>&nombre_colegio=<?= urlencode($row['nombre_colegio']); ?>" class="fs-15">Ver lista <i class="ri-file-text-line"></i></a>
                        <?php endif ?>
                    </div>
                    <div class="card-footer text-center">
                        <form action="Models/Crud-student/delete-student.php" method="POST">
                            <button style="background-color: rgba(255, 255, 255, 0);border: none;" type="button" class="link-success fs-15" data-bs-toggle="modal" data-bs-target="#UpdateProducto" onclick="update(event, '<?= $row['id_alumno'] ?>', '<?= $row['nombre_alumno'] ?>', '<?= $row['apellido_alumno'] ?>', '<?= $row['rut_alumno'] ?>')"><i class="ri-edit-2-line"></i></button>

                            <a href="#" class="text-danger d-inline-block remove-item-btn" onclick="confirmacion(event, <?= $row['id_alumno'] ?>)" name="id_alumno" value="<?= $row['id_alumno'] ?>"><i class="ri-delete-bin-5-fill fs-16"></i></a>
                        </form>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
        <!-- IMPRIME LA CARD PARA AGREGAR UN ALUMNO -->
        <div class="col-xl-3" style="padding-top: 10px;">
            <div class="card student-card card-equal-height">
                <div class="card-header">
                    <h6 class="card-title mb-0">AGREGAR ALUMNO</h6>
                </div>
                <div class="card-body p-4 text-center">
                    <div class="mx-auto avatar-md mb-3">
                        <img src="assets/images/alumnos/mas.png" alt="" class="img-fluid rounded-circle">
                    </div>
                    <h5 class="card-title mb-1">PULSE AQUÍ PARA INGRESAR UN ALUMNO </h5><br><br>
                    <button type="button" class="btn btn-primary btn-label waves-effect waves-light rounded-pill" data-bs-toggle="modal" data-bs-target="#Modalalumno"><i class="ri-add-circle-line label-icon align-middle rounded-pill fs-16 me-2"></i> INGRESAR ALUMNO </button>
                    <br><br><br>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal de Actualizar Alumno -->
<div class="modal fade" id="UpdateProducto" tabindex="-1" aria-labelledby="exampleModalgridLabel" aria-modal="true" onsubmit="actualizar(event)">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ModalProducto">Actualizar Alumno</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/my-school/Models/Crud-student/edit-student.php" method="POST" enctype="multipart/form-data">
                    <div class="row g-3">
                        <div class="col-lg-12">
                            <div>
                                <label for="nombre_alumno" class="form-label">Nombre del Alumno</label>
                                <input type="text" class="form-control" name="nombre_alumno" id="nombre_alumno_edit" required oninput="convertirAMayusculas(this)">
                            </div>
                        </div><!--end col-->
                        <div class="col-lg-12">
                            <div>
                                <label for="apellido_alumno" class="form-label">Apellido del Alumno</label>
                                <input type="text" class="form-control" name="apellido_alumno" id="apellido_alumno_edit" required oninput="convertirAMayusculas(this)">
                            </div>
                        </div><!--end col-->
                        <div class="col-lg-12">
                            <div>
                                <label for="rut_alumno" class="form-label">Rut</label>
                                <input type="text" class="form-control" name="rut_alumno" id="rut_alumno_edit" required>
                            </div>
                        </div><!--end col-->
                        <div class="col-lg-12">
                            <div class="hstack gap-2 justify-content-end">
                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cerrar</button>
                                <button type="submit" class="btn btn-primary" onsubmit="confirmacionProductUpdate(event)">Guardar</button>
                            </div>
                        </div><!--end col-->
                        <input type="hidden" name="id_alumno" id="id_alumno_edit">
                    </div><!--end row-->
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Columna para horizontal -->
<div class="row" style="display: none;">
    <div class="col-4">
        <div class="form-check card-radio">
            <input id="customizer-layout02" name="data-layout" type="radio" value="horizontal" checked>
        </div>
    </div>
</div>
<!-- Fin de la columna para horizontal-->
<!-- Empieza el Modal de agregar alumno-->
<div class="modal fade" id="Modalalumno" tabindex="-1" aria-labelledby="exampleModalgridLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalgridLabel">Agregar Alumno</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="Models/Crud-student/insert-student.php" method="POST">
                    <div class="row g-3">
                        <div class="row mb-3">
                            <div>
                                <label for="region" class="form-label">Región</label>
                            </div>
                            <div>
                                <select name="region" id="region" class="form-select mb-3" aria-label=".form-select-lg example" style="width: 300px;">
                                    <option selected disabled>SELECCIONE REGIÓN</option>
                                    <!-- Las opciones de regiones se cargarán desde PHP -->
                                    <?php while ($row = mysqli_fetch_array($queryregion)) : ?>
                                        <option value="<?= $row['id_region'] . '|' . $row['nombre_region'] ?>">
                                            <?= $row['nombre_region'] ?>
                                        </option>
                                    <?php endwhile; ?>
                                </select>
                            </div>
                        </div>
                        <!-- SELECT DE COMUNAS -->
                        <div class="row mb-3">
                            <div class="">
                                <label for="comuna" class="form-label">Comuna</label>
                            </div>
                            <div class="">
                                <select name="comuna" id="comuna" class="form-select mb-3" aria-label=".form-select-lg example" style="width: 300px;">
                                    <option selected disabled>SELECCIONE COMUNA</option>
                                    <!-- Las opciones de comunas se cargarán dinámicamente con JavaScript desde el PHP de get_comunas -->
                                </select>
                            </div>
                        </div>
                        <!-- SELECT DE COLEGIOS -->
                        <div class="row mb-3">
                            <div class="col-lg-3">
                                <label for="colegio" class="form-label">COLEGIO</label>
                            </div>
                            <div class="">
                                <select name="colegio" id="colegio" class="form-select mb-3" aria-label=".form-select-lg example" style="width: 300px;">
                                    <option selected disabled>SELECCION COLEGIO</option>
                                    <!-- Las opciones de colegios se cargarán dinámicamente con JavaScript desde el PHP de get_colegios -->
                                </select>
                            </div>
                        </div>
                        <!-- SELECT DE CURSOS -->
                        <div class="row mb-3">
                            <div class="col-lg-3">
                                <label for="curso" class="form-label">CURSO</label>
                            </div>
                            <div class="">
                                <select name="curso" id="curso" class="form-select mb-3" aria-label=".form-select-lg example" style="width: 300px;">
                                    <option selected disabled>SELECCION CURSO</option>
                                    <!-- Las opciones de cursos se cargarán dinámicamente con JavaScript desde el PHP de get_cursos -->
                                </select>
                            </div>
                        </div>
                        <!-- RESTO DE LOS CAMPOS -->
                        <div class="col-lg-12">
                            <div>
                                <label for="firstName" class="form-label">Nombre del Alumno</label>
                                <input type="text" name="nombre_alumno" class="form-control" id="firstName" placeholder="Ingrese Nombre" required oninput="Mayuscula(this)">
                            </div>
                        </div><!--end col-->
                        <div class="col-lg-12">
                            <div>
                                <label for="lastName" class="form-label">Apellido del Alumno</label>
                                <input type="text" name="apellido_alumno" class="form-control" id="lastName" placeholder="Ingrese Apellido" required oninput="Mayuscula(this)">
                            </div>
                        </div><!--end col-->
                        <div class="col-lg-12">
                            <div>
                                <label for="phonenumberInput" class="form-label">Rut del Alumno</label>
                                <input type="text" name="rut_alumno" id="rut" class="form-control" id="phonenumberInput" placeholder="Ingrese Rut" required oninput="formatearRut(this)">
                            </div>
                        </div><!--end col-->
                        <div class="col-lg-12">
                            <div class="hstack gap-2 justify-content-end">
                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cerrar</button>
                                <button type="submit" class="btn btn-primary">Agregar Alumno</button>
                            </div>
                        </div><!--end col-->
                    </div><!--end row-->
                    <input type="hidden" name="id" value="<?php echo ($id_cliente) ?>">
                </form>
            </div>
        </div>
    </div>
</div><!-- End of the Modal to add a student -->
<!-- Termina El modal de ageegar alumno -->
</div>
<!-- Script que trae los valores para actualizar alumno seleccionado -->
<script>
    function update(event, id_alumno, nombre_alumno, apellido_alumno, rut_alumno) {
        document.getElementById('id_alumno_edit').value = id_alumno;
        document.getElementById('nombre_alumno_edit').value = nombre_alumno;
        document.getElementById('apellido_alumno_edit').value = apellido_alumno;
        document.getElementById('rut_alumno_edit').value = rut_alumno;
    }

    function convertirAMayusculas(element) {
        element.value = element.value.toUpperCase();
    }
</script>
<script>
     function actualizar(event) {
            // Evita que el formulario se envíe automáticamente
            event.preventDefault();
            Swal.fire({
                position: "center",
                icon: "success",
                title: "¡Alumno Actualizado Con Éxito!",
                showConfirmButton: false,
                timer: 1500
            }).then(() => {
                // Procede con el envío del formulario después de mostrar la alerta
                event.target.submit();
            });
        }
</script>