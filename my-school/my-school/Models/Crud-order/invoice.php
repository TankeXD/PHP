<?php
session_start();
$id_cliente = isset($_SESSION['id_cliente']) ? $_SESSION['id_cliente'] : null;
include('../../layouts/config.php');
$con = connection();

$nombre = $_POST['nombre'];
$apellido = $_POST['apellidos'];
$nombre_completo = $nombre." ".$apellido;
$email = $_POST['email'];
$fono = $_POST['fono'];
$direccion = $_POST['direccion'];
$descripcion = $_POST['descripcion'];
$numero_tarjeta = $_POST['numero_tarjeta'];
$fecha_exp = $_POST['fecha_exp'];
$ccv = $_POST['ccv'];
$id_alumno = $_POST['id_alumno'];
$total = 0;

$sql_colegio = $con->prepare("SELECT * FROM pedidos INNER JOIN producto WHERE pedidos.id_alumno = ? and pedidos.id_prod = producto.id_producto");
    $sql_colegio->bind_param("i", $id_alumno);
    $sql_colegio->execute();
    $result = $sql_colegio->get_result();

if ($result) {
    while ($row = $result->fetch_assoc()) {
        $tot_prod = $row['precio_prod'] * $row['cant_prod'];
        $total_prod += $tot_prod;
        $cod_pedido = $row['cod_pedido'];
    }
}
$servicio = ($total_prod * 12.5)/100;
$total = $total_prod + $servicio;

if (isset($_POST['id_alumno'])) {
    $sql = "INSERT INTO boleta (nombre_boleta, apellido_boleta, email_boleta, tel_boleta, direccion_boleta, descripcion_direc, cod_pedido, total) VALUES ('$nombre', '$apellido', '$email', $fono, '$direccion', '$descripcion', $cod_pedido, $total)";
$query = mysqli_query($con, $sql);

if ($query) {
    $sql_payment = "INSERT INTO tarjeta (titular_tarjeta, numero_tarjeta, fecha_tarjeta, cvv, id_cliente) VALUES ('$nombre_completo', $numero_tarjeta, $fecha_exp, $ccv, $id_cliente)";
    $query_payment = mysqli_query($con, $sql_payment);
    if ($query_payment) {
        sleep(1.5);
        header("Location: ../../view/Order/invoice-detail.php?id_alumno=$id_alumno&cod_pedido=$cod_pedido&total=$total&numero_tj=$numero_tarjeta&nombre_boleta=$nombre_completo");
    }
    
} else {
    die("Error al ejecutar la consulta SQL: " . mysqli_error($con));
}
}else {
    die("No se ha enviado la id del cliente $id_cliente");

}

?>