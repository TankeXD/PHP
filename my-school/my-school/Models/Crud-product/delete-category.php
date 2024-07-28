<?php
    include("../../layouts/config.php");
    $con = connection();

    $data = json_decode(file_get_contents("php://input"), true);
    $id = $data["id_categoria"];

    if (isset($id)) {
        $sql = "DELETE FROM categorias WHERE id_categoria ='$id'";
        $query = mysqli_query($con, $sql);

        if ($query) {
            echo json_encode(["success" => true]);
        } else {
            echo json_encode(["success" => false, "error" => mysqli_error($con)]);
        }
    } else {
        echo json_encode(["success" => false, "error" => "ID no proporcionado"]);
    }
?>