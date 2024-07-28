<?php
    /* Conecta a base de datos */
    include("../../layouts/config.php");
    $con = connection();

    // Obtener datos de la solicitud POST
    $data = json_decode(file_get_contents("php://input"), true);
    $id = $data["id_marca"];

    // Consulta para eliminar la marca
    $sql = "DELETE FROM marcas WHERE id_marca ='$id'";
    $query = mysqli_query($con, $sql);

    // Verificar si la consulta fue exitosa y enviar respuesta
    if($query){
        echo json_encode(["success" => true]);
    } else {
        echo json_encode(["success" => false]);
    }
?>