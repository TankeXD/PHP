<?php
    /*conecta a base de datos */
    include("../../layouts/config.php");
    $con = connection();
   
   $id=$_GET["id_pack"];
   /*Elimina al usuario */
   $sql="DELETE FROM paquetes WHERE id_pack='$id'";
   $query = mysqli_query($con, $sql);
   
   if($query){
       Header("Location: ../../ver_paquetes.php");
   }else{
   
   }
?>