<?php
    /*conecta a la base de datos */
    include("../../layouts/config.php");
    $con = connection();
    $id = $_POST["id_pack"];
    $nom_pack = $_POST['nom_pack'];
    $destino = $_POST['destino'];
    $fecha_salida = $_POST['fecha_salida'];
    $fecha_llegada = $_POST['fecha_llegada'];
    $info = $_POST['info'];
    $precio = $_POST['precio'];
    $inclusion = $_POST['inclusion'];
    $fecha_public = $_POST['fecha_public'];
    $fecha_expi = $_POST['fecha_expi'];
    $img = $_POST['img'];

    /*actualiza al paquete */
    $sql = "UPDATE paquetes SET nom_pack='$nom_pack', destino='$destino', fecha_salida='$fecha_salida', fecha_llegada='$fecha_llegada',
    info='$info',precio='$precio',inclusion='$inclusion',fecha_public='$fecha_public',fecha_expi='$fecha_expi',img='$img' WHERE id_pack='$id'";
    $query = mysqli_query($con, $sql);

    if ($query) {
        Header("Location: ../../ver_paquetes.php");
    } else {
    }
?>