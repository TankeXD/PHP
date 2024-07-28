<?php
    // Conecta a la base de datos
    include("../../layouts/config.php");
    $con = connection();

    // Obtener el id_producto de la URL
    $id = $_GET["id_producto"];

    // Eliminar dependencias en list_1 primero
    $sql_delete_list_1 = "DELETE FROM list_1 WHERE id_producto='$id'";
    $query_delete_list_1 = mysqli_query($con, $sql_delete_list_1);

    // Eliminar el producto
    if ($query_delete_list_1) {
        $sql_delete_producto = "DELETE FROM producto WHERE id_producto='$id'";
        $query_delete_producto = mysqli_query($con, $sql_delete_producto);

        if ($query_delete_producto) {
            Header("Location: ../../view/Product/management-product.php");
        } else {
            // Manejo del error si no se pudo eliminar el producto
            echo "Error al eliminar el producto.";
        }
    } else {
        // Manejo del error si no se pudieron eliminar las dependencias
        echo "Error al eliminar las dependencias del producto.";
    }
?>