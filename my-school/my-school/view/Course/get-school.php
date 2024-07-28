<?php
// Incluir el archivo de configuración de la base de datos
include("../../layouts/config.php");

// Verificar si se ha proporcionado un ID de comuna válido
if(isset($_GET['id_comuna'])) {
    // Obtener el ID de comuna de la solicitud
    $idComuna = $_GET['id_comuna'];

    // Establecer la conexión con la base de datos
    $con = connection();

    // Consulta para obtener los colegios de la comuna seleccionada
    $sql = "SELECT * FROM colegio WHERE id_comuna = '$idComuna'";
    $result = mysqli_query($con, $sql);

    // Verificar si se encontraron colegios
    if(mysqli_num_rows($result) > 0) {
        // Crear un array para almacenar los colegios
        $colegios = array();

        // Iterar sobre los resultados y agregar cada colegio al array
        while($row = mysqli_fetch_assoc($result)) {
            $colegios[] = $row;
        }

        // Devolver los colegios en formato JSON
        echo json_encode($colegios);
    } else {
        // Si no se encontraron colegios, devolver un JSON vacío
        echo json_encode(array());
    }
    // Cerrar la conexión con la base de datos
    mysqli_close($con);
} else {
    // Si no se proporcionó un ID de comuna válido, devolver un JSON vacío
    echo json_encode(array());
}
?>
