<?php
include '../../layouts/config.php';  // Ajusta la ruta según sea necesario
$con = connection();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_alumno = $_POST['id_alumno'];
    $nombre_alumno = strtoupper($_POST['nombre_alumno']);
    $apellido_alumno = strtoupper($_POST['apellido_alumno']);
    $rut_alumno = $_POST['rut_alumno'];

    $sql = "UPDATE alumnos SET nombre_alumno='$nombre_alumno', apellido_alumno='$apellido_alumno', rut_alumno='$rut_alumno' WHERE id_alumno='$id_alumno'";
    
    if (mysqli_query($con, $sql)) {
        sleep(1.5);
        Header("Location: ../../index.php");
    } else {
        echo "Error al actualizar alumno: " . mysqli_error($con);
    }
    
    mysqli_close($con);
}
?>