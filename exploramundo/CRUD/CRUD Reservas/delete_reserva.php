<?php
    /*conecta a base de datos */
    include("../../layouts/config.php");
    $con = connection();
   
   $id=$_GET["id_reser"];
   /*Elimina al usuario */
   $sql="DELETE FROM reservas WHERE id_reser='$id'";
   $query = mysqli_query($con, $sql);
   
   if($query){
       Header("Location: ../../ver_reservas.php");
   }else{
   
   }
?>