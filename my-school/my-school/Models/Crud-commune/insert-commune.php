<?php
include("../../layouts/config.php");
$con = connection();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_region = $_POST['id_region'];
    $nombre_comuna = $_POST['nombre_comuna'];

    $sql = "INSERT INTO comunas (nombre_comuna, id_region) VALUES ('$nombre_comuna', '$id_region')";
    if (mysqli_query($con, $sql)) {
        echo "Comuna agregada exitosamente.";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($con);
    }

    mysqli_close($con);
    sleep(1.5);
    header("Location: ../../view/Region/regions?id=$id_region");
    exit();
}
?>