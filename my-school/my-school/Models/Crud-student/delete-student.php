<?php
// Conecta a la base de datos
include("../../layouts/config.php");
$con = connection();

// Obtén el ID del alumno a eliminar
$id = $_GET['id_alumno'];
echo ("id alumno" . $id);
// Preparar la consulta de selección
$stmt = $con->prepare("SELECT * FROM pedidos WHERE id_alumno =? LIMIT 1");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
// Validar el resultado
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $cod_pedido = $row['cod_pedido'];
    }
}

$sql_boleta = "DELETE FROM boleta WHERE cod_pedido='$cod_pedido'";
$quert_boleta = mysqli_query($con, $sql_boleta);
// Elimina al usuario y maneja la FK si es necesario
$sql_pedido = "DELETE FROM pedidos WHERE id_alumno='$id'";
$query_pedido = mysqli_query($con, $sql_pedido);
if ($query_pedido) {
    echo ("si se borro de pedidos");
}
$sql_list = "DELETE FROM list_2 WHERE id_alumno='$id'";
$query_list = mysqli_query($con, $sql_list);
if ($sql_list) {
    echo ("si se borro lista");
}

// Puedes realizar consultas adicionales para eliminar referencias o configurar eliminación en cascada
$sql = "DELETE FROM alumnos WHERE id_alumno='$id'";
$query = mysqli_query($con, $sql);

if ($query) {
    // Redirige a la página principal después de eliminar
    Header("Location: ../../index.php");
} else {
    // Manejo de errores si la eliminación falla
    echo "Error al intentar eliminar el alumno.";
}
