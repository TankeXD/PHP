<?php
    include("../../layouts/config.php");
    $con = connection();

    $id = null;/*la id es auto increment entonces por eso es null se pone automatica */
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


    $sql = "INSERT INTO paquetes VALUES('$id','$nom_pack','$destino','$fecha_salida','$fecha_llegada','$info','$precio','$inclusion','$fecha_public','$fecha_expi','$img')";
    $query = mysqli_query($con, $sql);

    if($query){
        Header("Location: ../../paquetes.php");
    }else{

    }
?>