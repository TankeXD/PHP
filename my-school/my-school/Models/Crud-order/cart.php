<?php
include '../../layouts/session.php';
// Incluye el archivo de configuración de la base de datos
include("../../layouts/config.php");



// Verificar el método de solicitud
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Conexión a la base de datos
    $con = connection();

    // Obtener los datos del formulario
    $id_cient = $_SESSION['id_cliente'];
    $id_curso_select = $_POST['id_curso'];
    $id_alumno = $_POST['id_alumno'];
    $numero_aleatorio = mt_rand(1000, 9999);



    $sql_conditional = $con->prepare("SELECT * FROM list_2 WHERE id_alumno = ?");
    $sql_conditional->bind_param("i", $id_alumno);
    $sql_conditional->execute();
    $result = $sql_conditional->get_result();

    // Verificar si la consulta se ejecutó correctamente
    if ($result) {
        // Verificar si hay datos en la tabla list_2
        if ($result->num_rows > 0) {
            // El curso si posee lista
            $id_producto = array();
            $cant_prod = array();
            // Recorrer los resultados y almacenarlos en el arreglo
            while ($row = $result->fetch_assoc()) {
                $id_producto[] = $row['id_producto'];
                $cant_prod[] = $row['cant_prod'];
            }
            $sql_conditional2 = $con->prepare("SELECT * FROM pedidos WHERE id_alumno = ?");
            $sql_conditional2->bind_param("i", $id_alumno);
            $sql_conditional2->execute();
            $result2 = $sql_conditional2->get_result();
            if ($result2->num_rows > 0) {
                //El alumno si posee un pedido
                sleep(1.5);
                header("Location: ../../view/Order/pedido.php?id_alumno=$id_alumno&id_cliente=$id_client");
                exit; // Asegura que el script se detenga después de la redirección
            } else {
                $insert_stmt = $con->prepare("INSERT INTO pedidos (id_prod, cant_prod, id_alumno, cod_pedido, id_cliente) VALUES (?, ?, ?, ?, ?)");
                foreach ($id_producto as $index => $producto) {
                    $cantidad = $cant_prod[$index];
                    $insert_stmt->bind_param("iiiii", $producto, $cantidad, $id_alumno, $numero_aleatorio, $id_cient);
                    $insert_stmt->execute();
                }

                // Cerrar la declaración preparada
                $insert_stmt->close();

                sleep(1.5);
                header("Location: ../../view/Order/pedido.php?id_alumno=$id_alumno&id_cliente=$id_client");
                exit; // Asegura que el script se detenga después de la redirección
            }
        } else {
            //El curso no posee lista
            header("Location: ../Client/maintenance-page.php");
        }
    } else {
        die("Error al ejecutar la consulta SQL: " . mysqli_error($con));
    }
}
