<?php
/* Conecta a base de datos */
include("../../layouts/config.php");
$con = connection();

$id = isset($_GET['id_list']) ? $_GET['id_list'] : null;
$id_curso = isset($_GET['id_curso']) ? $_GET['id_curso'] : null;

if ($id !== null && $id_curso !== null) {
    /* Elimina el usuario */
    $sql = "DELETE FROM list_1 WHERE id_list='$id'";
    $query = mysqli_query($con, $sql);

    if ($query) {
        // Redirecciona a la lista de curso con el id_curso
        Header("Location: ../../view/Product/list-course.php?id_curso=" . $id_curso);
        exit();
    } else {
        error_log("Error en la consulta DELETE: " . mysqli_error($con));
    }
} else {
    error_log("ID de lista o curso no proporcionado.");
}
?>