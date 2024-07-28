<?php
    // Conecta a la base de datos
    include("../../layouts/config.php");
    $con = connection();

    // Verificar que se recibieron los parámetros necesarios
    if (isset($_GET["id_comuna"]) && isset($_GET["id_region"])) {
        $id_comuna = $_GET["id_comuna"];
        $id_region = $_GET["id_region"];

        // Preparar y ejecutar la consulta para eliminar la comuna
        $sql = "DELETE FROM comunas WHERE id_comuna = '$id_comuna'";
        $query = mysqli_query($con, $sql);

        if ($query) {
            // Redirigir a la página de regiones después de eliminar la comuna
            header("Location: ../../view/Region/regions?id=" . $id_region);
            exit();
        } else {
            // Manejar el error si la eliminación falla
            echo "Error al eliminar la comuna: " . mysqli_error($con);
        }
    } else {
        echo "Faltan parámetros necesarios para eliminar la comuna.";
    }
?>