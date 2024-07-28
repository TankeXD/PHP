<?php
include("../../layouts/config.php");
$con = connection();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar si hay productos seleccionados
    if (!empty($_POST['product'])) {
        $products = $_POST['product'];
        $quantities = $_POST['quantity'];
        $id_curso = $_POST['id_curso'];
        $id_alumno = $_POST['id_alumno'];
        $nombre_colegio = $_POST['nombre_colegio'];
        foreach ($products as $products_id) {
            // Preparar la consulta de selección
            $stmt = $con->prepare("SELECT * FROM list_2 INNER JOIN alumnos ON list_2.id_alumno = alumnos.id_alumno WHERE list_2.id_producto =? AND alumnos.id_alumno =?");
            $stmt->bind_param("ii", $products_id, $id_alumno);
            $stmt->execute();
            $result = $stmt->get_result();

            // Validar el resultado
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    // Ahora puedes acceder a los datos de la fila actual
                    $unidades = $row['cant_prod'];
                }
                $quantity = isset($quantities[$products_id])? $quantities[$products_id] : 1;
                $total = $unidades + $quantity;
                // Preparar la consulta de actualización
                $stmt = $con->prepare("UPDATE list_2 SET cant_prod =? WHERE id_producto =?");
                $stmt->bind_param("ii", $total, $products_id);
                if (!$stmt->execute()) {
                    echo "Error al actualizar la cantidad: ". $stmt->error;
                } else {
                    sleep(1.5);
                    header("Location: ../../view/Student/list-useful.php?id_curso=$id_curso&id_alumno=$id_alumno&nombre_colegio=$nombre_colegio");
                    //?id_curso=$id_curso&id_alumno=$id_alumno&nombre_colegio=$nombre_colegio
                }
            } else {
                // Preparar la consulta de inserción
                $stmt = $con->prepare("INSERT INTO list_2 (id_producto, cant_prod, id_alumno) VALUES (?,?,?)");
                $quantity = isset($quantities[$products_id])? $quantities[$products_id] : 1;
                $stmt->bind_param("iii", $products_id, $quantity, $id_alumno);
                if (!$stmt->execute()) {
                    echo "Error al guardar el producto $products_id: ". $stmt->error;
                } else {
                    sleep(1.5);
                    header("Location: ../../view/Student/list-useful.php?id_curso=$id_curso&id_alumno=$id_alumno&nombre_colegio=$nombre_colegio");
                }
            }
        }
    }
}
?>