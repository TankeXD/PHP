<?php
    /*conecta a la base de datos */
    include("../../layouts/config.php");
    $con = connection();
    $id = $_POST["id_reser"];
    $nom_cli = $_POST['nom_cli'];
    $rut = $_POST['rut'];
    $fecha_nac = $_POST['fecha_nac'];
    $telefono = $_POST['telefono'];
    $correo = $_POST['correo'];
    $fecha_salida = $_POST['fecha_salida'];
    $numero_per = $_POST['numero_per'];
    $paquete = $_POST['paquete'];

    /*actualiza al reservas */
    $sql = "UPDATE reservas SET nom_cli='$nom_cli', rut='$rut', fecha_nac='$fecha_nac', telefono='$telefono',
    correo='$correo',fecha_salida='$fecha_salida',numero_per='$numero_per',paquete='$paquete' WHERE id_reser='$id'";
    $query = mysqli_query($con, $sql);

    if ($query) {
        Header("Location: ../../ver_reservas.php");
    } else {
    }
?>