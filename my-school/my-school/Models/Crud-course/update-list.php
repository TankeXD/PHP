<?php
include("../../layouts/config.php");
$con = connection();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar si hay productos seleccionados
    if (!empty($_POST['product'])) {
        $products = $_POST['product'];
        $quantities = $_POST['quantity'];
        $grandTotal = (int)$_POST['grandTotalHidden'];
        $id_curso = $_POST['id_curso'];
        
        foreach ($products as $products_id) {
            print_r($grandTotal); 
            // Preparar la consulta de selección
            $stmt = $con->prepare("SELECT * FROM list_1 INNER JOIN cursos ON list_1.id_curso = cursos.id_curso WHERE list_1.id_producto =? AND cursos.id_curso =?");
            $stmt->bind_param("ii", $products_id, $id_curso);
            $stmt->execute();
            $result = $stmt->get_result();

            // Validar el resultado
            if ($result->num_rows > 0) {
                $quantity = isset($quantities[$products_id])? $quantities[$products_id] : 1;
                // Preparar la consulta de actualización
                $stmt = $con->prepare("UPDATE list_1 SET cant_prod =?, grand_total=? WHERE id_producto =? AND id_curso=?");
                $stmt->bind_param("iiii", $quantity, $grandTotal, $products_id, $id_curso);
                if (!$stmt->execute()) {
                    echo "Error al actualizar la cantidad: ". $stmt->error;
                } else {
                    sleep(1.5);
                    header("Location: ../../view/Product/list-course.php?id_curso=$id_curso");
                }
            } else {
                error_log("Error en la consulta Update: " . mysqli_error($con));
            }
        }
    } else {
        $id_curso = $_POST['id_curso']; // Asegúrate de obtener el id_curso aquí
        echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js'></script>";
        echo "<link href='https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css' rel='stylesheet'>";
        echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'No se seleccionó ningún producto.',
                }).then(() => {
                    window.location.href = '../../view/Product/list-course.php?id_curso=$id_curso';
                });
            });
        </script>";
    }
}
// Cerrar la conexión
$con->close();
?>
