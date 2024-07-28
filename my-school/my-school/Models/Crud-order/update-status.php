<?php
include("../../layouts/config.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $con = connection();

    $id_boleta = $_POST['id_boleta'];
    $status = $_POST['status'];

    $sql = "UPDATE boleta SET estado='$status' WHERE id_boleta='$id_boleta'";
    if (mysqli_query($con, $sql)) {
        echo "Estado actualizado exitosamente";
    } else {
        echo "Error actualizando el estado: " . mysqli_error($con);
    }

    mysqli_close($con);
}
?>