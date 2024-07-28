<?php
    include("../../layouts/config.php");
    $con = connection();

    $id = null;/*la id es auto increment entonces por eso es null se pone automatica */
    $username = $_POST['username'];
    $password = $_POST['password'];
    $hashpassword = password_hash($password, PASSWORD_BCRYPT, ['cost' => 10]);
    echo($hashpassword);
    $email = $_POST['email'];
    $fecha_nac = $_POST['fecha_nac'];
    $rol = $_POST['rol'];

    $sql = "INSERT INTO users VALUES('$id','$username','$hashpassword','$email','$fecha_nac','$rol')";
    $query = mysqli_query($con, $sql);

    if($query){
        Header("Location: ../../Usuario.php");
    }else{

    }
?>