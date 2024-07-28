<?php
    include("../../layouts/config.php");
    $con = connection();

    $id = null;/*la id es auto increment entonces por eso es null se pone automatica */
    $nombre_prod = $_POST['nombre_prod'];
    $precio_prod = $_POST['precio_prod'];    
    $stock_prod = $_POST['stock_prod'];
    $descripcion_prod = $_POST['descripcion_prod'];
    $categoria = $_POST['id_categoria'];
    $marca = $_POST['id_marca'];
    $img = '';
    if (isset($_POST['id_categoria'])) {
        
    }else {
        die("No se ha enviado la categoria");
    }
     // Mostrar errores para depuración
     ini_set('display_errors', 1);
     ini_set('display_startup_errors', 1);
     error_reporting(E_ALL);
 
     if (isset($_FILES['img_prod']) && $_FILES['img_prod']['error'] === UPLOAD_ERR_OK) {
         $file = $_FILES['img_prod'];
         $nombre = $file['name'];
         $tipo = $file['type'];
         $ruta_temporal = $file['tmp_name'];
         $size = $file['size'];
         $carpeta = "/my-school/assets/images/products/";
 
        // Verificar y crear la carpeta de destino si no existe
        $carpeta_absoluta = $_SERVER['DOCUMENT_ROOT'] . $carpeta;
        if (!is_dir($carpeta_absoluta)) {
            mkdir($carpeta_absoluta, 0777, true);
        }

        // Validar el tipo de archivo
        $allowed_types = ['image/jpg', 'image/jpeg', 'image/png'];
        if (!in_array($tipo, $allowed_types)) {
            die("El archivo no es una imagen permitida.");
        }

        // Validar el tamaño del archivo (máximo 3MB)
        if ($size > 3 * 1024 * 1024) {
            die("El tamaño de la imagen es superior a 3MB.");
        }

        // Mover el archivo a la carpeta de destino
        $src = $carpeta_absoluta . $nombre;
        if (move_uploaded_file($ruta_temporal, $src)) {
            $img = $carpeta . $nombre;
        } else {
            die("Error al mover el archivo cargado.");
        }
    } else {
        if (isset($_FILES['img_prod']['error']) && $_FILES['img_prod']['error'] !== UPLOAD_ERR_OK) {
            die("Error al subir el archivo: " . $_FILES['img_prod']['error']);
        } else {
            die("No se ha enviado ningún archivo.");
        }
    }

    $sql = "INSERT INTO producto (nombre_prod, ruta_img, precio_prod, stock_prod , descripcion_prod, id_categoria, id_marca) VALUES ('$nombre_prod','$img', '$precio_prod','$stock_prod','$descripcion_prod', $categoria, $marca)";
    $query = mysqli_query($con, $sql);

    if ($query) {
        sleep(1.5);
        header("Location: ../../view/Product/management-product.php");
    } else {
        die("Error al ejecutar la consulta SQL: " . mysqli_error($con));
    }
?>