<?php
    /*conecta a la base de datos */
    include("../../layouts/config.php");
    $con = connection();


    $id = $_POST["id_user"];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $fecha_nac = $_POST['fecha_nac'];
    $rol = $_POST['rol'];

    /*actualiza al usuario */
    $sql = "UPDATE users SET username='$username', password='$password', email='$email', fecha_nac='$fecha_nac', rol='$rol' WHERE id_user='$id'";
    $query = mysqli_query($con, $sql);

    if ($query) {
        Header("Location: ../../ver_Usuarios.php");
    } else {
    }
?>