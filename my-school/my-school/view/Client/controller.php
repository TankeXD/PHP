<?php include '../../layouts/config.php';
$con = connection();
$curso = $_GET['id_curso'];
$id_alumno = $_GET['id_alumno'];
$nombre_colegio = $_GET['nombre_colegio'];


    $sql_conditional = $con->prepare("SELECT * FROM list_1 WHERE id_curso = ?");
    $sql_conditional->bind_param("i", $curso);
    $sql_conditional->execute();
    $result = $sql_conditional->get_result();
    
    // Verificar si la consulta se ejecutó correctamente
    if ($result) {
        // Verificar si hay datos en la tabla list_1
        if ($result->num_rows > 0) {
            // El curso si posee lista
            $id_producto = array();
            $cant_prod = array();
            // Recorrer los resultados y almacenarlos en el arreglo
            while ($row = $result->fetch_assoc()) {
                $id_producto[] = $row['id_producto'];
                $cant_prod[] = $row['cant_prod'];
            }
            $sql_conditional2 = $con->prepare("SELECT * FROM list_2 WHERE id_alumno = ?");
            $sql_conditional2->bind_param("i", $id_alumno);
            $sql_conditional2->execute();
            $result2 = $sql_conditional2->get_result();
            if ($result2->num_rows > 0) {
                //El alumno si posee lista
                header("Location: ../Student/list-useful.php?id_curso=$curso&id_alumno=$id_alumno&nombre_colegio=$nombre_colegio");
                exit; // Asegura que el script se detenga después de la redirección
            }else{
            $insert_stmt = $con->prepare("INSERT INTO list_2 (id_alumno, id_producto, cant_prod) VALUES (?, ?, ?)");
            foreach ($id_producto as $index => $producto) {
                $cantidad = $cant_prod[$index];
                $insert_stmt->bind_param("iii", $id_alumno, $producto, $cantidad);
                $insert_stmt->execute();
            }

            // Cerrar la declaración preparada
            $insert_stmt->close();

            sleep(1.5);
            header("Location: ../Student/list-useful.php?id_curso=$curso&id_alumno=$id_alumno&nombre_colegio=$nombre_colegio");
            exit; // Asegura que el script se detenga después de la redirección
        }
        } else {
            //El curso no posee lista
            header("Location: ../Client/maintenance-page.php");
        }
    } else {
        die("Error al ejecutar la consulta SQL: " . mysqli_error($con));
    }
?>