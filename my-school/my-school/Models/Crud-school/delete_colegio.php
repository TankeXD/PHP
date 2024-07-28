<?php
    /*conecta a base de datos */
    include("../../layouts/config.php");
    $con = connection();
   
    $id=$_GET["id_colegio"];
   
    $sql="DELETE FROM colegio WHERE id_colegio ='$id'";
    $query = mysqli_query($con, $sql);
   
    if($query){
       Header("Location: ../../view/School/list-school.php");
    }else{

   }
?>