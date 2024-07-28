<?php 
    include("../../layouts/config.php");

    $con = connection();

    $id = null;
    $categoria = $_POST['categoria'];
    $sql = "INSERT INTO categorias (nombre_cat) VALUES ('$categoria')";
    $query = mysqli_query($con, $sql);

    if($query){
        sleep(1.5);
        Header("Location: ../../view/Product/management-product.php");

    } else {
        
    }
?>