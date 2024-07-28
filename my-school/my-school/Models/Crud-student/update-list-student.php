<?php
include("../../layouts/config.php");
$con = connection();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar si hay productos seleccionados
    if (!empty($_POST['id_producto'])) {
        $id_producto = $_POST['id_producto'];
        $quantities = $_POST['cantidad'];
        $id_curso = $_POST['id_curso'];
        $id_alumno = $_POST['id_alumno'];
        $nombre_colegio = $_POST['nombre_colegio'];
        echo("id producto: ".$id_producto."<br>");
        echo("cantidad: ".$quantities."<br>");
        echo("id curso: ".$id_curso."<br>");
        echo("id alumno: ".$id_alumno."<br>");
        echo("nombre colegio: ".$nombre_colegio."<br>");
        /*
            // Preparar la consulta de selección
        $stmt = $con->prepare("UPDATE list_2 SET cant_prod =? WHERE id_producto =?");
        $stmt->bind_param("ii", $quantities, $id_producto);
        if (!$stmt->execute()) {
                    echo "Error al actualizar la cantidad: " . $stmt->error;
        } else {
            sleep(1.5);
            header("Location: ../../view/Student/list-useful.php?id_curso=$id_curso&id_alumno=$id_alumno&nombre_colegio=$nombre_colegio");
            //?id_curso=$id_curso&id_alumno=$id_alumno&nombre_colegio=$nombre_colegio
        }
      */  
    } else {
        echo ("No se seleccionó ningún producto.");
        sleep(1.5);
        //header("Location: ../../view/Student/list-useful.php?id_curso=$id_curso&id_alumno=$id_alumno&nombre_colegio=$nombre_colegio");
    }
}
$con->close();
