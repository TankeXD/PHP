<?php 
    include("../../layouts/config.php");

    $con = connection();

    $id = null;
    $marca = $_POST['nombre_marca'];
    $sql = "INSERT INTO marcas (nombre_marca) VALUES ('$marca')";
    $query = mysqli_query($con, $sql);

    if($query){
        sleep(1.5);
        Header("Location: ../../view/Product/management-product.php");

    } else {
        
    }
?>