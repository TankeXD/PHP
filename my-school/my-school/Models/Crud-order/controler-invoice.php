<?php
include '../../layouts/session.php';
// Incluye el archivo de configuración de la base de datos
include("../../layouts/config.php");



// Verificar el método de solicitud
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Conexión a la base de datos
    $con = connection();

    // Obtener los datos del formulario
    $id_alumno = $_POST['id_alumno'];



    $sql_conditional = $con->prepare("SELECT * FROM pedidos WHERE id_alumno = ? LIMIT 1");
    $sql_conditional->bind_param("i", $id_alumno);
    $sql_conditional->execute();
    $result = $sql_conditional->get_result();

    // Verificar si la consulta se ejecutó correctamente
    if ($result) {
        // Verificar si hay datos en la tabla list_2
        if ($result->num_rows > 0) {
            // El curso si posee lista
            // Recorrer los resultados y almacenarlos en el arreglo
            while ($row = $result->fetch_assoc()) {
                $cod_pedido = $row['cod_pedido'];
            }

            $sql_conditional_2 = $con->prepare("SELECT * FROM boleta WHERE cod_pedido = ? LIMIT 1");
            $sql_conditional_2->bind_param("i", $cod_pedido);
            $sql_conditional_2->execute();
            $result_2 = $sql_conditional_2->get_result();
            if($result_2){
                while ($row = $result_2->fetch_assoc()) {
                    $fecha_boleta = $row['fecha_boleta'];
                    $total = $row['total'];
                    $nombre_completo = ($row['nombre_boleta']." ".$row['apellido_boleta']);
                }
                header("Location: ../../view/Order/invoice-detail.php?id_alumno=$id_alumno&cod_pedido=$cod_pedido&fecha_boleta=$fecha_boleta&total=$total&nombre_boleta=$nombre_completo");
            }else {
                echo("error al buscar la boleta");
            }
            
                        
        } else {
            //El curso no posee lista
            header("Location: ../Client/maintenance-page.php");
        }
    } else {
        die("Error al ejecutar la consulta SQL: " . mysqli_error($con));
    }
}
