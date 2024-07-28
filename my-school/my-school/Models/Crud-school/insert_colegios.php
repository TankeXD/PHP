<?php 
    include("../../layouts/config.php");

    $con = connection();

    $id = null;
    $comuna = $_POST['comuna'];
    $colegio = $_POST['colegio'];
    $sql = "INSERT INTO colegio(nombre_colegio,id_comuna) VALUES ('$colegio','$comuna')";
    $query = mysqli_query($con, $sql);

    if($query){
        sleep(1.5);
        Header("Location: ../../view/School/list-school.php");

    } else {
        
    }
?>