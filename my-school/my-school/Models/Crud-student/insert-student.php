<?php 
    include('../../layouts/config.php');
    $con = connection();
    $id_cliente = $_POST['id'];
    $curso = $_POST['curso'];
    $nombre_alumno = $_POST['nombre_alumno'];
    $apellido_alumno = $_POST['apellido_alumno'];
    $rut_alumno = $_POST['rut_alumno'];
    if (isset($_POST['id'])) {
        $sql = "INSERT INTO alumnos (nombre_alumno, apellido_alumno, rut_alumno, id_curso, id_cliente) VALUES ('$nombre_alumno', '$apellido_alumno', '$rut_alumno', $curso, $id_cliente)";
    $query = mysqli_query($con, $sql);

    if ($query) {
        sleep(1.5);
        header("Location: ../../index.php");
    } else {
        die("Error al ejecutar la consulta SQL: " . mysqli_error($con));
    }
    }else {
        die("No se ha enviado la id del cliente $id_cliente");

    }

?>