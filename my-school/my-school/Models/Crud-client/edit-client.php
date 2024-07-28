<?php
    /*conecta a la base de datos */
    include("../../layouts/config.php");
    $con = connection();
    $id = $_POST["id_cliente"];
    $nombre = $_POST['nombre'];
    $apellido = $_post['apellido'];
    $rut = $_POST['rut'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $hashpassword = password_hash($password, PASSWORD_BCRYPT, ['cost' => 10]);//para hashear la contraseña ingresada nueva
    echo($hashpassword);
   

    /*actualiza al clientes */
    $sql = "UPDATE clientes SET nombre='$nombre', apellido='$apellido', rut='$rut',
    email='$email', password='$hashpassword' WHERE id_cliente='$id'";
    $query = mysqli_query($con, $sql);

    if ($query) {
        Header("Location: ../../index.php");
    } else {
    }
?>