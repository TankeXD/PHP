<?php
    /*conecta a la base de datos */
    include("../../layouts/config.php");
    $con = connection();
    $id = $_POST["id_cliente"];
    $nombre_com = $_POST['nombre_com'];
    $rut = $_POST['rut'];
    $fecha_nac = $_POST['fecha_nac'];
    $celular = $_POST['celular'];
    $email = $_POST['email'];
    $direccion = $_POST['direccion'];
   

    /*actualiza al clientes */
    $sql = "UPDATE clientes SET nom_cliente='$nombre_com', rut='$rut', fecha_nac='$fecha_nac', celular='$celular',
    email='$email',direccion='$direccion' WHERE id_cliente='$id'";
    $query = mysqli_query($con, $sql);

    if ($query) {
        Header("Location: ../../ver_clientes.php");
    } else {
    }
?>