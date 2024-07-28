<?php
include("../../layouts/config.php");
$con = connection();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar si hay productos seleccionados
    if (!empty($_POST['id_producto_original'])) {
        $id_producto_original = $_POST['id_producto_original'];
        $id_list = $_POST['id_list'];
        $id_alumno = $_POST['id_alumno'];
        $id_new_producto = $_POST['new_product'];
        $nombre_colegio = $_POST['nombre_colegio'];
        $id_curso = $_POST['id_curso'];
        $new_product_radio = $_POST['new_product_radio'];

        // Consulta para extraer la cantidad del producto original.
        $sql = "SELECT cant_prod FROM list_2 WHERE id_list = ?";
        $stmt = $con->prepare($sql);
        $stmt->bind_param("i", $id_list);
        $stmt->execute();
        $result = $stmt->get_result();

        // Verificar si se obtuvieron resultados
        if ($result->num_rows > 0) {
            // Recorrer y procesar los resultados
            while ($row = $result->fetch_assoc()) {
                $cant_prod = $row['cant_prod'];
            }
        } else {
            echo "0 resultados";
        }

        // Eliminar el producto original para después agregar el nuevo con la misma cantidad
        $sql_condicional = "DELETE FROM list_2 WHERE id_list = ?";
        $stmt = $con->prepare($sql_condicional);
        $stmt->bind_param("i", $id_list);
        $stmt->execute();

        // Preparar la consulta de actualización
        $sql_insert = "INSERT INTO list_2 (id_producto, cant_prod, id_alumno) VALUES (?, ?, ?)";
        $stmt = $con->prepare($sql_insert);
        $stmt->bind_param("iii", $new_product_radio, $cant_prod, $id_alumno);
        if (!$stmt->execute()) {
            echo "Error al actualizar la cantidad: " . $stmt->error;
        } else {
            sleep(1.5);
            header("Location: ../../view/Student/list-useful.php?id_curso=$id_curso&id_alumno=$id_alumno&nombre_colegio=$nombre_colegio");
        }
    }
} else {
    echo ("No se seleccionó ningún producto.");
    sleep(1.5);
    //header("Location: ../../view/Student/list-useful.php?id_curso=$id_curso&id_alumno=$id_alumno&nombre_colegio=$nombre_colegio");
}

$con->close();
