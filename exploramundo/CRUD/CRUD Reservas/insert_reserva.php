<?php
    include("../../layouts/config.php");
    $con = connection();

    $id = null;/*la id es auto increment entonces por eso es null se pone automatica */
    $nom_cli = $_POST['nom_cli'];
    $rut = $_POST['rut'];
    $fecha_nac = $_POST['fecha_nac'];
    $telefono = $_POST['telefono'];
    $correo = $_POST['correo'];
    $fecha_salida = $_POST['fecha_salida'];
    $numero_per = $_POST['numero_per'];
    $paquete = $_POST['paquete'];


    $sql = "INSERT INTO reservas VALUES('$id','$nom_cli','$rut','$fecha_nac','$telefono','$correo','$fecha_salida','$numero_per','$paquete')";
    $query = mysqli_query($con, $sql);

    if($query){
        Header("Location: ../../reservas.php");
    }else{

    }
?>