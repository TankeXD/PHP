<?php
// Incluir el archivo de configuración de la base de datos
include("../../layouts/config.php");

// Verificar si se ha proporcionado un ID de región válido
if(isset($_GET['id_region'])) {
    // Obtener el ID de región de la solicitud
    $idRegion = $_GET['id_region'];

    // Establecer la conexión con la base de datos
    $con = connection();

    // Consulta para obtener las comunas de la región seleccionada
    $sql = "SELECT * FROM comunas WHERE id_region = '$idRegion'";
    $result = mysqli_query($con, $sql);

    // Verificar si se encontraron comunas
    if(mysqli_num_rows($result) > 0) {
        // Crear un array para almacenar las comunas
        $comunas = array();

        // Iterar sobre los resultados y agregar cada comuna al array
        while($row = mysqli_fetch_assoc($result)) {
            $comunas[] = $row;
        }

        // Devolver las comunas en formato JSON
        echo json_encode($comunas);
    } else {
        // Si no se encontraron comunas, devolver un JSON vacío
        echo json_encode(array());
    }

    // Cerrar la conexión con la base de datos
    mysqli_close($con);
} else {
    // Si no se proporcionó un ID de región válido, devolver un JSON vacío
    echo json_encode(array());
}
?>
