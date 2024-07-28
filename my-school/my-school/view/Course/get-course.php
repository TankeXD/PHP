<?php
include("../../layouts/config.php");
$con = connection();

$id_colegio = $_GET['id_colegio'];

$sql = "SELECT c.*, col.*, l1.id_list, l1.id_curso AS list_1_id_curso, l1.id_producto 
        FROM cursos c 
        INNER JOIN colegio col ON c.id_colegio = col.id_colegio 
        LEFT JOIN (SELECT id_curso, MIN(id_list) AS id_list, MIN(id_producto) AS id_producto 
                   FROM list_1 
                   GROUP BY id_curso) l1 
        ON c.id_curso = l1.id_curso 
        WHERE c.id_colegio = '$id_colegio'";

$result = mysqli_query($con, $sql);
$cursos = array();

while ($row = mysqli_fetch_assoc($result)) {
    $cursos[] = $row;
}

echo json_encode($cursos);
?>
