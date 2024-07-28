<?php
/* Conecta a base de datos */
include("../../layouts/config.php");
$con = connection();

$id = isset($_GET['id_list']) ? $_GET['id_list'] : null;
$id_curso = isset($_GET['id_curso']) ? $_GET['id_curso'] : null;
if ($id_curso !== null) {
    /* Elimina la lista */
    $sql = "DELETE FROM list_1 WHERE list_1.id_curso = $id_curso";
    $query = mysqli_query($con, $sql);

    if ($query) {
        // Redirecciona a la lista de curso con el id_curso
        sleep(1.5);
        Header("Location: ../../view/Course/filter-course.php");
    } else {
        echo("Error en la consulta DELETE: " . mysqli_error($con));
    }
} else {
    echo("ID de lista o curso no proporcionado.");
}
?>