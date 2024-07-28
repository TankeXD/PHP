<?php
    /*conecta a base de datos */
    include("../../layouts/config.php");
    $con = connection();
   
   $id=$_GET["id_user"];
   /*Elimina al usuario */
   $sql="DELETE FROM users WHERE id_user='$id'";
   $query = mysqli_query($con, $sql);
   
   if($query){
       Header("Location: ../../ver_Usuarios.php");
   }else{
   
   }
?>