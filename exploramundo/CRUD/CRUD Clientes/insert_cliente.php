<?php
    include("../../layouts/config.php");
    $con = connection();

    $id = null;/*la id es auto increment entonces por eso es null se pone automatica */
    $nombre_com = $_POST['nombre_com'];
    $rut = $_POST['rut'];
    $fecha_nac = $_POST['fecha_nac'];
    $celular = $_POST['celular'];
    $email = $_POST['email'];
    $direccion = $_POST['direccion'];
    


    $sql = "INSERT INTO clientes VALUES('$id','$nombre_com','$rut','$fecha_nac','$celular','$email','$direccion')";
    $query = mysqli_query($con, $sql);

    if($query){
        Header("Location: ../../clientes.php");
    }else{

    }
?>