<?php
    /*conecta a la base de datos */
    include("../../layouts/config.php");
    $con = connection();

    $id = $_POST["id_user"];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $hashpassword = password_hash($password, PASSWORD_BCRYPT, ['cost' => 10]);//para hashear la contraseña ingresada nueva
    echo($hashpassword);
    $email = $_POST['email'];
    $rol = $_POST['rol'];

    /*actualiza al usuario */
    $sql = "UPDATE users SET username='$username', password='$hashpassword', email='$email', rol='$rol' WHERE id_user='$id'";
    $query = mysqli_query($con, $sql);

    if ($query) {
        sleep(1.5);
        Header("Location: ../../view/Admin/view-admins.php");
    } else {
    }
?>