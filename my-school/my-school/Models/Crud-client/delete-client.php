<?php
    //conecta a base de datos
    include("../../layouts/config.php");
    $con = connection();

   $id=$_GET["id_cliente"];
   //Elimina al usuario
   $sql_conditional="DELETE FROM alumnos WHERE id_cliente='$id'"; 
   $query_conditional = mysqli_query($con, $sql_conditional);
   $sql="DELETE FROM clientes WHERE id_cliente='$id'";
   $query = mysqli_query($con, $sql);

   if($query){
       Header("Location: ../../view/Client/view-clients.php");
   }else{

   }
?>